<?php

namespace App\Controller\Front\AllBiens\BienParVille;

use App\Entity\bien;
use App\Entity\Ville;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienParVilleController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/front/all/biens/ville/{nomVille}', name: 'app_front_all_biens_par_ville')]
    public function biensParVille(Request $request, string $nomVille, PaginatorInterface $paginator): Response
    {
        // Trouver la ville par son nom
        $ville = $this->entityManager->getRepository(Ville::class)->findOneBy(['nomVille' => $nomVille]);

        if (!$ville) {
            throw $this->createNotFoundException("La ville $nomVille n'existe pas.");
        }

        // Récupérer les paramètres de la requête (typeOffre, id, nomType)
        $typeOffre = $request->query->get('typeOffre');
        $id = $request->query->get('id');
        $nomType = $request->query->get('nomType');

        // Récupérer les biens associés à cette ville et filtrer par typeOffre si spécifié
        $bienRepo = $this->entityManager->getRepository(Bien::class);
        $queryBuilder = $bienRepo->createQueryBuilder('b')
            ->where('b.ville = :ville')
            ->andWhere('b.bienAfficher = true')
            ->setParameter('ville', $ville);

        // Filtre par typeOffre
        if ($typeOffre) {
            $queryBuilder->andWhere('b.typeOffre = :typeOffre')
                         ->setParameter('typeOffre', $typeOffre);
        }

        // Filtre par ID (si rempli)
        if ($id) {
            $queryBuilder->andWhere('b.id = :id')
                         ->setParameter('id', $id);
        }

        // Filtre par Type de Bien (nomType)
        if ($nomType) {
            $queryBuilder->join('b.type', 't')  // 'type' doit être le nom de la relation dans l'entité Bien
                         ->andWhere('t.nomType = :nomType')
                         ->setParameter('nomType', $nomType);
        }

        // Tri par option
        $orderby = $request->query->get('orderby');
        switch ($orderby) {
            case 'date':
                $queryBuilder->orderBy('b.dateCreation', 'DESC');
                break;

            case 'price':
                $queryBuilder->orderBy('b.prixBien', 'ASC');
                break;

            case 'price-desc':
                $queryBuilder->orderBy('b.prixBien', 'DESC');
                break;

            default:
                $queryBuilder->orderBy('b.id', 'ASC');  // Tri par défaut
                break;
        }

        // Pagination : Exécuter la requête et récupérer les résultats
        $biens = $paginator->paginate(
            $queryBuilder->getQuery(), // Utilisation de la bonne variable ici
            $request->query->getInt('page', 1), // Page actuelle
            3 // Nombre d'éléments par page
        );

        // Récupérer tous les types d'offres disponibles pour cette ville
        $typesOffres = $bienRepo->createQueryBuilder('b')
            ->select('DISTINCT b.typeOffre')
            ->where('b.ville = :ville')
            ->andwhere('b.bienAfficher = true')
            ->setParameter('ville', $ville)
            ->getQuery()
            ->getResult();

        $typesOffres = array_map(function($typeOffre) {
            return $typeOffre['typeOffre']; // Retourne la valeur de 'typeOffre' pour chaque résultat
        }, $typesOffres);

        // Renvoyer les résultats
        return $this->render('front/all_biens/BienParVille/bien_par_ville.html.twig', [
            'biens' => $biens,
            'nomVille' => $nomVille,
            'typesOffres' => $typesOffres,  // Directement les résultats, pas de `array_column` nécessaire
            'selectedTypeOffre' => $typeOffre,
            'selectedNomType' => $nomType,
            'selectedId' => $id,
            'ville' => $ville,
            'typeOffre' => $typeOffre,
        ]);
    }
}
