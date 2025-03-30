<?php

namespace App\Service;

use App\Entity\HistoriqueAction;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class HistoriqueService
{
    private EntityManagerInterface $entityManager;
    private Security $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    /**
     * Enregistrer une action dans l'historique (Ajout, Modification, Suppression)
     */
    public function enregistrerAction(string $action, string $description): void
    {
        // Vérifier si un utilisateur est connecté
        $user = $this->security->getUser();
        if (!$user instanceof User) {
            return;
        }

        // Créer une nouvelle entrée dans l'historique
        $historique = new HistoriqueAction();
        $historique->setUser($user);
        $historique->setAction($action);
        $historique->setDescription($description);
        $historique->setDateAction(new \DateTime());

        // Sauvegarde en base de données
        $this->entityManager->persist($historique);
        $this->entityManager->flush();
    }
}
