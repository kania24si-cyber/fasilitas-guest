<style>
/* HEADER 1 - Bagian Atas (Logo dan Icon Menu Profesional) */
#header {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
    background-color: rgba(79, 198, 99, 1); /* Warna hijau terang untuk bagian atas header */
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); /* Bayangan lebih halus */
    padding: 0px 0; /* Mengurangi padding agar header lebih kompak */
    border-bottom: 0px solid #333; /* Menambahkan garis pemisah yang lebih tipis */
}

/* Logo dan Menu Icon */
#header .container-xl {
    display: flex;
    align-items: center;
    justify-content: space-between; /* Menyusun elemen-elemen ke kiri dan kanan */
    padding: 0 15px; /* Mengurangi padding agar lebih ringkas */
}

/* Ukuran Ikon Hamburger - Sama untuk pengguna login dan tidak login */
#menu-icon, #hamburger-icon {
    font-size: 2rem; /* Ukuran ikon besar sama untuk keduanya */
    background: none;
    border: none;
    z-index: 1100; /* Memastikan ikon berada di atas elemen lain */
}

/* Ikon Hamburger */
#hamburger-icon i {
    color: #ffffffff; /* Warna hijau untuk ikon */
    font-size: 2rem; /* Ukuran ikon */
}

#hamburger-icon:hover i {
    color: #1da918ff; /* Warna hijau lebih gelap saat hover */
}

/* Logo */
.logo {
    display: flex;
    align-items: center;
    margin-left: 50px; /* Memberikan sedikit jarak di kiri logo */
}

.logo img {
    width: 30px; /* Mengecilkan ukuran logo */
    height: 30px; /* Mengecilkan ukuran logo */
}

/* Dropdown Menu */
.dropdown-menu {
    position: absolute; /* Agar dropdown muncul di bawah ikon menu */
    top: 100%; /* Dropdown muncul tepat di bawah tombol menu */
    left: 0; /* Menyelaraskan dropdown dengan tombol menu */
    display: none; /* Menyembunyikan dropdown secara default */
    z-index: 1000; /* Memastikan dropdown di atas elemen lain */
    background-color: #98dc93ff; /* Warna latar belakang dropdown */
    width: auto; /* Menyesuaikan lebar dropdown */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Bayangan untuk dropdown */
}

/* Tampilkan dropdown ketika 'show' class ditambahkan */
.dropdown-menu.show {
    display: block; /* Menampilkan dropdown saat toggle */
}

/* Header Kedua - Navbar */
.navbar-container {
    background-color: #98dc93ff; /* Warna navbar yang gelap untuk pemisahan yang jelas */
    padding: 2px 0; /* Padding untuk navbar agar lebih tipis */
    width: 100%; /* Navbar memenuhi lebar layar */
    margin-top: 10px; /* Memberikan jarak antara header 1 dan 2 */
}

/* Styling untuk Navbar */
.navbar {
    display: flex;
    justify-content: center; /* Menyusun navbar ke tengah */
    width: 100%;
}

.navbar ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center; /* Menyusun item navbar ke tengah */
    width: 100%; /* Navbar memenuhi lebar yang ada */
}

.navbar ul li {
    position: relative;
    padding: 10px 15px; /* Mengurangi padding item navbar */
}

/* Link Navbar */
.navbar ul li a {
    color: #d2ffd3ff;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    transition: 0.3s ease;
    border-radius: 5px; /* Menambahkan border radius untuk sudut yang lebih halus */
    padding: 8px 12px; /* Padding lebih kecil */
}

/* Warna Hover untuk Setiap Item */
.navbar ul li:nth-child(1) a:hover {
    background-color: #6fa34f; /* Hijau lebih gelap untuk item pertama */
}

.navbar ul li:nth-child(2) a:hover {
    background-color: #4c9f52; /* Hijau berbeda untuk item kedua */
}

.navbar ul li:nth-child(3) a:hover {
    background-color: #3b8e45; /* Hijau lebih gelap untuk item ketiga */
}

.navbar ul li:nth-child(4) a:hover {
    background-color: #4c8d47; /* Hijau lebih terang untuk item keempat */
}

.navbar ul li:nth-child(5) a:hover {
    background-color: #357d3d; /* Hijau dengan sedikit warna biru untuk item kelima */
}

.navbar ul li:nth-child(6) a:hover {
    background-color: #498b44; /* Warna hijau sedikit lebih tua untuk item keenam */
}

/* Hover dan Active State */
.navbar ul li a:hover,
.navbar ul li a.active {
    color: #fff;
    transform: translateY(-3px); /* Efek angkat tombol saat hover */
}

/* Efek Tertekan pada Link ketika Diklik */
.navbar ul li a:active {
    background-color: #78b78b; /* Warna sedikit lebih gelap saat tertekan */
    transform: translateY(2px); /* Efek menekan tombol ke bawah */
    box-shadow: none; /* Menghapus bayangan saat tertekan */
}

/* Fokus pada Link */
.navbar ul li a:focus {
    outline: none; /* Menghilangkan outline default */
    box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.1); /* Menambahkan efek fokus */
    background-color: #78b78b; /* Menambahkan efek fokus dengan warna yang lebih gelap */
}

