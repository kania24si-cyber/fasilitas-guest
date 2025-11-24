<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
        'status',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id', 'fasilitas_id');
    }

    // FILTERING
    public function scopeFilter($query, Request $request, array $columns)
    {
        foreach ($columns as $col) {
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
