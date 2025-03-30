<?php
namespace App\Controller\Front\AllBiens\DetailsProp;

use App\Entity\bien;
use App\Entity\ImageBien;
use App\Entity\Favoris;
use App\Entity\DetailsPropriete;
use App\Repository\FavorisRepository;
use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ContactMessage;

class detailsPropController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/front/all/biens/details/prop/{id}', name: 'app_front_all_biens_details_prop')]
    public function index(int $id, Request $request, FavorisRepository $favorisRepository, BienRepository $bienRepository, EntityManagerInterface $entityManager): Response
    {
        // Récupérer le bien
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

        // Récupérer les images associées au bien
        $images = $this->entityManager->getRepository(ImageBien::class)->findBy(['bien' => $bien]);

        // Récupérer les propriétés associées au bien
        $detailsProprietes = $this->entityManager->getRepository(DetailsPropriete::class)->findBy(['bien' => $bien]);

        // Vérifier si le formulaire a été soumis
        if ($request->isMethod('POST')) {
            $nom = htmlspecialchars($request->request->get('nom'));
            $email = htmlspecialchars($request->request->get('email'));
            $telephone = htmlspecialchars($request->request->get('telephone'));
            $message = htmlspecialchars($request->request->get('message'));
            $idBien = htmlspecialchars($request->request->get('id_bien'));

            // Vérifier si tous les champs sont remplis
            if (!$nom || !$email || !$telephone || !$message) {
                $this->addFlash('error', 'Veuillez remplir tous les champs obligatoires.');
                return $this->redirectToRoute('app_front_all_biens_details_prop', ['id' => $idBien]);
            }

            // Enregistrer le message en base de données
            $contactMessage = new ContactMessage();
            $contactMessage->setName($nom);
            $contactMessage->setEmail($email);
            $contactMessage->setTel($telephone);
            $contactMessage->setMessage($message);
            $contactMessage->setCreatedAt(new \DateTime());

            $entityManager->persist($contactMessage);
            $entityManager->flush();

            // Ajouter un message flash de succès
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
                ]);
            }else{
                $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoi du message.');

            };


        // Passer les informations au template Twig
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
        ]);
    }

    #[Route('/favoris/toggle', name: 'toggle_favoris', methods: ['POST'])]
    public function toggleFavoris(Request $request): JsonResponse
    {
        $user = $this->getUser(); // Récupérer l'utilisateur connecté

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non connecté'], Response::HTTP_UNAUTHORIZED);
        }

        $idBien = $request->request->get('id');

        $bien = $this->entityManager->getRepository(Bien::class)->find($idBien);

        if (!$bien) {
            return new JsonResponse(['message' => 'Bien non trouvé'], Response::HTTP_NOT_FOUND);
        }

        // Vérifier si le favori existe déjà
        $favori = $this->entityManager->getRepository(Favoris::class)->findOneBy([
            'user' => $user,
            'bien' => $bien,
        ]);

        if ($favori) {
            // Supprimer des favoris
            $this->entityManager->remove($favori);
            $this->entityManager->flush();
            return new JsonResponse(['status' => 'removed', 'isFavori' => false]);
        } else {
            // Ajouter aux favoris
            $favori = new Favoris();
            $favori->setUser($user);
            $favori->setBien($bien);
            $this->entityManager->persist($favori);
            $this->entityManager->flush();
            return new JsonResponse(['status' => 'added', 'isFavori' => true]);
        }
    }

   





    
}