/* Mengubah ukuran menu ikon pada perangkat mobile */
@media (max-width: 768px) {
    #menu-icon, #hamburger-icon {
        font-size: 1.5rem; /* Mengubah ukuran ikon pada perangkat mobile */
    }

    /* Menyusun menu navbar dalam kolom pada perangkat kecil */
    .navbar ul {
        flex-direction: column;
        width: 100%;
        padding-left: 0;
        padding-right: 0;
    }

    /* Mengatur link navbar lebih kecil pada perangkat kecil */
    li a {
        font-size: 14px;
        padding: 8px 12px;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
    }

    /* Styling untuk link "About" pada navbar */
.navbar ul li a.about-link {
    color: #d2ffd3ff;  /* Warna teks link sesuai dengan warna header */
    font-weight: 600;
    font-size: 18px;  /* Menyesuaikan ukuran font */
    text-decoration: none;
    padding: 8px 12px; /* Padding yang sesuai */
    border-radius: 5px;
}

/* Warna Hover dan Active untuk link About */
.navbar ul li a.about-link:hover,
.navbar ul li a.about-link.active {
    background-color: #6fa34f;  /* Warna hijau lebih gelap untuk hover */
    color: #fff; /* Mengubah warna teks menjadi putih saat hover */
}

/* Efek Tertekan pada Link About */
.navbar ul li a.about-link:active {
    background-color: #78b78b; /* Warna sedikit lebih gelap saat tertekan */
    transform: translateY(2px); /* Efek menekan tombol ke bawah */
    box-shadow: none; /* Menghapus bayangan saat tertekan */
}

/* Fokus pada Link About */
.navbar ul li a.about-link:focus {
    outline: none; /* Menghilangkan outline default */
    box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.1); /* Menambahkan efek fokus */
    background-color: #78b78b; /* Efek fokus dengan warna lebih gelap */
}
}





/* BAGIAN PROFILE */
/* Styling untuk halaman profil pengembang */
/* Styling untuk container (background halaman) */
body {
    background-color: #e8f5e9; /* Latar belakang halaman hijau muda */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
}

/* Styling untuk container */
.container {
    margin-top: 50px;
    padding: 15px; /* Padding untuk memberi jarak di seluruh konten */
}

/* Styling card profil pengembang */
.card {
    border-radius: 20px; /* Rounded corners untuk card */
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.15); /* Shadow lebih besar untuk kesan elegan */
    transition: all 0.3s ease-in-out; /* Animasi saat card di-hover */
    background-color: #28a745; /* Background hijau lebih kuat untuk card */
    color: white; /* Teks menjadi putih untuk kontras */
}

.card:hover {
    transform: scale(1.05); /* Membuat card sedikit membesar saat dihover */
    box-shadow: 0 10px 50px rgba(0, 0, 0, 0.2); /* Shadow lebih besar saat dihover */
}

/* Styling header card */
.card-header {
    background-color: #5fc068; /* Hijau terang */
    color: white;
    padding: 25px;
    font-size: 1.8rem; /* Ukuran font lebih besar */
    text-align: center;
    border-radius: 20px 20px 0 0; /* Rounded corners di atas */
    font-weight: 700;
}

/* Styling body card */
.card-body {
    padding: 30px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #ffffff; /* Background putih untuk body */
    border-radius: 0 0 20px 20px;
    color: #333; /* Teks berwarna gelap agar kontras dengan background putih */
}

/* Styling untuk nama pengembang */
.card-body h4 {
    color: #2a4d2f; /* Hijau gelap untuk teks */
    font-weight: 700;
    font-size: 2rem; /* Ukuran font lebih besar */
    margin-bottom: 15px;
    text-transform: capitalize; /* Membuat nama lebih elegan */
}

/* Styling untuk paragraf dan informasi */
.card-body p {
    font-size: 1.2rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 20px;
}

/* Styling untuk list link social media */
.card-body ul {
    list-style: none;
    padding-left: 0;
}

.card-body ul li {
    margin-bottom: 12px;
}

/* Styling untuk link social media */
.card-body a {
    color: #5fc068;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.2rem; /* Ukuran font sedikit lebih besar */
    transition: color 0.3s ease, text-decoration 0.3s ease;
    display: inline-block;
    margin-right: 15px; /* Jarak antar link */
}

.card-body a:hover {
    color: #2a4d2f; /* Warna gelap saat hover */
    text-decoration: underline;
    font-weight: bold; /* Menebalkan font saat hover */
    transform: translateY(-3px); /* Efek sedikit naik saat hover */
}

/* Styling gambar */
.profile-img {
    max-width: 180px;
    border-radius: 50%; /* Membuat gambar bulat */
    border: 5px solid #5fc068; /* Border hijau terang */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease; /* Smooth transition */
}

.profile-img:hover {
    transform: scale(1.1); /* Membuat gambar sedikit membesar saat dihover */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2); /* Shadow lebih besar */
}

/* Styling untuk baris */
.row {
    margin-bottom: 25px;
}

/* Styling untuk judul halaman */
h3 {
    margin-top: 40px;
    font-weight: 700;
    font-size: 2.25rem; /* Ukuran font lebih besar */
    color: #bff5bbff;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 3px; /* Memberikan jarak antar huruf */
    margin-bottom: 30px;
}

/* Responsiveness: untuk layar kecil */
@media (max-width: 768px) {
    .card-body {
        padding: 20px;
    }

    .card-body h4 {
        font-size: 1.5rem;
    }

    .card-body p {
        font-size: 1rem;
    }

    .profile-img {
        max-width: 150px;
    }

    .card-body a {
        font-size: 1.1rem;
    }
}

</style>

