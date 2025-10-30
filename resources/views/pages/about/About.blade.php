@extends('layouts.guest.app')

@section('content')
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
            /* biru muda lembut */
            color: #333;
            margin: 0;
            padding-top: 100px;
        }

        h1 {
            text-align: center;
            color: #0d6efd;
            /* biru khas Bootstrap */
            margin-bottom: 40px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .about-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.15);
            padding: 30px;
            margin-bottom: 25px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .about-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.25);
        }

        .about-card h2,
        .about-card h4 {
            color: #0d6efd;
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
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
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
            color: #0b5ed7;
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
                        <li><strong>Modul Data Warga:</strong> Menyimpan dan menampilkan informasi penduduk secara
                            terstruktur.</li>
                        <li><strong>Modul Peminjaman:</strong> Mengatur proses peminjaman fasilitas umum seperti aula dan
                            alat.</li>
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

        <p class="copyright">© {{ date('Y') }} BinaDesa | Sistem Informasi Desa Digital</p>
    </div>
@endsection