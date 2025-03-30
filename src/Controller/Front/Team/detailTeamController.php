<?php

namespace App\Controller\Front\Team;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class detailTeamController extends AbstractController
{
    #[Route('/front/team/detail/{id}', name: 'app_front_team_detail_team', methods: ['GET'])]
    public function index(int $id, UserRepository $userRepository): Response
    {
        $admin = $userRepository->find($id);

        if (!$admin) {
            throw $this->createNotFoundException("L'agent avec l'ID $id n'existe pas.");
        }

        return $this->render('front/team/detailTeam.html.twig', [
            'agent' => $admin,
        ]);
    }

}
