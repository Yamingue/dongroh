<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="service")
     */
    public function index(ServiceRepository $srepo,Request $req): Response
    {
        $c = new Contact();
        $form = $this->createForm(ContactType::class,$c);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            # code...
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
        }
        return $this->render('service/index.html.twig', [
            'services'=>$srepo->findAll(),
            'form'=>$form->createView()
        ]);
    }
}
