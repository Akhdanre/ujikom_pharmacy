<?php

namespace App\Http\Middleware;

use App\Application\Services\AdminAuthApplicationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function __construct(
        private AdminAuthApplicationService $adminAuthService
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user can access admin panel using Application Service
        if (!$this->adminAuthService->canAccessAdminPanel()) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Get current admin user
        $admin = $this->adminAuthService->getCurrentAdmin();
        
        if (!$admin) {
            $this->adminAuthService->logoutAdmin();
            return redirect()->route('admin.login')
                ->with('error', 'Anda tidak memiliki akses admin.');
        }

        // Check if admin is active
        if (!$admin->isActive()) {
            $this->adminAuthService->logoutAdmin();
            return redirect()->route('admin.login')
                ->with('error', 'Akun Anda telah dinonaktifkan.');
        }

        return $next($request);
    }
}
