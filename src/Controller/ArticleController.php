<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article_list")
     */
    public function list()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'pouet',
        ]);
    }

    /**
     * @Route("/article/{id<\d+>}", name="article_show")
     */
    public function show(Article $article)
    {
        return $this->render('article/single.html.twig', [
            'article' => $article
        ]);
    }
}
