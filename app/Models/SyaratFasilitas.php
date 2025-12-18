<?php
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SyaratFasilitas extends Model
{
    use HasFactory;

    protected $table = 'syarat_fasilitas';
    protected $primaryKey = 'syarat_id';
    protected $fillable = ['fasilitas_id', 'nama_syarat', 'deskripsi'];

    // Relasi ke fasilitas_umum
    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id', 'fasilitas_id');
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
// Di model SyaratFasilitas
public function media()
{
    return $this->hasMany(Media::class, 'ref_id', 'syarat_id')
                ->where('ref_table', 'syarat_fasilitas'); // Pastikan ref_table sesuai
}

}
