<?php

namespace App\Repository;

use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @extends ServiceEntityRepository<Transaction>
 */
class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function countSalesAndRentalsByMonth()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
            SELECT 
                DATE_FORMAT(date_transaction, '%Y-%m') AS month, 
                SUM(CASE WHEN type_transaction = 'vente' THEN 1 ELSE 0 END) as total_sales,
                SUM(CASE WHEN type_transaction = 'location' THEN 1 ELSE 0 END) as total_rentals
            FROM transaction
            GROUP BY month
            ORDER BY month ASC
        ";

        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery();

        return $result->fetchAllAssociative();
    }


    public function countCommissionsByType()
    {
        return $this->createQueryBuilder('t')
            ->select("SUM(CASE WHEN t.typeTransaction = 'Vente' THEN t.commission ELSE 0 END) as total_sales_commission,
                    SUM(CASE WHEN t.typeTransaction = 'location' THEN t.commission ELSE 0 END) as total_rentals_commission")
            ->getQuery()
            ->getResult();
    }

    public function getTransactionStatistics(): array
    {
        return $this->createQueryBuilder('t')
            ->select(
                "SUM(CASE WHEN t.typeTransaction = 'Vente' THEN 1 ELSE 0 END) as total_sales",
                "SUM(CASE WHEN t.typeTransaction = 'Location' THEN 1 ELSE 0 END) as total_rentals",
                "SUM(CASE WHEN t.statutTransaction = 'En attente' THEN 1 ELSE 0 END) as total_pending",
                "SUM(CASE WHEN t.payer = 'En cours' THEN 1 ELSE 0 END) as total_in_progress"
            )
            ->getQuery()
            ->getSingleResult();
    }

    public function vendreBien(Transaction $transaction, EntityManagerInterface $entityManager)
    {
        $bien = $transaction->getBien();

        if ($transaction->getTypeTransaction() === 'Vente') {
            $bien->setBienAfficher(false); // Masquer le bien vendu
            $bien->setDisponibilite('Non_disponible'); // Indiquer que le bien est non disponible
        } elseif ($transaction->getTypeTransaction() === 'Location') {
            $bien->setDisponibilite('Louee'); // Indiquer que le bien est loué
            $bien->setBienAfficher(true);     // Le bien peut rester visible
        }

        $entityManager->persist($bien);
        $entityManager->flush();
    }

    public function findFinLocationDepassee(): array
    {
        $qb = $this->createQueryBuilder('t');
        $qb->where('t.finLocation IS NOT NULL')
            ->andWhere('t.finLocation < :today')
            ->setParameter('today', new \DateTime('today'));
        return $qb->getQuery()->getResult();
    }

}
