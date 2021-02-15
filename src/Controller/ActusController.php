<?php

namespace App\Controller;
use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActusController extends AbstractController
{
    /**
     * @Route("/actus", name="actus")
     */
    public function index(NewsRepository $newsRepository): Response
    {
        $news = $newsRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('actus/index.html.twig', ['news' => $news]);
    }

    /**
     * @Route("/actus/{id}", name="app_actus_montrer")
     */
    public function montrer(News $new): Response
    {  
                   
        return $this->render('actus/montrer.html.twig', compact('new'));
    }
}
