<?php

namespace App\Controller\Front\formulaireBesoin;

use App\Entity\BesoinUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // ⚡ très important
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/besoin-user')]
class BesoinUserController extends AbstractController // ⚡ très important
{
    #[Route('/save', name: 'besoin_user_save', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function save(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser(); // fonctionne car tu étends AbstractController

        $besoin = new BesoinUser();
        $besoin->setUser($user);
        $besoin->setVilleBien($request->request->get('villeBien'));
        $besoin->setGouvernoratBien($request->request->get('gouvernoratBien'));
        $besoin->setTypeBien($request->request->get('typeBien'));
        $besoin->setPrixMin((float)$request->request->get('prixMin'));
        $besoin->setPrixMax((float)$request->request->get('prixMax'));

        $em->persist($besoin);
        $em->flush();

        $this->addFlash('success', 'Votre besoin a été enregistré avec succès.');

        return $this->redirect($request->headers->get('referer'));

    }
}
