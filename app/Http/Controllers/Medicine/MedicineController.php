<?php

namespace App\Http\Controllers\Medicine;

use App\Application\Services\MedicineApplicationService;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class MedicineController extends BaseController {

    public function index(Request $request) {
        $medicineService = app(MedicineApplicationService::class);
        
        // Get statistics
        $statistics = $medicineService->getMedicineStatistics();
        
        // Get medicines by status for alert sections
        $expiredMedicines = $medicineService->getExpiredMedicines();
        $expiringSoonMedicines = $medicineService->getExpiringSoonMedicines(30); // 30 days
        
        // Get all medicines for pagination
        $allMedicines = $medicineService->getAllMedicines();
        
        // Create paginated collection
        $perPage = $request->get('per_page', 15);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $perPage;
        
        $medicines = new LengthAwarePaginator(
            array_slice($allMedicines, $offset, $perPage),
            count($allMedicines),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        
        return view('pages.admin-medicine.index', compact(
            'statistics',
            'expiredMedicines',
            'expiringSoonMedicines',
            'medicines'
        ));
    }
}
