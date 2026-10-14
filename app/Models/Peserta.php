<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    
    protected $fillable = ['user_id', 'nik', 'nama', 'email', 'no_hp', 'alamat', 'skema_id', 'status'];

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    public function scopeCari($query, ?string $keyword)
    {
        return $query->when($keyword, function ($q) use ($keyword) {
            $q->where(function ($w) use ($keyword) {
                $w->where   ('nama', 'like', "%{$keyword}%")
                    ->orWhere('nik', 'like', "%{$keyword}%");
            });
        });
    }
}
