<?php
namespace App\Controller\Front\AllBiens\DetailsProp;

use App\Entity\Bien;
use App\Entity\ImageBien;
use App\Entity\Favoris;
use App\Entity\DetailsPropriete;
use App\Repository\FavorisRepository;
use App\Repository\BienRepository;
use App\Repository\TransactionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\ContactMessage;

class detailsPropController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/front/all/biens/details/prop/{id}', name: 'app_front_all_biens_details_prop')]
    public function index(int $id, Request $request, FavorisRepository $favorisRepository, BienRepository $bienRepository, EntityManagerInterface $entityManager, TransactionRepository $transactionRepository): Response
    {
        $bien = $this->entityManager->getRepository(Bien::class)->find($id);

        if (!$bien) {
            throw $this->createNotFoundException('Le bien n\'existe pas.');
        }

        $nombreFavoris = $favorisRepository->countFavorisForBien($bien);

        $isFavori = false;

        if ($this->getUser()) {
            $isFavori = (bool) $this->entityManager->getRepository(Favoris::class)->findOneBy([
                'user' => $this->getUser(),
                'bien' => $bien
            ]);
        }

        $images = $this->entityManager->getRepository(ImageBien::class)->findBy(['bien' => $bien]);
        $detailsProprietes = $this->entityManager->getRepository(DetailsPropriete::class)->findBy(['bien' => $bien]);

        if ($request->isMethod('POST')) {
            $nom = htmlspecialchars($request->request->get('nom'));
            $email = htmlspecialchars($request->request->get('email'));
            $telephone = htmlspecialchars($request->request->get('telephone'));
            $message = htmlspecialchars($request->request->get('message'));
            $idBien = htmlspecialchars($request->request->get('id_bien'));

            if (!$nom || !$email || !$telephone || !$message) {
                $this->addFlash('error', 'Veuillez remplir tous les champs obligatoires.');
                return $this->redirectToRoute('app_front_all_biens_details_prop', ['id' => $idBien]);
            }

            $contactMessage = new ContactMessage();
            $contactMessage->setName($nom);
            $contactMessage->setEmail($email);
            $contactMessage->setTel($telephone);
            $contactMessage->setMessage($message);
            $contactMessage->setCreatedAt(new \DateTime());

            $entityManager->persist($contactMessage);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a été enregistré avec succès !');

            return $this->render('front/all_biens/details_prop/detailsProp.html.twig', [
                'bien' => $bien,
                'images' => $images,
                'detailsProprietes' => $detailsProprietes,
                'date_creation' => $bien->getDateCreation(),
                'description' => $bien->getDescription(),
                'typeOffre' => $bien->getTypeOffre(), 
                'prixBien' => $bien->getPrixBien(),
                'adresseBien' => $bien->getAdresseBien(),
                'afficherPrix' => $bien->isAfficherPrix(),
                'positionMap' => $bien->getPositionMap(),  
                'is_favori' => $isFavori,  
                'nbFavoris' => $nombreFavoris,
                'isLocation' => false, // sera mis à jour juste après

            ]);
        } else {
            $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoi du message.');
        }

        $transactions = $transactionRepository->findBy(['bien' => $bien]);

        $isLocation = false;
        foreach ($transactions as $transaction) {
            if ($transaction->getTypeTransaction() === 'Location') {
                $isLocation = true;
                break;
            }
        }

        return $this->render('front/all_biens/details_prop/detailsProp.html.twig', [
            'bien' => $bien,
            'images' => $images,
            'detailsProprietes' => $detailsProprietes,
            'date_creation' => $bien->getDateCreation(),
            'description' => $bien->getDescription(),
            'typeOffre' => $bien->getTypeOffre(), 
            'prixBien' => $bien->getPrixBien(),
            'adresseBien' => $bien->getAdresseBien(),
            'afficherPrix' => $bien->isAfficherPrix(),
            'positionMap' => $bien->getPositionMap(),
            'is_favori' => $isFavori,
            'nbFavoris' => $nombreFavoris,
            'isLocation' => $isLocation,
  
        ]);
    }

    #[Route('/favoris/toggle', name: 'toggle_favoris', methods: ['POST'])]
    public function toggleFavoris(Request $request): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non connecté'], Response::HTTP_UNAUTHORIZED);
        }

        $idBien = $request->request->get('id');
        $bien = $this->entityManager->getRepository(Bien::class)->find($idBien);

        if (!$bien) {
            return new JsonResponse(['message' => 'Bien non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $favori = $this->entityManager->getRepository(Favoris::class)->findOneBy([
            'user' => $user,
            'bien' => $bien,
        ]);

        if ($favori) {
            $this->entityManager->remove($favori);
            $this->entityManager->flush();
            return new JsonResponse(['status' => 'removed', 'isFavori' => false]);
        } else {
            $favori = new Favoris();
            $favori->setUser($user);
            $favori->setBien($bien);
            $this->entityManager->persist($favori);
            $this->entityManager->flush();
            return new JsonResponse(['status' => 'added', 'isFavori' => true]);
        }
    }
}
