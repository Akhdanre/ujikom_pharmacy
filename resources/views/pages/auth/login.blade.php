<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - DrigSell</title>
    
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

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-hover);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
            min-height: 600px;
        }

        .login-sidebar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #00A896 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }

        .login-sidebar-content {
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

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-icon {
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

        .login-form {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
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

        .btn-login {
            background: var(--primary-color);
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

        .btn-login:hover {
            background: #00A896;
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

        .checkbox-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 20px 0;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            accent-color: var(--primary-color);
        }

        .form-check-label {
            color: var(--text-dark);
            font-size: 14px;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #E9ECEF;
        }

        .divider span {
            background: white;
            padding: 0 20px;
            color: var(--text-light);
            font-size: 14px;
        }

        .social-login {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn-social {
            width: 50px;
            height: 50px;
            border: 2px solid #E9ECEF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-social:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 400px;
            }
            
            .login-sidebar {
                padding: 30px 20px;
            }
            
            .login-form {
                padding: 30px 20px;
            }
            
            .brand-logo {
                font-size: 2rem;
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
    <div class="login-container animate-fade-in-up">
        <!-- Sidebar -->
        <div class="login-sidebar">
            <div class="login-sidebar-content">
                <div class="brand-logo">
                    <i class="fas fa-pills me-2"></i>DrigSell
                </div>
                <div class="brand-subtitle">
                    Platform E-commerce Terdepan untuk Produk Kesehatan
                </div>
                
                <ul class="feature-list">
                    <li>
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <strong>100% Produk Asli</strong><br>
                            <small>Dijamin keaslian dan kualitas</small>
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div>
                            <strong>Pengiriman Cepat</strong><br>
                            <small>1-3 hari kerja ke seluruh Indonesia</small>
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div>
                            <strong>24/7 Support</strong><br>
                            <small>Layanan pelanggan siap membantu</small>
                        </div>
                    </li>
                    <li>
                        <div class="feature-icon">
                            <i class="fas fa-undo"></i>
                        </div>
                        <div>
                            <strong>Garansi 100%</strong><br>
                            <small>Uang kembali jika tidak sesuai</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Login Form -->
        <div class="login-form">
            <div class="form-header">
                <h1 class="form-title">Selamat Datang Kembali</h1>
                <p class="form-subtitle">Masuk ke akun admin DrigSell Anda</p>
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

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="login" class="form-label">Email atau Username</label>
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input id="login" name="login" type="text" required 
                               class="form-control input-with-icon" 
                               placeholder="Masukkan email atau username Anda"
                               value="{{ old('login') }}">
                    </div>
                    @error('login') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input id="password" name="password" type="password" required 
                               class="form-control input-with-icon" 
                               placeholder="Masukkan password Anda">
                    </div>
                    @error('password') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <div class="checkbox-group">
                    <div class="checkbox-wrapper">
                        <input id="remember" name="remember" type="checkbox" class="form-check-input" value="1">
                        <label for="remember" class="form-check-label">Ingat saya</label>
                    </div>
                    <a href="#" class="forgot-password">Lupa password?</a>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Dashboard
                </button>
            </form>

            <div class="divider">
                <span>atau</span>
            </div>

            <div class="social-login">
                <a href="#" class="btn-social">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#" class="btn-social">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="btn-social">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>

            <div class="form-footer">
                <p class="mb-0">
                    Belum punya akun? 
                    <a href="{{ route('register') }}">Daftar disini</a>
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
            const icon = document.querySelector('.input-group .fa-lock');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.className = 'fas fa-eye input-icon';
            } else {
                passwordInput.type = 'password';
                icon.className = 'fas fa-lock input-icon';
            }
        }
    </script>
</body>
</html>
