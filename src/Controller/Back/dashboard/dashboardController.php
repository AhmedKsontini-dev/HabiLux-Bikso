<?php

namespace App\Controller\Back\dashboard;

use App\Repository\BienRepository;
use App\Repository\TypeBienRepository;
use App\Repository\EvenementRepository;
use App\Repository\HistoriqueActionRepository;
use App\Service\HistoriqueService;
use App\Service\UnreadMessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\Query\Expr\Join;
use App\Repository\TransactionRepository;

class DashboardController extends AbstractController
{
    private HistoriqueService $historiqueService;
    private $unreadMessageService;

    public function __construct(HistoriqueService $historiqueService, UnreadMessageService $unreadMessageService)
    {
        $this->historiqueService = $historiqueService;
        $this->unreadMessageService = $unreadMessageService;
    }

    #[Route('/back/dashboard', name: 'app_back_dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(
        BienRepository $bienRepository,
        TypeBienRepository $typeBienRepository,
        EvenementRepository $evenementRepository,
        HistoriqueActionRepository $historiqueActionRepository,
        TransactionRepository $transactionRepository
    ): Response {

        // Récupérer le prochain événement
        $now = new \DateTime();
        $nextEvent = $evenementRepository->findNextEvent($now);

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();
       
        
        // Récupérer les 10 dernières actions de l'historique
        $historique = $historiqueActionRepository->findBy([], ['dateAction' => 'DESC'], 10);

        $salesAndRentalsByMonth = $transactionRepository->countSalesAndRentalsByMonth();

        // Récupérer les commissions par type
        $commissions = $transactionRepository->countCommissionsByType();
        $totalSalesCommission = $commissions[0]['total_sales_commission'] ?? 0;
        $totalRentalsCommission = $commissions[0]['total_rentals_commission'] ?? 0;

        // Passer les données à la vue
        return $this->render('back/dashboard/index.html.twig', [
            'next_event' => $nextEvent,
            'historique' => $historique,
            'unreadCount' => $unreadCount, 
            'salesAndRentalsByMonth' => $salesAndRentalsByMonth,
            'totalSalesCommission' => $totalSalesCommission,
            'totalRentalsCommission' => $totalRentalsCommission,
        ]);
    }
}
