<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepotsController extends AbstractController
{
    /**
     * @Route("/depots", name="depots")
     */
    public function index(): Response
    {
        return $this->render('depots/index.html.twig', [
            'controller_name' => 'DepotsController',
        ]);
    }
}
