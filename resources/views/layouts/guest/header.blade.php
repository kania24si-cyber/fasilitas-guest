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
                <a class="dropdown-item" href="{{ route('whatsapp.link') }}">Contact us</a>
                <a class="dropdown-item" href="{{ route('auth.index') }}">Login</a>
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
                <img src="{{ asset('assets/img/logo11.png') }}" style="height: 30px; object-fit: contain;" alt="Logo DesaSface">
                <span class="ms-2" style="font-size: 24px; font-weight: bold; color: #d2ffd3ff;">DesaSface</span>
            </a>
        </div>
    </div>

    <!-- Header Kedua (Navbar Menu untuk Setelah Login) -->
    <div class="navbar-container">
        <nav id="navbar" class="navbar">
            <ul class="d-flex list-unstyled mb-0">

            <!-- LOGO KECIL DI HEADER 2 (PALING KIRI) -->
            <li class="header2-logo d-flex align-items-center me-3">
                <a href="{{ route('about') }}" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('assets/img/logo9.png') }}" alt="Logo DesaSface">
                </a>
            </li>

                <!-- Link About hanya tampil jika pengguna tidak login -->
                @guest
                <div class="navbar-center">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        About
                    </a>
                </div>
                @endguest

                <!-- Menu login/admin/user -->
@if(auth()->check() && auth()->user()->role == 'admin')
    <li class="navbar-right"><a class="{{ request()->routeIs('warga.*') ? 'active' : '' }}" href="{{ route('warga.index') }}">Warga</a></li>
    <li class="navbar-right"><a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">User</a></li>
    <li class="navbar-right"><a class="{{ request()->routeIs('fasilitas.*') ? 'active' : '' }}" href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
    <li class="navbar-right"><a class="{{ request()->routeIs('petugas*') ? 'active' : '' }}" href="{{ route('petugas.index') }}">Petugas Fasilitas</a></li>
    <li class="navbar-right"><a class="{{ request()->routeIs('pembayaran_fasilitas.*') ? 'active' : '' }}" href="{{ route('pembayaran_fasilitas.index') }}">Pembayaran</a></li>
    <li class="navbar-right"><a class="{{ request()->routeIs('peminjaman*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
    <li class="navbar-right"><a class="{{ request()->routeIs('syarat_fasilitas.*') ? 'active' : '' }}" href="{{ route('syarat_fasilitas.index') }}">Syarat Fasilitas</a></li>
@elseif(auth()->check())
    <li class="navbar-right"><a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
    <li class="navbar-right"><a class="{{ request()->routeIs('fasilitas.*') ? 'active' : '' }}" href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
    <li class="navbar-right"><a class="{{ request()->routeIs('petugas*') ? 'active' : '' }}" href="{{ route('petugas.index') }}">Petugas Fasilitas</a></li>
    <li class="navbar-right"><a class="{{ request()->routeIs('syarat_fasilitas.*') ? 'active' : '' }}" href="{{ route('syarat_fasilitas.index') }}">Syarat Fasilitas</a></li>
    <li class="nav-item dropdown navbar-right">
        <a class="nav-link dropdown-toggle {{ request()->routeIs('peminjaman*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Peminjaman
        </a>
        <div class="dropdown-menu" id="peminjaman-dropdown" aria-labelledby="navbarDropdown">
            <a href="{{ route('peminjaman.create') }}" class="dropdown-item"><i class="bi bi-plus-circle"></i> Ajukan Peminjaman</a>
            <a href="{{ route('peminjaman.index') }}" class="dropdown-item"><i class="bi bi-list-ul"></i> Lihat List Peminjaman</a>
        </div>
    </li>
    <li class="nav-item dropdown navbar-right">
        <a class="nav-link dropdown-toggle {{ request()->routeIs('pembayaran_fasilitas.*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pembayaran
        </a>
        <div class="dropdown-menu" id="pembayaran-dropdown" aria-labelledby="navbarDropdown">
            <a href="{{ route('pembayaran_fasilitas.create') }}" class="dropdown-item"><i class="bi bi-cash-stack"></i> Isi data pembayaran Sekarang</a>
            <a href="{{ route('pembayaran_fasilitas.index') }}" class="dropdown-item"><i class="bi bi-list-ul"></i> Lihat Data Pembayaran</a>
        </div>
    </li>
@endif


                <!-- USER DROPDOWN - SELALU DI UJUNG KANAN -->
                @auth
                <li class="ms-auto">
                    <div class="dropdown">
                        <button class="btn btn-link d-flex align-items-center" id="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->avatar }}" alt="Profile" class="rounded-circle">
                            <span class="ms-2 fw-semibold user-name">{{ auth()->user()->name }}</span>
                            <i class="bi bi-caret-down-fill ms-2"></i>
                        </button>
                        <div class="dropdown-menu shadow-lg" aria-labelledby="user-dropdown">
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
                @endauth
            </ul>
        </nav>
    </div>
</header>
