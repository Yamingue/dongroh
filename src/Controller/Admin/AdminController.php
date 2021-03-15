<?php
namespace App\Controller\Admin;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Formation;
use App\Form\ArticleType;
use App\Form\CategorieType;
use App\Form\FormationType;
use App\Entity\Notification;
use App\Entity\FormationVideo;
use App\Form\FormationVideoType;
use App\Repository\ArticleRepository;
use App\Repository\ContactRepository;
use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use App\Repository\NotificationRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\FormationVideoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    private $notif;
    private $paginator;
    private $cr;
          
    public function __construct(ContactRepository $cr, NotificationRepository $nr,PaginatorInterface $paginator )
    {
        $this->cr = $cr;
        $this->paginator= $paginator;
        $this->notif= count($nr->findBy(['state'=>false]));
    }

    /**
     * @Route("", name="admin")
     */
    public function index(Request $req,ArticleRepository $articleRepository): Response
    {
        $ar = new Article();
        $form = $this->createForm(ArticleType::class, $ar);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            # code...
            $file = new File($ar->getPhoto());
            $name = uniqid() . '.' . $file->guessExtension();
            $file->move('img/', $name);
            $ar->setPhoto('img/' . $name);
            $em = $this->getDoctrine()->getManager();
            $em->persist($ar);
            $em->flush();
            $this->addFlash("success", $ar->getTitre() . " Ajouter avec success");
            return $this->redirectToRoute('admin');
        }

        $pagination = $this->paginator->paginate(
            $articleRepository->findAllPaginate(), /* query NOT result */
            $req->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
            'articles'=> $pagination,
            'messages' => $this->cr->findNotRead()
        ]);
    }
    

     /**
     * @Route("/article-{id}-delete", name="article_delete")
     */
    public function article_delete(Article $ar=null)
    {
        if ($ar != null) {
            # code...
            $em = $this->getDoctrine()->getManager();
            $em->remove($ar);
            $em->flush();
            $this->addFlash('success',"Supprimer !!!");
        }
       return $this->redirectToRoute("admin");
        //dd($ar);
    }

    /**
     * @Route("/formation", name="admin_formation")
     */
    public function addFormation(Request $req, FormationRepository $formationRepo): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $poster = $form->get('poster')->getData();
            $name = $poster->getClientOriginalName();
            $poster->move('images',$name);
            $formation->setPoster('images/'.$name);
            //dump($name);
            //dd($poster);

            $exts = ['mp4','avi','3pg'];
            $media = $formation->getMedia();
            $file = new File($media->getPath());
            $ext =$file->guessExtension();
            $name= uniqid().'.'.$ext;
            $file->move('media/',$name);
            $media->setPath('media/'.$name);
            if (in_array($ext,$exts)) {
                $media->setType('video');
            }else {
                $media->setType('image');
            }
            $media->setCreateAt(new \DateTime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->persist($formation);
            $em->flush();
            $this->addFlash('success','Ajouter avec succes');
            return $this->redirectToRoute('admin_formation');
        }
        $pagination = $this->paginator->paginate(
            $formationRepo->findAllPaginate(), /* query NOT result */
            $req->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
    
        return $this->render('admin/formation.html.twig', [
            'form' => $form->createView(),
            'formations' => $pagination,
            'messages' => $this->cr->findNotRead()
        ]);
    }

    /**
     * @Route("/formation-{id}-view", name="admin_formation_view")
     */
    public function view_formation(Formation $formation=null){
        return $this->render('admin/formationView.html.twig',[
            'formation'=>$formation,
            'messages' => $this->cr->findNotRead()
        ]);
        
    }

    /**
     * @Route("/formation-{id}-pdf", name="admin_formation_extract")
     */
    public function extrct_formation(Formation $formation=null){
        
     // Configure Dompdf according to your needs
     $pdfOptions = new Options();
     $pdfOptions->set('defaultFont', 'Arial');
     
     // Instantiate Dompdf with our options
     $dompdf = new Dompdf($pdfOptions);
     
     // Retrieve the HTML generated in our twig file
     $html = $this->renderView('admin/mypdf.html.twig', [
         'participants' => $formation->getInscriptions()
     ]);
     
     // Load HTML to Dompdf
     $dompdf->loadHtml($html);
     
     // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
     $dompdf->setPaper('A4', 'portrait');

     // Render the HTML as PDF
     $dompdf->render();

     // Output the generated PDF to Browser (inline view)
     $dompdf->stream($formation->getId()."participant.pdf", [
         "Attachment" => false
     ]);
    }
    /**
     * @Route("/formation-{id}-delete", name="formation_delete")
     */
    public function delete_formation(Formation $formation, Request $req){
        $em = $this->getDoctrine()->getManager();
        //dd($formation);
        $em->remove($formation);

        $em->flush();
        $this->addFlash('success','Suprimer');
        return $this->redirectToRoute('admin_formation');
        
    }

    /**
     * @Route("/categorie", name="categorie")
     */
    public function categorie(Request $req,CategorieRepository $catRepo){
        $cat = new Categorie();
        $form = $this->createForm(CategorieType::class,$cat);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            # Ajout d'une nouvelle categorie 
            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            return $this->redirectToRoute("categorie");
        }
        $categorie = $this->paginator->paginate(
            $catRepo->findAllPaginate(), /* query NOT result */
            $req->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('admin/categorie.html.twig',[
            'categories'=> $categorie,
            'form'=> $form->createView(),
            'messages' => $this->cr->findNotRead()
        ]);
    }
    /**
     * @Route("categorie-{id}-rm",name="categorie_delete")
     */
    public function categorie_delete(Categorie $cat = null, Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($cat);
        $em->flush();
        $this->addFlash('success','Suprimer');
        return $this->redirectToRoute('categorie');
        dd($cat);
    }

    /**
     * @Route("categorie-{id}-edite",name="categorie_edite")
     */
    public function categorie_view(Categorie $cat = null,Request $req)
    {
        $form = $this->createForm(CategorieType::class,$cat);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            $this->addFlash('success','Suprimer');
        return $this->redirectToRoute("categorie");
        }
        
        return $this->render('admin/form.html.twig',[
            'form'=> $form->createView(),
            'notif' => $this->notif,
        ]);
    }
    /**
     * @Route("/notification", name="notification")
     */
    public function notification(NotificationRepository $nr,Request $req)
    {
        # code...
        $notification = $this->paginator->paginate(
            $nr->findAllorderByView(), /* query NOT result */
            $req->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('notification/index.html.twig',[
            'notif'=> $this->notif,
            'notifications'=> $notification,
            'messages' => $this->cr->findNotRead()
        ]);
    }

    /**
     * @Route("/notification-view-{id}", name="notification_view")
     */
    public function notification_view(Notification $n=null ,NotificationRepository $nr,Request $req)
    {
        # code...
       
        return $this->render('notification/view.html.twig',[
            'notif'=> $this->notif,
            'notification'=> $n,
            'messages' => $this->cr->findNotRead()
        ]);
    }
    /**
     * @Route("/video", name="video_formation")
     */
    public function video(Request $req,FormationVideoRepository $repo)
    {
        $video= new FormationVideo();
        $form= $this->createForm(FormationVideoType::class,$video);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var File
             */
            $file = $form->get('poster')->getData();
           // $file->getClientOriginalName();
            $name = uniqid().'.'.$file->guessExtension();
            $file->move('paye',$name);
            $video->setPoster('paye/'.$name);

            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();
            return $this->redirectToRoute('video_formation');
        }
        $pagination = $this->paginator->paginate(
            $repo->findAllPaginate(), /* query NOT result */
            $req->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render("admin/video.html.twig",[
            'notif'=>'',
            'form'=>$form->createView(),
            'videos' =>$pagination,
            'messages' => $this->cr->findNotRead()
        ]);
    }
    /**
     * @Route("video/delete-{id}", name="delete_video_formation")
     */
    public function delete_video(FormationVideo $fv=null)
    {
       if ($fv) {
            $em = $this->getDoctrine()->getManager();
            unlink($fv->getPoster());
            $em->remove($fv);
            $em->flush();
       }
       return $this->redirectToRoute('video_formation');
    }
}
