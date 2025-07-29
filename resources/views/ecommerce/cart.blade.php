<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja - DrigSell</title>
    
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

        /* Cart Styles */
        .cart-container {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .cart-header {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .cart-item {
            border-bottom: 1px solid #eee;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            background-color: #f8f9fa;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .cart-item-title {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .cart-item-price {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 16px;
        }

        .cart-item-original-price {
            text-decoration: line-through;
            color: var(--text-light);
            font-size: 14px;
            margin-left: 8px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            width: 35px;
            height: 35px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 8px;
        }

        .remove-btn {
            color: #dc3545;
            background: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            color: #c82333;
            transform: scale(1.1);
        }

        /* Summary Card */
        .summary-card {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 25px;
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 20px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .summary-total {
            border-top: 2px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .btn-checkout {
            background: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-checkout:hover {
            background: #e55a2b;
            color: white;
            transform: scale(1.02);
        }

        .btn-continue-shopping {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-continue-shopping:hover {
            background: #00A896;
            color: white;
        }

        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-cart-icon {
            font-size: 80px;
            color: var(--text-light);
            margin-bottom: 20px;
        }

        .empty-cart-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .empty-cart-text {
            color: var(--text-light);
            margin-bottom: 30px;
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
            .summary-card {
                position: static;
                margin-top: 20px;
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
                <li class="breadcrumb-item active">Keranjang Belanja</li>
            </ol>
        </nav>
    </div>

    <!-- Cart Content -->
    <div class="container py-4">
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="cart-container">
                    <div class="cart-header">
                        <h4 class="mb-0">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Keranjang Belanja (3 item)
                        </h4>
                    </div>

                    <!-- Cart Items List -->
                    <div id="cartItems">
                        <!-- Item 1 -->
                        <div class="cart-item">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="https://via.placeholder.com/80x80/00BFA6/FFFFFF?text=Obat+1" alt="Product 1" class="cart-item-image">
                                </div>
                                <div class="col-md-4">
                                    <div class="cart-item-title">Paracetamol 500mg</div>
                                    <div class="text-muted small">Brand: Kimia Farma</div>
                                    <div class="text-muted small">Ukuran: 10 Tablet</div>
                                </div>
                                <div class="col-md-2">
                                    <div class="cart-item-price">
                                        Rp 15.000
                                        <span class="cart-item-original-price">Rp 20.000</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="quantity-control">
                                        <button class="quantity-btn" onclick="changeQuantity(1, -1)">-</button>
                                        <input type="number" class="quantity-input" value="2" min="1" id="qty1">
                                        <button class="quantity-btn" onclick="changeQuantity(1, 1)">+</button>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="cart-item-price">Rp 30.000</div>
                                </div>
                                <div class="col-md-1 text-end">
                                    <button class="remove-btn" onclick="removeItem(1)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="cart-item">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="https://via.placeholder.com/80x80/FF6B35/FFFFFF?text=Obat+2" alt="Product 2" class="cart-item-image">
                                </div>
                                <div class="col-md-4">
                                    <div class="cart-item-title">Vitamin C 1000mg</div>
                                    <div class="text-muted small">Brand: Sido Muncul</div>
                                    <div class="text-muted small">Kemasan: Botol</div>
                                </div>
                                <div class="col-md-2">
                                    <div class="cart-item-price">Rp 25.000</div>
                                </div>
                                <div class="col-md-2">
                                    <div class="quantity-control">
                                        <button class="quantity-btn" onclick="changeQuantity(2, -1)">-</button>
                                        <input type="number" class="quantity-input" value="1" min="1" id="qty2">
                                        <button class="quantity-btn" onclick="changeQuantity(2, 1)">+</button>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="cart-item-price">Rp 25.000</div>
                                </div>
                                <div class="col-md-1 text-end">
                                    <button class="remove-btn" onclick="removeItem(2)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="cart-item">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="https://via.placeholder.com/80x80/FFD93D/FFFFFF?text=Obat+3" alt="Product 3" class="cart-item-image">
                                </div>
                                <div class="col-md-4">
                                    <div class="cart-item-title">Obat Flu & Batuk</div>
                                    <div class="text-muted small">Brand: Konimex</div>
                                    <div class="text-muted small">Ukuran: 12 Tablet</div>
                                </div>
                                <div class="col-md-2">
                                    <div class="cart-item-price">
                                        Rp 18.000
                                        <span class="cart-item-original-price">Rp 22.000</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="quantity-control">
                                        <button class="quantity-btn" onclick="changeQuantity(3, -1)">-</button>
                                        <input type="number" class="quantity-input" value="1" min="1" id="qty3">
                                        <button class="quantity-btn" onclick="changeQuantity(3, 1)">+</button>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="cart-item-price">Rp 18.000</div>
                                </div>
                                <div class="col-md-1 text-end">
                                    <button class="remove-btn" onclick="removeItem(3)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Continue Shopping -->
                    <div class="p-3 text-center">
                        <a href="{{ route('products') }}" class="btn-continue-shopping">
                            <i class="fas fa-arrow-left me-2"></i>Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h5 class="summary-title">
                        <i class="fas fa-receipt me-2"></i>Ringkasan Pesanan
                    </h5>
                    
                    <div class="summary-item">
                        <span>Subtotal (3 item)</span>
                        <span>Rp 73.000</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Diskon</span>
                        <span class="text-success">-Rp 9.000</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Ongkos Kirim</span>
                        <span>Rp 15.000</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Asuransi</span>
                        <span>Rp 2.000</span>
                    </div>
                    
                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span>Rp 81.000</span>
                    </div>

                    <!-- Promo Code -->
                    <div class="mt-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Kode Promo">
                            <button class="btn btn-outline-primary" type="button">Gunakan</button>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <button class="btn-checkout" onclick="proceedToCheckout()">
                        <i class="fas fa-credit-card me-2"></i>Lanjut ke Pembayaran
                    </button>

                    <!-- Payment Methods -->
                    <div class="mt-3">
                        <small class="text-muted">Metode Pembayaran:</small>
                        <div class="d-flex gap-2 mt-2">
                            <img src="https://via.placeholder.com/40x25/FFFFFF/666666?text=VISA" alt="VISA" class="border rounded">
                            <img src="https://via.placeholder.com/40x25/FFFFFF/666666?text=MC" alt="MasterCard" class="border rounded">
                            <img src="https://via.placeholder.com/40x25/FFFFFF/666666?text=BCA" alt="BCA" class="border rounded">
                            <img src="https://via.placeholder.com/40x25/FFFFFF/666666?text=MDR" alt="Mandiri" class="border rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
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
                        <li><a href="#" class="text-muted">Tentang Kami</a></li>
                        <li><a href="#" class="text-muted">Kontak</a></li>
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
        // Change quantity
        function changeQuantity(itemId, change) {
            const input = document.getElementById(`qty${itemId}`);
            let value = parseInt(input.value) + change;
            if (value < 1) value = 1;
            input.value = value;
            updateCart();
        }

        // Remove item
        function removeItem(itemId) {
            if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
                const cartItem = document.querySelector(`#cartItems .cart-item:nth-child(${itemId})`);
                cartItem.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => {
                    cartItem.remove();
                    updateCart();
                }, 300);
            }
        }

        // Update cart totals
        function updateCart() {
            // This would typically make an AJAX call to update the cart
            console.log('Cart updated');
        }

        // Proceed to checkout
        function proceedToCheckout() {
            alert('Fitur checkout akan segera tersedia!');
        }

        // Add slide out animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideOut {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(-100%);
                }
            }
        `;
        document.head.appendChild(style);

        // Quantity input validation
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                if (this.value < 1) this.value = 1;
                updateCart();
            });
        });
    </script>
</body>
</html> 