@extends('layouts.guest.app')

@section('content')

{{-- Bagian Hero dengan Slideshow --}}
<section id="hero" class="hero">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/desa4.jpg') }}" class="d-block w-100" alt="Pemandangan Indonesia 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/desa.jpg') }}" class="d-block w-100" alt="Pemandangan Indonesia 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/desa2.jpg') }}" class="d-block w-100" alt="Pemandangan Indonesia 3">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="hero-text">
        <h1 class="fw-bold mb-3 text-white">
            Selamat Datang di <span class="highlight-text">DesaSface</span>
        </h1>
        <p class="mb-4 text-white">
            <span class="fw-bold fs-3">DesaSface</span> adalah platform digital yang mempermudah pengelolaan informasi warga dan fasilitas umum di desa Anda.
            Dengan sistem informasi terintegrasi, seluruh aktivitas desa menjadi lebih transparan, efisien, dan mudah diakses oleh masyarakat.
        </p>
    </div>
</section>

<style>
/* =========================
   FIX FULL WIDTH HERO
   ========================= */
#hero,
#hero .carousel,
#hero .carousel-inner,
#hero .carousel-item {
    width: 100vw;
    max-width: 100vw;
    margin: 0;
    padding: 0;
}

/* Hindari white gap horizontal */
body {
    margin: 0;
    overflow-x: hidden;
}

/* =========================
   CAROUSEL IMAGE
   ========================= */
.carousel-inner img {
    width: 100%;
    height: 100vh;
    object-fit: cover;
}

/* =========================
   HERO SECTION
   ========================= */
#hero {
    position: relative;
    height: 100vh;
}

.hero-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    width: 100%;
    padding: 0 15px;
    z-index: 2;
}

.hero-text h1 {
    font-size: 3rem;
    font-weight: 700;
}

.hero-text p {
    font-size: 1.25rem;
}

.highlight-text {
    color: #00b029ff;
}

/* =========================
   RESPONSIVE
   ========================= */
@media (max-width: 768px) {
    .hero-text h1 {
        font-size: 2.2rem;
    }

    .hero-text p {
        font-size: 1rem;
    }
}


