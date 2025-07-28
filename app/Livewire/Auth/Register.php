<?php

namespace App\Livewire\Auth;

use App\Application\Services\AuthApplicationService;
use Livewire\Component;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $phone = '';
    public $address = '';
    public $role = 'users_pelanggan';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'phone' => 'nullable|string',
        'address' => 'nullable|string',
        'role' => 'required|in:admin,apoteker,users_pelanggan',
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'name.min' => 'Nama minimal 3 karakter',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
        'role.required' => 'Role wajib dipilih',
        'role.in' => 'Role tidak valid',
    ];

    public function register()
    {
        $this->validate();

        try {
            $authService = app(AuthApplicationService::class);
            
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'phone' => $this->phone,
                'address' => $this->address,
                'role' => $this->role,
            ];

            $user = $authService->register($data);

            session()->flash('message', 'Registrasi berhasil! Silakan login.');
            return redirect()->route('login');

        } catch (\InvalidArgumentException $e) {
            session()->flash('error', $e->getMessage());
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat registrasi');
        }
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.auth');
    }
} 