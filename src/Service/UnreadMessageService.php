<?php
namespace App\Service;

use App\Entity\ContactMessage;
use Doctrine\ORM\EntityManagerInterface;

class UnreadMessageService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getUnreadCount(): int
    {
        return (int) $this->entityManager->getRepository(ContactMessage::class)
            ->createQueryBuilder('m')
            ->select('COUNT(m.id)')
            ->where('m.isRead = 0')
            ->getQuery()
            ->getSingleScalarResult();
    }
}