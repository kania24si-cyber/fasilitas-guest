<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeveloperProfileController extends Controller
{
    /**
     * Tampilkan halaman identitas pengembang.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $developer = [
            'name' => 'Tiara Kania Noer Riska', // Ganti dengan nama pengembang
            'nim' => '2457301146',     // Ganti dengan NIM pengembang
            'prodi' => 'Sistem Informasi', // Ganti dengan prodi pengembang
            'photo' => asset('assets/img/developer1_photo.jpeg'), // Ganti dengan path foto pengembang
            'linkedin' => 'https://www.linkedin.com/in/tiara-kania-noer-riska-755b3b394?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app', // Ganti dengan link LinkedIn pengembang
            'github' => 'https://github.com/kania24si-cyber/fasilitas-guest.git', // Ganti dengan link GitHub pengembang
            'social_media' => 'https://www.instagram.com/tiaraknr_?igsh=MXkyNnN2Mjl4dDVpeA==', // Pastikan ada 'instagram'
        ];

        return view('pages.developer.profile', compact('developer'));
    }
}
