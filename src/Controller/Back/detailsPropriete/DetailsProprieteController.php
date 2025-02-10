<?php

namespace App\Controller\Back\detailsPropriete;

use App\Entity\DetailsPropriete;
use App\Form\DetailsProprieteType;
use App\Repository\DetailsProprieteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/details_propriete')]
final class DetailsProprieteController extends AbstractController
{
    #[Route(name: 'app_details_propriete_index', methods: ['GET'])]
    public function index(DetailsProprieteRepository $detailsProprieteRepository): Response
    {
        return $this->render('back/details_propriete/liste_detail_prop.html.twig', [
            'details_proprietes' => $detailsProprieteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_details_propriete_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $detailsPropriete = new DetailsPropriete();
        $form = $this->createForm(DetailsProprieteType::class, $detailsPropriete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($detailsPropriete);
            $entityManager->flush();

            return $this->redirectToRoute('app_details_propriete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/details_propriete/new.html.twig', [
            'details_propriete' => $detailsPropriete,
            'form' => $form,
        ]);
    }

    




    #[Route('/{id}/edit', name: 'app_details_propriete_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DetailsPropriete $detailsPropriete, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DetailsProprieteType::class, $detailsPropriete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_details_propriete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/details_propriete/edit.html.twig', [
            'details_propriete' => $detailsPropriete,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_details_propriete_delete', methods: ['POST'])]
    public function delete(Request $request, DetailsPropriete $detailsPropriete, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailsPropriete->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($detailsPropriete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_details_propriete_index', [], Response::HTTP_SEE_OTHER);
    }







// l'ajoute de valeur de propriété





    #[Route('/edit_propriete/{id}/', name: 'app_bien_propriete')]
    public function getPropriete(Request $request,$id, EntityManagerInterface $entityManager,DetailsProprieteRepository $detailsProprieteRepository): Response
    {

       $detailBien=$detailsProprieteRepository->findBy(['bien' => $id]);
    

        return $this->render('back/details_propriete/add_prop_bien.html.twig', [
            'proprietebien' => $detailBien, // Pass the data to the Twig template
        ]);
    }
   

    #[Route("/propriete/update", name: 'app_propriete_update', methods: ['POST'])]
    public function updatePropriete(Request $request, EntityManagerInterface $entityManager, DetailsProprieteRepository $detailsProprieteRepository): Response
    {
        $data = $request->request->all();

        if (!empty($data['proprietes'])) {
            foreach ($data['proprietes'] as $id => $proprieteData) {
                $detailsPropriete = $detailsProprieteRepository->find($id);
                if ($detailsPropriete) {
                    $detailsPropriete->setValeurPropriete($proprieteData['valeurPropriete']);
                    $entityManager->persist($detailsPropriete);
                }
            }
            $entityManager->flush();
        }

        $this->addFlash('success', 'Les valeurs des propriétés ont été mises à jour avec succès.');

        return $this->redirectToRoute('app_bien_index');
    }



   




}
