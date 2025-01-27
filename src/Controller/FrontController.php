<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FrontController extends AbstractController
{
    #[Route('', name: 'app_front')]
    public function index(): Response
    {
        return $this->render('front/accueil.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }


    #[Route('/Proprietes', name: 'app_Proprietes')]
    public function Proprietes(): Response
    {
        return $this->render('front/liste_propriétés.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route('/agents', name: 'app_agents')]
    public function agents(): Response
    {
        return $this->render('front/liste_agents.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route('/details_agent', name: 'app_details_agent')]
    public function details_agent(): Response
    {
        return $this->render('front/details_agents.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route('/details_proprietes', name: 'app_details_proprietes')]
    public function details_proprietes(): Response
    {
        return $this->render('front/details_propriétés.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route('/boutique', name: 'app_boutique')]
    public function boutique(): Response
    {
        return $this->render('front/boutique.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    #[Route('/boutique_details', name: 'app_boutique_details')]
    public function boutique_details(): Response
    {
        return $this->render('front/details_boutique.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    
    
    }

    #[Route('/checkout', name: 'app_checkout')]
    public function checkout(): Response
    {
        return $this->render('front/checkout.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    
    
    }


    #[Route('/a_propos', name: 'app_propos')]
    public function propos(): Response
    {
        return $this->render('front/about_us.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    
    
    }


    #[Route('/tarifs', name: 'app_tarifs')]
    public function tarifs(): Response
    {
        return $this->render('front/tarifs.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    
    
    }

    #[Route('/Erreur_404', name: 'app_erreur')]
    public function erreur(): Response
    {
        return $this->render('front/erreur.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    
    
    }

    #[Route('/Bientôt_disponible', name: 'app_coming_soon')]
    public function coming_soon(): Response
    {
        return $this->render('front/coming_soon.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    
    
    }

    #[Route('/En_Construction', name: 'app_construction')]
    public function construction(): Response
    {
        return $this->render('front/en_construction.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    
    
    }


    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('front/contact.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    
    
    }

    #[Route('/wishlist', name: 'app_wishlist')]
    public function wishlist(): Response
    {
        return $this->render('front/wishlist.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    
    
    }

    #[Route('/panier', name: 'app_panier')]
    public function panier(): Response
    {
        return $this->render('front/panier.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    
    
    }
}
