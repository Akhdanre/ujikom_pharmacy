<?php

namespace App\Presentation\Controllers\Auth;

use App\Application\Services\AuthApplicationService;
use App\Presentation\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends BaseController
{
    public function __construct(
        private AuthApplicationService $authApplicationService
    ) {}

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
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
            if ($remember) {
                auth()->login($user, true);
            } else {
                auth()->login($user);
            }

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        throw ValidationException::withMessages([
            'login' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        $this->authApplicationService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
} 