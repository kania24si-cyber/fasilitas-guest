<style>
/* HEADER */
#header {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
    background-color: #4fc663ff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); /* Menipiskan shadow */
    padding: 5px 0; /* Mengurangi padding vertikal agar header lebih tipis */
}

#header .container-xl {
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Menyusun elemen-elemen ke kiri */
    padding: 0 20px;
}

.d-flex.align-items-center {
    display: flex;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    margin-left: 0px; /* Memberikan sedikit jarak di kiri logo */
}

.logo img {
    width: 40px;
    height: 40px;
}

#hamburger-icon {
    background: none;
    border: none;
    font-size: 1.2rem; /* Mengurangi ukuran ikon hamburger */
    margin-right: 10px; /* Jarak antara hamburger dan logo */
}

/* Navbar styles */
/* Navbar styles */
.navbar {
    display: flex;
    justify-content: center; /* Menyusun navbar ke tengah */
    width: 100%; /* Pastikan navbar memenuhi lebar yang ada */
}

.navbar ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center; /* Menyusun item navbar ke tengah */
}

.navbar ul li {
    position: relative;
    padding: 8px 12px; /* Mengurangi padding untuk memadatkan menu */
}

.navbar ul li a {
    color: #d2ffd3ff;
    font-weight: 500; /* Mengurangi ketebalan font */
    font-size: 14px; /* Memperkecil ukuran font */
    text-decoration: none;
    transition: 0.3s;
}

.navbar ul li a:hover,
.navbar ul li a.active {
    color: #d2ffd3ff;
}


/* Hamburger Icon */
#hamburger-icon {
    background-color: transparent; /* Tanpa latar belakang */
    border: none; /* Menghilangkan border */
    color: #d2ffd3ff; /* Warna hijau untuk ikon */
    font-size: 28px; /* Ukuran font untuk ikon */
    transition: all 0.3s ease; /* Transisi halus saat hover */
    padding: 10px; /* Jarak dalam */
}

/* Efek Hover pada Hamburger Icon */
#hamburger-icon:hover {
    color: #d2ffd3ff; /* Hijau lebih gelap saat hover */
    transform: scale(1.1); /* Memberikan efek membesar sedikit saat hover */
}

/* Dropdown Menu */
.dropdown-menu {
    background-color: #379b3aff; /* Warna hijau untuk menu */
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border: none;
}

/* Item Dropdown */
.dropdown-menu .dropdown-item {
    font-weight: 500; /* Mengurangi ketebalan font */
    padding: 10px 18px; /* Mengurangi padding item dropdown */
    font-size: 13px; /* Memperkecil ukuran font item dropdown */
    color: white; /* Warna teks item */
    transition: background-color 0.3s ease, padding-left 0.3s ease;
}

/* Hover effect untuk item dropdown */
.dropdown-menu .dropdown-item:hover {
    background-color: #45a049; /* Warna hijau gelap saat hover */
    padding-left: 25px; /* Memberikan efek geser saat hover */
}




/* Card Dashboard Styles */
/* Styling untuk Hero Section */

/* Bagian About yang ada link tombol crud login guest*/
  
    /* Bagian About yang dibawah */
  
  /* Styling untuk menu link header(About) */

li a {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font elegan dan modern */
    font-size: 18px;
    color: #d2ffd3ff; /* Warna hijau */
    text-decoration: none; /* Menghapus garis bawah pada link */
    font-weight: 600;
    padding: 10px 15px;
    border-radius: 8px;
    transition: all 0.3s ease-in-out; /* Menambahkan transisi untuk animasi yang halus */
}

/* Efek hover */
li a:hover {
    color: #d2ffd3ff; /* Ubah warna teks menjadi putih saat hover */
    transform: translateY(-3px); /* Efek angkat tombol saat hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Efek bayangan */
}

/* Responsiveness */
@media (max-width: 768px) {
    li a {
        font-size: 16px;
        padding: 8px 12px;
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

