<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    const AMOUNT = 5;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $user = new User();

        $user
            ->setEmail('admin@test.com')
            ->setUsername('admin')
            ->setPassword('admin')
        ;

        $manager->persist($user);

        for ($i = 0; $i < self::AMOUNT; $i += 1) {
            $user = new User();

            $user
                ->setEmail($faker->email())
                ->setUsername($faker->userName())
                ->setPassword($faker->password())
            ;

            $manager->persist($user);
        }
        
        $manager->flush();
    }
}
