<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title', 'Pharmacy Management System')</title>
  <meta content="Pharmacy Management System" name="description">
  <meta content="pharmacy, management, system" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('niceadmin/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('niceadmin/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('niceadmin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('niceadmin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('niceadmin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('niceadmin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('niceadmin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('niceadmin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('niceadmin/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('niceadmin/css/style.css') }}" rel="stylesheet">

  @stack('styles')
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('niceadmin/img/logo.png') }}" alt="">
        <span class="d-none d-lg-block">Pharmacy System</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">3</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 3 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Low Stock Alert</h4>
                <p>Some medicines are running low on stock</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Expired Medicine</h4>
                <p>Some medicines are approaching expiry date</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>New Order</h4>
                <p>New order has been placed</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-center small text-gray-500" href="#">Show all notifications</a></li>
          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-dots"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="{{ asset('niceadmin/img/messages-1.jpg') }}" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="{{ asset('niceadmin/img/messages-2.jpg') }}" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="{{ asset('niceadmin/img/messages-3.jpg') }}" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li><a class="dropdown-item text-center small text-gray-500" href="#">Read more messages</a></li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset('niceadmin/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name ?? 'User' }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name ?? 'User' }}</h6>
              <span>{{ Auth::user()->email ?? 'user@example.com' }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('medicines.*') ? '' : 'collapsed' }}" href="{{ route('medicines.index') }}">
          <i class="bi bi-capsule"></i>
          <span>Medicines</span>
        </a>
      </li><!-- End Medicines Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('categories.*') ? '' : 'collapsed' }}" href="{{ route('categories.index') }}">
          <i class="bi bi-collection"></i>
          <span>Categories</span>
        </a>
      </li><!-- End Categories Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('customers.*') ? '' : 'collapsed' }}" href="{{ route('customers.index') }}">
          <i class="bi bi-people"></i>
          <span>Customers</span>
        </a>
      </li><!-- End Customers Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('sales.*') ? '' : 'collapsed' }}" href="{{ route('sales.index') }}">
          <i class="bi bi-cart"></i>
          <span>Sales</span>
        </a>
      </li><!-- End Sales Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('purchases.*') ? '' : 'collapsed' }}" href="{{ route('purchases.index') }}">
          <i class="bi bi-bag"></i>
          <span>Purchases</span>
        </a>
      </li><!-- End Purchases Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('inventory.*') ? '' : 'collapsed' }}" href="{{ route('inventory.index') }}">
          <i class="bi bi-boxes"></i>
          <span>Inventory</span>
        </a>
      </li><!-- End Inventory Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('reports.*') ? '' : 'collapsed' }}" href="{{ route('reports.index') }}">
          <i class="bi bi-file-earmark-text"></i>
          <span>Reports</span>
        </a>
      </li><!-- End Reports Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('users.*') ? '' : 'collapsed' }}" href="{{ route('users.index') }}">
          <i class="bi bi-person-gear"></i>
          <span>Users</span>
        </a>
      </li><!-- End Users Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('settings.*') ? '' : 'collapsed' }}" href="{{ route('settings.index') }}">
          <i class="bi bi-gear"></i>
          <span>Settings</span>
        </a>
      </li><!-- End Settings Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>@yield('page-title', 'Dashboard')</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          @yield('breadcrumb')
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @yield('content')
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Pharmacy Management System</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('niceadmin/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('niceadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('niceadmin/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('niceadmin/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('niceadmin/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('niceadmin/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('niceadmin/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('niceadmin/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('niceadmin/js/main.js') }}"></script>

  @stack('scripts')

</body>

</html> 