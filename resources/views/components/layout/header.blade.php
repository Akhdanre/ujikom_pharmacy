 <header class="main-header">
     <div class="container-fluid bg-primary-500">
         <div class="row align-items-center py-3">
             <!-- Logo -->
             <div class="col-md-3">
                 <a href="{{ route('home') }}" class="text-decoration-none text-white">
                     <h2 class="mb-0 fw-bold">
                         <i class="fas fa-pills me-2 text-white"></i>DrigSell
                     </h2>
                 </a>

             </div>

             <!-- Search Form -->
             <div class="col-md-6 d-flex justify-content-center">
                 <form class="d-flex w-100" action="{{ route('ecommerce.search') }}" method="GET"
                     style="max-width: 600px;">
                     <input type="text" name="q" class="form-control"
                         placeholder="Cari obat, vitamin, atau suplemen...">
                     <button type="submit" class="btn btn-primary ms-2" style="border-radius: 25px;">
                         <i class="fas fa-search"></i>
                     </button>
                 </form>
             </div>

             <!-- Cart & User -->
             <div class="col-md-3 d-flex justify-content-end align-items-center gap-3">
                 <!-- Cart -->
                 <a href="{{ route('ecommerce.cart') }}" class="btn btn-primary position-relative">
                     <i class="fas fa-shopping-cart"></i>
                     <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                         3
                     </span>
                 </a>

                 <!-- User -->
                 <div class="dropdown">
                     <a class="btn dropdown-toggle d-flex align-items-center " href="#" role="button"
                         data-bs-toggle="dropdown" aria-expanded="false" style="border: none; box-shadow: none;">
                         <span class="d-inline-block rounded-circle bg-primary-50 text-white text-center me-2"
                             style="width: 35px; height: 35px; line-height: 35px;">
                             <i class="fas fa-user"></i>
                         </span>
                     </a>
                     <ul class="dropdown-menu dropdown-menu-end">
                         <li><a class="dropdown-item" href="{{ route('login') }}">login</a></li>
                         <li><a class="dropdown-item" href="">Profil</a></li>
                         {{-- <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li> --}}
                     </ul>
                 </div>


             </div>
         </div>
     </div>
 </header>
