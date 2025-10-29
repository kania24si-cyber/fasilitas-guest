<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bina Desa | Dashboard Guest</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Bina Desa, Dashboard, Fasilitas Umum, Peminjaman Ruangan" name="keywords">
    <meta content="Dashboard Guest - Bina Desa" name="description"> <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet"> <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet"> <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <style>
        /* HERO */
        .hero {
            padding: 120px 0 80px;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
            url('{{ asset(' assets/img/banner.jpg') }}') center center/cover no-repeat;
            color: #fff;
            text-align: center;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 2.8rem;
        }

        .hero p {
            font-size: 1.2rem;
            color: #e0e0e0;
        }

        /* NAVIGATION */
        #navbar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        #navbar ul li {
            position: relative;
            padding: 10px 15px;
        }

        #navbar ul li a {
            color: #012970;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        #navbar ul li a:hover,
        #navbar ul li a.active {
            color: #4154f1;
        }

        /* SECTION CARD */
        .dashboard-section {
            padding: 60px 0;
        }

        .card-dashboard {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
            background-color: #fff;
        }

        .card-dashboard:hover {
            transform: translateY(-10px);
        }

        .card-dashboard img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-dashboard i {
            font-size: 3rem;
            color: #0d6efd;
            margin-top: 20px;
        }

        .card-dashboard .btn {
            margin-bottom: 20px;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
    </style>
</head>

<body> <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between"> <!-- Logo + Tombol Logout sejajar -->
            <div class="d-flex align-items-center"> <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center me-3"> <img src="{{ asset('assets/img/logo.png') }}" alt=""> <span class="ms-2">BinaDesa</span> </a> <!-- Tombol Logout persis di samping "BinaDesa" --> <a href="{{ route('auth.logout') }}" class="btn btn-danger btn-sm" style="font-weight: 600;"> Logout </a> </div>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Home</a></li>
                    <li><a class="{{ request()->routeIs('warga.*') ? 'active' : '' }}" href="{{ route('warga.index') }}">Data Warga</a></li>
                    <li><a class="{{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
                    <li><a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a></li>
            </nav> <!-- .navbar -->
        </div>
    </header> <!-- End Header --> <!-- ======= Hero Section ======= --> @section('content') {{-- Bagian Hero --}}
    <section id="hero" class="hero d-flex align-items-center" data-aos="fade-up">
        <div class="container text-center">
            <h1 class="fw-bold mb-3">Selamat Datang di <span class="text-primary">Bina Desa</span></h1>
            <p class="mb-4"> Sistem informasi terpadu untuk pengelolaan data warga dan peminjaman fasilitas umum desa.<br> Semua kegiatan desa kini lebih transparan, mudah, dan efisien. </p>
        </div>
    </section> {{-- Bagian Gambar --}}
    <section class="dashboard-section" data-aos="fade-up" data-aos-delay="200">
        <div class="container text-center">
            <div class="row justify-content-center gy-4">
                <div class="col-md-5">
                    <div class="card card-dashboard"> <img src="{{ asset('assets/img/binadesautama1.jpg') }}" alt="Data Warga" />
                        <div class="card-body">
                            <h5 class="fw-bold mt-3">Data Warga</h5>
                            <p class="text-muted">Berisi informasi lengkap warga desa untuk membantu administrasi dan pelayanan publik.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-dashboard"> <img src="{{ asset('assets/img/binadesautama2.jpg') }}" alt="Peminjaman Ruangan" />
                        <div class="card-body">
                            <h5 class="fw-bold mt-3">Peminjaman Ruangan</h5>
                            <p class="text-muted">Fitur yang memudahkan masyarakat dalam mengatur dan mengajukan peminjaman fasilitas desa.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-dashboard"> <img src="{{ asset('assets/img/binadesautama3.jpg') }}" alt="Users yang login" />
                        <div class="card-body">
                            <h5 class="fw-bold mt-3">Users</h5>
                            <p class="text-muted">Fitur untuk melihat semua akses login</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  <main id="main" style="margin-top: 100px;"> @yield('content') </main> <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 <strong>Bina Desa</strong>. All Rights Reserved</p>
        </div>
    </footer> <a href="#" class="scroll-top d-flex align-items-center justify-content-center"> <i class="bi bi-arrow-up-short"></i> </a> <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script> <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>