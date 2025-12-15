@extends('layouts.guest.app')

@section('content')

{{-- Bagian Hero --}}
<section id="hero" class="hero" style="background-image: url('https://images.pexels.com/photos/29294543/pexels-photo-29294543.jpeg'); background-size: cover; background-position: center; height: 500px;">
    <div class="container text-center" style="padding-top: 100px;">
        <h1 class="fw-bold mb-3 text-white">Selamat Datang di <span class="highlight-text">DesaSface</span></h1>
        <p class="mb-4 text-white">
            <span class="fw-bold fs-3">DesaSface</span> adalah platform digital yang mempermudah pengelolaan informasi warga dan fasilitas umum di desa Anda. Dengan sistem informasi terintegrasi, seluruh aktivitas desa menjadi lebih transparan, efisien, dan mudah diakses oleh masyarakat.
        </p>
    </div>
</section>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #243f56ff; /* biru muda lembut */
        color: #333;
        margin: 0;
        padding-top: 100px;
    }

    h1 {
        text-align: center;
        color: #00A0B0; /* biru soft */
        margin-bottom: 40px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .about-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 160, 176, 0.15); /* biru soft */
        padding: 30px;
        margin-bottom: 25px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .about-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 15px rgba(0, 160, 176, 0.25); /* biru soft */
    }

    .about-card h2,
    .about-card h4 {
        color: #00A0B0; /* biru soft */
        margin-bottom: 10px;
    }

    .about-card p,
    .about-card li {
        line-height: 1.6;
    }

    .about-section {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px 80px;
    }

    .about-section img {
        width: 100%;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 160, 176, 0.15); /* biru soft */
        transition: transform 0.3s ease;
    }

    .about-section img:hover {
        transform: scale(1.03);
    }

    .copyright {
        text-align: center;
        color: #6c757d;
        font-size: 0.9rem;
        margin-top: 50px;
    }

    strong {
        color: #2C7D59; /* hijau soft */
    }
</style>

<div class="about-section container">
    <h1>Tentang Aplikasi BinaDesa</h1>

    <div class="about-card">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('assets/img/about_desa.jpg') }}" alt="Tentang Desa">
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <h4>Tujuan Modul</h4>
                <p>Aplikasi ini dirancang untuk membantu administrasi desa menjadi lebih modern dan efisien.</p>
                <ul>
                    <li><strong>Modul Data Warga:</strong> Menyimpan dan menampilkan informasi penduduk secara terstruktur.</li>
                    <li><strong>Modul Peminjaman:</strong> Mengatur proses peminjaman fasilitas umum seperti aula dan alat.</li>
                    <li><strong>Modul Users:</strong> Mengelola data pengguna dengan hak akses berbeda.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="about-card">
        <div class="row align-items-center">
            <div class="col-md-6 order-md-2">
                <img src="{{ asset('assets/img/about_flow.jpg') }}" alt="Alur Sistem">
            </div>
            <div class="col-md-6 order-md-1 mt-4 mt-md-0">
                <h4>Alur Sistem</h4>
                <ol>
                    <li>Pengguna login ke sistem sesuai hak akses.</li>
                    <li>Admin mengelola data warga dan peminjaman fasilitas.</li>
                    <li>Data tersimpan otomatis ke database.</li>
                    <li>Pengguna dapat memantau status dan laporan kegiatan desa.</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="about-card text-center">
        <h4>Tujuan Utama BinaDesa</h4>
        <p>
            Mewujudkan sistem informasi desa yang <strong>transparan</strong>, <strong>terpadu</strong>,
            dan <strong>mudah diakses</strong> oleh masyarakat desa.
        </p>
    </div>
</div>

