<?php

namespace App\Controller\Front\habitation\Appartement;

use App\Entity\bien;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class AppartemantController extends AbstractController
{
    #[Route('/front/habitation/appartemant/louer', name: 'app_front_habitation_appartemant_louer')]
    public function louer(EntityManagerInterface $entityManager, PaginatorInterface $paginator, BienRepository $bienRepository, Request $request): Response
    {

        // Récupérer uniquement les biens avec typeOffre = "A Louer" et typeBien = "Villa"
        $qb = $bienRepository->findByTypeOffreAndTypeBien('A Louer', 'Appartement', true);

        // Exécuter la requête et récupérer les résultats
        $biens = $qb->getQuery()->getResult();

        // Filtre par ID (si rempli)
        $id = $request->query->get('id');
        if ($id) {
            $qb->andWhere('b.id = :id')->setParameter('id', $id);
        }

        // Filtre par gouvernorat
        $gouvernorat = $request->query->get('gouvernorat');
        if ($gouvernorat) {
            $qb->join('b.gouvernorat', 'g')  // 'gouvernorat' doit être le nom de la relation dans l'entité Bien
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

        $biens = $paginator->paginate(
            $qb->getQuery(),
            $request->query->getInt('page', 1), // Page actuelle
            3 // Nombre d'éléments par page
        );

        // Récupérer le nombre total de biens de type "Villa" et "A Louer"
        $totalBiensLouer = $bienRepository->countBiensByTypeOffreAndTypeBien('A Louer', 'Appartement', true);

        return $this->render('front/habitation/appartemant/appartement_louer.html.twig', [
            'controller_name' => 'AppartemantController',
            'biens' => $biens,
            'totalBiensLouer' => $totalBiensLouer
        ]);
    }

    #[Route('/front/habitation/appartemant/avendre', name: 'app_front_habitation_appartemant_avendre')]
    public function vendre(EntityManagerInterface $entityManager, PaginatorInterface $paginator, BienRepository $bienRepository, Request $request): Response
    {

         // Récupérer uniquement les biens avec typeOffre = "A Louer" et typeBien = "Villa"
         $qb = $bienRepository->findByTypeOffreAndTypeBien('A Vendre', 'Appartement', true);


        // Exécuter la requête et récupérer les résultats
        $biens = $qb->getQuery()->getResult();

        // Filtre par ID (si rempli)
        $id = $request->query->get('id');
        if ($id) {
            $qb->andWhere('b.id = :id')->setParameter('id', $id);
        }

        // Filtre par gouvernorat
        $gouvernorat = $request->query->get('gouvernorat');
        if ($gouvernorat) {
            $qb->join('b.gouvernorat', 'g')  // 'gouvernorat' doit être le nom de la relation dans l'entité Bien
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

        $biens = $paginator->paginate(
            $qb->getQuery(),
            $request->query->getInt('page', 1), // Page actuelle
            3 // Nombre d'éléments par page
        );
         
        // Récupérer le nombre total de biens de type "Villa" et "A Louer"
        $totalBiensVendre = $bienRepository->countBiensByTypeOffreAndTypeBien('A Vendre', 'Appartement', true); 

        return $this->render('front/habitation/appartemant/appartement_vendre.html.twig', [
            'controller_name' => 'AppartemantController',
            'biens' => $biens,
            'totalBiensVendre' => $totalBiensVendre
        ]);
    }
}
