<style>
/* =========================================================
   HEADER 1 - Bagian Atas (Logo dan Icon Menu Profesional)
   (TIDAK DIUBAH)
========================================================= */
#header {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
    background-color: rgba(79, 198, 99, 1);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    padding: 0px 0;
    border-bottom: 0px solid #333;
}

#header .container-xl {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 8;
}

#menu-icon, #hamburger-icon {
    font-size: 2rem;
    background: none;
    border: none;
    z-index: 1100;
}

#hamburger-icon i {
    color: #ffffffff;
    font-size: 2rem;
}

#hamburger-icon:hover i {
    color: #1da918ff;
}

.logo {
    display: flex;
    align-items: center;
    margin-left: 35px;
}

.logo img {
    width: 50px;
    height: 50px;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    display: none;
    z-index: 1000;
    background-color: #98dc93ff;
    width: auto;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.dropdown-menu.show {
    display: block;
}

/* ===============================
   HAMBURGER ICON → HIJAU TERANG
================================ */

/* Hamburger icon default */
#hamburger-icon i,
#menu-icon i {
    color: #bef7bcff; /* hijau terang */
    transition: color 0.3s ease, transform 0.2s ease;
}

/* Hover effect */
#hamburger-icon:hover i,
#menu-icon:hover i {
    color: #224b05ff; /* hijau WhatsApp (lebih terang) */
    transform: scale(1.1);
}

/* ===============================
   WARNA ISI DROPDOWN HAMBURGER
   (TAMBAHAN SAJA)
================================ */

/* Background dropdown */
#hamburger-icon + .dropdown-menu,
#menu-icon + .dropdown-menu {
    background-color: #dcffdaff; /* hijau muda lembut */
}

/* Teks item dropdown */
#hamburger-icon + .dropdown-menu .dropdown-item,
#menu-icon + .dropdown-menu .dropdown-item {
    color: #224b05ff; /* hijau gelap */
    font-weight: 600;
}

/* Icon di dalam dropdown */
#hamburger-icon + .dropdown-menu .dropdown-item i,
#menu-icon + .dropdown-menu .dropdown-item i {
    color: #158b46ff;
}

/* Hover item dropdown */
#hamburger-icon + .dropdown-menu .dropdown-item:hover,
#menu-icon + .dropdown-menu .dropdown-item:hover {
    background: rgba(34, 75, 5, 0.15);
    color: #0f6b34ff;
}

/* Hover icon */
#hamburger-icon + .dropdown-menu .dropdown-item:hover i,
#menu-icon + .dropdown-menu .dropdown-item:hover i {
    color: #0f6b34ff;
}
/* ===============================
   HEADER 2 - NAVBAR FIX
================================ */

/* Navbar container */
.navbar-container {
    background-color: #efffeeff;
    padding: 2px 0;
    width: 100%;
    margin-top: 10px;
}

/* Navbar utama */
.navbar {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 0 15px;
}

/* List menu */
.navbar ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    width: 100%;
    gap: 10px; /* jarak antar menu */
}

/* Logo header 2 selalu di kiri */
.header2-logo {
    display: flex;
    align-items: center;
    margin-left: 40px; /* Memberikan jarak kecil ke kanan */
}

/* Navbar center (About untuk guest) */
.navbar-center {
    display: flex;
    justify-content: center; /* posisikan isi di tengah */
    flex: 1; /* ambil sisa ruang di antara logo & menu kanan */
    position: absolute; /* untuk guest */
    left: 50%;
    transform: translateX(-50%);
}

/* Link di navbar-center */
.navbar-center a {
    color: #158b46ff;             /* Sama dengan menu lainnya */
    font-weight: 600;             /* Konsisten dengan menu lainnya */
    font-size: 18px;              /* Serasi dengan ukuran menu */
    text-decoration: none;
    padding: 8px 15px;           /* Sedikit lebih lebar untuk tampilan */
    border-radius: 8px;          /* Tidak terlalu bulat, lebih natural */
    transition: all 0.3s ease;   /* Transisi halus untuk semua efek */
    background-color: transparent; /* Menghilangkan background */
}

/* Hover dan active state */
.navbar-center a:hover,
.navbar-center a.active {
    color: rgba(79, 198, 99, 1);               /* Ubah teks menjadi putih saat hover */
    background-color: transparent; /* Tidak ada background */
    transform: translateY(-3px);    /* Efek hover lebih ringan */
}

/* Efek ketika item dalam keadaan aktif */
.navbar-center a:active {
    color: #4c921bff;              /* Warna teks tetap setelah klik */
    background-color: transparent; /* Tidak ada background */
    transform: translateY(1px);    /* Efek pergeseran ke bawah sedikit */
}

