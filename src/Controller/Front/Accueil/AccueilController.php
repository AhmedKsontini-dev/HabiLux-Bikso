<?php
namespace App\Controller\Front\Accueil;

use App\Repository\UserRepository;
use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('', name: 'app_front_accueil_accueil')]
    public function index(UserRepository $userRepository, BienRepository $bienRepository): Response
    {
        // Fetch all users
        $admins = $userRepository->findAll();

        // Filter users with the 'ROLE_ADMIN'
        $adminsWithRole = array_filter($admins, function($user) {
            return in_array('ROLE_ADMIN', $user->getRoles());
        });

        // Récupérer tous les biens avec leurs relations
        $biens = $bienRepository->findAllWithRelations();

        return $this->render('front/accueil/accueil.html.twig', [
            'admins' => $adminsWithRole,
            'biens' => $biens,
        ]);
    }
}
