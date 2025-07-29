<?php

namespace App\Presentation\Controllers\Auth;

use App\Application\Services\AuthApplicationService;
use App\Presentation\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class RegisterController extends BaseController
{
    public function __construct(
        private AuthApplicationService $authApplicationService
    ) {}

    public function showRegistrationForm()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['nullable', 'string', 'in:admin,pharmacist,buyer,supplier'],
        ]);

        try {
            $userData = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role ?? 'buyer', // Default role
            ];

            $userDTO = $this->authApplicationService->register($userData);

            // Login the user after successful registration
            auth()->login(\App\Models\User::find($userDTO->id));

            return redirect()->route('dashboard')->with('success', 'Registration successful!');
        } catch (\InvalidArgumentException $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
} 