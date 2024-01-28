<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'kategori_name' => 'Laptop',
            'kategori_code' => 'LTP',
            'jurusan_id' => 1,
        ]);

        Kategori::create([
            'kategori_name' => 'Monitor',
            'kategori_code' => 'MNR',
            'jurusan_id' => 1,
        ]);

        Kategori::create([
            'kategori_name' => 'Router',
            'kategori_code' => 'RTR',
            'jurusan_id' => 1,
        ]);

        Kategori::create([
            'kategori_name' => 'Switch',
            'kategori_code' => 'SWC',
            'jurusan_id' => 1,
        ]);
    }
}
