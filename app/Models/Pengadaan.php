<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengadaan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function pengadaan_detail()
    {
        return $this->hasMany(PengadaanDetail::class);
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class,'pengadaan_details');
    }

    public function kwitansi()
    {
        return $this->hasOne(Kwitansi::class);
    }
}
