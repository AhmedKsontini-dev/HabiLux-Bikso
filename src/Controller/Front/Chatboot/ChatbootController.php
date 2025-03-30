<?php

namespace App\Controller\Front\Chatboot;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChatbootController extends AbstractController
{
    #[Route('/chat', name: 'chat', methods: ['POST'])]
    public function chat(Request $request): JsonResponse
    {
        // Liste des questions et réponses
        $responses = [
            "vous etes qui" => "Nous sommes l'agence immobilière **HabiLux**, créée en 2024. Nos fondateurs sont **Ahmed Ksontini** et **Bilel Maghrebi**. Notre mission est de vous aider à trouver l'appartement, la villa, le terrain ou le bureau commercial de vos rêves. 🏡✨",
            "comment je peux trouver les bien" => "Trouver nos biens disponibles est **très simple** ! 🏠\n👉 Il vous suffit de cliquer sur **Propriétés** dans le menu, et vous aurez accès à **toutes nos offres**.",
            "jai une villa, appartement, burau, terrain a vendre est ce que je peux le partager dans cette platforme" => "Bien sûr ! Nous sommes là pour répondre à vos besoins. 🏡🔑\n📩 Vous pouvez nous contacter à **Contact@habilux.com**\n📞 Ou nous appeler au **93 313 278 / 55 236 485**."
        ];

        // Récupérer le message de l'utilisateur
        $data = json_decode($request->getContent(), true);
        $userMessage = strtolower(trim($data['message'] ?? ''));

        // Vérifier la réponse correspondante
        $responseMessage = $responses[$userMessage] ?? "Désolé, je ne comprends pas votre question. ❌\nEssayez de poser une autre question ! 😊";

        return new JsonResponse(['response' => $responseMessage]);
    }
}