/*-----*/


/* Menu utama untuk guest */
body.guest .navbar ul {
    display: flex;
    align-items: center;
    width: 100%;
    position: relative;
}

/* Menu utama untuk user login */
body.auth .navbar ul {
    display: flex;
    align-items: center;
    width: 100%;
}

/* Dorong menu login/admin/user ke kanan, kecuali logo dan user dropdown */
body.auth .navbar ul li.navbar-right {
    margin-left: auto;  /* dorong menu login/admin/user ke kanan */
}

/* Item menu */
.navbar ul li {
    position: relative;
    padding: 0 10px;
}

/* Link menu */
.navbar ul li a {
    color: #158b46ff;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    transition: color 0.3s ease, transform 0.2s ease;
}

/* Hover dan active state */
.navbar ul li a:hover,
.navbar ul li a.active {
    color: #30ff25ff;
    transform: translateY(-2px);
}

/* ===============================
   USER DROPDOWN (NAMA USER)
================================ */

/* Kontainer tombol user dropdown */
#user-dropdown {
    display: flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 20px;
    background: #efffeeff;
    transition: all 0.3s ease;
    text-decoration: none;
}

/* Hover efek tombol user */
#user-dropdown:hover {
    background: rgba(21, 139, 70, 0.35);
    transform: translateY(-1px);
}

/* Avatar user */
#user-dropdown img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #65ca8dff;
    transition: transform 0.3s ease;
}

#user-dropdown:hover img {
    transform: scale(1.05);
}

/* Nama user */
#user-dropdown span {
    font-size: 15px;
    font-weight: 700;
    color: #0f6b34ff; /* Hijau gelap */
    white-space: nowrap;
    margin-left: 6px;
}

/* Ikon caret dropdown (di tombol user) */
#user-dropdown i {
    color: #158b46ff; /* hijau utama */
    font-size: 14px;
    transition: color 0.3s ease;
}

#user-dropdown:hover i {
    color: #0f6b34ff; /* hijau gelap saat hover */
}

/* Dropdown menu */
#user-dropdown + .dropdown-menu {
    border-radius: 14px;
    padding: 8px;
    min-width: 160px;
    background-color: #efffeeff;
}

/* Teks dan tombol item dropdown */
#user-dropdown + .dropdown-menu .dropdown-item,
#user-dropdown + .dropdown-menu .dropdown-item button {
    color: #224b05ff;
    font-weight: 600;
    transition: background 0.3s ease, color 0.3s ease;
}

/* Hover item dropdown */
#user-dropdown + .dropdown-menu .dropdown-item:hover,
#user-dropdown + .dropdown-menu .dropdown-item button:hover {
    background: rgba(34, 75, 5, 0.15);
    color: #0f6b34ff; /* hijau gelap */
}

/* Ikon dalam dropdown */
#user-dropdown + .dropdown-menu .dropdown-item i,
#user-dropdown + .dropdown-menu .dropdown-item button i {
    color: #158b46ff; /* hijau utama */
}

#user-dropdown + .dropdown-menu .dropdown-item:hover i,
#user-dropdown + .dropdown-menu .dropdown-item button:hover i {
    color: #0f6b34ff; /* hijau gelap saat hover */
}

/* Pastikan dropdown berada di posisi relatif dalam list item */
.navbar ul li.dropdown,
.navbar ul li.ms-auto {
    position: relative;
    margin-left: auto; /* pastikan berada di ujung kanan */
}

/* ===============================
   OVERRIDE UKURAN FONT NAVBAR
================================ */

/* Ukuran teks menu navbar */
.navbar ul li a {
    font-size: 13px;      /* dari 16px → 13px */
    padding: 5px 10px;    /* lebih ramping */
}

/* Dropdown item navbar */
.navbar .dropdown-menu .dropdown-item {
    font-size: 12px;       /* lebih kecil */
}

/* Perbesar logo header 2 */
.header2-logo img {
    height: 50px;   /* dari 22px → 40px */
}


/* =========================================================
   🔥 TAMBAHAN CSS BACKGROUND FOTO (INI YANG DIPERBAIKI)
========================================================= */

/* Section background full layar */
.background-section {
    position: relative;
    width: 100%;
    min-height: 100vh;
    padding-top: 120px; /* ⬅️ penting agar tidak ketutup header fixed */
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

/* Background image FIX */
.background-section .background-image {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* ⬅️ kunci agar foto tidak rusak */
    z-index: -2;
}

/* Overlay biar teks jelas */
.background-section::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.35);
    z-index: -1;
}

