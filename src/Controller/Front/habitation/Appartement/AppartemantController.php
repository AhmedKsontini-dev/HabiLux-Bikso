<?php

namespace App\Controller\Front\habitation\Appartement;

use App\Entity\Bien;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AppartemantController extends AbstractController
{
    #[Route('/front/habitation/appartemant/louer', name: 'app_front_habitation_appartemant_louer')]
    public function louer(BienRepository $bienRepository): Response
    {

         // Récupérer uniquement les biens avec typeOffre = "A Louer" et typeBien = "Villa"
         $biens = $bienRepository->findByTypeOffreAndTypeBien('A Louer', 'Appartement');

        return $this->render('front/habitation/appartemant/appartement_louer.html.twig', [
            'controller_name' => 'AppartemantController',
            'biens' => $biens,
        ]);
    }

    #[Route('/front/habitation/appartemant/avendre', name: 'app_front_habitation_appartemant_avendre')]
    public function vendre(BienRepository $bienRepository): Response
    {

         // Récupérer uniquement les biens avec typeOffre = "A Louer" et typeBien = "Villa"
         $biens = $bienRepository->findByTypeOffreAndTypeBien('A Vendre', 'Appartement');
         
        return $this->render('front/habitation/appartemant/appartement_vendre.html.twig', [
            'controller_name' => 'AppartemantController',
            'biens' => $biens,
        ]);
    }
}
