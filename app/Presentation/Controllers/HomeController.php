<?php

namespace App\Presentation\Controllers;

use App\Application\Services\MedicineApplicationService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function __construct(
        private MedicineApplicationService $medicineService
    ) {}

    public function index(Request $request): View
    {
        $search = $request->get('search', '');
        $category = $request->get('category', '');
        
        $medicines = $this->medicineService->getPublicMedicines($search, $category);
        $categories = $this->medicineService->getMedicineCategories();
        $featuredMedicines = $this->medicineService->getFeaturedMedicines();
        
        return view('pages.home', compact('medicines', 'categories', 'featuredMedicines', 'search', 'category'));
    }

    public function show($id): View
    {
        $medicine = $this->medicineService->getMedicineById($id);
        $relatedMedicines = $this->medicineService->getRelatedMedicines($id);
        
        return view('pages.medicine-detail', compact('medicine', 'relatedMedicines'));
    }

    public function category($category): View
    {
        $medicines = $this->medicineService->getMedicinesByCategory($category);
        $categories = $this->medicineService->getMedicineCategories();
        
        return view('pages.category', compact('medicines', 'categories', 'category'));
    }
} 