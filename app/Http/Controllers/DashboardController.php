<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends BaseController {
    public function index() {
        Log::info("testing");
        return view('pages.admin-home.index');
    }
}
