<?php

namespace App\Controller\Back\detailsPropriete;

use App\Entity\DetailsPropriete;
use App\Form\DetailsProprieteType;
use App\Entity\Bien;
use App\Entity\Propriete;
use App\Repository\DetailsProprieteRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\UnreadMessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/details_propriete')]
final class DetailsProprieteController extends AbstractController
{
    private $unreadMessageService;

    public function __construct(UnreadMessageService $unreadMessageService)
    {
        $this->unreadMessageService = $unreadMessageService;
    }

    #[Route(name: 'app_details_propriete_index', methods: ['GET'])]
    public function index(DetailsProprieteRepository $detailsProprieteRepository): Response
    {

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        return $this->render('back/details_propriete/liste_detail_prop.html.twig', [
            'details_proprietes' => $detailsProprieteRepository->findAll(),
            'unreadCount' => $unreadCount, 
            'idBien' => $id
        ]);
    }

    #[Route('/new', name: 'app_details_propriete_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

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
            'unreadCount' => $unreadCount, 
            'idBien' => $id
        ]);
    }

    




    #[Route('/{id}/edit', name: 'app_details_propriete_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DetailsPropriete $detailsPropriete, EntityManagerInterface $entityManager): Response
    {

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        $form = $this->createForm(DetailsProprieteType::class, $detailsPropriete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_details_propriete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/details_propriete/edit.html.twig', [
            'details_propriete' => $detailsPropriete,
            'form' => $form,
            'unreadCount' => $unreadCount, 
            'idBien' => $id
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

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        $detailBien=$detailsProprieteRepository->findBy(['bien' => $id]);
    

        return $this->render('back/details_propriete/add_prop_bien.html.twig', [
            'proprietebien' => $detailBien,
            'unreadCount' => $unreadCount,
            'idBien' => $id
        ]);
    }
   

    #[Route("/propriete/update/{id}", name: 'app_propriete_update', methods: ['POST'])]
    public function updatePropriete(
        Request $request,
        EntityManagerInterface $entityManager,
        DetailsProprieteRepository $detailsProprieteRepository,
        int $id
    ): Response {
        $data = $request->request->all();
        $bien = $entityManager->getRepository(Bien::class)->find($id);

        if (!$bien) {
            $this->addFlash('danger', 'Bien non trouvé.');
            return $this->redirectToRoute('app_bien_index');
        }

        // 1️⃣ Mettre à jour les propriétés existantes
        if (!empty($data['proprietes'])) {
            foreach ($data['proprietes'] as $id => $proprieteData) {
                $detailsPropriete = $detailsProprieteRepository->find($id);
                if ($detailsPropriete) {
                    $detailsPropriete->setValeurPropriete($proprieteData['valeurPropriete']);
                    $detailsPropriete->setAfficher(isset($proprieteData['afficher']));
                    $entityManager->persist($detailsPropriete);
                }
            }
        }

        // 2️⃣ Ajouter de nouvelles propriétés
        if (!empty($data['newProprietes'])) {
            foreach ($data['newProprietes'] as $newProprieteData) {
                if (!empty($newProprieteData['nomPropriete']) && !empty($newProprieteData['valeurPropriete'])) {
                    // Vérifier si la propriété existe déjà
                    $existingPropriete = $entityManager->getRepository(Propriete::class)->findOneBy([
                        'nomPropriete' => $newProprieteData['nomPropriete'],
                        'type' => $bien->getType()
                    ]);

                    if (!$existingPropriete) {
                        // Créer une nouvelle propriété
                        $newPropriete = new Propriete();
                        $newPropriete->setNomPropriete($newProprieteData['nomPropriete']);
                        $newPropriete->setType($bien->getType()); // Associer au type du bien
                        $entityManager->persist($newPropriete);
                        $entityManager->flush();
                    } else {
                        $newPropriete = $existingPropriete;
                    }

                    // Ajouter une nouvelle valeur de propriété dans details_propriete
                    $detailsPropriete = new DetailsPropriete();
                    $detailsPropriete->setBien($bien);
                    $detailsPropriete->setPropriete($newPropriete);
                    $detailsPropriete->setValeurPropriete($newProprieteData['valeurPropriete']);
                    $entityManager->persist($detailsPropriete);
                }
            }
        }

        $entityManager->flush();
        $this->addFlash('success', 'Les valeurs des propriétés ont été mises à jour avec succès.');

        return $this->redirectToRoute('app_bien_index');
    }



}
