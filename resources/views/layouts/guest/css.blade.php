<style>
/* HEADER */
#header {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
    background-color: #fff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); /* Menipiskan shadow */
    padding: 5px 0; /* Mengurangi padding vertikal agar header lebih tipis */
}

#header .container-xl {
    display: flex;
    align-items: center;
    justify-content: space-between; /* Memastikan logo dan navbar berada di ujung yang berbeda */
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
    font-size: 1.5rem;
    margin-right: 20px; /* Jarak antara hamburger dan logo */
}

/* Navbar styles */
.navbar {
    display: flex;
    justify-content: center; /* Memusatkan navbar di tengah */
    width: 100%; /* Pastikan navbar memenuhi lebar yang ada */
}

.navbar ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center; /* Memastikan item navbar tetap di tengah */
}

.navbar ul li {
    position: relative;
    padding: 10px 15px;
}

.navbar ul li a {
    color: #012970;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
}

.navbar ul li a:hover,
.navbar ul li a.active {
    color: #4154f1;
}

/* Dropdown Menu */
.dropdown-menu {
    background-color: #f8f9fa;
    border-radius: 5px;
}

.dropdown-menu .dropdown-item {
    font-weight: 600;
    padding: 10px;
}
</style>