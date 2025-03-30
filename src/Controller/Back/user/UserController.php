<?php
namespace App\Controller\Back\user;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\UserType;
use App\Service\HistoriqueService;
use App\Service\UnreadMessageService;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/user')]
final class UserController extends AbstractController
{

    private HistoriqueService $historiqueService;
    private $unreadMessageService;

    public function __construct(HistoriqueService $historiqueService, UnreadMessageService $unreadMessageService)
    {
        $this->historiqueService = $historiqueService;
        $this->unreadMessageService = $unreadMessageService;
    }

    #[Route(name: 'app_back_user_index', methods: ['GET'])]
    public function index(Request $request, UserRepository $userRepository): Response
    {   
        // Récupérer les statistiques des biens
        $totalUsers = $userRepository->countAll();
        $nbrAdmin = $userRepository->countByRoles('ROLE_ADMIN');
        $nbrConnecte = $userRepository->countByStatus(1);

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        // Récupérer les termes de recherche et les filtres depuis la requête GET
        $search = $request->query->get('search');
        $role = $request->query->get('role');
        $poste = $request->query->get('poste');
        $dateInscription = $request->query->get('date_inscription');

        // Création de la requête de base
        $queryBuilder = $userRepository->createQueryBuilder('u');

        // Appliquer les filtres de recherche
        if ($search) {
            $queryBuilder->andWhere('u.nom LIKE :search OR u.prenom LIKE :search')
                        ->setParameter('search', '%' . $search . '%');
        }

        if ($role) {
            $queryBuilder->andWhere('u.roles LIKE :role')
                        ->setParameter('role', '%' . $role . '%');
        }

        if ($poste) {
            $queryBuilder->andWhere('u.poste LIKE :poste')
                        ->setParameter('poste', '%' . $poste . '%');
        }

        if ($dateInscription) {
            $queryBuilder->andWhere('u.dateInscription >= :dateInscription')
                        ->setParameter('dateInscription', $dateInscription);
        }

        // Exécuter la requête avec les filtres appliqués
        $users = $queryBuilder->getQuery()->getResult();

        // Rendu de la vue avec les utilisateurs filtrés
        return $this->render('back/user/listeUsers.html.twig', [
            'users' => $users,
            'search' => $search,
            'role' => $role,
            'poste' => $poste,
            'date_inscription' => $dateInscription,
            'total_users' => $totalUsers,
            'nbr_admin' => $nbrAdmin,
            'nbr_connecte' => $nbrConnecte,
            'unreadCount' => $unreadCount,
        ]);
    }


 

    #[Route('/new', name: 'app_back_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader, UserPasswordHasherInterface $passwordHasher): Response
    {

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer le fichier photo de profil
            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('photoProfil')->getData();

            if ($photoFile) {
                // Utilisation du service pour uploader l'image
                $photoFileName = $fileUploader->upload($photoFile);
                $user->setPhotoProfil($photoFileName);  // Assurez-vous que la méthode 'setPhotoProfil' existe dans votre entité User
            }

            // Récupérer et hacher le mot de passe
            $plainPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);  // Définir le mot de passe haché
            
            // Persister l'utilisateur dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_back_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'unreadCount' => $unreadCount,
        ]);
    }



    #[Route('/{id}', name: 'app_back_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        return $this->render('back/user/show.html.twig', [
            'user' => $user,
            'unreadCount' => $unreadCount,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Si une nouvelle photo est uploadée, on met à jour la photo
            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('photoProfil')->getData();
    
            if ($photoFile) {
                // Utilisation du service pour uploader l'image
                $photoFileName = $fileUploader->upload($photoFile);
                $user->setPhotoProfil($photoFileName);  // Assurez-vous que la méthode 'setPhotoProfil' existe dans votre entité User
            }
            $this->addFlash('success', 'Modification de client avec succès');
            $this->historiqueService->enregistrerAction('Modification', "Modification de client ID: {$user->getId()}");
    
            $entityManager->flush();
    
            return $this->redirectToRoute('app_back_user_index', [], Response::HTTP_SEE_OTHER); 
        }
            
        
    
        return $this->render('back/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'unreadCount' => $unreadCount,
        ]);
    }
    

    #[Route('/{id}', name: 'app_back_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();

            $this->historiqueService->enregistrerAction('Suppression', "Suppression de client ");
            $this->addFlash('success', 'Suppression de client avec succès');
        }

        
        return $this->redirectToRoute('app_back_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
