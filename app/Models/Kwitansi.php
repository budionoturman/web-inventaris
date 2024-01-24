<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class);
    }
}
