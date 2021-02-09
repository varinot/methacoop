<?php

namespace App\Controller;

use App\Repository\DocsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocusController extends AbstractController
{
    /**
     * @Route("/docus", name="docus")
     */
    public function index(DocsRepository $docsRepository): Response
    {
        $docs = $docsRepository->findBy([''], ['createdAt' => 'DESC']);
        
        return $this->render('docus/index.html.twig', compact('docs'));
    }
}
