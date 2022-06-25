 <!-- Navbar Header -->
 <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg">

     <div class="container-fluid">
         <div class="collapse" id="search-nav">
             <h2 class="mb-0 fw-bold" style="color: #1572E8 !important;">SI PINTAR BERAKSI</h2>
         </div>
         <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
             <li class="nav-item dropdown hidden-caret">
                 <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                     <div class="avatar-sm">
                         <img src="{{ asset('assets/img/no-profile4.png') }}" alt="..."
                             class="avatar-img rounded-circle">
                     </div>
                 </a>
                 <ul class="dropdown-menu dropdown-user animated fadeIn">
                     <div class="dropdown-user-scroll scrollbar-outer">
                         <li>
                             <div class="user-box">
                                 <div class="avatar-lg"><img src="{{ asset('assets/img/no-profile4.png') }}"
                                         alt="image profile" class="avatar-img rounded"></div>
                                 <div class="u-text">
                                     <h4>{{ Auth::user()->nama_lengkap }}</h4>
                                     <p class="text-muted">
                                         {{ Auth::user()->role == 'Admin' && Auth::user()->id == '5gf9ba91-4778-404c-aa7f-5fd327e87e80' ? 'Super Admin' : Auth::user()->role }}
                                     </p><button class="btn btn-xs btn-warning btn-sm" id="ubah-akun"><i
                                             class="fas fa-user-cog"></i>
                                         Ubah
                                         Akun</button>
                                 </div>
                             </div>
                         </li>
                         <li>
                             <div class="dropdown-divider"></div>
                             <a class="dropdown-item" href="{{ url('/logout') }}"><i
                                     class="fas fa-arrow-circle-left"></i> Keluar</a>
                         </li>
                     </div>
                 </ul>
             </li>
         </ul>
     </div>
 </nav>
 <!-- End Navbar -->
