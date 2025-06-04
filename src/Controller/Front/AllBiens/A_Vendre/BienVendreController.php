<?php

namespace App\Controller\Front\AllBiens\A_Vendre;

use App\Entity\Bien;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class BienVendreController extends AbstractController
{
    #[Route('/front/all/biens/vendre', name: 'app_front_all_biens_vendre')]
    public function index(
        EntityManagerInterface $entityManager, 
        PaginatorInterface $paginator, 
        BienRepository $bienRepository, 
        Request $request): Response
    {
         // Créer une requête pour récupérer les biens visibles avec typeOffre = "A Vendre"
    $qb = $entityManager->getRepository(Bien::class)->createQueryBuilder('b');

    // Appliquer les filtres
    $qb->where('b.typeOffre = :typeOffre')
       ->andWhere('b.bienAfficher = true')  // Filtrer les biens visibles
       ->setParameter('typeOffre', 'A Vendre');

    // Filtre par ID (si fourni)
    if ($id = $request->query->get('id')) {
        $qb->andWhere('b.id = :id')->setParameter('id', $id);
    }

    // Filtre par Type de Bien (nomType)
    if ($nomType = $request->query->get('nomType')) {
        $qb->join('b.type', 't')  
           ->andWhere('t.nomType = :nomType')
           ->setParameter('nomType', $nomType);
    }

    // Filtre par Gouvernorat
    if ($gouvernorat = $request->query->get('gouvernorat')) {
        $qb->join('b.gouvernorat', 'g')  
           ->andWhere('g.nomGouvernorat = :nomGouvernorat')
           ->setParameter('nomGouvernorat', $gouvernorat);
    }


    // Récupérer les valeurs de prixMin et prixMax depuis la requête
    $prixMin = $request->query->get('prixMin');
    $prixMax = $request->query->get('prixMax');
    // Vérifier et appliquer les filtres
    if (!empty($prixMin)) {
        $qb->andWhere('b.prixBien >= :prixMin')
        ->setParameter('prixMin', (int) $prixMin);
    }
    if (!empty($prixMax)) {
        $qb->andWhere('b.prixBien <= :prixMax')
        ->setParameter('prixMax', (int) $prixMax);
    }

    // Tri par option
    $orderby = $request->query->get('orderby');
    switch ($orderby) {
        case 'date':
            $qb->orderBy('b.dateCreation', 'DESC');
            break;
        case 'price':
            $qb->orderBy('b.prixBien', 'ASC');
            break;
        case 'price-desc':
            $qb->orderBy('b.prixBien', 'DESC');
            break;
        default:
            $qb->orderBy('b.id', 'ASC');  // Tri par défaut
            break;
    }

    // Paginer les résultats
    $biens = $paginator->paginate(
        $qb->getQuery(),
        $request->query->getInt('page', 1), 
        3
    );

    // Compter le nombre de biens "A Vendre" visibles
    $countBiensAVendre = $bienRepository->countByTypeOffre('A Vendre', true);
        

        return $this->render('front/all_biens/A_Vendre/liste_prop_Vendre.html.twig', [
            'biens' => $biens,
            'countBiensAVendre' => $countBiensAVendre
        ]);
    }
}
