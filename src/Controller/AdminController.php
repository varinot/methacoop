<?php

namespace App\Controller;
use App\Entity\News;
use App\Entity\Docs;
use App\Entity\User;
use App\Entity\Depots;
use App\Form\DepoType;
use App\Form\DocuType;
use App\Form\DepodocType;
use App\Service\FileUploader;
use App\Repository\DocsRepository;
use App\Repository\NewsRepository;
use App\Repository\UserRepository;
use App\Repository\DepotsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

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

            $this->addFlash('success', 'Actualité créée');

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
     * @Route("/admin/gesdocs", name="app_admin_gesdocs",methods="GET")
     */
    public function gesdocs(DocsRepository $docsRepository): Response
    { 
        $docs = $docsRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('admin/gesdocs_index.html.twig', compact('docs'));
    }

    /**
     * @Route("/admin/gesdocs_ajout", name="app_admin_gesdocs_ajout", methods={"GET", "POST"})
     */
    public function docusajout(Request $request, EntityManagerInterface $em): Response 
    { 
        $doc = new Docs;
        
        $form = $this->createForm(DocuType::class, $doc);
            
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($doc);
            
            $em->flush();

            $this->addFlash('success', 'Documentation créée');

            return $this->redirectToRoute('app_admin_gesdocs');
        }
        return $this->render('admin/gesdocs_ajout.html.twig', ['docuform' => $form->createView()]);
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
     * @Route("/admin/gesusers_ajout", name="app_admin_gesusers_ajout", methods={"GET", "POST"})
     */
    public function ajoututil(Request $request,EntityManagerInterface $em): Response
    {  
        $user = new User;

        $form = $this->createFormBuilder($user)
        ->add('nom', TextType::class)
        ->add('prenom', TextType::class)
        ->add('numvoie', TextType::class)
        ->add('typvoie', TextType::class)
        ->add('voienom', TextType::class)
        ->add('codpost', TextType::class)
        ->add('ville', TextType::class)
        ->add('nbdepot', IntegerType::class)
        
        ->add('email', TextType::class)
        ->add('password', TextType::class)
        ->getForm();

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {          
             
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Membre ajouté');

            return $this->redirectToRoute('app_admin_gesusers');
        }
            
        return $this->render('admin/gesusers_ajout.html.twig', ['utilform' => $form->createView()]);
    }

    /**
     * @Route("/admin/gesusers_detail/{id}", name="app_admin_gesusers_detail")
     */
    public function utildetail(User $util): Response
    {  
                   
        return $this->render('admin/gesusers_detail.html.twig',compact('util'));
    }

    /**
     * @Route("/admin/gesusers_maj/{id}", name="app_admin_gesusers_maj", methods={"GET", "PUT"})
     */
    public function majutil(Request $request, EntityManagerInterface $em, User $util): Response
    { 
        $form = $this->createFormBuilder($util, ['method' => 'PUT'])
        ->add('nom', TextType::class)
        ->add('prenom', TextType::class)
        ->add('numvoie', TextType::class)
        ->add('typvoie', TextType::class)
        ->add('voienom', TextType::class)
        ->add('codpost', TextType::class)
        ->add('ville', TextType::class)
        ->add('nbdepot', IntegerType::class)
        
        ->add('email', TextType::class)
        ->add('password', TextType::class)
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {   
            $em->persist($util);       
            $em->flush();

            $this->addFlash('success', 'Membre mis à jour');

            return $this->redirectToRoute('app_admin_gesusers');
        }
        return $this->render('admin/gesusers_maj.html.twig', ['util' => $util, 'utilform' => $form->createView()]);
       
    } 
    /**
     * @Route("/admin/gesusers_supp/{id}", name="app_admin_gesusers_supp", methods={"DELETE"})
     */
    public function supputil(Request $request, EntityManagerInterface $em, User $util): Response
    {   
              
        $em->remove($util);
        $em->flush();

            $this->addFlash('info', 'Membre supprimé');

            return $this->redirectToRoute('app_admin_gesusers');
    }

    /**
     * @Route("/admin/gesdocs_supp/{id}", name="app_admin_gesdocs_supp", methods={"DELETE"})
     */
    public function suppdoc(Request $request, EntityManagerInterface $em, Docs $doc): Response
    {               
            $em->remove($doc);
            $em->flush();

            $this->addFlash('info', 'Documentation Supprimée');

            return $this->redirectToRoute('app_admin_gesdocs');
    }

    /**
     * @Route("/admin/gesdepots", name="app_admin_gesdepots")
     */
    public function gesdepots(DepotsRepository $depotsRepository): Response
    {
        $depots = $depotsRepository->findBy([], ['updatedAt' => 'DESC']);
        return $this->render('admin/gesdepots_index.html.twig', compact('depots'));
    }          
    
    /**
     * @Route("/admin/gesdepots_ajout", name="app_admin_gesdepots_ajout", methods={"GET", "POST"})
     */
    public function depotsajout(Request $request, EntityManagerInterface $em, DepotsRepository $depotsRepository, UserRepository $userRepository): Response 
    { 
        $depot = new Depots;
        
        $form = $this->createForm(DepoType::class, $depot);
            
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            
            $depot->setUser($this->getUser());
                        
            $em->persist($depot);
            
            $em->flush();

            $this->addFlash('success', 'Dépôt créé avec succès par administrateur' );

            return $this->redirectToRoute('app_admin_gesdepots');
        }
        return $this->render('admin/gesdepots_ajout.html.twig', ['depotform' => $form->createView()]);
    }

    /**
     * @Route("/admin/gesdepots_ajout_doc", name="app_admin_gesdepots_ajout_doc", methods={"GET", "POST"})
     */
    public function depotsajoutdoc(Request $request, SluggerInterface $slugger, FileUploader $fileUploader, EntityManagerInterface $em, DepotsRepository $depotsRepository, UserRepository $userRepository): Response 
    { 
        $depot = new Depots;
        
        $form = $this->createForm(DepodocType::class, $depot);
            
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
             /** @var UploadedFile $depoFile */ 

             $depoFile = $form->get('depoFileName')->getData();

             if ($depoFile)
             {
                 $originalFilename = pathinfo($depoFile->getClientOriginalName(), PATHINFO_FILENAME);
                 
                 $safeFilename = $slugger->slug($originalFilename);
                 $newFilename = $safeFilename.'-'.uniqid().'.'.$depoFile->guessExtension();
                 try {
                     $depoFile->move(
                         $this->getParameter('depofichiers_directory'),
                         $newFilename
                     );
                     }
                 catch (FileException $e)
                 {
 
                 }  
                 $depoFileName = $fileUploader->upload($depoFile);
                 $depot->setDepoFilename($depoFileName); 
                 $depot->setDepoFilename($newFilename); 
             }
                 
             $depot->setUser($this->getUser());
                        
            $em->persist($depot);
            
            $em->flush();

            $this->addFlash('success', 'Dépôt document créé avec succès par {{depot.user.nom }}' );

            return $this->redirectToRoute('app_admin_gesdepots');
        }
        return $this->render('admin/gesdepots_ajout_doc.html.twig', ['depotdocform' => $form->createView()]);
    }

    /**
     * @Route("/admin/gesdocs_maj/({id}", name="app_admin_gesdocs_maj", methods={"GET", "PUT"})
     */
    public function documaj(Request $request, EntityManagerInterface $em, Docs $doc): Response 
    { 
        $form = $this->createForm(DocuType::class, $doc, ['method' => 'PUT']);
         
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($doc);
            
            $em->flush();

            $this->addFlash('success', 'Documentation mise à jour');
            
            return $this->redirectToRoute('app_admin_gesdocs');
        }
        return $this->render('admin/gesdocs_maj.html.twig', ['docuform' => $form->createView()]);
   
    }

    /**
     * @Route("/admin/gesactus_supp/{id}", name="app_admin_gesactus_supp", methods={"DELETE"})
     */
    public function suppactu(Request $request,EntityManagerInterface $em,News $new): Response
    {               
            $em->remove($new);
            $em->flush();

            $this->addFlash('info', 'Actualité supprimée');

            return $this->redirectToRoute('app_admin_gesactus');
    }
/**
     * @Route("/admin/gesdepots_detail/{id}", name="app_admin_gesdepots_detail")
     */
    public function admindepodetail(Depots $depot): Response
    {  
                   
        return $this->render('admin/gesdepots_detail.html.twig',compact('depot'));
    }
        /**
     * @Route("/admin/gesdepots_supp/{id}", name="app_admin_depots_supp", methods={"DELETE"})
     */
    public function adminsupdepot(Request $request, EntityManagerInterface $em, Depots $depot): Response
    {   
              
        $em->remove($depot);
        $em->flush();

            $this->addFlash('info', 'Dépôt supprimé');

            return $this->redirectToRoute('app_admin_gesdepots');
    }

}
