<?php
namespace App\Controller\Back\dashboard;

use App\Repository\BienRepository;
use App\Repository\TypeBienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractController
{
    #[Route('/back/dashboard', name: 'app_back_dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(
        BienRepository $bienRepository,
        TypeBienRepository $typeBienRepository
    ): Response
    {
        // Récupérer les statistiques des biens
        $totalProperties = $bienRepository->countAll();
        $propertiesForRent = $bienRepository->countByTypeOffre('À Louer');
        $propertiesForSale = $bienRepository->countByTypeOffre('À Vendre');
        
        // Récupérer le nombre de types distincts de biens
        $distinctTypesCount = $typeBienRepository->countDistinctTypes();

        // Passer les données à la vue
        return $this->render('back/dashboard/index.html.twig', [
            'total_properties' => $totalProperties,
            'properties_for_rent' => $propertiesForRent,
            'properties_for_sale' => $propertiesForSale,
            'distinct_types_count' => $distinctTypesCount, // Ajout du nombre de types distincts
        ]);
    }
}
