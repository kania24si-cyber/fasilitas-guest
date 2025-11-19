<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center me-3">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <span class="ms-2">BinaDesa</span>
            </a>
            <a href="{{ route('auth.logout') }}" class="btn btn-danger btn-sm" style="font-weight: 600;"> Logout </a>
        </div>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                <li><a class="{{ request()->routeIs('warga.*') ? 'active' : '' }}" href="{{ route('warga.index') }}">Data Warga</a></li>
                <li><a class="{{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
                <li><a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a></li>
                <li><a class="{{ request()->routeIs('fasilitas.*') ? 'active' : '' }}" href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
            </ul>
        </nav>
    </div>
</header>