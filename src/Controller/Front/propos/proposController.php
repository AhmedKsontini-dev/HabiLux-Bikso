<?php

namespace App\Controller\Front\propos;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class proposController extends AbstractController
{
    #[Route('/front/propos/propos', name: 'app_front_propos_propos')]
    public function index(UserRepository $userRepository): Response
    {

        // Fetch all users
        $admins = $userRepository->findAll();

        // Filter users with the 'ROLE_ADMIN'
        $adminsWithRole = array_filter($admins, function($user) {
            return in_array('ROLE_ADMIN', $user->getRoles());
        });

        return $this->render('front/propos/about_us.html.twig', [
            'admins' => $adminsWithRole,
        ]);

    }
}
