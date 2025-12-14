<?php
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PetugasFasilitas extends Model
{
    use HasFactory;

    protected $table = 'petugas_fasilitas';
    protected $primaryKey = 'petugas_id';
    protected $fillable = ['fasilitas_id', 'petugas_warga_id', 'peran'];

    // Relasi ke tabel fasilitas_umum
    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id', 'fasilitas_id');
    }

    // Relasi ke tabel warga
    public function petugas_warga()
    {
        return $this->belongsTo(Warga::class, 'petugas_warga_id', 'warga_id');
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