/* Card konten */
.content-container {
    background: rgba(255, 255, 255, 0.88);
    padding: 40px;
    border-radius: 18px;
    max-width: 600px;
    width: 90%;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
}

/* Judul */
.content-container h1 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #1f7431ff;
}

/* Paragraf */
.content-container p {
    font-size: 17px;
    color: #444;
    margin-bottom: 30px;
}

/* Tombol WhatsApp */
.whatsapp-btn {
    background-color: #25D366;
    color: #fff;
    padding: 16px 34px;
    border-radius: 50px;
    font-size: 18px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    transition: 0.3s ease;
}

.whatsapp-btn:hover {
    background-color: #1da918;
    transform: scale(1.05);
}

/* Tooltip */
.whatsapp-tooltip {
    margin-top: 15px;
    background: #25D366;
    color: #eaffea;
    padding: 10px 18px;
    border-radius: 14px;
    font-size: 14px;
    opacity: 0;
    transition: 0.3s;
}

.whatsapp-btn:hover + .whatsapp-tooltip {
    opacity: 1;
}

/* Tombol Back */
.back-to-about-btn {
    position: fixed;
    bottom: 25px;
    right: 25px;
    background: #25D366;
    color: white;
    padding: 12px 22px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 6px 15px rgba(0,0,0,0.25);
    z-index: 999;
}

