<?php
namespace App\Controller\Front\ListeFavoris;

use App\Repository\FavorisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Favoris;
use App\Entity\Bien;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class ListeFavorisController extends AbstractController
{
    #[Route('/front/liste/favoris', name: 'app_front_liste_favoris')] 
    public function index(FavorisRepository $favorisRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login'); 
        }

        // Récupérer les favoris de l'utilisateur
        $favoris = $favorisRepository->findBy(['user' => $user]);

        // Préparer une liste de biens à partir des favoris
        $biens = array_map(function($favori) {
            return $favori->getBien();
        }, $favoris);

        // Paginer les biens
        $pagination = $paginator->paginate(
            $biens, 
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('front/liste_favoris/liste_favoris.html.twig', [
            'favoris' => $favoris,
            'biens' => $pagination,
        ]);
    }

    #[Route('/toggle-favori/{id}', name: 'toggle_favori', methods: ['POST'])]
    public function toggleFavori(Bien $bien, EntityManagerInterface $entityManager, FavorisRepository $favorisRepository): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['success' => false, 'message' => 'Utilisateur non connecté'], 403);
        }

        $favori = $favorisRepository->findOneBy(['user' => $user, 'bien' => $bien]);

        if ($favori) {
            $entityManager->remove($favori);
            $isFavori = false;
        } else {
            $newFavori = new Favoris();
            $newFavori->setUser($user);
            $newFavori->setBien($bien);
            $entityManager->persist($newFavori);
            $isFavori = true;
        }

        $entityManager->flush();

        $totalFavoris = $favorisRepository->count(['bien' => $bien]);

        return new JsonResponse([
            'success' => true,
            'isFavori' => $isFavori,
            'totalFavoris' => $totalFavoris
        ]);
    }

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

        $totalFavoris = $favorisRepository->count(['user' => $this->getUser()]);

        return new JsonResponse(['success' => true, 'message' => 'Favori supprimé avec succès', 'totalFavoris' => $totalFavoris]);
    }
}
