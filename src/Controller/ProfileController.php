<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Depots;
use App\Form\DepoType;
use App\Form\DepodocType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\DepotsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig');
    }

    /**
     * @Route("/profile/depots_liste", name="app_profile_depots_liste",methods="GET")
     */
    public function depotsindex(DepotsRepository $depotsRepository): Response
    { 
        $depots = $depotsRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('profile/depots_liste.html.twig', compact('depots'));
    }

    /**
     * @Route("/profile/depots_maliste", name="app_profile_depots_maliste",methods="GET")
     */
    public function mesdepots(DepotsRepository $depotsRepository): Response
    { 
        $depots = $depotsRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('profile/depots_maliste.html.twig', compact('depots'));
    }
    /**
     * @Route("/profile/depots_ajout", name="app_profile_depots_ajout", methods={"GET", "POST"})
     */
    
    public function ajoudepot(Request $request, EntityManagerInterface $em): Response 
    { 
        $depot = new Depots;
        
        $form = $this->createForm(DepoType::class, $depot);
            
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
             
            $depot->setUser($this->getUser());
            $em->persist($depot);
           //  $util = $userRepository->getUser(depot.id); 
                   // { 
                        //  $user->setnbdepot('nbdepot + 1');
                        //  $em->persist($user);
                                     
                        //         $em->flush(); 
                        //         return $user;
            $em->flush();

            $this->addFlash('success', 'Dépôt créé avec succès ');
                 
            return $this->redirectToRoute('app_profile_depots_maliste');
        }
        return $this->render('profile/depots_ajout.html.twig', ['depotform' => $form->createView()]);
    }
    
    /**
     * @Route("/profile/annuaire", name="app_profile_annuaire")
     */
    public function listusers(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('profile/annuaire.html.twig', compact('users'));
    }


    /**
     * @Route("/profile/depots_detail/{id}", name="app_profile_depots_detail")
     */
    public function depotdetail(Depots $depot): Response
    {  
                   
        return $this->render('profile/depots_detail.html.twig',compact('depot'));
    }

    /**
     * @Route("/profile/depots_mondetail/{id}", name="app_profile_depots_mondetail")
     */
    public function mondepotdetail(Depots $depot): Response
    {  
                   
        return $this->render('profile/depots_mondetail.html.twig',compact('depot'));
    }
    /**
     * @Route("/profile/depots_maj/({id}", name="app_profile_depots_maj", methods={"GET", "PUT"})
     */
   
    public function depotmaj(Request $request, EntityManagerInterface $em, Depots $depot): Response 
    { 
     
        $form = $this->createForm(DepoType::class, $depot, ['method' => 'PUT']);
         
        $form->handleRequest($request);
  
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($depot);
            
            $em->flush();

            $this->addFlash('success', 'Dépôt mis à jour');
            
            return $this->redirectToRoute('app_profile_depots_maliste');
        }
        return $this->render('profile/depots_maj.html.twig', ['depoform' => $form->createView()]);
    }
    
    /**
     * @Route("/profile/depots_supp/{id}", name="app_profile_depots_supp", methods={"DELETE"})
     */
    public function supdepot(Request $request,EntityManagerInterface $em,Depots $depot): Response
    {   
                    
        $em->remove($depot);
        $em->flush();

        $this->addFlash('info', 'Dépôt supprimé');

        return $this->redirectToRoute('app_profile_depots_maliste');
    }
}
