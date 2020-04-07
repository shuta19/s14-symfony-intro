<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("", name="list")
     */
    public function list()
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/{id<\d+>}", name="show")
     */
    public function show(Category $category)
    {
        return $this->render('category/single.html.twig', [
            'category' => $category,
        ]);
    }
}