/*teks saja*/

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #243f56ff; /* biru muda lembut */
        color: #333;
        margin: 0;
        padding-top: 100px;
    }

    h1 {
        text-align: center;
        color: #00b029ff; /* biru soft */
        margin-bottom: 40px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .about-card {
        background: #effff6ff;
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
    <div class="about-card">
        <div class="row align-items-center">
             <h1>About DesaSface</h1>
            <div class="col-md-6">
                <img src="{{ asset('assets/img/about_desa1.jpg') }}" alt="Tentang Desa">
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <h4>Apa itu DesaSface?</h4>
            <p>DesaSface merupakan singkatan dari "Desa Space and Facility", yang berarti "Desa Ruangan dan Fasilitas".</p>
            </div>
        </div>
    </div>

    <div class="about-card">
    <div class="row align-items-center">
        <div class="col-md-6 order-md-2">
            <img src="{{ asset('assets/img/about_flow1.jpg') }}" alt="Alur Sistem">
        </div>
        <div class="col-md-6 order-md-1 mt-4 mt-md-0">
            <h4>Alur Sistem</h4>
            <ol>
                <li>
                    <strong>Pengguna login ke sistem sesuai hak akses</strong>. 
                    Pengguna yang terdaftar dengan status <strong>admin</strong> dapat mengelola berbagai data dan informasi terkait fasilitas desa, sedangkan pengguna dengan status <strong>guest</strong> hanya dapat mengakses informasi dasar tentang desa.
                </li>
                <li>
                    <strong>Admin mengelola data warga dan peminjaman fasilitas</strong>. 
                    Admin memiliki hak untuk mengelola berbagai data, termasuk <strong>fasilitas umum</strong>, <strong>peminjaman fasilitas</strong>, <strong>pembayaran fasilitas</strong>, <strong>syarat fasilitas</strong>, dan <strong>petugas fasilitas</strong> yang ada di desa. Admin juga dapat melakukan pembaruan dan penghapusan data sesuai kebutuhan.
                </li>
                <li>
                    <strong>Data tersimpan otomatis ke database</strong>. 
                    Semua data yang dimasukkan atau diperbarui oleh pengguna, baik admin maupun guest, akan tersimpan otomatis ke dalam database untuk menjaga konsistensi dan keakuratan informasi.
                </li>
                <li>
                    <strong>Pengguna dapat memantau status dan laporan kegiatan desa</strong>. 
                    Pengguna dengan akses yang sesuai dapat memantau status terkini dan melihat laporan kegiatan desa, termasuk informasi tentang petugas, fasilitas umum, peminjaman fasilitas, pembayaran fasilitas, serta syarat fasilitas. Sedangkan guest hanya dapat mengakses informasi umum terkait petugas, fasilitas umum, peminjaman fasilitas, pembayaran fasilitas, dan syarat fasilitas.
                </li>
            </ol>
        </div>
    </div>
</div>

<div class="about-card mt-4">
    <h4>Informasi Akses Tersedia</h4>
    <ul>
        <li><strong>Petugas</strong>: Informasi mengenai petugas desa yang bertugas dalam pengelolaan fasilitas desa.</li>
        <li><strong>Fasilitas Umum</strong>: Informasi lengkap tentang fasilitas desa seperti aula, lapangan, dan sarana umum lainnya yang dapat digunakan oleh warga desa.</li>
        <li><strong>Peminjaman Fasilitas</strong>: Pantau peminjaman fasilitas desa secara online dan transparan untuk memudahkan warga dalam mengakses fasilitas.</li>
        <li><strong>Pembayaran Fasilitas</strong>: Lakukan pembayaran dan unggah bukti pembayaran untuk peminjaman fasilitas yang telah dilakukan.</li>
        <li><strong>Syarat Fasilitas</strong>: Lihat dan unduh syarat serta ketentuan peminjaman fasilitas desa yang berlaku.</li>
    </ul>
</div>


    <div class="about-card text-center">
        <h4>Tujuan Utama Fasilitas Desa & Peminjaman Ruang</h4>
<p>
    Fasilitas Desa & Peminjaman Ruang bertujuan untuk menciptakan sistem yang <strong>efisien</strong>, <strong>terorganisir</strong>, dan <strong>transparan</strong> dalam pengelolaan sarana umum di desa. Dengan memanfaatkan teknologi, sistem ini memberikan akses yang <strong>mudah</strong> bagi masyarakat untuk memanfaatkan fasilitas desa seperti balai desa, aula, dan lapangan secara <strong>terpadu</strong> dan terstruktur. 
</p>
<p>
    Melalui aplikasi DesaSface, tujuan utamanya adalah memberikan kemudahan bagi warga untuk melakukan peminjaman fasilitas dengan cara yang lebih <strong>praktis</strong> dan <strong>efisien</strong>, tanpa harus melalui proses manual yang rumit. Dengan menyediakan informasi yang jelas mengenai ketersediaan ruang dan fasilitas lainnya, warga dapat merencanakan acara atau kegiatan dengan lebih baik. 
</p>
<p>
    Selain itu, sistem ini juga bertujuan untuk meningkatkan <strong>transparansi</strong> dalam pengelolaan fasilitas. Dengan adanya sistem peminjaman yang terintegrasi, proses peminjaman dapat dipantau dan diakses secara langsung oleh masyarakat, sehingga mengurangi kemungkinan penyalahgunaan dan memastikan fasilitas digunakan dengan adil oleh seluruh warga.
</p>
<p>
    Fasilitas desa, seperti balai desa, aula, dan lapangan, memiliki peran yang sangat penting dalam kehidupan sosial masyarakat. Fasilitas-fasilitas ini sering digunakan untuk berbagai macam kegiatan, mulai dari pertemuan desa, perayaan, hingga kegiatan olahraga atau pelatihan. Oleh karena itu, penting bagi desa untuk memiliki sistem yang memungkinkan peminjaman ruang tersebut dilakukan secara mudah, terorganisir, dan aman. Dengan tujuan ini, DesaSface berkomitmen untuk menyediakan sebuah platform yang <strong>terpercaya</strong> dan <strong>terjangkau</strong> bagi warga desa dalam mengakses fasilitas publik.
</p>
<p>
    Dengan tujuan utama untuk meningkatkan <strong>aksesibilitas</strong> dan <strong>kualitas pelayanan</strong> kepada masyarakat, DesaSface memungkinkan proses peminjaman ruang dilakukan secara online, sehingga memudahkan warga dalam memesan ruang untuk kegiatan mereka, baik itu acara sosial, budaya, pendidikan, atau olahraga. Sistem ini juga memungkinkan pengelolaan fasilitas yang lebih <strong>terstruktur</strong>, di mana pihak pengelola desa dapat memantau jadwal penggunaan ruang, melakukan verifikasi permintaan, dan memastikan bahwa setiap fasilitas digunakan secara optimal.
</p>
<p>
    Secara keseluruhan, sistem peminjaman fasilitas desa yang terintegrasi ini bertujuan untuk memastikan bahwa fasilitas yang ada dapat dimanfaatkan dengan sebaik-baiknya oleh seluruh warga desa, menciptakan lingkungan yang lebih <strong>teratur</strong>, <strong>terkontrol</strong>, dan <strong>berkelanjutan</strong>.
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
                        @if(!auth()->check())
                        <p class="fw-bold text-danger">Login terlebih dahulu untuk mengakses</p>
                        @endif
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
                        @if(!auth()->check())
                        <p class="fw-bold text-danger">Login terlebih dahulu untuk mengakses</p>
                        @endif
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
                       @if(!auth()->check())
                        <p class="fw-bold text-danger">Login terlebih dahulu untuk mengakses</p>
                        @endif
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
                        @if(!auth()->check())
                        <p class="fw-bold text-danger">Login terlebih dahulu untuk mengakses</p>
                        @endif
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
                        @if(!auth()->check())
                        <p class="fw-bold text-danger">Login terlebih dahulu untuk mengakses</p>
                        @endif
                        @if(auth()->check()) {{-- Cek jika sudah login --}}
                            <a href="{{ route('syarat_fasilitas.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Syarat</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Styling untuk tombol dalam card dengan tema hijau --}}
<style>
    /* Styling untuk tombol dalam card */
    .btn-primary, .btn-success, .btn-outline-primary {
        font-weight: 600; /* Font lebih tebal untuk tombol */
        padding: 10px 20px; /* Menambah padding untuk tombol */
        border-radius: 5px; /* Memberikan sudut yang lebih lembut */
        transition: all 0.3s ease; /* Efek transisi untuk tombol */
    }

    /* Tombol Primary dengan warna hijau */
    .btn-primary {
        background-color: #28a745; /* Hijau */
        border: none;
        color: white;
    }

    /* Tombol Primary hover dengan hijau lebih gelap */
    .btn-primary:hover {
        background-color: #218838; /* Hijau lebih gelap saat hover */
        color: white;
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25); /* Efek bayangan */
    }

    /* Tombol Success dengan warna hijau */
    .btn-success {
        background-color: #28a745; /* Hijau */
        border: none;
        color: white;
    }

    /* Tombol Success hover dengan hijau lebih gelap */
    .btn-success:hover {
        background-color: #218838; /* Hijau lebih gelap saat hover */
        color: white;
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25); /* Efek bayangan */
    }

    /* Tombol Outline Primary dengan hijau border */
    .btn-outline-primary {
        border-color: #28a745; /* Hijau */
        color: #28a745;
    }

    /* Tombol Outline Primary hover dengan hijau lebih gelap */
    .btn-outline-primary:hover {
        background-color: #28a745; /* Hijau lebih gelap saat hover */
        color: white;
        border-color: #218838; /* Hijau lebih gelap */
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25); /* Efek bayangan */
    }
