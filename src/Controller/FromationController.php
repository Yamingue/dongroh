<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Inscription;
use App\Entity\Notification;
use App\Form\InscriptionType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FromationController extends AbstractController
{
    /**
     * @Route("/formation", name="formation")
     */
    public function index(FormationRepository $fRepo): Response
    {

        return $this->render('fromation/index.html.twig', [
            'formations' => $fRepo->findAll(),
            'notif'=>0,
        ]);
    }
    /**
     * @Route("/formation-view-{id}", name="formation_view")
     */
    public function view(Formation $f = null,Request $req)
    {
        $insc = new Inscription();
        $insc->setFormation($f);
        $f->addInscription($insc);
        $form = $this->createForm(InscriptionType::class,$insc);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            # Ajout de l'inscription a la formation
            $f->addInscription($insc);
            #persister l'inscription 
            $em = $this->getDoctrine()->getManager();
            $em->persist($insc);
            $em->persist($f);
            $em->flush();
            #notifier l'administrateur de l'inscription
            $n = new Notification();
            $n->setTitre("Inscription a une formation par ".$insc->getNom());
            $n->setMessage($this->render('notification/formation.html.twig',[
                'formation'=>$f,
                'inscription'=>$insc
            ]));
            $n->setState(false);
            $em->persist($n);
            $em->flush();
            #faire une notification visuel a l'utilisateur de l'inscription
            $this->addFlash('succes',"Inscription réussit. Merci");

            return $this->redirectToRoute('formation');
        }
        return $this->render("fromation/view.html.twig",[
            "formation"=>$f,
            "form"=>$form->createView(),
            'notif'=>0
        ]);
    }
}
