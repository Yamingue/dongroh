<?php

namespace App\Controller\Admin;

use App\Repository\NoteArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminReviewController extends AbstractController
{
    /**
     * @Route("/review", name="admin_review")
     */
    public function index(NoteArticleRepository $noteRepo): Response
    {
        return $this->render('admin_review/index.html.twig', [
            'notes' => $noteRepo->findAll(),
        ]);
    }
}
