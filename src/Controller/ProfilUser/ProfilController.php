<?php
namespace App\Controller\ProfilUser;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfilController extends AbstractController
{
    private $userRepository;
    private $entityManager;

    // Injection de UserRepository et EntityManagerInterface dans le constructeur
    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/profil/user/profil', name: 'app_profil_user_profil')]
    public function index(): Response
    {
        // Récupérer l'ID de l'utilisateur connecté depuis la session
        $userId = $this->getUser()->getId();

        // Trouver l'utilisateur par son ID
        $user = $this->userRepository->find($userId); 
        
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        return $this->render('profil_user/Admin_profil.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profil/user/profil/update', name: 'app_profil_user_profil_update', methods: ['POST'])]
    public function update(Request $request): Response
    {
        // Récupérer l'ID de l'utilisateur connecté depuis la session
        $userId = $this->getUser()->getId();
    
        // Trouver l'utilisateur par son ID
        $user = $this->userRepository->find($userId); 
        
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }
    
        // Récupérer les données du formulaire
        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $email = $request->request->get('email');
        $tel = $request->request->get('tel');
        $linkedin = $request->request->get('linkedin');
        $instagram = $request->request->get('instagram');
        $facebook = $request->request->get('facebook');
        $localisation = $request->request->get('localisation');
        $adresse = $request->request->get('adresse');
        $description = $request->request->get('description');
        $experience = $request->request->get('experience');
    
        // Mettre à jour les informations de l'utilisateur uniquement si elles sont modifiées
        if ($nom && $nom !== $user->getNom()) {
            $user->setNom($nom);
        }
    
        if ($prenom && $prenom !== $user->getPrenom()) {
            $user->setPrenom($prenom);
        }
    
        if ($email && $email !== $user->getEmail()) {
            $user->setEmail($email);
        }
    
        if ($tel && $tel !== $user->getTel()) {
            $user->setTel($tel);
        }
    
        if ($linkedin && $linkedin !== $user->getLinkedin()) {
            $user->setLinkedin($linkedin);
        }
    
        if ($instagram && $instagram !== $user->getInstagram()) {
            $user->setInstagram($instagram);
        }
    
        if ($facebook && $facebook !== $user->getFacebook()) {
            $user->setFacebook($facebook);
        }

        if ($localisation && $localisation !== $user->getLocalisation()) {
            $user->setLocalisation($localisation);
        }
        
        if ($adresse && $adresse !== $user->getAdresse()) {
            $user->setAdresse($adresse);
        }
        
        if ($description && $description !== $user->getDescription()) {
            $user->setDescription($description);
        }
        
        if ($experience && $experience !== $user->getExperience()) {
            $user->setExperience($experience);
        }
    
        // Gérer l'upload de la photo de profil
        /** @var UploadedFile $photoFile */
        $photoFile = $request->files->get('photo_profil');
        if ($photoFile) {
            $photoFileName = md5(uniqid()).'.'.$photoFile->guessExtension();
            $photoFile->move(
                $this->getParameter('profile_photos_directory'),
                $photoFileName
            );
            $user->setPhotoProfil($photoFileName);
        }
    
        // Sauvegarder les modifications dans la base de données
        $this->entityManager->flush();
    
        // Rediriger l'utilisateur vers la page de profil avec un message de succès
        $this->addFlash('success', 'Votre profil a été mis à jour avec succès.');
        return $this->redirectToRoute('app_profil_user_profil');
    }

    #[Route('/profil/user/photo/update', name: 'app_profil_user_photo_update', methods: ['POST'])]
    public function updatePhoto(Request $request): Response
    {
        $user = $this->getUser();
        
        if (!$user) {
            return $this->json(['success' => false, 'message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        /** @var UploadedFile $photoFile */
        $photoFile = $request->files->get('photo_profil');
        if ($photoFile) {
            $photoFileName = md5(uniqid()) . '.' . $photoFile->guessExtension();
            $photoFile->move(
                $this->getParameter('profile_photos_directory'), 
                $photoFileName
            );

            $user->setPhotoProfil($photoFileName);
            $this->entityManager->flush();

            return $this->json([
                'success' => true,
                'photoUrl' => $this->getParameter('profile_photos_web_path') . '/' . $photoFileName
            ]);
        }

        return $this->json(['success' => false, 'message' => 'Aucune image reçue'], Response::HTTP_BAD_REQUEST);
    }

    
}