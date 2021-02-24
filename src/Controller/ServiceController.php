<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="service")
     */
    public function index(ServiceRepository $srepo): Response
    {
        return $this->render('service/index.html.twig', [
            'services'=>$srepo->findAll()
        ]);
    }
}
