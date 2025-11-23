<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasilitasUmum extends Model
{
    protected $table = 'fasilitas_umum';
    protected $primaryKey = 'fasilitas_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'jenis',
        'alamat',
        'kapasitas',
        'media',
        'rt',
        'rw',
        'deskripsi'
    ];
}
