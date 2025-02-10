<?php

namespace App\Controller\Front\Team;

use App\Repository\UserRepository; // Assurez-vous d'avoir le bon namespace pour votre repository User
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    #[Route('/front/team/team', name: 'app_front_team_team')]
    public function index(UserRepository $userRepository): Response
    {
        // Récupérer tous les utilisateurs avec le rôle ROLE_ADMIN
        $admins = $userRepository->findAll();  // Récupère tous les utilisateurs

        // Filtrer les utilisateurs avec le rôle ROLE_ADMIN
        $adminsWithRole = array_filter($admins, function($user) {
            return in_array('ROLE_ADMIN', $user->getRoles());
        });

        // Passer les données à la vue
        return $this->render('front/team/listeTeam.html.twig', [
            'admins' => $adminsWithRole,
        ]);
    }
}
