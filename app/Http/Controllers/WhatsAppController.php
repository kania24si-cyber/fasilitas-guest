<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function generateLink()
    {
    
        $phoneNumber = '6282261042427'; 
        $message = 'Halo, saya ingin bertanya tentang aplikasi ini.'; 

        $encodedMessage = urlencode($message);

        $whatsappLink = "https://wa.me/$phoneNumber?text=$encodedMessage";

        return view('pages.kontak.whatsapp', compact('whatsappLink'));
    }
}

