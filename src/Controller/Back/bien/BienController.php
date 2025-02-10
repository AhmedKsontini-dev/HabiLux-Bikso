<?php

namespace App\Controller\Back\bien;

use App\Entity\Bien;
use App\Form\BienType;
use App\Entity\TypeBien;
use App\Entity\User;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\FileUploader;
use App\Entity\ImageBien;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/back/bien')]
final class BienController extends AbstractController
{
    #[Route(name: 'app_bien_index', methods: ['GET'])]
    public function index(BienRepository $bienRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeBienId = $request->query->get('typeBien'); // Récupérer le filtre par type de bien
        $localisationBien = $request->query->get('localisationBien'); // Récupérer le filtre par localisation
        $typeOffre = $request->query->get('typeOffre'); // Récupérer le filtre par type d'offre
        $propertiesForRent = $bienRepository->countByTypeOffre('À Louer');
        $propertiesForSale = $bienRepository->countByTypeOffre('À Vendre');
        $totalProperties = $bienRepository->countAll();

        // Construire la condition pour le filtre
        $criteria = [];

        if ($typeBienId) {
            $criteria['type'] = $typeBienId;
        }

        if ($localisationBien) {
            $criteria['localisationBien'] = $localisationBien;
        }

        if ($typeOffre) {
            $criteria['typeOffre'] = $typeOffre;
        }

        // Appliquer les filtres ou récupérer tous les biens
        $biens = $criteria ? $bienRepository->findBy($criteria) : $bienRepository->findAll();

        // Récupérer tous les types de biens pour la liste déroulante
        $typeBiens = $entityManager->getRepository(TypeBien::class)->findAll();

        return $this->render('back/bien/liste_bien.html.twig', [
            'biens' => $biens,
            'typeBiens' => $typeBiens,
            'selectedTypeBien' => $typeBienId, // Garder la sélection après filtrage
            'selectedLocalisationBien' => $localisationBien, // Garder la sélection de la localisation
            'selectedTypeOffre' => $typeOffre,
            'properties_for_rent' => $propertiesForRent,
            'properties_for_sale' => $propertiesForSale,
            'total_properties' => $totalProperties, // Garder la sélection du type d'offre
        ]);
    }



    #[Route('/new', name: 'app_bien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $bien = new Bien();
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFiles = $form->get('imageBien')->getData();

            if ($imageFiles) {
                foreach ($imageFiles as $imageFile) {
                    $imageFileName = $fileUploader->upload($imageFile);
                    $imageBien = new ImageBien();
                    $imageBien->setNomImage($imageFileName);
                    $imageBien->setPrincipal(True);
                    $imageBien->setBien($bien); // Use setBien to set the relationship
                    $bien->addImageBien($imageBien);
                }
                
            }

            // Associer l'admin connecté au bien
            $bien->setPublierPar($this->getUser());

            $entityManager->persist($bien);
            $entityManager->flush();

            return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/bien/new.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bien_show', methods: ['GET'])]
    public function show(Bien $bien): Response
    {
        return $this->render('back/bien/show.html.twig', [
            'bien' => $bien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bien $bien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bien->setPublierPar($this->getUser()); // Met à jour l'admin qui modifie
            $entityManager->flush();

            return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/bien/edit.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bien_delete', methods: ['POST'])]
    public function delete(Request $request, Bien $bien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bien->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($bien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
    }



}
