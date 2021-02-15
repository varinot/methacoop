<?php

namespace App\Controller;
use App\Repository\DocsRepository;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @[IsGranted("ROLE_ADMIN")]
 */

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
    /**
     * @Route("/admin/gesactus", name="app_admin_gesactus")
     */
    public function gesactus(NewsRepository $newsRepository): Response
    { $news = $newsRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('admin/gesactus_index.html.twig', compact('news'));
    }
    /**
     * @Route("/admin/gesdocs", name="app_admin_gesdocs")
     */
    public function gesdocs(DocsRepository $docsRepository): Response
    {$docs = $docsRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('admin/gesdocs_index.html.twig');
    }
    /**
     * @Route("/admin/gesusers", name="app_admin_gesusers")
     */
    public function gesusers(): Response
    {
        return $this->render('admin/gesusers_index.html.twig');
    }
    /**
     * @Route("/admin/gesdepots", name="app_admin_gesdepots")
     */
    public function gesdepots(): Response
    {
        return $this->render('admin/gesdepots_index.html.twig');
    }
}
