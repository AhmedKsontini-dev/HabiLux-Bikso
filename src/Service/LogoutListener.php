<?php

namespace App\Service;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class LogoutListener implements EventSubscriberInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onLogout(LogoutEvent $event)
    {
        $user = $event->getToken()->getUser();

        if ($user instanceof User) {
            // Mettre le statut de l'utilisateur à 'false' lorsqu'il se déconnecte
            $user->setStatus(false);
            $this->entityManager->persist($user); // S'assurer que l'utilisateur est bien géré par l'EntityManager
            $this->entityManager->flush();
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            LogoutEvent::class => 'onLogout',
        ];
    }
}
