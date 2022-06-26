<!-- Sidebar -->
<div class="sidebar sidebar-style-2" data-background-color="blue">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
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
                            <li id="li-aset-pegawai">
                                <a href="{{ url('aset-pegawai') }}">
                                    <span class="sub-item">Aset Pegawai</span>
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
                                <a href="{{ url('manajemen-aset-tidak-bergerak') }}">
                                    <span class="sub-item">Manajemen Aset</span>
                                </a>
                            </li>
                            <li id="li-ruangan-aset">
                                <a href="{{ url('ruangan-aset') }}">
                                    <span class="sub-item">Ruangan Aset</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" id="nav-export-simda">
                    <a href="{{ url('/preview-export-simda') }}">
                        <i class="fas fa-download"></i>
                        <p>Ekspor SIMDA</p>
                    </a>
                </li>
                @if (Auth::user()->role == 'Admin')
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
                    <li class="nav-item" id="nav-akun">
                        <a href="{{ url('/akun') }}">
                            <i class="fas fa-user-circle"></i>
                            <p>Akun</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