</style>

{{-- Styling untuk tampilan Card Dashboard --}}
<style>
    /* Body styling */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #cbf6cbff; /* Biru muda lembut */
        color: #333;
        margin: 0;
        padding-top: 100px;
    }

    /* Styling card dashboard */
    .card-dashboard {
        background: #effff6ff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 160, 176, 0.15); /* Biru soft */
        transition: transform 0.3s ease, box-shadow 0.3s ease, filter 0.3s ease;
        cursor: pointer; /* Tampilkan pointer saat hover */
    }

    .card-dashboard:hover {
        transform: translateY(-6px); /* Meningkatkan efek hover */
        box-shadow: 0 6px 15px rgba(0, 160, 176, 0.25); /* Biru soft */
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
        color: #effff6ff; /* Biru soft */
        font-weight: 600;
        font-size: 1.2rem; /* Ukuran font lebih besar */
    }

    .card-dashboard p {
        color: #333;
        line-height: 1.6;
        font-size: 1.1rem; /* Ukuran font lebih besar */
    }
</style>

{{-- Styling untuk tombol di dalam card (tombol tambahan) --}}
<style>
    .btn-primary, .btn-success, .btn-outline-primary {
        transition: background-color 0.3s, color 0.3s; /* Efek transisi untuk tombol */
    }

    .btn-primary:hover, .btn-success:hover, .btn-outline-primary:hover {
        background-color: #caf8daff; /* Biru lebih gelap untuk efek hover */
        color: #b8ffd0ff;
    }

    /* Styling untuk tombol login */
    .btn-login {
        background-color: #78ca98ff;
        border: none;
        color: rgba(182, 249, 197, 1);
        font-weight: 600;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-login:hover {
        background-color: #66b27dff; /* Hijau lebih gelap */
        color: white;
    }

    /* Teks 'Login terlebih dahulu' */
    .login-warning {
        color: #28a745; /* Warna hijau untuk teks */
        font-weight: 600;
        font-size: 1.1rem; /* Ukuran font */
        text-decoration: none;
        transition: color 0.3s, transform 0.3s;
    }

    .login-warning:hover {
        color: #155724; /* Warna hijau lebih gelap saat hover */
        transform: scale(1.05); /* Efek zoom saat hover */
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .card-dashboard img {
            height: 160px;
        }

        .about-card {
            margin-top: 20px;
        }

        .about-card h4 {
            font-size: 1.5rem;
        }

        .about-card p {
            font-size: 1rem;
        }
    }
</style>

@endsection
