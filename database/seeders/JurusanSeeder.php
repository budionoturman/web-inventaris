<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create([
            'jurusan_name' => 'Teknik Komputer dan Jaringan',
            'jurusan_code' => 'TK'
        ]);
        
        Jurusan::create([
            'jurusan_name' => 'Teknik Otomotif',
            'jurusan_code' => 'TO'
        ]);
        
        Jurusan::create([
            'jurusan_name' => 'Multimedia',
            'jurusan_code' => 'MM'
        ]);
    }
}
