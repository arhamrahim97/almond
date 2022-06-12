<!-- Sidebar -->
<div class="sidebar sidebar-style-2" data-background-color="blue">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('assets') }}/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Hizrian
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Fitur Utama</h4>
                </li>
                <li class="nav-item" id="nav-aset-bergerak">
                    <a data-toggle="collapse" href="#aset-bergerak">
                        <i class="fas fa-car-alt"></i>
                        <p>Aset Bergerak</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="aset-bergerak">
                        <ul class="nav nav-collapse">
                            <li id="li-manajemen-aset-bergerak">
                                <a href="{{ url('manajemen-aset-bergerak') }}">
                                    <span class="sub-item">Manajemen Aset</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('aset-pegawai') }}">
                                    <span class="sub-item">Aset Pegawai</span>
                                </a>
                            </li>
                            <li>
                                <a href="email-compose.html">
                                    <span class="sub-item">Status Aset</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" id="nav-aset-tidak-bergerak">
                    <a data-toggle="collapse" href="#aset-tidak-bergerak">
                        <i class="fas fa-keyboard"></i>
                        <p>Aset Tidak Bergerak</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="aset-tidak-bergerak">
                        <ul class="nav nav-collapse">
                            <li id="li-manajemen-aset-tidak-bergerak">
                                <a href="{{ url('aset-tidak-bergerak') }}">
                                    <span class="sub-item">Manajemen Aset</span>
                                </a>
                            </li>
                            <li>
                                <a href="email-compose.html">
                                    <span class="sub-item">Lokasi Aset</span>
                                </a>
                            </li>
                            <li>
                                <a href="email-compose.html">
                                    <span class="sub-item">Status Aset</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a href="starter-template.html">
                        <i class="fas fa-print"></i>
                        <p>IPO Report</p>
                    </a>
                </li> --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master Data</h4>
                </li>
                <li class="nav-item" id="nav-ruangan">
                    <a href="{{ url('ruangan') }}">
                        <i class="fas fa-box"></i>
                        <p>Ruangan</p>
                    </a>
                </li>
                <li class="nav-item" id="nav-pegawai">
                    <a href="{{ url('pegawai') }}">
                        <i class="fas fa-user-tie"></i>
                        <p>Pegawai</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="starter-template.html">
                        <i class="fas fa-user-circle"></i>
                        <p>Akun</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a data-toggle="collapse" href="#email-nav">
                        <i class="far fa-envelope"></i>
                        <p>Email</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="email-nav">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="email-inbox.html">
                                    <span class="sub-item">Inbox</span>
                                </a>
                            </li>
                            <li>
                                <a href="email-compose.html">
                                    <span class="sub-item">Email Compose</span>
                                </a>
                            </li>
                            <li>
                                <a href="email-detail.html">
                                    <span class="sub-item">Email Detail</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
