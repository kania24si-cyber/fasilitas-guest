@extends('layouts.guest.app')

@section('content')

    {{-- CSS Hover Card --}}
    <style>
        .card-dashboard {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            background: #fff;
            transition: all 0.35s ease;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .card-dashboard img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        /* Efek saat cursor diarahkan */
        .card-dashboard:hover {
            transform: translateY(-10px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.15);
        }

        .card-dashboard:hover img {
            transform: scale(1.08);
        }

        .card-dashboard .card-body h5 {
            transition: color 0.3s ease;
        }

        .card-dashboard:hover .card-body h5 {
            color: #0d6efd; /* Bootstrap primary */
        }
    </style>
    {{-- Bagian Hero --}}
    <section id="hero" class="hero d-flex align-items-center" data-aos="fade-up">
        <div class="container text-center">
            <h1 class="fw-bold mb-3">Selamat Datang di <span class="text-primary">Bina Desa</span></h1>
            <p class="mb-4">
                Sistem informasi terpadu untuk pengelolaan data warga dan peminjaman fasilitas umum desa.<br>
                Semua kegiatan desa kini lebih transparan, mudah, dan efisien.
            </p>
        </div>
    </section>


   {{-- Bagian Card Dashboard --}}
<section class="dashboard-section" data-aos="fade-up" data-aos-delay="200">
    <div class="container text-center">
        <div class="row justify-content-center gy-4">

            <div class="row g-4">

            {{-- Warga --}}
    <div class="col-md-5 col-lg-4">
        <div class="card card-dashboard h-100">
            <img src="{{ asset('assets/img/warga.jpg') }}" alt="Warga">
            <div class="card-body d-flex flex-column">
                <h5 class="fw-bold mt-3">Warga</h5>
                <p class="text-muted">
                    Isi dengan lengkap Informasi kamu.
                </p>

                <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm mt-auto">
                    Isi dengan lengkap data diri
                </a>
            </div>
        </div>
    </div>

    {{-- Fasilitas Umum --}}
    <div class="col-md-5 col-lg-4">
        <div class="card card-dashboard h-100">
            <img src="{{ asset('assets/img/fasilitas.jpg') }}" alt="Fasilitas Umum">
            <div class="card-body d-flex flex-column">
                <h5 class="fw-bold mt-3">Fasilitas Umum</h5>
                <p class="text-muted">
                    Informasi lengkap fasilitas desa seperti aula, lapangan, dan sarana umum lainnya.
                </p>

                <a href="{{ route('fasilitas.index') }}" class="btn btn-primary btn-sm mt-auto">
                    Lihat Fasilitas
                </a>
            </div>
        </div>
    </div>

    {{-- Peminjaman Fasilitas --}}
    <div class="col-md-5 col-lg-4">
        <div class="card card-dashboard h-100">
            <img src="{{ asset('assets/img/peminjaman.jpg') }}" alt="Peminjaman Fasilitas">
            <div class="card-body d-flex flex-column">
                <h5 class="fw-bold mt-3">Peminjaman Fasilitas</h5>
                <p class="text-muted">
                    Pantau peminjaman fasilitas desa secara online dan transparan.
                </p>

                <a href="{{ route('peminjaman.index') }}" class="btn btn-primary btn-sm mt-auto">
                    Lihat list Peminjaman
                </a>
            </div>
        </div>
    </div>

    {{-- Pembayaran Fasilitas --}}
    <div class="col-md-5 col-lg-4">
        <div class="card card-dashboard h-100">
            <img src="{{ asset('assets/img/pembayaran.jpg') }}" alt="Pembayaran Fasilitas">
            <div class="card-body d-flex flex-column">
                <h5 class="fw-bold mt-3">Pembayaran Fasilitas</h5>
                <p class="text-muted">
                    Lakukan pembayaran dan unggah bukti pembayaran peminjaman fasilitas.
                </p>

                <a href="{{ route('pembayaran_fasilitas.create') }}" class="btn btn-success btn-sm mt-auto">
                    Bayar Sekarang
                </a>
            </div>
        </div>
    </div>

    {{-- Syarat Fasilitas --}}
    <div class="col-md-5 col-lg-4">
        <div class="card card-dashboard h-100">
            <img src="{{ asset('assets/img/syarat.jpg') }}" alt="Syarat Fasilitas">
            <div class="card-body d-flex flex-column">
                <h5 class="fw-bold mt-3">Syarat Fasilitas</h5>
                <p class="text-muted">
                    Lihat dan unduh syarat serta ketentuan peminjaman fasilitas desa.
                </p>

                <a href="{{ route('syarat_fasilitas.index') }}" class="btn btn-outline-primary btn-sm mt-auto">
                    Lihat Syarat
                </a>
            </div>
        </div>
    </div>

</div>
@endsection

