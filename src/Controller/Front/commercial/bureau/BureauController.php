<?php

namespace App\Controller\Front\commercial\bureau;

use App\Entity\Bien;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BureauController extends AbstractController
{
    #[Route('/front/commercial/bureau/louer', name: 'app_front_commercial_bureau_louer')]
    public function louer(BienRepository $bienRepository): Response
    {

        // Récupérer uniquement les biens avec typeOffre = "A Louer" et typeBien = "Villa"
        $biens = $bienRepository->findByTypeOffreAndTypeBien('A Louer', 'Bureau commercial');

        return $this->render('front/commercial/bureau/bureau_louer.html.twig', [
            'controller_name' => 'BureauController',
            'biens' => $biens,
        ]);
    }

    #[Route('/front/commercial/bureau/avendre', name: 'app_front_commercial_bureau_avendre')]
    public function vendre(BienRepository $bienRepository): Response
    {

        // Récupérer uniquement les biens avec typeOffre = "A Louer" et typeBien = "Villa"
        $biens = $bienRepository->findByTypeOffreAndTypeBien('A Vendre', 'Bureau commercial');

        return $this->render('front/commercial/bureau/bureau_vendre.html.twig', [
            'controller_name' => 'BureauController',
            'biens' => $biens,
        ]);
    }
}
