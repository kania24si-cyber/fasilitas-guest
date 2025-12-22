@extends('layouts.guest.app')

@section('content')
<div class="whatsapp-page">

    <!-- Tombol Back -->
    <a href="{{ route('about') }}" class="back-to-about-btn">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke About
    </a>

    <div class="content-container">
        <h1>Hubungi Kami!</h1>
        <p>
            Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami melalui WhatsApp.
            Kami siap membantu Anda.
        </p>

        <a href="https://wa.me/6282261042427?text=Halo%20DesaSface!"
           class="whatsapp-btn" target="_blank">
            <i class="bi bi-whatsapp"></i> Hubungi Kami di WhatsApp
        </a>

        <div class="whatsapp-tooltip">
            Silahkan hubungi jika ada pertanyaan 😊
        </div>
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

/* ===============================
   FULL PAGE BACKGROUND FOTO
   =============================== */
.whatsapp-page {
    min-height: 100vh;
    width: 100%;
    background-image: url("{{ asset('assets/img/whatsapp.jpg') }}"); /* ✅ FOTO TETAP ADA */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

/* ===============================
   BACK BUTTON
   =============================== */
.back-to-about-btn {
    position: fixed;
    bottom: 25px;
    right: 25px;
    padding: 12px 25px;
    background-color: #25D366;
    color: white;
    font-size: 16px;
    font-weight: 600;
    border-radius: 50px;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(0,0,0,.3);
    z-index: 10;
}

.back-to-about-btn:hover {
    background-color: #1da918;
    transform: translateY(-3px);
}

/* ===============================
   CONTENT CARD
   =============================== */
.content-container {
    text-align: center;
    background-color: rgba(255,255,255,0.88);
    padding: 40px;
    border-radius: 18px;
    max-width: 600px;
    font-family: 'Poppins', sans-serif;
    box-shadow: 0 10px 30px rgba(0,0,0,.25);
}

h1 {
    font-size: 40px;
    font-weight: 600;
    margin-bottom: 20px;
}

p {
    font-size: 18px;
    margin-bottom: 30px;
}

/* ===============================
   WHATSAPP BUTTON
   =============================== */
.whatsapp-btn {
    background-color: #25D366;
    color: white;
    padding: 18px 35px;
    border-radius: 50px;
    display: inline-flex;
    align-items: center;
    font-size: 20px;
    font-weight: 600;
    text-decoration: none;
}

.whatsapp-btn i {
    margin-right: 15px;
    font-size: 24px;
}

.whatsapp-btn:hover {
    background-color: #1da918;
}

/* Tooltip */
.whatsapp-tooltip {
    margin-top: 15px;
    font-size: 14px;
    color: #25D366;
    font-weight: bold;
}
</style>
@endsection
