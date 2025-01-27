<?php

namespace App\Controller\Back\typeBien;

use App\Entity\TypeBien;
use App\Form\TypeBienType;
use App\Repository\TypeBienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/type/bien')]
final class TypeBienController extends AbstractController
{
    #[Route(name: 'app_back_type_bien_index', methods: ['GET'])]
    public function index(TypeBienRepository $typeBienRepository): Response
    {
        return $this->render('back/type_bien/liste_type_bien.html.twig', [
            'type_biens' => $typeBienRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_type_bien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeBien = new TypeBien();
        $form = $this->createForm(TypeBienType::class, $typeBien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeBien);
            $entityManager->flush();

            return $this->redirectToRoute('app_back_type_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/type_bien/new.html.twig', [
            'type_bien' => $typeBien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_type_bien_show', methods: ['GET'])]
    public function show(TypeBien $typeBien): Response
    {
        return $this->render('back/type_bien/show.html.twig', [
            'type_bien' => $typeBien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_type_bien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeBien $typeBien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeBienType::class, $typeBien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_back_type_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/type_bien/edit.html.twig', [
            'type_bien' => $typeBien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_type_bien_delete', methods: ['POST'])]
    public function delete(Request $request, TypeBien $typeBien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeBien->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($typeBien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_type_bien_index', [], Response::HTTP_SEE_OTHER);
    }
}
