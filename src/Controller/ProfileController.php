<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commande;
use App\Entity\CommandeArticle;
use App\Form\CommandeArticleType;
use App\Repository\CommandeRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

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
        if (!$commande) {
            $commande = new Commande();
            $commande->setIsOut(false);
            $commande->setDoAt( new \DateTime());
            $commande->setMakeBy($this->getUser());
            dd($commande);
            $em->persist($commande);
            $em->flush();
        }
        //On verifie s'il existe un article de ce genre dans le panier courant
        if ($commande->hasArticle($article)) {
            $this->addFlash('success',"l'article existe");
            return $this->redirectToRoute('profile');
        }
        $cmdArt= new CommandeArticle();
        $cmdArt->setArticle($article);
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

}
