<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barangs')->insert([
            [
                'barang_code' => 'TKJ/RTR/01',
                'barang_name' => 'TP-LINK GRID',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '3',
            ],
            [
                'barang_code' => 'TKJ/RTR/02',
                'barang_name' => 'TP-LINK OMNI',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '3',
            ],
            [
                'barang_code' => 'TKJ/RTR/03',
                'barang_name' => 'TP-LINK 2,4 GHZ',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '3',
            ],
        ]);

        for($i = 4; $i < 14; $i++) {
            Barang::create([
                'barang_code' => 'TKJ/SWC/0'.$i,
                'barang_name' => 'TP-LINK SWITCH 5 PORT',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '4',
            ]);
        }
        
        for($i = 14; $i < 19; $i++) {
            Barang::create([
                'barang_code' => 'TKJ/SWC/0'.$i,
                'barang_name' => 'TP-LINK SWITCH 8 PORT',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '4',
            ]);
        }

        for($i = 19; $i < 30; $i++) {
            Barang::create([
                'barang_code' => 'TKJ/SWC/0'.$i,
                'barang_name' => 'D-LINK WIRELES N 150 MBPS',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '4',
            ]);
        }

        Barang::create([
            'barang_code' => 'TKJ/SWC/031',
            'barang_name' => 'D-LINK SWITCH DES-1024A 24 PORT',
            'status' => 'tersedia',
            'kondisi' => 'baik',
            'tgl_masuk' => Carbon::now()->format('Y-m-d'),
            'kategori_id' => '4',
        ]);

        for($i = 31; $i < 36; $i++) {
            Barang::create([
                'barang_code' => 'TKJ/RTR/0'.$i,
                'barang_name' => 'MIKROTIK ROUTERBOARD 750',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '3',
            ]);
        }
        
        for($i = 36; $i < 46; $i++) {
            Barang::create([
                'barang_code' => 'TKJ/RTR/0'.$i,
                'barang_name' => 'MIKROTIK ROUTERBOARD 941',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '3',
            ]);
        }

        for($i = 46; $i < 76; $i++) {
            Barang::create([
                'barang_code' => 'TKJ/MNR/0'.$i,
                'barang_name' => 'LAYAR MONITOR LG',
                'status' => 'tersedia',
                'kondisi' => 'baik',
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'kategori_id' => '2',
            ]);
        }
    }
}
