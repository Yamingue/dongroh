<?php
namespace App\Controller\Admin;


use App\Entity\BanierImage;
use App\Form\BanierImageType;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/admin/banier")
*/
class BanierAdminController extends AbstractController
{
    private $cr;
    public function __construct( ContactRepository $cr )
    {
        $this->cr = $cr;
        
    }
    /**
     * @Route("", name="banier_admin")
     */
    public function index(Request $req): Response
    {   
        $b = new BanierImage();
        $form = $this->createForm(BanierImageType::class,$b);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file= $form->get('path')->getData();
            $name = $file->getClientOriginalName();
            $file->move('banier',$name);
            $b->setPath('banier/'.$name);
            $em->persist($b);
            $em->flush();
        }
        return $this->render('banier_admin/index.html.twig', [
            'form' =>$form->createView(),
            'messages' => $this->cr->findNotRead()
        ]);
    }
}
