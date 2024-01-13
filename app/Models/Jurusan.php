<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->hasMany(Kategori::class);
    }

    public function barang()
    {
        return $this->hasManyThrough(
            Barang::class,
            Kategori::class,
            'jurusan_id',
            'kategori_id',
            'id',
            'id'
        );
    }
}
