<!-- Brand Logo -->
<a href="/" class="brand-link" style="text-decoration:none;">
    <img src="{{ asset('assets/img/logo2.png') }}" alt="Logo" class="brand-image">
    <span class="brand-text fw-bold">Aplikasi Magang</span>
</a>

<!-- Sidebar -->
<div class="sidebar hold-transition">
    <!-- Sidebar Menu -->
    <nav class="mt-3">
        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item ">
                <a href="/home" class="nav-link {{ request()->is('home') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if (Auth::user()->role == 'admin')
            <li class="nav-item has-treeview {{ request()->is('dashboard/murid*','dashboard/mitra*','dashboard/guru*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('dashboard/murid*','dashboard/mitra*','dashboard/guru*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-database"></i>
                    <p>Master Data<i class="right fas fa-angle-left"></i></p>
                    </a>
                <ul class="nav nav-treeview">
                    <!-- Add your submenu items here -->
                    <li class="nav-item">
                        <a href="{{route('guru.index')}}" class="nav-link {{ request()->is('dashboard/guru*') ? 'active' : ''}}">
                            <i class="fas fa-chalkboard-teacher nav-icon"></i>
                            <p>Data Guru</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('murid.index')}}" class="nav-link {{ request()->is('dashboard/murid*') ? 'active' : ''}}">
                            <i class="fas fa-user-graduate nav-icon"></i>
                            <p>Data Siswa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('mitra.index')}}" class="nav-link {{ request()->is('dashboard/mitra*') ? 'active' : ''}}">
                            <i class="fas fa-building nav-icon"></i>
                            <p>Data Mitra</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->is('dashboard/magang*','dashboard/laporan*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('dashboard/magang*','dashboard/laporan*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Magang<i class="right fas fa-angle-left"></i></p>
                    </a>
                <ul class="nav nav-treeview">
                    <!-- Add your submenu items here -->
                    <li class="nav-item">
                        <a href="{{route('magang.index')}}" class="nav-link {{ request()->is('dashboard/magang*') ? 'active' : ''}}">
                            <i class="fas fa-folder-plus nav-icon"></i>
                            <p>Tambah Data Magang</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('data-magang')}}" class="nav-link {{ request()->is('dashboard/laporan*') ? 'active' : ''}}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Data Magang</p>
                        </a>
                    </li>
                </ul>
            @elseif (Auth::user()->role == 'guru')
            <li class="nav-item ">
                <a href="{{route('magang.index')}}" class="nav-link {{ request()->is('dashboard/magang') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Magang</p>
                </a>
            </li>
            @elseif (Auth::user()->role == 'siswa')
            <li class="nav-item ">
                <a href="{{route('infoMagang.siswa')}}" class="nav-link {{ request()->is('dashboard/magang') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-briefcase"></i>
                    <p>Informasi Magang</p>
                </a>
            </li>
            
            @endif
        </ul>
    </nav>
</div>