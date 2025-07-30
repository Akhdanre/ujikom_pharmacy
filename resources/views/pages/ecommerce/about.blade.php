<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tentang Kami - DrigSell</title>
    
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
            color: var(--text-dark);
            background-color: var(--bg-light);
        }

        /* Header Styles */
        .top-header {
            background: var(--primary-color);
            color: white;
            padding: 8px 0;
            font-size: 14px;
        }

        .main-header {
            background: white;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .search-bar {
            background: var(--bg-light);
            border: 2px solid var(--primary-color);
            border-radius: 25px;
            padding: 12px 20px;
            width: 100%;
            max-width: 500px;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #00A896 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* About Section */
        .about-section {
            padding: 80px 0;
            background: white;
        }

        .about-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: var(--shadow);
            height: 100%;
            transition: all 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .about-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), #00A896);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 32px;
        }

        /* Stats Section */
        .stats-section {
            background: var(--bg-light);
            padding: 60px 0;
        }

        .stat-card {
            text-align: center;
            padding: 30px 20px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        /* Team Section */
        .team-section {
            padding: 80px 0;
            background: white;
        }

        .team-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .team-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--primary-color), #00A896);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .team-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .team-position {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 15px;
        }

        .team-social {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .social-link {
            width: 35px;
            height: 35px;
            background: var(--bg-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Values Section */
        .values-section {
            background: var(--bg-light);
            padding: 80px 0;
        }

        .value-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            height: 100%;
            transition: all 0.3s ease;
        }

        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .value-icon {
            width: 60px;
            height: 60px;
            background: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 24px;
        }

        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 15px 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--text-light);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .search-bar {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <i class="fas fa-phone me-2"></i> Hubungi Kami: 021-1234567
                    <i class="fas fa-envelope ms-3 me-2"></i> info@pharmacare.com
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('login') }}" class="text-white me-3 text-decoration-none">
                        <i class="fas fa-user me-1"></i> Login Admin
                    </a>
                    <a href="{{ route('register') }}" class="text-white text-decoration-none">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-md-3">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <h2 class="mb-0 text-primary fw-bold">
                            <i class="fas fa-pills me-2"></i>DrigSell
                        </h2>
                    </a>
                </div>
                <div class="col-md-6">
                    <form class="d-flex" action="{{ route('search') }}" method="GET">
                        <input type="text" name="q" class="search-bar" placeholder="Cari obat, vitamin, atau suplemen...">
                        <button type="submit" class="btn btn-primary ms-2" style="border-radius: 25px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="col-md-3 text-end">
                    <a href="{{ route('cart') }}" class="btn btn-outline-primary position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Tentang Kami</li>
            </ol>
        </nav>
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Tentang PharmaCare</h1>
            <p class="hero-subtitle">
                Kami adalah platform e-commerce terdepan untuk produk kesehatan dan obat-obatan di Indonesia, 
                berkomitmen untuk memberikan akses mudah dan aman terhadap produk kesehatan berkualitas tinggi.
            </p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="h1 fw-bold mb-3">Mengapa Memilih Kami?</h2>
                    <p class="lead text-muted">Kami memberikan solusi terbaik untuk kebutuhan kesehatan Anda</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="about-card">
                        <div class="about-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">100% Produk Asli</h4>
                        <p class="text-muted">
                            Semua produk yang kami jual dijamin 100% asli dan berkualitas tinggi. 
                            Kami bekerja langsung dengan distributor resmi dan produsen terkemuka.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="about-card">
                        <div class="about-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Pengiriman Cepat & Aman</h4>
                        <p class="text-muted">
                            Layanan pengiriman cepat dan aman ke seluruh Indonesia. 
                            Produk dikemas dengan baik untuk menjaga kualitas dan keamanan.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="about-card">
                        <div class="about-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Layanan 24/7</h4>
                        <p class="text-muted">
                            Tim customer service kami siap membantu Anda 24/7. 
                            Konsultasi gratis dengan apoteker berpengalaman.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Pelanggan Puas</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">Produk Tersedia</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Kota Terjangkau</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">5+</div>
                        <div class="stat-label">Tahun Pengalaman</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="h1 fw-bold mb-3">Nilai-Nilai Kami</h2>
                    <p class="lead text-muted">Prinsip yang menjadi dasar dalam melayani pelanggan</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Kepedulian</h4>
                        <p class="text-muted">
                            Kami peduli terhadap kesehatan dan kesejahteraan setiap pelanggan. 
                            Setiap produk dipilih dengan teliti untuk memastikan kualitas terbaik.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Kepercayaan</h4>
                        <p class="text-muted">
                            Membangun kepercayaan melalui transparansi, kejujuran, dan pelayanan yang konsisten. 
                            Pelanggan adalah prioritas utama kami.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Inovasi</h4>
                        <p class="text-muted">
                            Terus berinovasi dalam teknologi dan layanan untuk memberikan pengalaman 
                            berbelanja yang lebih baik dan efisien.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="h1 fw-bold mb-3">Tim Kami</h2>
                    <p class="lead text-muted">Bertemu dengan tim profesional yang siap melayani Anda</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h5 class="team-name">Ahmad Rahman</h5>
                        <div class="team-position">CEO & Founder</div>
                        <p class="text-muted small mb-3">
                            Lebih dari 10 tahun pengalaman di industri farmasi dan e-commerce.
                        </p>
                        <div class="team-social">
                            <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h5 class="team-name">Sarah Wijaya</h5>
                        <div class="team-position">Head of Operations</div>
                        <p class="text-muted small mb-3">
                            Spesialis dalam manajemen operasional dan logistik farmasi.
                        </p>
                        <div class="team-social">
                            <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h5 class="team-name">Budi Santoso</h5>
                        <div class="team-position">Head of Technology</div>
                        <p class="text-muted small mb-3">
                            Ahli teknologi dengan fokus pada pengembangan platform e-commerce.
                        </p>
                        <div class="team-social">
                            <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h5 class="team-name">Diana Putri</h5>
                        <div class="team-position">Head of Customer Service</div>
                        <p class="text-muted small mb-3">
                            Berpengalaman dalam memberikan layanan pelanggan terbaik.
                        </p>
                        <div class="team-social">
                            <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-pills me-2"></i>DrigSell</h5>
                    <p>Toko obat online terpercaya dengan berbagai produk kesehatan berkualitas tinggi.</p>
                </div>
                <div class="col-md-2">
                    <h6>Produk</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted">Obat Bebas</a></li>
                        <li><a href="#" class="text-muted">Obat Keras</a></li>
                        <li><a href="#" class="text-muted">Vitamin</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Layanan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted">Pengiriman</a></li>
                        <li><a href="#" class="text-muted">Pembayaran</a></li>
                        <li><a href="#" class="text-muted">Garansi</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Perusahaan</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}" class="text-muted">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="text-muted">Kontak</a></li>
                        <li><a href="#" class="text-muted">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Bantuan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted">FAQ</a></li>
                        <li><a href="#" class="text-muted">Cara Belanja</a></li>
                        <li><a href="#" class="text-muted">Kebijakan</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">&copy; 2024 DrigSell. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Animate numbers on scroll
        function animateNumbers() {
            const numbers = document.querySelectorAll('.stat-number');
            numbers.forEach(number => {
                const target = parseInt(number.textContent);
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    number.textContent = Math.floor(current) + (number.textContent.includes('+') ? '+' : '');
                }, 50);
            });
        }

        // Trigger animation when stats section is visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateNumbers();
                    observer.unobserve(entry.target);
                }
            });
        });

        document.querySelectorAll('.stat-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html> 