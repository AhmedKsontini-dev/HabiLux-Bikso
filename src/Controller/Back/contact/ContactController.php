<?php
namespace App\Controller\Back\contact;

use App\Entity\ContactMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/back/contact/messages', name: 'app_back_contact_messages')]
    public function listMessages(EntityManagerInterface $entityManager): Response
    {
        $messages = $entityManager->getRepository(ContactMessage::class)->findBy([], ['createdAt' => 'DESC']);

        $unreadCount = $entityManager->getRepository(ContactMessage::class)
            ->createQueryBuilder('m')
            ->select('COUNT(m.id)')
            ->where('m.isRead = 0')
            ->getQuery()
            ->getSingleScalarResult();

        return $this->render('back/contact/messages.html.twig', [
            'messages' => $messages,
            'unreadCount' => $unreadCount,
        ]);
    }

    #[Route('/back/contact/messages/unread-count', name: 'app_back_contact_unread_count')]
    public function getUnreadCount(EntityManagerInterface $entityManager): JsonResponse
    {
        $unreadCount = $entityManager->getRepository(ContactMessage::class)
            ->createQueryBuilder('m')
            ->select('COUNT(m.id)')
            ->where('m.isRead = 0')
            ->getQuery()
            ->getSingleScalarResult();

        return new JsonResponse(['unreadCount' => $unreadCount]);
    }

    #[Route('/back/contact/messages/mark-as-read/{id}', name: 'app_back_contact_mark_as_read')]
    public function markAsRead(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $message = $entityManager->getRepository(ContactMessage::class)->find($id);
        
        if ($message) {
            $message->setIsRead(true);
            $entityManager->flush();
            return new JsonResponse(['status' => 'success']);
        }
        
        return new JsonResponse(['status' => 'error', 'message' => 'Message non trouvé']);
    }

    #[Route('/back/contact/messages/update-status/{id}/{status}', name: 'contact_message_update_status', methods: ['POST'])]
    public function updateStatus(EntityManagerInterface $entityManager, int $id, string $status): JsonResponse
    {
        $message = $entityManager->getRepository(ContactMessage::class)->find($id);

        if (!$message) {
            return new JsonResponse(['status' => 'error', 'message' => 'Message non trouvé'], 404);
        }

        if (!in_array($status, ['confirmer', 'en_attente', 'annuler'])) {
            return new JsonResponse(['status' => 'error', 'message' => 'Statut invalide'], 400);
        }

        $message->setStatus($status);
        $entityManager->flush();

        return new JsonResponse(['status' => 'success', 'newStatus' => $status]);
    }
}
