<?php

namespace App\Controller\Admin;

use App\Entity\CheckOut;
use App\Entity\Commande;
use App\Repository\CheckOutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminCommandeController extends AbstractController
{
    /**
     * @Route("/order", name="admin_commande")
     */
    public function index(CheckOutRepository $co): Response
    {
        return $this->render('admin_commande/index.html.twig', [
            'commandes' =>$co->findAll(),
        ]);
    }

    /**
     * @Route("/order-more-{id}", name="admin_commande_detaille")
     */
    public function detaille(CheckOut $c=null): Response
    {
        if (!$c) {
            return $this->redirectToRoute('admin_commande');
        }
        return $this->render('admin_commande/detaille.html.twig', [
            'commande' => $c,
        ]);
    }
}
