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
public function scopeFilter($query, Request $request, array $columns)
{
    foreach ($columns as $col) {

        // gunakan filled() bukan has()
        if ($request->filled($col)) {
            $query->where($col, $request->$col);
        }
    }

    return $query;
}


    // SEARCHING
 public function scopeSearch($query, Request $request, array $columns)
{
    if ($request->filled('search')) {
        $keyword = $request->search;
        $query->where(function ($q) use ($columns, $keyword) {
            foreach ($columns as $col) {
                $q->orWhere($col, 'LIKE', '%' . $keyword . '%');
            }
        });
    }
    return $query;
}
}
