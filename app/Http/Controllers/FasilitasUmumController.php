<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FasilitasUmumController extends Controller
{
    public function index()
    {
        $judul = 'Daftar Fasilitas Umum Bina Desa';
        $fasilitas = [
            [ 
                'fasilitas_id' => 1,
                'nama' => 'Masjid Bina Desa',
                'jenis' => 'Tempat Ibadah',
                'Alamat' => 'Jl. Merdeka No. 10, Bina Desa',
                'rt' => '01',
                'rw' => '02',
                'Kapasitas' => 200,
                'deskripsi' => 'Masjid yang terletak di pusat desa, menyediakan tempat ibadah bagi warga sekitar'
            ],
            [ 
                'fasilitas_id' => 2,
                'nama' => 'Lapangan Olahraga',
                'jenis' => 'Lapangan',
                'Alamat' => 'Jl. Sudirman No. 5, Bina Desa',
                'rt' => '03',
                'rw' => '04',
                'Kapasitas' => 150,
                'deskripsi' => 'Merupakan Lapangan Serbaguna untuk berbagai kegiatan Olahraga dan acara desa',
            ],
            [
                'fasilitas_id' => 3,
                'nama' => 'Puskesmas Bina Desa',
                'jenis' => 'Fasilitas Kesehatan',
                'Alamat' => 'Jl. Tartini No. 8, Bina Desa',
                'rt' => '05',
                'rw' => '06',
                'Kapasitas' => 200,
                'deskripsi' => 'Pusat Layanan Kesehatan bagi warga desa dan sekitarnya',
            ]
            ];
            return view('index', compact ('judul', 'fasilitas'));
    }
}
