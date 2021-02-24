<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/service")
 */
class AdminServiceController extends AbstractController
{
    /**
     * @Route("", name="admin_service")
     */
    public function index(Request $req, ServiceRepository $srepo): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();
            $this->addFlash('sucess', $service->getTitle() . ' Est bien Ajouter');
            return $this->redirectToRoute('admin_service');
        }
        return $this->render('admin_service/index.html.twig', [
            'messages' => 1,
            'form' => $form->createView(),
            'services' => $srepo->findAll(),
        ]);
    }
    /**
     * @Route("/{id}-rm", name="admin_service_rm")
     */
    public function delete(Service $s=null)
    {
        if ($s) {
           $em = $this->getDoctrine()->getManager();
           $em->remove($s);
           $em->flush();
           $this->addFlash('sucess','Suprimer !!!');
        }
        return $this->redirectToRoute('admin_service');
    }
}
