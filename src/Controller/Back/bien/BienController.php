<?php

namespace App\Controller\Back\bien;

use App\Entity\bien;
use App\Form\BienType;
use App\Entity\TypeBien;
use App\Entity\Gouvernorat;
use App\Entity\Ville;
use App\Entity\User;
use App\Service\UnreadMessageService;
use App\Repository\BienRepository;
use App\Service\HistoriqueService;
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
    private HistoriqueService $historiqueService;
    private $unreadMessageService;

    public function __construct(HistoriqueService $historiqueService, UnreadMessageService $unreadMessageService)
    {
        $this->historiqueService = $historiqueService;
        $this->unreadMessageService = $unreadMessageService;
    }


    #[Route(name: 'app_bien_index', methods: ['GET'])]
    public function index(BienRepository $bienRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeBienId = $request->query->get('typeBien'); // Récupérer le filtre par type de bien
        $typeOffre = $request->query->get('typeOffre'); // Récupérer le filtre par type d'offre
        $dateCreation = $request->query->get('dateCreation'); // Récupérer le filtre par date de création
        $propertiesForRent = $bienRepository->countByTypeOffre('À Louer');
        $propertiesForSale = $bienRepository->countByTypeOffre('À Vendre');
        $totalProperties = $bienRepository->countAll();

        // Construire la condition pour le filtre
        $criteria = [];

        if ($typeBienId) {
            $criteria['type'] = $typeBienId;
        }

        if ($typeOffre) {
            $criteria['typeOffre'] = $typeOffre;
        }

        if ($dateCreation) {
            $criteria['dateCreation'] = $dateCreation; // Filtre sur la date de création
        }

        // Appliquer les filtres ou récupérer tous les biens
        $biens = $criteria ? $bienRepository->findBy($criteria) : $bienRepository->findAll();

        // Récupérer tous les types de biens pour la liste déroulante
        $typeBiens = $entityManager->getRepository(TypeBien::class)->findAll();

        $gouvernorat = $entityManager->getRepository(Gouvernorat::class)->findAll();

        $ville = $entityManager->getRepository(Ville::class)->findAll();

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        return $this->render('back/bien/liste_bien.html.twig', [
            'biens' => $biens,
            'typeBiens' => $typeBiens,
            'gouvernorat' => $gouvernorat,
            'ville' => $ville,
            'selectedTypeBien' => $typeBienId, // Garder la sélection après filtrage
            'selectedTypeOffre' => $typeOffre,
            'selectedDateCreation' => $dateCreation, // Garder la sélection de la date
            'properties_for_rent' => $propertiesForRent,
            'properties_for_sale' => $propertiesForSale,
            'total_properties' => $totalProperties,
            'unreadCount' => $unreadCount, 
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
            
            $this->historiqueService->enregistrerAction('Ajout', "Ajout d'un nouveau bien ");
            $this->addFlash('success', 'Ajout de bien avec succès');

         
            $entityManager->persist($bien);
            $entityManager->flush();

            return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();


        return $this->render('back/bien/new.html.twig', [
            'bien' => $bien,
            'form' => $form,
            'unreadCount' => $unreadCount,
        ]);
    }

    #[Route('/{id}', name: 'app_bien_show', methods: ['GET'])]
    public function show(Bien $bien): Response
    {
        $positionMap = $bien->getPositionMap(); // Utilisation du getter pour accéder à positionMap

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        return $this->render('back/bien/show.html.twig', [
            'bien' => $bien,
            'positionMap' => $positionMap,
            'unreadCount' => $unreadCount,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bien $bien, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);
        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les fichiers d'image envoyés
            $imageFiles = $form->get('imageBien')->getData();

            if ($imageFiles) {
                // Supprimer les anciennes images
                foreach ($bien->getImageBiens() as $oldImage) {
                    $entityManager->remove($oldImage);
                }
                $bien->getImageBiens()->clear();
                
                // Ajouter les nouvelles images
                foreach ($imageFiles as $imageFile) {
                    $imageFileName = $fileUploader->upload($imageFile);
                    $newImage = new ImageBien();
                    $newImage->setNomImage($imageFileName);
                    $newImage->setPrincipal(true);
                    $newImage->setBien($bien);
                    $bien->addImageBien($newImage);
                }
            }

            // Enregistrer l'action dans l'historique
            $this->historiqueService->enregistrerAction('Modification', "Modification de bien ID: {$bien->getId()}");
            $this->addFlash('success', 'Modification de bien avec succès');

            $bien->setPublierPar($this->getUser()); // Met à jour l'admin qui modifie
            $entityManager->flush();

            return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/bien/edit.html.twig', [
            'bien' => $bien,
            'form' => $form,
            'unreadCount' => $unreadCount,
        ]);
    }

    #[Route('/{id}', name: 'app_bien_delete', methods: ['POST'])]
    public function delete(Request $request, Bien $bien, EntityManagerInterface $entityManager): Response
    {
        
        if ($this->isCsrfTokenValid('delete'.$bien->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($bien);
            $entityManager->flush();

            // 🔹 Enregistrer l'action
            $this->historiqueService->enregistrerAction('Suppression', "Suppression de bien ");
            $this->addFlash('success', 'Suppression de bien avec succès');
        }

        

        return $this->redirectToRoute('app_bien_index', [], Response::HTTP_SEE_OTHER);
    }

    



}
