<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $req): Response
    {
        $contact = new Contact();
        $contact->setSujet('demande de site web marketing');
        $contact->setIsRead(false);
        if ($this->getUser()) {
           $contact->setEmail($this->getUser()->getEmail());
        }

        $form = $this->createForm(ContactType::class,$contact);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            # code...
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
