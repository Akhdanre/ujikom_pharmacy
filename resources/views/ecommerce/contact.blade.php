<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kontak Kami - DrigSell</title>
    
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
            padding: 60px 0;
            text-align: center;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Contact Section */
        .contact-section {
            padding: 80px 0;
            background: white;
        }

        .contact-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow);
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid #E9ECEF;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), #00A896);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 24px;
        }

        .contact-info h5 {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .contact-info p {
            color: var(--text-light);
            margin-bottom: 0;
        }

        /* Contact Form */
        .contact-form {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: var(--shadow);
        }

        .form-title {
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control {
            border: 2px solid #E9ECEF;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 191, 166, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .btn-submit {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-submit:hover {
            background: #00A896;
            color: white;
            transform: scale(1.02);
        }

        /* Map Section */
        .map-section {
            padding: 60px 0;
            background: var(--bg-light);
        }

        .map-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .map-placeholder {
            height: 400px;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: 1.2rem;
        }

        /* FAQ Section */
        .faq-section {
            padding: 80px 0;
            background: white;
        }

        .faq-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .faq-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .faq-question {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 10px;
            cursor: pointer;
        }

        .faq-answer {
            color: var(--text-light);
            margin-bottom: 0;
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
            
            .contact-form {
                padding: 25px;
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
                <li class="breadcrumb-item active">Kontak Kami</li>
            </ol>
        </nav>
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Hubungi Kami</h1>
            <p class="hero-subtitle">
                Kami siap membantu Anda dengan pertanyaan, saran, atau keluhan. 
                Tim customer service kami akan merespons dalam waktu 24 jam.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="h1 fw-bold mb-3">Informasi Kontak</h2>
                    <p class="lead text-muted">Berbagai cara untuk menghubungi tim kami</p>
                </div>
            </div>
            
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card text-center">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-info">
                            <h5>Telepon</h5>
                            <p>021-1234567</p>
                            <p class="small text-muted">Senin - Jumat: 08:00 - 17:00</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card text-center">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info">
                            <h5>Email</h5>
                            <p>info@pharmacare.com</p>
                            <p class="small text-muted">support@pharmacare.com</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card text-center">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-info">
                            <h5>Alamat</h5>
                            <p>Jl. Sudirman No. 123</p>
                            <p class="small text-muted">Jakarta Pusat, 12345</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form and Map -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-form">
                        <h3 class="form-title">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                        </h3>
                        
                        <form id="contactForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">Nama Depan *</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Nama Belakang</label>
                                    <input type="text" class="form-control" id="lastName">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Telepon</label>
                                    <input type="tel" class="form-control" id="phone">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subjek *</label>
                                <select class="form-control" id="subject" required>
                                    <option value="">Pilih subjek</option>
                                    <option value="general">Pertanyaan Umum</option>
                                    <option value="order">Pesanan</option>
                                    <option value="product">Produk</option>
                                    <option value="complaint">Keluhan</option>
                                    <option value="suggestion">Saran</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan *</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
                            </div>
                            
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="map-container">
                        <div class="map-placeholder">
                            <div class="text-center">
                                <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                                <p>Peta Lokasi</p>
                                <small>Jl. Sudirman No. 123, Jakarta Pusat</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="h1 fw-bold mb-3">Pertanyaan Umum</h2>
                    <p class="lead text-muted">Jawaban untuk pertanyaan yang sering diajukan</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="faq-card">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <i class="fas fa-plus me-2"></i>
                            Bagaimana cara memesan produk di PharmaCare?
                        </div>
                        <div class="faq-answer" style="display: none;">
                            Anda dapat memesan produk dengan mudah melalui website kami. Pilih produk yang diinginkan, 
                            tambahkan ke keranjang, dan ikuti proses checkout. Pembayaran dapat dilakukan melalui 
                            berbagai metode yang tersedia.
                        </div>
                    </div>
                    
                    <div class="faq-card">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <i class="fas fa-plus me-2"></i>
                            Berapa lama waktu pengiriman?
                        </div>
                        <div class="faq-answer" style="display: none;">
                            Waktu pengiriman bervariasi tergantung lokasi tujuan. Untuk area Jakarta dan sekitarnya, 
                            pengiriman biasanya 1-2 hari kerja. Untuk daerah lain, pengiriman memakan waktu 2-5 hari kerja.
                        </div>
                    </div>
                    
                    <div class="faq-card">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <i class="fas fa-plus me-2"></i>
                            Apakah produk dijamin 100% asli?
                        </div>
                        <div class="faq-answer" style="display: none;">
                            Ya, semua produk yang kami jual dijamin 100% asli. Kami bekerja langsung dengan distributor 
                            resmi dan produsen terkemuka untuk memastikan kualitas produk.
                        </div>
                    </div>
                    
                    <div class="faq-card">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <i class="fas fa-plus me-2"></i>
                            Bagaimana jika produk rusak saat diterima?
                        </div>
                        <div class="faq-answer" style="display: none;">
                            Jika produk rusak saat diterima, Anda dapat mengajukan klaim dalam waktu 24 jam setelah 
                            menerima produk. Tim kami akan membantu proses penggantian atau refund.
                        </div>
                    </div>
                    
                    <div class="faq-card">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <i class="fas fa-plus me-2"></i>
                            Apakah ada layanan konsultasi dengan apoteker?
                        </div>
                        <div class="faq-answer" style="display: none;">
                            Ya, kami menyediakan layanan konsultasi gratis dengan apoteker berpengalaman. 
                            Anda dapat menghubungi kami melalui chat, telepon, atau email untuk berkonsultasi.
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
        // Contact form submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const firstName = document.getElementById('firstName').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;
            
            // Simple validation
            if (!firstName || !email || !subject || !message) {
                alert('Mohon lengkapi semua field yang wajib diisi.');
                return;
            }
            
            // Show success message
            alert('Terima kasih! Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
            
            // Reset form
            this.reset();
        });

        // FAQ toggle functionality
        function toggleFAQ(element) {
            const answer = element.nextElementSibling;
            const icon = element.querySelector('i');
            
            if (answer.style.display === 'none') {
                answer.style.display = 'block';
                icon.className = 'fas fa-minus me-2';
            } else {
                answer.style.display = 'none';
                icon.className = 'fas fa-plus me-2';
            }
        }

        // Form validation
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        });
    </script>
</body>
</html> 