<?php

namespace App\Http\Middleware;

use App\Application\Services\AuthApplicationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function __construct(
        private AuthApplicationService $authService
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        if (!$this->authService->canAccessAdminPanel($user)) {
            session()->flash('error', 'Anda tidak memiliki akses ke halaman ini');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
