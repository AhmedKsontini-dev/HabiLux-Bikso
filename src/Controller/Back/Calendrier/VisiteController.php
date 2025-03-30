<?php

namespace App\Controller\Back\Calendrier;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\HistoriqueService;
use App\Service\UnreadMessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/calendrier')]
class VisiteController extends AbstractController
{

    private HistoriqueService $historiqueService;
    private $unreadMessageService;

    public function __construct(HistoriqueService $historiqueService, UnreadMessageService $unreadMessageService)
    {
        $this->historiqueService = $historiqueService;
        $this->unreadMessageService = $unreadMessageService;
    }

    #[Route('/visite', name: 'app_back_calendrier_visite')]
    public function index(): Response
    {
        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        return $this->render('back/calendrier/index.html.twig', [
            'controller_name' => 'VisiteController',
            'unreadCount' => $unreadCount, 
        ]);
    }

    #[Route('/events', name: 'get_events', methods: ['GET'])]
    public function getEvents(EvenementRepository $repository): JsonResponse
    {



        $events = $repository->findAll();
        $data = [];
        
        foreach ($events as $event) {
            $data[] = [
                'id' => $event->getId(),
                'title' => $event->getTitle(),
                'startDate' => $event->getStartDate()->format('Y-m-d'),
                'endDate' => $event->getEndDate()->format('Y-m-d'),
                'description' => $event->getDescription()
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/event', name: 'save_event', methods: ['POST'])]
    public function saveEvent(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $event = new Evenement();
        $event->setTitle($data['title']);
        $event->setStartDate(new \DateTime($data['startDate']));
        $event->setEndDate(new \DateTime($data['endDate']));
        $event->setDescription($data['description']);
        

        $this->historiqueService->enregistrerAction('Ajout', "Ajout d'un nouveau date de visite dans le calendrier ");

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();
        
        $entityManager->persist($event);
        $entityManager->flush();

        return new JsonResponse([
            'success' => true,
            'id' => $event->getId(),
            'unreadCount' => $unreadCount, 
        ]);
    }

    #[Route('/event/{id}', name: 'update_event', methods: ['PUT'])]
    public function updateEvent(
        Request $request,
        Evenement $event,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $event->setTitle($data['title']);
        $event->setStartDate(new \DateTime($data['startDate']));
        $event->setEndDate(new \DateTime($data['endDate']));
        $event->setDescription($data['description']);

        $this->historiqueService->enregistrerAction('Modification', "Modification de visite: {$event->getStartDate()}");
        
        $entityManager->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/event/{id}', name: 'delete_event', methods: ['DELETE'])]
    public function deleteEvent(
        Evenement $event,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $this->historiqueService->enregistrerAction('Suppression', "Suppression une date de visite");

        $entityManager->remove($event);
        $entityManager->flush();

        return new JsonResponse(['success' => true]);
    }
}