<?php

namespace App\Controller;

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
    public function show(Request $request, ArticleRepository $articleRepository)
    {
        // Récupère l'ID demandé par l'utilisateur dans l'URL de la requête
        $id = $request->attributes->get('id');

        // Récupère l'article avec l'ID désiré dans la base de données
        $article = $articleRepository->find($id);

        if (is_null($article)) {
            throw $this->createNotFoundException('Article #' . $id . ' does not exist');
        }

        return $this->render('article/single.html.twig', [
            'article' => $article
        ]);
    }
}
