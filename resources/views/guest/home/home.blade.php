@extends('layouts.guest.app')

@section('content')
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
                <div class="col-md-5">
                    <div class="card card-dashboard">
                        <img src="{{ asset('assets/img/binadesautama1.jpg') }}" alt="Data Warga" />
                        <div class="card-body">
                            <h5 class="fw-bold mt-3">Data Warga</h5>
                            <p class="text-muted">
                                Berisi informasi lengkap warga desa untuk membantu administrasi dan pelayanan publik.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card card-dashboard">
                        <img src="{{ asset('assets/img/binadesautama2.jpg') }}" alt="Peminjaman Ruangan" />
                        <div class="card-body">
                            <h5 class="fw-bold mt-3">Peminjaman Ruangan</h5>
                            <p class="text-muted">
                                Fitur yang memudahkan masyarakat dalam mengatur dan mengajukan peminjaman fasilitas desa.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card card-dashboard">
                        <img src="{{ asset('assets/img/binadesautama3.jpg') }}" alt="Users yang login" />
                        <div class="card-body">
                            <h5 class="fw-bold mt-3">Users</h5>
                            <p class="text-muted">
                                Fitur untuk melihat semua akses login.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
