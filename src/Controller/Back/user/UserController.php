<?php
namespace App\Controller\Back\user;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/user')]
final class UserController extends AbstractController
{
    #[Route(name: 'app_back_user_index', methods: ['GET'])]
    public function index(Request $request, UserRepository $userRepository): Response
    {   
        // Récupérer les statistiques des biens
        $totalUsers = $userRepository->countAll();
        $nbrAdmin = $userRepository->countByRoles('ROLE_ADMIN');
        $nbrConnecte = $userRepository->countByStatus(1);



        // Récupération du terme de recherche depuis la requête GET
        $search = $request->query->get('search');

        // Si un terme de recherche est présent, filtrer les utilisateurs
        if ($search) {
            $users = $userRepository->createQueryBuilder('u')
                ->where('u.nom LIKE :search')
                ->orWhere('u.prenom LIKE :search')
                ->setParameter('search', '%' . $search . '%')
                ->getQuery()
                ->getResult();
        } else {
            // Si aucun terme de recherche, récupérer tous les utilisateurs
            $users = $userRepository->findAll();
        }

        // Rendu de la vue avec les utilisateurs filtrés ou tous les utilisateurs
        return $this->render('back/user/listeUsers.html.twig', [
            'users' => $users,
            'search' => $search,
            'total_users' => $totalUsers,
            'nbr_admin' => $nbrAdmin,
            'nbr_connecte' => $nbrConnecte,
   
        ]);
    }

 

    #[Route('/new', name: 'app_back_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader, UserPasswordHasherInterface $passwordHasher): Response
    {
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
        ]);
    }



    #[Route('/{id}', name: 'app_back_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('back/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
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
    
            $entityManager->flush();
    
            return $this->redirectToRoute('app_back_user_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('back/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
    

    #[Route('/{id}', name: 'app_back_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
