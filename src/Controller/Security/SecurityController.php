<?php
namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class SecurityController extends AbstractController
{
    private $entityManager;

    // Injecte l'EntityManager pour pouvoir enregistrer les modifications dans la base de données
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Vérifie si l'utilisateur est déjà connecté
        $user = $this->getUser();

        if ($user) {
            // Lorsque l'utilisateur se connecte, mettre à jour son statut à "true"
            $user->setStatus(true);
            $this->entityManager->flush(); // Enregistre le changement dans la base de données
        }

        // Récupère l'erreur de connexion si elle existe
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupère le dernier nom d'utilisateur saisi
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Cette méthode peut être vide, car elle est interceptée par Symfony
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
