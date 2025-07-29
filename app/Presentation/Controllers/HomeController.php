<?php

namespace App\Presentation\Controllers;

use App\Application\Services\MedicineApplicationService;
use App\Application\Services\CategoryApplicationService;
use App\Presentation\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends BaseController
{
    public function __construct(
        private MedicineApplicationService $medicineService,
        private CategoryApplicationService $categoryService
    ) {}

    public function index(Request $request): View
    {
        $search = $request->get('search', '');
        $categoryId = $request->get('category_id');
        
        // Convert category_id to integer if provided
        if ($categoryId && is_numeric($categoryId)) {
            $categoryId = (int) $categoryId;
        } else {
            $categoryId = null;
        }
        
        $medicines = $this->medicineService->getPublicMedicines($search, $categoryId);
        $categories = $this->categoryService->getAllCategories();
        $featuredMedicines = $this->medicineService->getTopSellingMedicines(8); // Get top 8 selling medicines as featured
        
        return view('pages.home', compact('medicines', 'categories', 'featuredMedicines', 'search', 'categoryId'));
    }

    public function show($id): View
    {
        $medicine = $this->medicineService->getMedicineById($id);
        $relatedMedicines = $this->medicineService->getRelatedMedicines($id);
        
        return view('pages.medicine-detail', compact('medicine', 'relatedMedicines'));
    }

    public function category($categoryId): View
    {
        // Convert categoryId to integer
        $categoryId = (int) $categoryId;
        
        $medicines = $this->medicineService->getMedicinesByCategory($categoryId);
        $categories = $this->categoryService->getAllCategories();
        $category = $this->categoryService->getCategoryById($categoryId);
        
        return view('pages.category', compact('medicines', 'categories', 'category'));
    }
} 