.back-to-about-btn:hover {
    background: #1da918;
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

/* Memberikan margin dan padding lebih pada setiap container */
.container {
    margin-top: 20px;  /* Menurunkan konten dari atas */
    padding-bottom: 30px; /* Memberikan ruang di bawah konten */
}

/* Menurunkan container */
.container.mt-4 {
    margin-top: 40px; /* Jarak lebih besar untuk menurunkan seluruh konten */
}

/* Menurunkan bagian d-flex dalam container */
.d-flex.justify-content-between.align-items-center.mb-3 {
    margin-top: 20px; /* Jarak lebih kecil untuk menurunkan konten ini sedikit */
}




/* ------------------------------
   Button Styles for Detail, Edit, and Delete
------------------------------ */
/* ------------------------------
   General Button Styling
------------------------------ */

/* Tombol dengan warna hijau gelap (Detail) */
.btn-detail {
    background-color: #006400; /* Dark Green */
    color: white;
    border: none;
    padding: 6px 14px;
    font-size: 0.875rem;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
}

.btn-detail:hover {
    background-color: #004d00; /* Darker Green */
}

.btn-detail i {
    margin-right: 5px;
}

/* Tombol Edit */
.btn-edit {
    background-color: transparent;
    color: #ffc107; /* Yellow (warning) */
    border: 1px solid #ffc107;
    padding: 6px 14px;
    font-size: 0.875rem;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
}

.btn-edit:hover {
    background-color: #ffc107;
    color: white;
}

.btn-edit i {
    margin-right: 5px;
}

/* Tombol Hapus */
.btn-delete {
    background-color: transparent;
    color: #dc3545; /* Red (danger) */
    border: 1px solid #dc3545;
    padding: 6px 14px;
    font-size: 0.875rem;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
}

.btn-delete:hover {
    background-color: #dc3545;
    color: white;
}

.btn-delete i {
    margin-right: 5px;
}

/* ------------------------------
   Filter Dropdown Styles
------------------------------ */

/* Dropdown filter container */
.select-container {
    position: relative;
    max-width: 350px; /* Lebar filter */
}

/* Icon inside the filter dropdown */
.select-container i {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}
/* ------------------------------
   Font untuk Judul Data Warga
------------------------------ */

h4 {
    font-family: 'Arial', sans-serif;
    font-size: 1.5rem; /* Ukuran font untuk judul */
    color: #28a745; /* Warna hijau */
    font-weight: bold;
    text-transform: uppercase; /* Mengubah judul menjadi uppercase */
    letter-spacing: 1px; /* Menambahkan jarak antar huruf */
    margin-bottom: 20px; /* Menambahkan jarak bawah */
}
/*---------------------------
   Tombol Detail (Warna Hijau) 
------------------------------ */
/* Tombol Detail */
.btn-detail {
    background-color: #9dffb4ff;  /* Green */
    color: #ffffff;             /* Warna teks putih - ini tetap terang */
    border: none;
    padding: 6px 14px;
    font-size: 0.875rem;
    font-family: 'Arial', sans-serif;  /* Font default yang tidak aneh */
    font-weight: bold;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease; /* Tambahkan efek transisi pada warna font */
}

.btn-detail:hover {
    background-color: #39c557ff;  /* Darker Green */
    color: #406c38ff !important;     /* Pastikan warna font tetap terang saat hover */
}

.btn-detail:active {
    color: #f1f1f1;             /* Warna font yang lebih terang saat ditekan */
}

.btn-detail i {
    margin-right: 5px;
}

/* Tombol Info (btn-info) */
.btn-info {
    background-color: #9dffb4ff;  /* Hijau */
    color: #1e4e16ff;             /* Warna teks putih */
    border: none;
    padding: 8px 8px;           /* Lebar dan tinggi tombol lebih besar */
    font-size: 1rem;            /* Ukuran font yang lebih besar */
    font-family: 'Arial', sans-serif;  /* Font default yang tidak aneh */
    font-weight: bold;          /* Font bold */
    border-radius: 6px;         /* Sudut lebih membulat */
    display: inline-flex;
    align-items: center;
    text-decoration: none;      /* Menghilangkan underline pada link */
    transition: background-color 0.3s ease, transform 0.3s ease; /* Transisi hover */
}

.btn-info:hover {
    background-color: #63de7dff;  /* Hijau lebih gelap pada hover */
    transform: scale(1.05);      /* Efek pembesaran sedikit saat hover */
}

.btn-info i {
    margin-right: 8px;           /* Memberikan sedikit jarak antara ikon dan teks */
}

/* ------------------------------
   Tombol Hover Effects
------------------------------ */

.btn-info:active {
    transform: scale(1.02); /* Efek kecil saat tombol ditekan */
}

/* ------------------------------
   Tombol Edit (Warna Kuning)
------------------------------ */

/* Tombol Edit */
.btn-outline-warning {
    background-color: transparent;
    color: #ffc107; /* Yellow */
    border: 1px solid #ffc107;
    padding: 6px 14px;
    font-size: 0.875rem;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
}

.btn-outline-warning:hover {
    background-color: #ffc107;
    color: white;
}

.btn-outline-warning i {
    margin-right: 5px;
}

/* ------------------------------
   Tombol Hapus (Warna Merah)
------------------------------ */

/* Tombol Hapus */
.btn-outline-danger {
    background-color: transparent;
    color: #dc3545; /* Red */
    border: 1px solid #dc3545;
    padding: 6px 14px;
    font-size: 0.875rem;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
}

.btn-outline-danger i {
    margin-right: 5px;
}

/* ------------------------------
   Tombol Filter (Warna Hijau)
------------------------------ */

/* Tombol Filter */
.btn-success {
    background-color: #28a745;  /* Green */
    color: white;
    border: none;
    padding: 6px 14px;
    font-size: 0.875rem;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
}

.btn-success:hover {
    background-color: #218838; /* Darker Green */
}

/* ------------------------------
   Tombol Reset (Warna Abu-abu)
------------------------------ */

/* Tombol Reset */
.btn-secondary {
    background-color: #6c757d; /* Gray */
    color: white;
    border: none;
    padding: 6px 14px;
    font-size: 0.875rem;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
}

.btn-secondary:hover {
    background-color: #5a6268; /* Darker Gray */
}

.btn-secondary i {
    margin-right: 5px;
}

/* ------------------------------
   Styling untuk Pagination
------------------------------ */
.pagination {
    display: flex;
    justify-content: center; /* Menempatkan pagination di tengah */
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.pagination li {
    margin: 0 5px; /* Memberikan jarak antar elemen pagination */
}

.pagination a, .pagination .page-link {
    color: #28a745; /* Hijau pada link */
    background-color: #fff; /* Background putih */
    border: 1px solid #28a745; /* Border hijau */
    padding: 6px 12px; /* Ukuran padding tombol pagination */
    text-decoration: none;
    border-radius: 5px; /* Membuat sudut tombol lebih membulat */
    font-size: 0.875rem; /* Ukuran font yang sesuai */
    transition: background-color 0.3s, color 0.3s; /* Efek transisi pada hover */
}

.pagination a:hover, .pagination .page-link:hover {
    background-color: #28a745; /* Background hijau pada hover */
    color: #fff; /* Teks putih saat hover */
    border-color: #218838; /* Border hijau lebih gelap */
}

.pagination .page-item.disabled .page-link {
    color: #6c757d; /* Warna teks untuk disabled */
    background-color: #f8f9fa; /* Background untuk disabled */
    border-color: #ddd; /* Border untuk disabled */
}

.pagination .active .page-link {
    background-color: #28a745; /* Background hijau untuk active page */
    color: white; /* Teks putih untuk active page */
    border-color: #218838; /* Border hijau lebih gelap untuk active page */
}


</style>

