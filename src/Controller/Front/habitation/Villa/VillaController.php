<?php

namespace App\Controller\Front\habitation\Villa;

use App\Entity\Bien;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VillaController extends AbstractController
{
    #[Route('/front/habitation/villa/louer', name: 'app_front_habitation_villa_louer')]
    public function louer(BienRepository $bienRepository): Response
    {
        // Récupérer uniquement les biens avec typeOffre = "A Louer" et typeBien = "Villa"
        $biens = $bienRepository->findByTypeOffreAndTypeBien('A Louer', 'Villa');

        return $this->render('front/habitation/villa/villa_louer.html.twig', [
            'biens' => $biens,
        ]);
    }

    #[Route('/front/habitation/villa/avendre', name: 'app_front_habitation_villa_avendre')]
    public function vendre(BienRepository $bienRepository): Response
    {
        // Récupérer uniquement les biens avec typeOffre = "A Vendre" et typeBien = "Villa"
        $biens = $bienRepository->findByTypeOffreAndTypeBien('A Vendre', 'Villa');

        return $this->render('front/habitation/villa/villa_vendre.html.twig', [
            'biens' => $biens,
        ]);
    }
}
