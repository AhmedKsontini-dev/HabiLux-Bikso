<?php
namespace App\Repository;

use App\Entity\bien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Bien>
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }

    // Méthode pour compter les types distincts de biens
    public function countDistinctTypes(): int
    {
        $qb = $this->createQueryBuilder('b')
            ->select('COUNT(DISTINCT b.typeBien)');  // Assure-toi que le champ `typeBien` existe dans l'entité `Bien`

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    // Méthode pour compter les biens avec un type d'offre spécifique (par exemple 'A Louer' ou 'A Vendre')
    public function countByTypeOffre(string $typeOffre, bool $onlyVisible = false): int
    {
        $qb = $this->createQueryBuilder('b')
            ->select('COUNT(b.id)')
            ->where('b.typeOffre = :typeOffre')
            ->setParameter('typeOffre', $typeOffre);

        if ($onlyVisible) {
            $qb->andWhere('b.bienAfficher = true');
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }


    // Méthode pour compter tous les biens
    public function countAll(): int
    {
        return (int) $this->createQueryBuilder('b')
            ->select('COUNT(b.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    
    public function findAllWithRelations()
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.type', 't')->addSelect('t') // Correction du typeBien -> type
            ->leftJoin('b.imageBiens', 'i')->addSelect('i') // Correction des images
            ->leftJoin('b.publierPar', 'u')->addSelect('u') 
            ->leftJoin('b.ville', 'v')
            ->leftJoin('v.gouvernorat', 'g')
            ->addSelect('v', 'g')// Correction de l'utilisateur
            ->getQuery()
            ->getResult();
    }
    // recuperer les bien par date DESC
    public function findLastFiveBiens()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.dateCreation', 'DESC')
            ->where('b.bienAfficher = true')
            ->setMaxResults(5) // Limiter à 5 biens
            ->getQuery()
            ->getResult();
    }


    // Méthode pour trouver les biens avec un type d'offre spécifique
    // public function findByTypeOffreAndTypeBien(string $typeOffre, string $typeBien)
    // {
    //     return $this->createQueryBuilder('b')
    //         ->leftJoin('b.type', 't') // Assure-toi que la relation entre `Bien` et `TypeBien` est bien définie
    //         ->addSelect('t')
    //         ->where('b.typeOffre = :typeOffre')
    //         ->andWhere('t.nomType = :typeBien') // Filtrer par le nom du type (Villa)
    //         ->setParameter('typeOffre', $typeOffre)
    //         ->setParameter('typeBien', $typeBien)
    //         ->getQuery()
    //         ->getResult();
    // }

    // Méthode pour trouver les biens avec un type d'offre spécifique
    public function findByTypeOffreAndTypeBien(string $typeOffre, string $typeBien)
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.type', 't') // Assure-toi que la relation entre `Bien` et `TypeBien` est bien définie
            ->addSelect('t')
            ->where('b.typeOffre = :typeOffre')
            ->andWhere('t.nomType = :typeBien')
            ->andwhere('b.bienAfficher = true') // Filtrer par le nom du type (Villa)
            ->setParameter('typeOffre', $typeOffre)
            ->setParameter('typeBien', $typeBien);
    }


    // total des biens par type (accueil)
    public function countByType(): array
    {
        return $this->createQueryBuilder('b')
            ->select('t.nomType, COUNT(b.id) as total')
            ->join('b.type', 't')
            ->groupBy('t.nomType')
            ->getQuery()
            ->getResult();
    }


    // compter le nombre total des bien par typeOffre et typeId
    public function countBiensByTypeOffreAndTypeBien(string $typeOffre, string $typeBien): int
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.type', 't') // Jointure avec la table `type_bien`
            ->where('b.typeOffre = :typeOffre')
            ->andWhere('t.nomType = :typeBien')
            ->andwhere('b.bienAfficher = true') // Filtrer par le nom du type de bien
            ->setParameter('typeOffre', $typeOffre)
            ->setParameter('typeBien', $typeBien)
            ->select('COUNT(b.id)') // On compte le nombre d'enregistrements
            ->getQuery()
            ->getSingleScalarResult(); // Retourne un seul résultat, le nombre de biens
    }

    public function findBiensVisibles()
    {
        return $this->createQueryBuilder('b')
            ->where('b.bienAfficher = true')
            ->getQuery()
            ->getResult();
    }




}
