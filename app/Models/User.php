<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

 protected $fillable = [
    'name',
    'email',
    'password',
    'role',  // tambahkan role
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // -----------------------------
    // FILTERING
    // -----------------------------
    public function scopeFilter($query, $request, array $columns)
    {
        foreach ($columns as $col) {
            if ($request->filled($col)) {
                $query->where($col, $request->$col);
            }
        }
        return $query;
    }

    // -----------------------------
    // SEARCHING
    // -----------------------------
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $keyword = $request->search;

            $query->where(function ($q) use ($columns, $keyword) {
                foreach ($columns as $col) {
                    $q->orWhere($col, 'LIKE', "%$keyword%");
                }
            });
        }

        return $query;
    }
}
