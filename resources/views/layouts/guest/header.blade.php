<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">


        <!-- Hamburger Icon -->
        <button class="btn btn-link d-flex align-items-center" id="hamburger-icon" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-list"></i>
        </button>

        <!-- Dropdown Menu untuk guest -->
        <div class="dropdown">
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @guest
                    <!-- Menu untuk Guest -->
                    <li><a class="dropdown-item" href="{{ route('auth.index') }}">Login</a></li>
                @else
                    <!-- Menu untuk User yang sudah login -->
                    <li>
                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item" style="font-weight: 600;">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>

           <!-- Logo -->
        <div class="d-flex align-items-center">
            <a href="{{ route('about') }}" class="logo d-flex align-items-center me-3">
                <img src="{{ asset('assets/img/logo.png') }}" alt="DesaSface Logo" style="max-height: 50px;">
                <span class="ms-2">DesaSface</span>
            </a>
        </div>

        <!-- Navbar Menu -->
        <nav id="navbar" class="navbar">
            <ul class="d-flex list-unstyled mb-0">
                <!-- Tampilkan menu Home dan About untuk yang belum login atau yang tidak memiliki role admin atau guest -->
                @if(!auth()->check() || (auth()->check() && auth()->user()->role != 'admin' && auth()->user()->role != 'guest'))
                    <li><a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                @endif

                <!-- Hanya tampilkan menu admin jika sudah login dan role admin -->
                @auth
                    @if(auth()->user()->role == 'admin')
                        <!-- Menu khusus untuk Admin -->
                        <li><a class="{{ request()->routeIs('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a></li>
                        <li><a class="{{ request()->routeIs('warga*') ? 'active' : '' }}" href="{{ route('warga.index') }}">Warga</a></li>
                        <li><a class="{{ request()->routeIs('fasilitas.*') ? 'active' : '' }}" href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
                        <li><a class="{{ request()->routeIs('petugas*') ? 'active' : '' }}" href="{{ route('petugas.index') }}">Petugas Fasilitas</a></li>
                        <li><a class="{{ request()->routeIs('pembayaran_fasilitas.*') ? 'active' : '' }}" href="{{ route('pembayaran_fasilitas.index') }}">Pembayaran Fasilitas</a></li>
                        <li><a class="{{ request()->routeIs('peminjaman*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">Peminjaman Fasilitas</a></li>
                        <li><a class="{{ request()->routeIs('syarat_fasilitas.*') ? 'active' : '' }}" href="{{ route('syarat_fasilitas.index') }}">Syarat Fasilitas</a></li>
                    @elseif(auth()->user()->role == 'guest')
                        <!-- Menu untuk Guest -->
                        <li><a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                    @endif
                @endauth
            </ul>
        </nav>
    </div>
</header>
