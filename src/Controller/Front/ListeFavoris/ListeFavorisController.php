<?php
namespace App\Controller\Front\ListeFavoris;

use App\Repository\FavorisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Favoris;
use App\Entity\bien;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListeFavorisController extends AbstractController
{
    #[Route('/front/liste/favoris', name: 'app_front_liste_favoris')] 
    public function index(FavorisRepository $favorisRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login'); 
        }

        // Récupérer les favoris de l'utilisateur
        $favoris = $favorisRepository->findBy(['user' => $user]);

        return $this->render('front/liste_favoris/liste_favoris.html.twig', [
            'favoris' => $favoris,
        ]);
    }

    /**
     * Ajouter ou supprimer un favori (AJAX)
     */
    #[Route('/toggle-favori/{id}', name: 'toggle_favori', methods: ['POST'])]
    public function toggleFavori(Bien $bien, EntityManagerInterface $entityManager, FavorisRepository $favorisRepository): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['success' => false, 'message' => 'Utilisateur non connecté'], 403);
        }

        $favori = $favorisRepository->findOneBy(['user' => $user, 'bien' => $bien]);

        if ($favori) {
            // Supprimer des favoris
            $entityManager->remove($favori);
            $isFavori = false;
        } else {
            // Ajouter aux favoris
            $newFavori = new Favoris();
            $newFavori->setUser($user);
            $newFavori->setBien($bien);
            $entityManager->persist($newFavori);
            $isFavori = true;
        }

        $entityManager->flush();

        // Nombre total de favoris mis à jour
        $totalFavoris = $favorisRepository->count(['bien' => $bien]);

        return new JsonResponse([
            'success' => true,
            'isFavori' => $isFavori,
            'totalFavoris' => $totalFavoris
        ]);
    }

    /**
     * Supprimer un favori (AJAX)
     */
    #[Route('/front/liste/favoris/delete/{id}', name: 'app_front_liste_favoris_delete', methods: ['DELETE'])]
    public function deleteFavori(int $id, FavorisRepository $favorisRepository, EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(['success' => false, 'message' => 'Requête invalide'], 400);
        }

        $favori = $favorisRepository->find($id);

        if (!$favori) {
            return new JsonResponse(['success' => false, 'message' => 'Favori introuvable'], 404);
        }

        if ($favori->getUser() !== $this->getUser()) {
            return new JsonResponse(['success' => false, 'message' => 'Action non autorisée'], 403);
        }

        $entityManager->remove($favori);
        $entityManager->flush();

        // Nombre total de favoris mis à jour
        $totalFavoris = $favorisRepository->count(['user' => $this->getUser()]);

        return new JsonResponse(['success' => true, 'message' => 'Favori supprimé avec succès', 'totalFavoris' => $totalFavoris]);
    }
}
