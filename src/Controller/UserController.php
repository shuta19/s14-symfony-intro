<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/{id<\d+>}", name="show")
     */
    public function show(User $user)
    {
        return $this->render('user/single.html.twig', [
            'user' => $user,
            'articles' => $user->getArticles()
        ]);
    }
}
