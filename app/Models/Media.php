<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media'; // Nama tabel media

    // Relasi balik ke syarat_fasilitas
    public function syaratFasilitas()
    {
        return $this->belongsTo(SyaratFasilitas::class, 'ref_id', 'syarat_id');
    }
}
