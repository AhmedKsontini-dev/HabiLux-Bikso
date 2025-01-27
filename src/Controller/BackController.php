<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BackController extends AbstractController
{
   

    #[Route('/profil', name: 'app_profil')]
    public function profil(): Response
    {
        return $this->render('back/profil.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

    #[Route('/change_mdp', name: 'app_mdp')]
    public function change_mdp(): Response
    {
        return $this->render('back/change_mdp.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }
}
