<?php
namespace App\Controller\Front\Contact;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ContactMessage;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController
{
    #[Route('/front/contact/contact', name: 'app_front_contact_contact')]
    public function index(): Response
    {
        return $this->render('front/contact/contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    #[Route('/front/contact/visit', name: 'app_front_contact_visit', methods: ['POST'])]
    public function sendVisitRequest(Request $request, EntityManagerInterface $entityManager): Response
    {
        $name = $request->request->get('name');
        $tel = $request->request->get('tel');
        $userEmail = $request->request->get('email');
        $message = $request->request->get('message');

        if (!$name || !$tel || !$userEmail || !$message) { 
            $this->addFlash('error', 'Veuillez remplir tous les champs obligatoires.');
            return $this->redirectToRoute('app_front_contact_contact');
        }

        // Enregistrer le message en base de données
        $contactMessage = new ContactMessage();
        $contactMessage->setName($name);
        $contactMessage->setTel($tel);
        $contactMessage->setEmail($userEmail);
        $contactMessage->setMessage($message);
        $contactMessage->setCreatedAt(new \DateTime()); // ✅ Assure-toi que la date est bien définie

        $entityManager->persist($contactMessage);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Votre message a été envoyé avec succès.'
        ]);
        
        return $this->redirectToRoute('app_front_contact_contact');
    }


}