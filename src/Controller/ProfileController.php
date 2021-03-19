<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\CheckOut;
use App\Entity\Commande;
use App\Form\CheckOutType;
use App\Entity\CommandeArticle;
use App\Form\CommandeArticleType;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="profile")
     */
    public function index(CommandeRepository $cr): Response
    {
        //dd($cr->findNotOut($this->getUser()));
        // $cmd = $cr->findNotOut($this->getUser());
        // dd($cmd->getArticles()[0]);
        return $this->render('profile/index.html.twig', [

            'notif' => '',
            'commande' => $cr->findNotOut($this->getUser()),
        ]);
    }
    /**
     * @Route("/panier_add_{id}", name="profile_add_to_panier")
     */
    public function panier_add(Article $article=null,CommandeRepository $cr,Request $req): Response
    {
        $em= $this->getDoctrine()->getManager();
        /**
         * @var Commande
         */
        $commande = $cr->findNotOut($this->getUser());
        //dd($commande);
        /**
         * creations d'une commande
         */
        if (!$commande) {
            $commande = new Commande();
            $commande->setIsOut(false);
            $commande->setDoAt( new \DateTime());
            $commande->setMakeBy($this->getUser());
            //dd($commande);
            $em->persist($commande);
            $em->flush();
        }
        //On verifie s'il existe un article de ce genre dans le panier courant
        if ($commande->hasArticle($article)) {
            $this->addFlash('success',"l'article existe");
            return $this->redirectToRoute('profile');
        }
        $cmdArt= new CommandeArticle();
        $cmdArt->addArticle($article);
        $cmdArt->setQte(1);
        $commande->addArticle($cmdArt);
        $form = $this->createForm(CommandeArticleType::class,$cmdArt);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cmdArt);
            $em->persist($commande);
            $em->flush();
            $this->addFlash('success','bien ajouter');
            return $this->redirectToRoute('profile');
        }
        return $this->render('profile/add.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/remove-item-{id}", name="profile_remove_items")
     */
    public function remove_article(CommandeArticle $ca=null,CommandeRepository $cr)
    {
        $cm = $cr->findNotOut($this->getUser());
        if ($ca) {
           // dump(count($cm->getArticles()));
            $cm->removeArticle($ca);
            $em = $this->getDoctrine()->getManager();
           // dump($ca);
            $em->persist($cm);
            $em->remove($ca);
            $em->flush();

            //dd(count($cm->getArticles()));
        }
        return $this->redirectToRoute('profile');
    }

    /**
     * @Route("/check-out", name="profile_check_out")
     */
    public function check_out(Request $req,CommandeRepository $cr)
    {
        /**
         * @var User
         */
        $user= $this->getUser();
        $commande =$cr->findNotOut($this->getUser());
        if (!$commande) {
            $this->addFlash('error',"Votre panier est vide");
            return $this->redirectToRoute('profile');
        }
        $out = new CheckOut();
        $out->setEmail($user->getEmail());
        $out->setTelephone($user->getNumero());
        $out->setNom($user->getUsername());
        $out->setCommande($commande);
        $form = $this->createForm(CheckOutType::class,$out);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $out->setDoAt(new \DateTime());
            $commande->setIsOut(true);
            $em= $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->persist($out);
            $em->flush();
            $this->addFlash('success',"Commande effectuer");
            return $this->redirectToRoute('profile');
        }
        //dd($out);
        return $this->render('profile/out.html.twig',[
            'form'=>$form->createView(),

        ]);
    }

}
