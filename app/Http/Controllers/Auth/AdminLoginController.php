<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Application\Services\AdminAuthApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends BaseController {
    public function __construct(
        private AdminAuthApplicationService $adminAuthService
    ) {
    }

    public function index() {
        // Jika sudah login sebagai admin, redirect ke dashboard
        if ($this->adminAuthService->isLoggedInAsAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('pages.auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        // Gunakan Application Service untuk login admin
        $result = $this->adminAuthService->loginAdmin(
            $request->input('email'),
            $request->input('password'),
            $request->boolean('remember')
        );

        if (!$result['success']) {
            throw ValidationException::withMessages([
                'email' => $result['message'],
            ]);
        }

        // Regenerate session untuk keamanan
        $request->session()->regenerate();

        // Redirect ke dashboard admin
        return redirect()->intended(route('admin.dashboard'))
            ->with('success', 'Selamat datang, ' . $result['user']->getDisplayName() . '!');
    }

    public function logout(Request $request) {
        // Gunakan Application Service untuk logout admin
        $result = $this->adminAuthService->logoutAdmin();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $message = $result['success'] ? 'Anda telah berhasil logout.' : 'Terjadi kesalahan saat logout.';

        return redirect()->route('admin.login')
            ->with($result['success'] ? 'success' : 'error', $message);
    }
}
