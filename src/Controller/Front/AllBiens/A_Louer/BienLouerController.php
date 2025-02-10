<?php

namespace App\Controller\Front\AllBiens\A_Louer;

use App\Entity\Bien;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BienLouerController extends AbstractController
{
    #[Route('/front/all/biens/louer', name: 'app_front_all_biens_louer')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer uniquement les biens avec typeOffre = "A Louer"
        $biens = $entityManager->getRepository(Bien::class)->findBy([
            'typeOffre' => 'A Louer'
        ]);

        return $this->render('front/all_biens/A_Louer/liste_prop_louer.html.twig', [
            'biens' => $biens,
        ]);
    }
    
}
