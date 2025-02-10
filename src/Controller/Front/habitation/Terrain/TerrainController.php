<?php

namespace App\Controller\Front\habitation\Terrain;

use App\Entity\Bien;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TerrainController extends AbstractController
{
    #[Route('/front/habitation/terrain/louer', name: 'app_front_habitation_terrain_louer')]
    public function louer(BienRepository $bienRepository): Response
    {

        // Récupérer uniquement les biens avec typeOffre = "A Louer" et typeBien = "Villa"
        $biens = $bienRepository->findByTypeOffreAndTypeBien('A Louer', 'Terrain');

        return $this->render('front/habitation/terrain/terrain_louer.html.twig', [
            'controller_name' => 'TerrainController',
            'biens' => $biens,
        ]);
    }

    #[Route('/front/habitation/terrain/avendre', name: 'app_front_habitation_terrain_avendre')]
    public function vendre(BienRepository $bienRepository): Response
    {

        // Récupérer uniquement les biens avec typeOffre = "A Louer" et typeBien = "Villa"
        $biens = $bienRepository->findByTypeOffreAndTypeBien('A Vendre', 'Terrain');

        return $this->render('front/habitation/terrain/terrain_vendre.html.twig', [
            'controller_name' => 'TerrainController',
            'biens' => $biens,
        ]);
    }
}
