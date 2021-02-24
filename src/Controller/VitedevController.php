<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VitedevController extends AbstractController
{
    /**
     * @Route("/vitedev", name="vitedev")
     */
    public function index(): Response
    {
        return $this->render('vitedev/index.html.twig', [
            'controller_name' => 'VitedevController',
        ]);
    }
}
