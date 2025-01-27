<?php
namespace App\Repository;

use App\Entity\TypeBien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeBien>
 */
class TypeBienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeBien::class);
    }

    // Méthode pour compter le nombre de types distincts dans la table 'type_bien'
    public function countDistinctTypes(): int
    {
        $qb = $this->createQueryBuilder('t')
            ->select('COUNT(t.id)'); // Assure-toi que 'id' est le champ de la table `type_bien`

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
}
