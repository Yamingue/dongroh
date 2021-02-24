<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\CommandeArticle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="profile")
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'notif' => '',
        ]);
    }
    /**
     * @Route("/panier_add_{id}", name="profile_add_to_panier")
     */
    public function panier_add(Article $article=null): Response
    {
        $cmdArt= new CommandeArticle();
        return $this->render('profile/index.html.twig', [
            'notif' => '',
        ]);
    }
}
