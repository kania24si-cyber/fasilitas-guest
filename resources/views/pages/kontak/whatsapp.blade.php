@extends('layouts.guest.app')

@section('content')
<section class="background-section"> 
    <!-- Tombol Kembali ke About (KANAN BAWAH) -->
    <a href="{{ route('about') }}" class="back-to-about-btn">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke About
    </a>
    
    <!-- Gambar background -->
    <img src="{{ asset('assets/img/backgroundwhatsapp.jpg') }}" alt="Background" class="background-image">
    
    <div class="content-container">
        <h1>Hubungi Kami!</h1>
        <p>
            Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami melalui WhatsApp.
            Kami siap membantu Anda.
        </p>
        
        <!-- Button WhatsApp -->
        <a href="https://wa.me/6282261042427?text=Halo%20DesaSface!%20Saya%20ingin%20bertanya%20tentang%20website%20ini."
           class="whatsapp-btn" target="_blank" title="Chat via WhatsApp">
            <i class="bi bi-whatsapp"></i> Hubungi Kami di WhatsApp
        </a>

        <!-- Tooltip -->
        <div class="whatsapp-tooltip">
            Silahkan hubungi jika ada pertanyaan 😊
        </div>
    </div>
</section>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    section {
        position: relative;
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
        overflow: hidden;
    }

    /* ===============================
       BACK TO ABOUT (KANAN BAWAH)
       =============================== */
    .back-to-about-btn {
        position: fixed; /* ⬅️ FIXED biar selalu nempel layar */
        bottom: 25px;
        right: 25px;
        padding: 12px 25px;
        background-color: #25D366;
        color: white;
        font-size: 16px;
        font-weight: 600;
        border-radius: 50px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        text-decoration: none;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        z-index: 10;
    }

    .back-to-about-btn:hover {
        background-color: #1da918;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
        transform: translateY(-3px);
        color: white;
    }

    .back-to-about-btn i {
        margin-right: 8px;
        font-size: 20px;
    }

    /* Background Image */
    .background-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
    }

    .content-container {
        text-align: center;
        background-color: rgba(255, 255, 255, 0.85);
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
        font-family: 'Poppins', sans-serif;
    }

    h1 {
        font-size: 40px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    p {
        font-size: 18px;
        margin-bottom: 30px;
        color: #555;
    }

    .whatsapp-btn {
        background-color: #25D366;
        color: white;
        padding: 18px 35px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        text-decoration: none;
        font-size: 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .whatsapp-btn:hover {
        background-color: #1da918;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        transform: scale(1.05);
    }

    .whatsapp-btn i {
        margin-right: 15px;
        font-size: 24px;
    }

    .whatsapp-tooltip {
        background-color: #25D366;
        color: #b1ef90;
        padding: 10px 18px;
        border-radius: 15px;
        font-size: 14px;
        margin-top: 15px;
        font-weight: bold;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease;
    }

    .whatsapp-btn:hover + .whatsapp-tooltip {
        opacity: 1;
        visibility: visible;
    }
</style>
@endsection
