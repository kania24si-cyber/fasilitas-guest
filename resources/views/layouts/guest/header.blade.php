<header id="header" class="header fixed-top shadow-sm bg-white">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between py-2">
        {{-- Logo dan Nama Desa --}}
        <div class="d-flex align-items-center">
            <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center me-3 text-decoration-none">
                {{-- Icon Desa --}}
                <i class="bi bi-flower3 text-success fs-3 me-2 glow-icon"></i>
                <span class="fw-bold text-dark fs-5">BinaDesa</span>
            </a>
            <a href="{{ route('auth.logout') }}" class="btn btn-outline-danger btn-sm fw-semibold ms-2">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
        </div>

        {{-- Navbar --}}
        <nav id="navbar" class="navbar">
            <ul class="d-flex align-items-center gap-3 m-0">
                <li>
                    <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-heart-fill me-1 text-primary"></i> Home
                    </a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('warga.*') ? 'active' : '' }}" href="{{ route('warga.index') }}">
                        <i class="bi bi-people-fill me-1 text-success"></i> Data Warga
                    </a>
                </li>
                <li>
                    <a class="{{ request()->routeIs(patterns: 'peminjaman.*') ? 'active' : '' }}"
                        href="{{ route('peminjaman.index') }}">
                        <i class="bi bi-door-open-fill me-1 text-warning"></i> Peminjaman
                    </a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="bi bi-person-badge-fill me-1 text-info"></i> Users
                    </a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <i class="bi bi-heart-pulse-fill me-1 text-danger"></i> About
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <style>
        /* === Header Custom Style === */
        .navbar a {
            color: #444;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .navbar a:hover {
            color: #0d6efd;
            transform: translateY(-1px);
        }

        .navbar a.active {
            color: #0d6efd;
            font-weight: 600;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 3px;
        }

        .glow-icon {
            filter: drop-shadow(0 0 4px rgba(25, 135, 84, 0.4));
            transition: all 0.3s ease;
        }

        .glow-icon:hover {
            transform: scale(1.1);
            filter: drop-shadow(0 0 8px rgba(25, 135, 84, 0.6));
        }

        header.header {
            backdrop-filter: blur(8px);
            transition: background 0.3s ease;
        }

        header.header.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
    </style>

    <script>
        // Tambah efek transparan saat scroll
        window.addEventListener("scroll", () => {
            const header = document.querySelector("header.header");
            if (window.scrollY > 10) {
                header.classList.add("scrolled");
            } else {
                header.classList.remove("scrolled");
            }
        });
    </script>
</header>