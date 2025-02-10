<?php

namespace App\Controller\Front\AllBiens\BienParVille;

use App\Entity\Bien;
use App\Entity\Ville;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BienParVilleController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/front/all/biens/ville/{nomVille}', name: 'app_front_all_biens_par_ville')]
    public function biensParVille(Request $request, string $nomVille): Response
    {
        // Trouver la ville par son nom
        $ville = $this->entityManager->getRepository(Ville::class)->findOneBy(['nomVille' => $nomVille]);
        

        if (!$ville) {
            throw $this->createNotFoundException("La ville $nomVille n'existe pas.");
        }

        // Récupérer le type d'offre depuis l'URL (si présent)
        $typeOffre = $request->query->get('typeOffre');

        // Récupérer les biens associés à cette ville et filtrer par typeOffre si spécifié
        $bienRepo = $this->entityManager->getRepository(Bien::class);
        $queryBuilder = $bienRepo->createQueryBuilder('b')
            ->where('b.ville = :ville')
            ->setParameter('ville', $ville);

        if ($typeOffre) {
            $queryBuilder->andWhere('b.typeOffre = :typeOffre')
                         ->setParameter('typeOffre', $typeOffre);
        }

        $biens = $queryBuilder->getQuery()->getResult();

        // Récupérer tous les types d'offres disponibles pour cette ville
        $typesOffres = $bienRepo->createQueryBuilder('b')
            ->select('DISTINCT b.typeOffre')
            ->where('b.ville = :ville')
            ->setParameter('ville', $ville)
            ->getQuery()
            ->getResult();

        return $this->render('front/all_biens/BienParVille/bien_par_ville.html.twig', [
            'biens' => $biens,
            'nomVille' => $nomVille,
            'typesOffres' => array_column($typesOffres, 'typeOffre'), // On extrait uniquement les valeurs
            'selectedTypeOffre' => $typeOffre
        ]);
    }
}
