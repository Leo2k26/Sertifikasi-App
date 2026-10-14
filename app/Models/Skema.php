<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    protected $fillable = ['kode_skema', 'nama_skema', 'deskripsi'];

    public function pesertas()
    {
        return $this->hasMany(Peserta::class);
    }

public function scopeCariSkema($query, ?string $keyword)
    {
        return $query->when($keyword, function ($q) use ($keyword) {
            $q->where(function ($w) use ($keyword) {
                $w->where('kode_skema', 'like', "%{$keyword}%")
                    ->orWhere('nama_skema', 'like', "%{$keyword}%");
            });
        });
    }
}
