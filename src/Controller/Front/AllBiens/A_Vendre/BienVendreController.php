<?php

namespace App\Controller\Front\AllBiens\A_Vendre;

use App\Entity\Bien;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BienVendreController extends AbstractController
{
    #[Route('/front/all/biens/vendre', name: 'app_front_all_biens_vendre')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer uniquement les biens avec typeOffre = "A Louer"
        $biens = $entityManager->getRepository(Bien::class)->findBy([
            'typeOffre' => 'A Vendre'
        ]);

        return $this->render('front/all_biens/A_Vendre/liste_prop_Vendre.html.twig', [
            'biens' => $biens,
        ]);
    }
}
