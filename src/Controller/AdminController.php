<?php

namespace App\Controller;
use App\Entity\News;
use App\Entity\Docs;
use App\Entity\User;
use App\Repository\DocsRepository;
use App\Repository\NewsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
    { 
        $news = $newsRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('admin/gesactus_index.html.twig', compact('news'));
    }
     /**
     * @Route("/admin/gesactus_ajout", name="app_admin_gesactus_ajout", methods={"GET", "POST"})
     */
    public function actusajout(Request $request, EntityManagerInterface $em): Response 
    { 
        $form = $this->createFormBuilder()
        ->add('newstit', TextType::class)
        ->add('newscont', TextareaType::class)
        ->getForm();
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $donnees = $form->getData();
            $new = new News;
            $new->setNewstit($donnees['newstit']);      
            $new->setNewscont($donnees['newscont']);
            $em->persist($new);
            $em->flush();

            return $this->redirectToRoute('app_admin_gesactus');
        }

        return $this->render('admin/gesactus_ajout.html.twig', ['actuform' => $form->createView()]);
    }
    /**
     * @Route("/admin/gesactus_detail/{id}", name="app_admin_gesactus_detail")
     */
    public function actudetail(News $new): Response
    {  
                   
        return $this->render('admin/gesactus_detail.html.twig', compact('new'));
    }

    /**
     * @Route("/admin/gesdocs", name="app_admin_gesdocs")
     */
    public function gesdocs(DocsRepository $docsRepository): Response
    { 
        $docs = $docsRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('admin/gesdocs_index.html.twig', compact('docs'));
    }
    /**
     * @Route("/admin/gesdocs_detail/{id}", name="app_admin_gesdocs_detail")
     */
    public function docdetail(Docs $doc): Response
    {  
                   
        return $this->render('admin/gesdocs_detail.html.twig', compact('doc'));
    }

    /**
     * @Route("/admin/gesusers", name="app_admin_gesusers")
     */
    public function gesusers(UserRepository $userRepository): Response
    {
        $utils = $userRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('admin/gesusers_index.html.twig', compact('utils'));
    }
/**
     * @Route("/admin/gesusers_detail/{id}", name="app_admin_gesusers_detail")
     */
    public function utildetail(User $util): Response
    {  
         dd($util);          
        return $this->render('admin/gesusers_detail.html.twig', compact('util'));
    }

    /**
     * @Route("/admin/gesdepots", name="app_admin_gesdepots")
     */
    public function gesdepots(): Response
    {
        return $this->render('admin/gesdepots_index.html.twig');
    }
}
