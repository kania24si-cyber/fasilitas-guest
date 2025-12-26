<?php
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembayaranFasilitas extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_fasilitas';
    protected $primaryKey = 'bayar_id';
    protected $fillable = ['pinjam_id', 'tanggal', 'jumlah', 'metode', 'keterangan'];

    // Relasi ke Peminjaman Fasilitas
    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanFasilitas::class, 'pinjam_id', 'pinjam_id');
    }

      
    // FILTERING
public function scopeFilter($query, Request $request)
{
    if ($request->filled('metode')) {
        $query->where('metode', $request->metode);
    }

    if ($request->filled('status')) {
        $query->whereHas('peminjaman', function ($q) use ($request) {
            $q->where('status', $request->status);
        });
    }

    if ($request->filled('fasilitas_id')) {
        $query->whereHas('peminjaman', function ($q) use ($request) {
            $q->where('fasilitas_id', $request->fasilitas_id);
        });
    }

    return $query;
}


    // SEARCHING
 // SEARCH tujuan & nama warga
public function scopeSearch($query, Request $request)
{
    if ($request->filled('search')) {
        $keyword = $request->search;

        $query->whereHas('peminjaman', function ($qp) use ($keyword) {
            $qp->where('tujuan', 'LIKE', "%$keyword%")
               ->orWhereHas('warga', function ($qw) use ($keyword) {
                   $qw->where('nama', 'LIKE', "%$keyword%");
               });
        });
    }

    return $query;
}
}
