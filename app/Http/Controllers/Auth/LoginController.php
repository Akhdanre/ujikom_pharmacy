<?php

namespace App\Http\Controllers\Auth;


use App\Application\Services\AuthApplicationService;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController {
    public function __construct(
        private AuthApplicationService $authApplicationService
    ) {
    }

    public function showLoginForm() {
        return view('pages.auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'login' => 'required|string', // Can be email or username
            'password' => 'required',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        // Try to login and get user entity directly
        $user = $this->authApplicationService->loginAndGetUser($login, $password);

        if ($user) {
            // User is already logged in by AuthService, just set remember if needed
            if ($remember) {
                Auth::login($user, true);
            }

            $request->session()->regenerate();

            return redirect()->intended(default: route(name: 'dashboard'));
        }

        throw ValidationException::withMessages([
            'login' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request) {
        $this->authApplicationService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
