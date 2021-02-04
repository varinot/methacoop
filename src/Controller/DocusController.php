<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocusController extends AbstractController
{
    /**
     * @Route("/docus", name="docus")
     */
    public function index(): Response
    {
        return $this->render('docus/index.html.twig', [
            'controller_name' => 'DocusController',
        ]);
    }
}
