<?php

namespace App\Controller\Front\AllBiens\A_Louer;

use App\Entity\bien;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienLouerController extends AbstractController
{
    #[Route('/front/all/biens/louer', name: 'app_front_all_biens_louer')]
    public function index(
        EntityManagerInterface $entityManager, 
        PaginatorInterface $paginator, 
        BienRepository $bienRepository, 
        Request $request
    ): Response {
        // Créer une requête pour récupérer les biens visibles avec typeOffre = "A Louer"
        $qb = $entityManager->getRepository(Bien::class)->createQueryBuilder('b');

        // Appliquer les filtres
        $qb->where('b.typeOffre = :typeOffre')
        ->andWhere('b.bienAfficher = true')  // Filtrer les biens visibles
        ->setParameter('typeOffre', 'A Louer');

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

        // Compter le nombre de biens "A Louer" visibles
        $countBiensALouer = $bienRepository->countByTypeOffre('A Louer', true);

        // Retourner la vue avec les résultats
        return $this->render('front/all_biens/A_Louer/liste_prop_louer.html.twig', [
            'biens' => $biens,
            'countBiensALouer' => $countBiensALouer
        ]);
    }

}
