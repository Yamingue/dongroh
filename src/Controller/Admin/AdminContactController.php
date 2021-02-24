<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/contact")
 */
class AdminContactController extends AbstractController
{
    private $cr;
    public function __construct( ContactRepository $cr )
    {
        $this->cr = $cr;
        
    }

    /**
     * @Route("/", name="admin_contact")
     */
    public function index(): Response
    {
        return $this->render('admin_contact/index.html.twig', [
            'contacts' => $this->cr->findAll(),
            'messages' => $this->cr->findNotRead()
        ]);
    }
    /**
     * @Route("/remove-{id}", name="admin_contact_remove")
     */
    public function remove(Contact $c): Response
    {
        if ($c) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($c);
            $em->flush();
        }
        return $this->redirectToRoute('admin_contact');
    }

    /**
     * @Route("/view-{id}", name="admin_contact_view")
     */
    public function view(Contact $c): Response
    {
       
       if (!$c->getIsRead()) {
            $c->setIsRead(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($c);
            $em->flush();
           # code...
       }
        return $this->render('admin_contact/view.html.twig', [
            'contact' => $c,
            'messages' => $this->cr->findNotRead()
        ]);
    }
}
