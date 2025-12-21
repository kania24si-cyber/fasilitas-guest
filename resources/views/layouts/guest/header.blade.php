<!-- Header 1 -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <!-- Hamburger Icon - Menampilkan berdasarkan status login -->
        <div class="dropdown d-flex align-items-center me-3">
            <!-- Hamburger untuk Pengguna yang belum login -->
            @guest
            <button class="btn btn-link d-flex align-items-center" id="hamburger-icon" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-list"></i> <!-- Ikon Hamburger Baru -->
            </button>

            <!-- Dropdown Menu Login di dalam Hamburger Icon -->
            <div class="dropdown-menu" aria-labelledby="hamburger-icon">
                <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('auth.index') }}">Login</a>
                <a class="dropdown-item" href="{{ route('whatsapp.link') }}">Contact us</a>
            </div>
            @endguest

            <!-- Hamburger untuk Pengguna yang sudah login -->
            @auth
            <button class="btn btn-link d-flex align-items-center" id="menu-icon" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-list"></i> <!-- Ikon Dua Garis Horizontal -->
            </button>

            <!-- Dropdown Menu untuk Profile dan Logout -->
            <div class="dropdown-menu" aria-labelledby="hamburger-icon">
                <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('whatsapp.link') }}">Contact us</a>
            </div>
            @endauth
        </div>

        <!-- Logo Horizontal -->
        <div class="d-flex align-items-center" style="flex-grow: 1;">
            <a href="{{ route('about') }}" class="logo d-flex align-items-center me-3" style="width: 100%;">
                <img src="{{ asset('assets/img/logo5.png') }}" style="height: 30px; object-fit: contain;" alt="Logo DesaSface">
                <span class="ms-2" style="font-size: 24px; font-weight: bold; color: #d2ffd3ff;">DesaSface</span>
            </a>
        </div>
    </div>

    <!-- Header Kedua (Navbar Menu untuk Setelah Login) -->
    <div class="navbar-container">
        <nav id="navbar" class="navbar">
            <ul class="d-flex list-unstyled mb-0">
                <!-- Link About hanya tampil jika pengguna tidak login -->
                @guest
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        About
                    </a>
                </li>
                @endguest

                @if(auth()->check() && auth()->user()->role == 'admin')
                    <li><a class="{{ request()->routeIs('warga.*') ? 'active' : '' }}" href="{{ route('warga.index') }}">Warga</a></li>
                    <li><a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">User</a></li>
                    <li><a class="{{ request()->routeIs('fasilitas.*') ? 'active' : '' }}" href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
                    <li><a class="{{ request()->routeIs('petugas*') ? 'active' : '' }}" href="{{ route('petugas.index') }}">Petugas Fasilitas</a></li>
                    <li><a class="{{ request()->routeIs('pembayaran_fasilitas.*') ? 'active' : '' }}" href="{{ route('pembayaran_fasilitas.index') }}">Pembayaran Fasilitas</a></li>
                    <li><a class="{{ request()->routeIs('peminjaman*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">Peminjaman Fasilitas</a></li>
                    <li><a class="{{ request()->routeIs('syarat_fasilitas.*') ? 'active' : '' }}" href="{{ route('syarat_fasilitas.index') }}">Syarat Fasilitas</a></li>
                @elseif(auth()->check())
                    <!-- Menu untuk User setelah login -->
                    <li><a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                    <li><a class="{{ request()->routeIs('fasilitas.*') ? 'active' : '' }}" href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
                    <li><a class="{{ request()->routeIs('petugas*') ? 'active' : '' }}" href="{{ route('petugas.index') }}">Petugas Fasilitas</a></li>
                    <li><a class="{{ request()->routeIs('syarat_fasilitas.*') ? 'active' : '' }}" href="{{ route('syarat_fasilitas.index') }}">Syarat Fasilitas</a></li>

                    <!-- Menu Peminjaman Fasilitas -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('peminjaman*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Peminjaman Fasilitas
                        </a>
                        <div class="dropdown-menu" id="peminjaman-dropdown" aria-labelledby="navbarDropdown">
                            <a href="{{ route('peminjaman.create') }}" class="dropdown-item">
                                <i class="bi bi-plus-circle"></i> Ajukan Peminjaman
                            </a>
                            <a href="{{ route('peminjaman.index') }}" class="dropdown-item">
                                <i class="bi bi-list-ul"></i> Lihat List Peminjaman
                            </a>
                        </div>
                    </li>
                    <!-- END Menu Peminjaman Fasilitas -->

                    <!-- Menu Pembayaran Fasilitas -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('pembayaran_fasilitas.*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pembayaran Fasilitas
                        </a>
                        <div class="dropdown-menu" id="pembayaran-dropdown" aria-labelledby="navbarDropdown">
                            <a href="{{ route('pembayaran_fasilitas.create') }}" class="dropdown-item">
                                <i class="bi bi-cash-stack"></i> Isi data pembayaran Sekarang
                            </a>
                            <a href="{{ route('pembayaran_fasilitas.index') }}" class="dropdown-item">
                                <i class="bi bi-list-ul"></i> Lihat Data Pembayaran
                            </a>
                        </div>
                    </li>
                    <!-- END Menu Pembayaran Fasilitas -->
                @endif

                <!-- USER INFO - Hanya tampil ketika sudah login -->
                 @auth
<!-- Nama Pengguna menjadi dropdown -->
<div class="dropdown">
    <button class="btn btn-link d-flex align-items-center" id="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ auth()->user()->avatar }}" alt="Profile" class="rounded-circle" style="width:40px;height:40px;object-fit:cover;border:2px solid #d2ffd3ff;">
        <span class="ms-2 fw-semibold text-white">{{ auth()->user()->name }}</span>
    </button>

    <!-- Dropdown Menu untuk Logout -->
    <div class="dropdown-menu shadow-lg" aria-labelledby="user-dropdown">
        <div class="dropdown-item d-flex align-items-center">
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="dropdown-item text-danger" style="font-weight: 600;">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>
@endauth

            </ul>
        </nav>
    </div>
</header>
