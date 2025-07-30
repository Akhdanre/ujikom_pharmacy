<?php

namespace App\Http\Controllers\UserHome;

use App\Http\Controllers\BaseController;
use App\Application\Services\MedicineApplicationService;
use App\Application\Services\CategoryApplicationService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserHomeController extends BaseController {
    protected $medicineService;
    protected $categoryService;

    public function __construct(MedicineApplicationService $medicineService, CategoryApplicationService $categoryService) {
        $this->medicineService = $medicineService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request): View {
        // Get featured medicines and categories
        $featuredMedicines = $this->medicineService->getFeaturedMedicines();
        $categories = $this->categoryService->getAllCategories();
        $popularMedicines = $this->medicineService->getPopularMedicines();

        return view('pages.ecommerce.home', compact('featuredMedicines', 'categories', 'popularMedicines'));
    }

    public function products(Request $request): View {
        $search = $request->get('search');
        $category = $request->get('category');
        $sort = $request->get('sort', 'name');
        $order = $request->get('order', 'asc');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');

        $medicines = $this->medicineService->getMedicinesWithFilters([
            'search' => $search,
            'category' => $category,
            'sort' => $sort,
            'order' => $order,
            'min_price' => $minPrice,
            'max_price' => $maxPrice
        ]);

        $categories = $this->categoryService->getAllCategories();

        return view('pages.ecommerce.products', compact('medicines', 'categories', 'search', 'category', 'sort', 'order', 'minPrice', 'maxPrice'));
    }

    public function productDetail($id): View {
        $medicine = $this->medicineService->getMedicineById($id);
        $relatedMedicines = $this->medicineService->getRelatedMedicines($id);

        return view('pages.ecommerce.product-detail', compact('medicine', 'relatedMedicines'));
    }

    public function category($categoryId): View {
        $medicines = $this->medicineService->getMedicinesByCategory($categoryId);
        $category = $this->categoryService->getCategoryById($categoryId);
        $categories = $this->categoryService->getAllCategories();

        return view('pages.ecommerce.category', compact('medicines', 'category', 'categories'));
    }

    public function search(Request $request): View {
        $query = $request->get('q');
        $medicines = $this->medicineService->searchMedicines($query);
        $categories = $this->categoryService->getAllCategories();

        return view('pages.ecommerce.search', compact('medicines', 'categories', 'query'));
    }

    public function cart(): View {
        return view('pages.ecommerce.cart');
    }

    public function checkout(): View {
        return view('pages.ecommerce.checkout');
    }

    public function about(): View {
        return view('pages.ecommerce.about');
    }

    public function contact(): View {
        return view('pages.ecommerce.contact');
    }
}
