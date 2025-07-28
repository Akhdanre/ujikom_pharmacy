<?php

namespace App\Livewire\Auth;

use App\Application\Services\AuthApplicationService;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
    ];

    public function login()
    {
        $this->validate();

        try {
            $authService = app(AuthApplicationService::class);
            $user = $authService->login($this->email, $this->password);

            if ($user) {
                if ($user->canAccessAdminPanel()) {
                    session()->flash('message', 'Login berhasil! Selamat datang ' . $user->getDisplayName());
                    return redirect()->intended('/dashboard');
                } else {
                    session()->flash('error', 'Anda tidak memiliki akses ke panel admin');
                    $authService->logout();
                }
            } else {
                session()->flash('error', 'Email atau password salah');
            }
        } catch (\InvalidArgumentException $e) {
            session()->flash('error', $e->getMessage());
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat login');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.auth');
    }
} 