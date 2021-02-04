<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActusController extends AbstractController
{
    /**
     * @Route("/actus", name="actus")
     */
    public function index(): Response
    {
        return $this->render('actus/index.html.twig', [
            'controller_name' => 'ActusController',
        ]);
    }
}
