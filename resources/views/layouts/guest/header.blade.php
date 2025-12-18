<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <!-- Hamburger Icon -->
        <button class="btn btn-link d-flex align-items-center" id="hamburger-icon" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-list"></i> <!-- Ikon Hamburger -->
        </button>

        <!-- Dropdown Menu -->
        <div class="dropdown">
            <ul class="dropdown-menu" aria-labelledby="hamburger-icon">
                @guest
                    <!-- Menu untuk Guest -->
                    <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('auth.index') }}">Login</a></li>
                @else
                    <!-- Menu untuk User yang sudah login -->
                    <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                    <li>
                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item" style="font-weight: 600;">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>

        <!-- Logo Horizontal -->
        <div class="d-flex align-items-center" style="flex-grow: 1;">
            <a href="{{ route('about') }}" class="logo d-flex align-items-center me-3" style="width: 100%;">
                <img src="{{ asset('assets/img/logo5.png') }}" style="height: 100%; object-fit: contain;" alt="Logo DesaSface">
                <span class="ms-2" style="font-size: 24px; font-weight: bold; color: #d2ffd3ff;">DesaSface</span>
            </a>
        </div>

        <!-- Navbar Menu -->
        <nav id="navbar" class="navbar">
            <ul class="d-flex list-unstyled mb-0">
                <!-- Menampilkan "About" hanya untuk Guest atau jika user tidak memiliki role tertentu -->
                @guest
                    <li><a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                @else
                    @if(auth()->user()->role != 'admin' && auth()->user()->role != 'guest')
                        <li><a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                    @endif
                @endguest

                <!-- Menu untuk Admin setelah login -->
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <li><a class="{{ request()->routeIs('warga.*') ? 'active' : '' }}" href="{{ route('warga.index') }}">Warga</a></li>
                    <li><a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">User</a></li>
                    <li><a class="{{ request()->routeIs('fasilitas.*') ? 'active' : '' }}" href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
                    <li><a class="{{ request()->routeIs('petugas*') ? 'active' : '' }}" href="{{ route('petugas.index') }}">Petugas Fasilitas</a></li>
                    <li><a class="{{ request()->routeIs('pembayaran_fasilitas.*') ? 'active' : '' }}" href="{{ route('pembayaran_fasilitas.index') }}">Pembayaran Fasilitas</a></li>
                    <li><a class="{{ request()->routeIs('peminjaman*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">Peminjaman Fasilitas</a></li>
                    <li><a class="{{ request()->routeIs('syarat_fasilitas.*') ? 'active' : '' }}" href="{{ route('syarat_fasilitas.index') }}">Syarat Fasilitas</a></li>
                @endif
            </ul>
        </nav>
{{-- USER INFO --}}
@auth
<div class="d-flex align-items-center me-3">
    <img
        src="{{ auth()->user()->avatar }}"
        alt="Profile"
        class="rounded-circle"
        style="width:40px;height:40px;object-fit:cover;
               border:2px solid #d2ffd3ff;"
    >
    <span class="ms-2 fw-semibold text-white">
        {{ auth()->user()->name }}
    </span>
</div>
@endauth

        
    </div>
</header>
