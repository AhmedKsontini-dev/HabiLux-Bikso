<?php
namespace App\Repository;

use App\Entity\Bien;
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
    public function countByTypeOffre(string $typeOffre): int
    {
        $qb = $this->createQueryBuilder('b')
            ->select('COUNT(b.id)')
            ->andWhere('b.typeOffre = :typeOffre')
            ->setParameter('typeOffre', $typeOffre);

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
            ->leftJoin('b.publierPar', 'u')->addSelect('u') // Correction de l'utilisateur
            ->getQuery()
            ->getResult();
    }

    public function findLastBiens(int $limit = 2)
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.dateCreation', 'DESC') // Trier par date décroissante
            ->setMaxResults($limit) // Limiter le nombre de résultats
            ->getQuery()
            ->getResult();
    }


    public function findByTypeOffreAndTypeBien(string $typeOffre, string $typeBien)
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.type', 't') // Assure-toi que la relation entre `Bien` et `TypeBien` est bien définie
            ->addSelect('t')
            ->where('b.typeOffre = :typeOffre')
            ->andWhere('t.nomType = :typeBien') // Filtrer par le nom du type (Villa)
            ->setParameter('typeOffre', $typeOffre)
            ->setParameter('typeBien', $typeBien)
            ->getQuery()
            ->getResult();
    }

 





}
