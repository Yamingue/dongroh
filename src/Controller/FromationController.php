<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Inscription;
use App\Entity\Notification;
use App\Form\InscriptionType;
use App\Repository\FormationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FromationController extends AbstractController
{
    private $paginator;

    public function __construct( PaginatorInterface $paginator )
    {
        $this->paginator = $paginator;
        
    }
    /**
     * @Route("/formation", name="formation")
     */
    public function index(FormationRepository $fRepo,Request $req): Response
    {

        $pagination = $this->paginator->paginate(
            $fRepo->findNotExpire(), /* query NOT result */
            $req->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('fromation/index.html.twig', [
            'formations' => $pagination,
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
            $this->addFlash('success',"Inscription réussit. Merci");

            return $this->redirectToRoute('formation');
        }
        return $this->render("fromation/view.html.twig",[
            "formation"=>$f,
            "form"=>$form->createView(),
            'notif'=>0
        ]);
    }
}
