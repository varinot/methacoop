<?php

namespace App\Controller;

use App\Entity\Depots;
use App\Repository\DepotsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepotsController extends AbstractController
{
    /**
     * @Route("/depotsvue", name="app_depotsvue_index")
     */
    public function index(DepotsRepository $depotsRepository): Response
    {
        $depots = $depotsRepository->findBy([], ['createdAt' => 'DESC']);
       
        return $this->render('depotsvue/index.html.twig', ['depots' => $depots]);
    }

    /**
     * @Route("/depotsvue/{id}", name="app_depotsvue_detail_depotsvue")
     */
    public function detailvue(Depots $depot): Response
    {
        return $this->render('depotsvue/detail_depotsvue.html.twig',compact('depot'));
    }
}
