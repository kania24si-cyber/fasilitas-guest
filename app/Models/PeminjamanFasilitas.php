<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanFasilitas extends Model
{
    protected $table = 'peminjaman_fasilitas';
    protected $primaryKey = 'pinjam_id';
    protected $fillable = [
        'warga_id',
        'fasilitas_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'tujuan',
        'total_biaya',
        'bukti_pembayaran',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }
}
