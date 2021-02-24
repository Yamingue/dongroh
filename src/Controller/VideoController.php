<?php

namespace App\Controller;

use App\Entity\FormationVideo;
use App\Repository\FormationVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 *  @Route("/video")
 */
class VideoController extends AbstractController
{
    /**
     * @Route("", name="video")
     */
    public function index(FormationVideoRepository $repo): Response
    {
        return $this->render('video/index.html.twig', [
            'notif' => '',
            'videos'=> $repo->findAll(),
        ]);
    }
    /**
     * @Route("/view-{id}", name="video_view")
     */
    public function view(FormationVideo $video): Response
    {
        return $this->render('video/view.html.twig', [
            'notif' => '',
            'videos'=> $video
        ]);
    }
}
