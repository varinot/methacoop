<?php

namespace App\Controller;

use App\Entity\Docs;
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
        $docs = $docsRepository->findBy([], ['createdAt' => 'DESC']);
        
        return $this->render('docus/index.html.twig', ['docs' => $docs]);
    }

    /**
     * @Route("/docus/{id}", name="app_docus_détail_doc")
     */
    public function montrer(Docs $doc): Response
    {
       
        return $this->render('docus/détail_doc.html.twig',compact('doc'));
    }
}
