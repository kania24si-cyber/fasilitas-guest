<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FasilitasUmum extends Model
{
    protected $table = 'fasilitas_umum';
    protected $primaryKey = 'fasilitas_id';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'jenis',
        'alamat',
        'kapasitas',
        'rt',
        'rw',
        'deskripsi'
    ];

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
