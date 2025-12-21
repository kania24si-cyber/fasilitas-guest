<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function generateLink()
    {
        // Nomor WhatsApp dan pesan default yang tidak bergantung pada user
        $phoneNumber = '6282261042427'; // Nomor default
        $message = 'Halo, saya ingin bertanya tentang aplikasi ini.'; // Pesan default

        // URL encode pesan untuk digunakan dalam link
        $encodedMessage = urlencode($message);

        // Buat link WhatsApp
        $whatsappLink = "https://wa.me/$phoneNumber?text=$encodedMessage";

        // Kembalikan link WhatsApp ke view
        return view('pages.kontak.whatsapp', compact('whatsappLink'));
    }
}
