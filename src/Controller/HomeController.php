<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\NoteArticle;
use App\Form\NoteArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\BanierImageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/market")
 */
class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $arRepo, BanierImageRepository $bR, CategorieRepository $cr): Response
    {
        //
        // $om = $this->getDoctrine()->getManager();
        // for ($i=0; $i <10 ; $i++) { 
        //     # code...
        //     $cat = new Categorie();
        //     $cat->setNom("Categories $i");
        //     $om->persist($cat);
        //     $om->flush();

        // }


        return $this->render('home/index.html.twig', [
            'articles' => $arRepo->findAll(),
            'baniers' => $bR->findAll(),
            'categories' => $cr->findAll()
        ]);
    }

    /**
     * @Route("/cat{id}", name="home_cat")
     */
    public function cat(Categorie $c, BanierImageRepository $bR, CategorieRepository $cr): Response
    {
        // $om = $this->getDoctrine()->getManager();
        // for ($i=0; $i <10 ; $i++) { 
        //     # code...
        //     $cat = new Categorie();
        //     $cat->setNom("Categories $i");
        //     $om->persist($cat);
        //     $om->flush();

        // }


        return $this->render('home/index.html.twig', [
            'articles' => $c->getArticles(),
            'baniers' => $bR->findAll(),
            'categories' => $cr->findAll()
        ]);
    }
    /**
     * @Route("/more-{id}", name="more")
     */
    public function more(Article $article = null, Request $req): Response
    {
        $note = new NoteArticle();
        $note->setArticle($article);
        $note->setAuteur($this->getUser());
        $noteForme = $this->createForm(NoteArticleType::class, $note);
        $noteForme->handleRequest($req);
        if ($noteForme->isSubmitted() && $noteForme->isValid()) {
            # code...
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();
            return $this->redirect($req->headers->get('referer'));
        }

        return $this->render('home/more.html.twig', [
            'article' => $article,
            'form' => $noteForme->createView()
        ]);
    }
}
