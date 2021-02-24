<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig');
    }
    
     /**
     * @Route("/", name="propos")
     */
    public function apropoindex(): Response
    {
        return $this->render('propos/index.html.twig');
    }
     
    /**
     * @Route("/", name="actus")
     */
    public function actusindex(): Response
    {
        return $this->render('actus/index.html.twig');
    }
 
    /**
     * @Route("/", name="docus")
     */
    public function docusindex(): Response
    {
        return $this->render('docus/index.html.twig');
    }
    
    /**
     * @Route("/security/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser($authenticationUtils)) 
         {
           return $this->redirectToRoute('propos');
         }
         return $this->render('security/login.html.twig');
        }
    /**
     * @Route("/register", name="app_register")
     */
    public function register(): Response
    {
        return $this->render('registration/register.html.twig');
    }
}
