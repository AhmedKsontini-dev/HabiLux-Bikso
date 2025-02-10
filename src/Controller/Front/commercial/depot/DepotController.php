<?php

namespace App\Controller\Front\commercial\depot;


use App\Entity\Bien;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DepotController extends AbstractController
{
    #[Route('/front/commercial/depot/louer', name: 'app_front_commercial_depot_louer')]
    public function louer(BienRepository $bienRepository): Response
    {

        // Récupérer uniquement les biens avec typeOffre = "A Louer" et typeBien = "Villa"
        $biens = $bienRepository->findByTypeOffreAndTypeBien('A Louer', 'Depot');

        return $this->render('front/commercial/depot/depot_louer.html.twig', [
            'controller_name' => 'DepotController',
            'biens' => $biens,
        ]);
    }

    #[Route('/front/commercial/depot/avendre', name: 'app_front_commercial_depot_avendre')]
    public function vendre(BienRepository $bienRepository): Response
    {

        // Récupérer uniquement les biens avec typeOffre = "A Louer" et typeBien = "Villa"
        $biens = $bienRepository->findByTypeOffreAndTypeBien('A Vendre', 'Depot');

        return $this->render('front/commercial/depot/depot_vendre.html.twig', [
            'controller_name' => 'DepotController',
            'biens' => $biens,
        ]);
    }
}