{{-- Bagian Card Dashboard --}}
<section class="dashboard-section" data-aos="fade-up" data-aos-delay="200">
    <div class="container text-center">
        <div class="row justify-content-center gy-4">
            {{-- Petugas --}}
            <div class="col-md-5 col-lg-4">
                <div class="card card-dashboard h-100">
                    <img src="{{ asset('assets/img/petugas.jpg') }}" alt="Petugas">
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold mt-3">Petugas</h5>
                        <p class="text-muted">Informasi mengenai petugas desa.</p>
                        @if(auth()->check()) {{-- Cek jika sudah login --}}
                            <a href="{{ route('petugas.index') }}" class="btn btn-primary btn-sm mt-auto">Lihat Peran Petugas</a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Fasilitas Umum --}}
            <div class="col-md-5 col-lg-4">
                <div class="card card-dashboard h-100">
                    <img src="{{ asset('assets/img/fasilitas.jpg') }}" alt="Fasilitas Umum">
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold mt-3">Fasilitas Umum</h5>
                        <p class="text-muted">Informasi lengkap tentang fasilitas desa seperti aula, lapangan, dan sarana umum lainnya.</p>
                        @if(auth()->check()) {{-- Cek jika sudah login --}}
                            <a href="{{ route('fasilitas.index') }}" class="btn btn-primary btn-sm mt-auto">Lihat Fasilitas</a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Peminjaman Fasilitas --}}
            <div class="col-md-5 col-lg-4">
                <div class="card card-dashboard h-100">
                    <img src="{{ asset('assets/img/peminjaman.jpg') }}" alt="Peminjaman Fasilitas">
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold mt-3">Peminjaman Fasilitas</h5>
                        <p class="text-muted">Pantau peminjaman fasilitas desa secara online dan transparan.</p>
                        @if(auth()->check()) {{-- Cek jika sudah login --}}
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-primary btn-sm mt-auto">Lihat List Peminjaman</a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Pembayaran Fasilitas --}}
            <div class="col-md-5 col-lg-4">
                <div class="card card-dashboard h-100">
                    <img src="{{ asset('assets/img/pembayaran.jpg') }}" alt="Pembayaran Fasilitas">
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold mt-3">Pembayaran Fasilitas</h5>
                        <p class="text-muted">Lakukan pembayaran dan unggah bukti pembayaran untuk peminjaman fasilitas.</p>
                        @if(auth()->check()) {{-- Cek jika sudah login --}}
                            <a href="{{ route('pembayaran_fasilitas.create') }}" class="btn btn-success btn-sm mt-auto">Bayar Sekarang</a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Syarat Fasilitas --}}
            <div class="col-md-5 col-lg-4">
                <div class="card card-dashboard h-100">
                    <img src="{{ asset('assets/img/syarat.jpg') }}" alt="Syarat Fasilitas">
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold mt-3">Syarat Fasilitas</h5>
                        <p class="text-muted">Lihat dan unduh syarat serta ketentuan peminjaman fasilitas desa.</p>
                        @if(auth()->check()) {{-- Cek jika sudah login --}}
                            <a href="{{ route('syarat_fasilitas.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Syarat</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CSS --}}
<style>
    /* Body styling */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f8ff; /* biru muda lembut */
        color: #333;
        margin: 0;
        padding-top: 100px;
    }

    /* Styling card dashboard */
    .card-dashboard {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 160, 176, 0.15); /* biru soft */
        transition: transform 0.3s ease, box-shadow 0.3s ease, filter 0.3s ease;
        cursor: pointer; /* Tampilkan pointer saat hover */
    }

    .card-dashboard:hover {
        transform: translateY(-6px); /* Meningkatkan efek hover */
        box-shadow: 0 6px 15px rgba(0, 160, 176, 0.25); /* biru soft */
        filter: brightness(1.05); /* Menerapkan sedikit kecerahan */
    }

    /* Styling untuk gambar card */
    .card-dashboard img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 15px;
    }

    /* Styling untuk card body */
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Styling untuk judul dan teks dalam card */
    .card-dashboard h5 {
        color: #00A0B0; /* Biru soft */
        font-weight: 600;
    }

    .card-dashboard p {
        color: #333;
        line-height: 1.6;
    }

    /* Styling untuk tombol dalam card */
    .btn-primary, .btn-success, .btn-outline-primary {
        transition: background-color 0.3s, color 0.3s; /* Efek transisi untuk tombol */
    }

    .btn-primary:hover, .btn-success:hover, .btn-outline-primary:hover {
        background-color: #007F8B; /* Biru lebih gelap untuk efek hover */
        color: #fff;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .card-dashboard {
            margin-bottom: 20px;
        }

        .card-dashboard img {
            height: 150px; /* Menyesuaikan tinggi gambar pada layar kecil */
        }
    }
</style>

@endsection
