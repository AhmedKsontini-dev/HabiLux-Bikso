<?php
namespace App\Controller\registration;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\EmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class RegistrationController extends AbstractController
{
    private $slugger;
    private $emailService;

    // Injection du SluggerInterface et du service d'email
    public function __construct(SluggerInterface $slugger, EmailService $emailService)
    {
        $this->slugger = $slugger;
        $this->emailService = $emailService;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion de l'upload de la photo de profil
            $photoFile = $form->get('photoProfil')->getData();
            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $this->slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();

                try {
                    $photoFile->move(
                        $this->getParameter('profile_photos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer l'erreur d'upload
                }

                $user->setPhotoProfil($newFilename);
            }

            // Encodage du mot de passe
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Générer un token de confirmation
            $confirmationToken = md5(uniqid());
            $user->setConfirmationToken($confirmationToken);
            $user->setVerifier(false); // Désactiver le compte jusqu'à confirmation

            // Ajout de la date actuelle dans le champ "creeEn"
            $user->setCreeEn(new \DateTime()); // Date de création de compte

            $entityManager->persist($user);
            $entityManager->flush();

            // Envoyer l'e-mail de confirmation
            $this->emailService->sendConfirmationEmail($user->getEmail(), $confirmationToken);
 

            // Rediriger vers la page de login avec un message
            $this->addFlash('success', 'Un e-mail de confirmation vous a été envoyé.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/confirm/{token}', name: 'app_confirm')]
    public function confirmAccount(string $token, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(User::class)->findOneBy(['confirmationToken' => $token]);

        if ($user) {
            $user->setVerifier(true);
            $user->setConfirmationToken(null);  // Supprimer le token après confirmation
            $entityManager->flush();

            $this->addFlash('success', 'Votre compte a bien été confirmé !');
            return $this->redirectToRoute('app_login');
        }

        $this->addFlash('error', 'Le token de confirmation est invalide.');
        return $this->redirectToRoute('app_register');
    }


    

}
