<?php

namespace App\Repository;

use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
        if ($transaction->getTypeTransaction() === 'Vente') {
            $bien = $transaction->getBien();
            $bien->setBienAfficher(false); // Masquer le bien vendu
            $entityManager->persist($bien);
            $entityManager->flush();
        }
    }

}
