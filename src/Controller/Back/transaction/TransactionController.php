<?php

namespace App\Controller\Back\transaction;

use App\Entity\Transaction;
use App\Form\TransactionType;
use App\Repository\UserRepository;
use App\Repository\TransactionRepository;
use App\Service\HistoriqueService;
use App\Service\UnreadMessageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\BienRepository; // ← IMPORTANT : Correct import
use App\Entity\Bien;

final class TransactionController extends AbstractController
{
    private HistoriqueService $historiqueService;
    private $unreadMessageService;
    private TransactionRepository $transactionRepository;

    public function __construct(HistoriqueService $historiqueService, UnreadMessageService $unreadMessageService, TransactionRepository $transactionRepository)
    {
        $this->unreadMessageService = $unreadMessageService;
        $this->historiqueService = $historiqueService;
        $this->transactionRepository = $transactionRepository;
    }

    #[Route('/back/transactions', name: 'app_transactions')]
    public function index(TransactionRepository $transactionRepository, Request $request): Response
    {
        // Récupérer les filtres depuis la requête GET
        $typeTransaction = $request->query->get('typeTransaction');
        $prixInitial = $request->query->get('prixInitial');
        $prixFinal = $request->query->get('prixFinal');
        $dateTransaction = $request->query->get('dateTransaction');
        $modePaiement = $request->query->get('modePaiement');
        $payer = $request->query->get('payer');
        $statutTransaction = $request->query->get('statutTransaction');

        // Construire les critères de filtrage
        $criteria = [];

        if ($typeTransaction) {
            $criteria['typeTransaction'] = $typeTransaction;
        }

        if ($prixInitial) {
            $criteria['prixInitial'] = $prixInitial;
        }

        if ($prixFinal) {
            $criteria['prixFinal'] = $prixFinal;
        }

        if ($dateTransaction) {
            $criteria['dateTransaction'] = $dateTransaction;
        }

        if ($modePaiement) {
            $criteria['modePaiement'] = $modePaiement;
        }

        if ($payer) {
            $criteria['payer'] = $payer;
        }

        if ($statutTransaction) {
            $criteria['statutTransaction'] = $statutTransaction;
        }

        // Récupérer les transactions filtrées
        $transactions = $criteria ? $transactionRepository->findBy($criteria) : $transactionRepository->findAll();

        // Récupérer les statistiques des transactions
        $stats = $transactionRepository->getTransactionStatistics();

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        // Rendre la vue avec les transactions filtrées
        return $this->render('back/transaction/list_transaction.html.twig', [
            'alltransactions' => $transactions,
            'unreadCount' => $unreadCount,
            'selectedTypeTransaction' => $typeTransaction,
            'selectedPrixInitial' => $prixInitial,
            'selectedPrixFinal' => $prixFinal,
            'selectedDateTransaction' => $dateTransaction,
            'selectedModePaiement' => $modePaiement,
            'selectedPayer' => $payer,
            'selectedStatutTransaction' => $statutTransaction,
            'totalSales' => $stats['total_sales'],
            'totalRentals' => $stats['total_rentals'],
            'totalPending' => $stats['total_pending'],
            'totalInProgress' => $stats['total_in_progress'],
        ]);
    }


    #[Route('/back/transactions/new', name: 'app_back_transaction_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,TransactionRepository $transactionRepository): Response
    {
        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->historiqueService->enregistrerAction('Ajout', "Ajout d'une nouvelle transaction ");
            $this->addFlash('success', 'Ajout de transaction avec succès');
            $entityManager->persist($transaction);
            $entityManager->flush();

            // Vérifier si c'est une vente et masquer le bien
            if ($transaction->getTypeTransaction() === 'Vente') {
                $bien = $transaction->getBien();
                if ($bien) {
                    $bien->setBienAfficher(false); // Masquer le bien vendu
                    $entityManager->persist($bien);
                    $entityManager->flush();
                }
            }

            // Appel de la méthode vendreBien() du repository
            $this->transactionRepository->vendreBien($transaction, $entityManager);
            

            return $this->redirectToRoute('app_transactions', [], Response::HTTP_SEE_OTHER);
        }
            

        return $this->render('back/transaction/new.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
            'unreadCount' => $unreadCount,
        ]);
    }


    #[Route('/back/transactions/show/{id}', name: 'app_back_transaction_show', methods: ['GET'])]
    public function show(Transaction $transaction): Response
    {

        // Récupérer le nombre de messages non lus
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        return $this->render('back/transaction/show.html.twig', [
            'transaction' => $transaction,
            'unreadCount' => $unreadCount,
        ]);
    }

    #[Route('/back/transactions/{id}/edit', name: 'app_back_transaction_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Transaction $transaction, EntityManagerInterface $entityManager,TransactionRepository $transactionRepository): Response
    {
        $unreadCount = $this->unreadMessageService->getUnreadCount();

        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Appel de la méthode pour mettre à jour la disponibilité du bien
            $this->transactionRepository->vendreBien($transaction, $entityManager);

            $this->historiqueService->enregistrerAction('Modification', "Modification de transaction ID: {$transaction->getId()} ");
            $this->addFlash('success', 'Modification de transaction avec succès');

            return $this->redirectToRoute('app_transactions', [], Response::HTTP_SEE_OTHER);
        }
            

        return $this->render('back/transaction/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
            'unreadCount' => $unreadCount,
        ]);
    }

    #[Route('/back/transactions/{id}/delete', name: 'app_back_transaction_delete', methods: ['POST'])]
    public function delete(Request $request, Transaction $transaction, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getId(), $request->request->get('_token'))) {
            $entityManager->remove($transaction);
            $entityManager->flush();

            $this->historiqueService->enregistrerAction('Suppression', "Suppression d'une transaction ");
            $this->addFlash('success', 'Suppression de transaction avec succès');
        }

        return $this->redirectToRoute('app_transactions', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/get-bien-description/{id}', name:'get_bien_description', methods:['GET'])]
    public function getBienDescription(int $id, BienRepository $bienRepository): JsonResponse
    {
        try {
            $bien = $bienRepository->find($id);
            
            if (!$bien) {
                return new JsonResponse([
                    'error' => 'Bien non trouvé avec l\'ID: ' . $id,
                    'success' => false
                ], 404);
            }
            
            // Vérifier si la méthode getDescription() existe
            if (!method_exists($bien, 'getDescription')) {
                return new JsonResponse([
                    'error' => 'La méthode getDescription() n\'existe pas dans l\'entité Bien',
                    'success' => false
                ], 500);
            }
            
            $description = $bien->getDescription();
            
            return new JsonResponse([
                'description' => $description ?? 'Aucune description disponible',
                'success' => true,
                'bien_id' => $bien->getId()
            ]);
            
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => 'Erreur serveur: ' . $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

  
   
}