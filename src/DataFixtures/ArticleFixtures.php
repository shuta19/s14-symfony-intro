<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker;

class ArticleFixtures extends Fixture
{
    const AMOUNT = 15;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < self::AMOUNT; $i += 1) {
            $article = new Article();

            $createdAt = $faker->dateTime();
            $updatedAt = $faker->dateTimeBetween($createdAt, 'now');

            $article
                ->setTitle($faker->catchphrase())
                ->setCover('https://i.picsum.photos/id/' . rand(0, 1000) . '/1280/768.jpg')
                ->setContent($faker->realText(500))
                ->setCreatedAt($createdAt)
                ->setUpdatedAt($updatedAt)
            ;
            
            $manager->persist($article);
        }

        $manager->flush();
    }
}
