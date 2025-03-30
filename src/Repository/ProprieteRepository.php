<?php

namespace App\Repository;

use App\Entity\propriete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Propriete|null find($id, $lockMode = null, $lockVersion = null)
 * @method Propriete|null findOneBy(array $criteria, array $orderBy = null)
 * @method Propriete[]    findAll()
 * @method Propriete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProprieteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Propriete::class);
    }

    // Méthode personnalisée pour trouver par type_id
    public function findByTypeId(int $typeId)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.type', 't')
            ->andWhere('t.id = :typeId')
            ->setParameter('typeId', $typeId)
            ->getQuery()
            ->getResult();
    }

}
