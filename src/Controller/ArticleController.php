<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/article", name="article_")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("", name="list")
     */
    public function list(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();

        return $this->render('article/list.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/{id<\d+>}", name="show")
     */
    public function show(Article $article)
    {
        return $this->render('article/single.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/create", methods={"GET"}, name="new_form")
     */
    public function newForm(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('article/edit.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/create", methods={"POST"}, name="process_new")
     */
    public function processNew(
        Request $request,
        CategoryRepository $categoryRepository,
        EntityManagerInterface $entityManager,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $article = new Article();

        $category = $categoryRepository->find($request->request->get('category'));

        $article
            ->setTitle($request->request->get('title'))
            ->setCover($request->request->get('cover'))
            ->setContent($request->request->get('content'))
            ->setAuthor($this->getUser())
            ->setCategory($category)
        ;

        $entityManager->persist($article);

        $entityManager->flush();
        
        return new RedirectResponse($urlGenerator->generate('article_show', ['id' => $article->getId()]));
    }
}
