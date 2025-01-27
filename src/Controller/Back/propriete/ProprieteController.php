<?php

namespace App\Controller\Back\propriete;

use App\Entity\Propriete;
use App\Form\ProprieteType;
use App\Repository\ProprieteRepository;
use App\Controller\DetailsProprieteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TypeBienRepository;


#[Route('/propriete')]
final class ProprieteController extends AbstractController
{
    #[Route(name: 'app_back_propriete_index', methods: ['GET'])]
    public function index(ProprieteRepository $proprieteRepository, TypeBienRepository $typeBienRepository, Request $request): Response
    {
        // Récupérer l'id du type de bien depuis le filtre
        $typeBienId = $request->query->get('typeBien');
    
        // Filtrer les propriétés selon le type de bien sélectionné
        if ($typeBienId) {
            // Filtrer les propriétés par type de bien
            $proprietes = $proprieteRepository->findBy(['type' => $typeBienId]);
        } else {
            // Récupérer toutes les propriétés si aucun filtre n'est appliqué
            $proprietes = $proprieteRepository->findAll();
        }
    
        // Récupérer tous les types de biens pour la liste déroulante du filtre
        $typeBiens = $typeBienRepository->findAll();
    
        return $this->render('back/propriete/liste_propriete.html.twig', [
            'proprietes' => $proprietes,
            'typeBiens' => $typeBiens,
            'selectedTypeBien' => $typeBienId, // Garder la sélection du filtre
        ]);
    }
    

    #[Route('/new', name: 'app_back_propriete_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $propriete = new Propriete();
        $form = $this->createForm(ProprieteType::class, $propriete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($propriete);
            $entityManager->flush();

            return $this->redirectToRoute('app_back_propriete_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/propriete/new.html.twig', [
            'propriete' => $propriete,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_back_propriete_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Propriete $propriete, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProprieteType::class, $propriete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_back_propriete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/propriete/edit.html.twig', [
            'propriete' => $propriete,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_propriete_delete', methods: ['POST'])]
    public function delete(Request $request, Propriete $propriete, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$propriete->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($propriete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_propriete_index', [], Response::HTTP_SEE_OTHER);
    }










    






}
