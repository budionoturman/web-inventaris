<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peminjaman_detail()
    {
        return $this->hasMany(PeminjamanDetail::class, 'peminjam_id');
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class,'peminjaman_details', 'peminjam_id')->withPivot(['status', 'kondisi', 'denda']);
    }

    public function pembayaran_denda()
    {
        return $this->hasOne(PembayaranDenda::class);
    }
}
