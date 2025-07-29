<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - DrigSell</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #00BFA6;
            --secondary-color: #FF6B35;
            --accent-color: #FFD93D;
            --text-dark: #2C3E50;
            --text-light: #7F8C8D;
            --bg-light: #F8F9FA;
            --white: #FFFFFF;
            --shadow: 0 2px 10px rgba(0,0,0,0.1);
            --shadow-hover: 0 5px 20px rgba(0,0,0,0.15);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, #00A896 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-hover);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            display: flex;
            min-height: 700px;
        }

        .register-sidebar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #00A896 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .register-sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }

        .register-sidebar-content {
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        .brand-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            text-align: center;
            margin-bottom: 40px;
        }

        .benefit-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .benefit-list li {
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }

        .benefit-list li:last-child {
            border-bottom: none;
        }

        .benefit-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 18px;
        }

        .register-form {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            overflow-y: auto;
            max-height: 700px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .form-subtitle {
            color: var(--text-light);
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #E9ECEF;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 191, 166, 0.1);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            z-index: 2;
        }

        .input-with-icon {
            padding-left: 50px;
        }

        .btn-register {
            background: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-register:hover {
            background: #e55a2b;
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .form-footer {
            text-align: center;
            margin-top: 30px;
        }

        .form-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #D4EDDA;
            color: #155724;
        }

        .alert-danger {
            background: #F8D7DA;
            color: #721C24;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .password-requirements {
            background: var(--bg-light);
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
        }

        .requirement-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .requirement-item i {
            margin-right: 8px;
            font-size: 12px;
        }

        .requirement-item.valid {
            color: #28a745;
        }

        .requirement-item.invalid {
            color: var(--text-light);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .register-sidebar {
                padding: 30px 20px;
            }
            
            .register-form {
                padding: 30px 20px;
            }
            
            .brand-logo {
                font-size: 2rem;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body>
    <div class="register-container animate-fade-in-up">
        <!-- Sidebar -->
        <div class="register-sidebar">
            <div class="register-sidebar-content">
                <div class="brand-logo">
                    <i class="fas fa-pills me-2"></i>DrigSell
                </div>
                <div class="brand-subtitle">
                    Bergabunglah dengan Platform E-commerce Terdepan
                </div>
                
                <ul class="benefit-list">
                    <li>
                        <div class="benefit-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <strong>Akun Gratis</strong><br>
                            <small>Daftar tanpa biaya apapun</small>
                        </div>
                    </li>
                    <li>
                        <div class="benefit-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <div>
                            <strong>Bonus Selamat Datang</strong><br>
                            <small>Dapatkan diskon khusus member baru</small>
                        </div>
                    </li>
                    <li>
                        <div class="benefit-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                            <strong>Notifikasi Real-time</strong><br>
                            <small>Update produk dan promo terbaru</small>
                        </div>
                    </li>
                    <li>
                        <div class="benefit-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <strong>Program Loyalitas</strong><br>
                            <small>Poin reward untuk setiap pembelian</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Register Form -->
        <div class="register-form">
            <div class="form-header">
                <h1 class="form-title">Buat Akun Baru</h1>
                <p class="form-subtitle">Bergabunglah dengan DrigSell untuk pengalaman berbelanja terbaik</p>
            </div>

            <!-- Flash Messages -->
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <form wire:submit.prevent="register">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Lengkap *</label>
                        <div class="input-group">
                            <i class="fas fa-user input-icon"></i>
                            <input wire:model="name" id="name" name="name" type="text" required 
                                   class="form-control input-with-icon" 
                                   placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address *</label>
                        <div class="input-group">
                            <i class="fas fa-envelope input-icon"></i>
                            <input wire:model="email" id="email" name="email" type="email" required 
                                   class="form-control input-with-icon" 
                                   placeholder="email@example.com">
                        </div>
                        @error('email') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">Password *</label>
                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input wire:model="password" id="password" name="password" type="password" required 
                                   class="form-control input-with-icon" 
                                   placeholder="Minimal 8 karakter">
                        </div>
                        @error('password') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                        
                        <!-- Password Requirements -->
                        <div class="password-requirements">
                            <div class="requirement-item {{ strlen($password ?? '') >= 8 ? 'valid' : 'invalid' }}">
                                <i class="fas {{ strlen($password ?? '') >= 8 ? 'fa-check' : 'fa-circle' }}"></i>
                                Minimal 8 karakter
                            </div>
                            <div class="requirement-item {{ preg_match('/[A-Z]/', $password ?? '') ? 'valid' : 'invalid' }}">
                                <i class="fas {{ preg_match('/[A-Z]/', $password ?? '') ? 'fa-check' : 'fa-circle' }}"></i>
                                Satu huruf besar
                            </div>
                            <div class="requirement-item {{ preg_match('/[0-9]/', $password ?? '') ? 'valid' : 'invalid' }}">
                                <i class="fas {{ preg_match('/[0-9]/', $password ?? '') ? 'fa-check' : 'fa-circle' }}"></i>
                                Satu angka
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password *</label>
                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input wire:model="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" required 
                                   class="form-control input-with-icon" 
                                   placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <i class="fas fa-phone input-icon"></i>
                            <input wire:model="phone" id="phone" name="phone" type="text" 
                                   class="form-control input-with-icon" 
                                   placeholder="08123456789">
                        </div>
                        @error('phone') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role" class="form-label">Role *</label>
                        <select wire:model="role" id="role" name="role" required class="form-control">
                            <option value="">Pilih role</option>
                            <option value="users_pelanggan">Pelanggan</option>
                            <option value="apoteker">Apoteker</option>
                            <option value="admin">Administrator</option>
                        </select>
                        @error('role') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea wire:model="address" id="address" name="address" rows="3" 
                              class="form-control" 
                              placeholder="Masukkan alamat lengkap"></textarea>
                    @error('address') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <button type="submit" class="btn btn-register">
                    <i class="fas fa-user-plus me-2"></i>Buat Akun
                </button>
            </form>

            <div class="form-footer">
                <p class="mb-0">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}">Login disini</a>
                </p>
                <p class="mt-2">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Website
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Add loading state to form
        document.querySelector('form').addEventListener('submit', function() {
            const button = this.querySelector('button[type="submit"]');
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            button.disabled = true;
        });

        // Password visibility toggle
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirmation');
            const icon = document.querySelector('.input-group .fa-lock');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                confirmInput.type = 'text';
                icon.className = 'fas fa-eye input-icon';
            } else {
                passwordInput.type = 'password';
                confirmInput.type = 'password';
                icon.className = 'fas fa-lock input-icon';
            }
        }
    </script>
</body>
</html>
