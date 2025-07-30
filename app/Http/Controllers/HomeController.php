<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends BaseController {
    public function index(Request $request): View {
        // Return static home page without service dependencies
        return view('pages.home');
    }

    public function show($id): View {
        // For now, return a simple message
        return view('pages.medicine-detail', [
            'medicine' => null,
            'relatedMedicines' => []
        ]);
    }

    public function category($categoryId): View {
        // For now, return a simple message
        return view('pages.medicine-detail', [
            'medicines' => [],
            'categories' => [],
            'category' => null
        ]);
    }
}
