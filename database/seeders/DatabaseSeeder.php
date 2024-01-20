<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\Jurusan;
use App\Models\Kategori;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create([
            'role_name' => 'Kepala Sekolah'
        ]);

        Role::create([
            'role_name' => 'Kepala Staff'
        ]);

        Role::create([
            'role_name' => 'Staff Gudang'
        ]);

        Role::create([
            'role_name' => 'Pegawai'
        ]);

        User::create([
            'name' => 'Kepala Sekolah',
            'username' => 'kepalasekolah',
            'password' => bcrypt('smkavicena'),
            'nip' => '09876541',
            'no_hp' => '089123456789',
            'role_id' => 1
        ]);
        
        User::create([
            'name' => 'Kepala Staff',
            'username' => 'kepalastaff',
            'password' => bcrypt('smkavicena'),
            'nip' => '09876542',
            'no_hp' => '089123456789',
            'role_id' => 2
        ]);
        
        User::create([
            'name' => 'Staff Gudang',
            'username' => 'staffgudang',
            'password' => bcrypt('smkavicena'),
            'nip' => '09876543',
            'no_hp' => '089123456789',
            'role_id' => 3
        ]);
        
        User::create([
            'name' => 'Eko Budiono',
            'username' => 'ekobudiono',
            'password' => bcrypt('smkavicena'),
            'nip' => '09876544',
            'no_hp' => '089123456789',
            'role_id' => 4
        ]);
        
        User::create([
            'name' => 'Ahmad Irgi Firdaus',
            'username' => 'ahmadirgi',
            'password' => bcrypt('smkavicena'),
            'nip' => '09876545',
            'no_hp' => '089123456788',
            'role_id' => 4
        ]);

        Jurusan::create([
            'jurusan_name' => 'Teknik Komputer dan Jaringan',
            'jurusan_code' => 'TKJ'
        ]);
        
        Jurusan::create([
            'jurusan_name' => 'Teknik Otomotif',
            'jurusan_code' => 'TO'
        ]);
        
        Jurusan::create([
            'jurusan_name' => 'Multimedia',
            'jurusan_code' => 'MM'
        ]);

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

        Barang::create([
            'barang_code' => 'TKJ/LTP/01',
            'barang_name' => 'MSI Modern 14 B5M',
            'status' => 'tersedia',
            'kondisi' => 'baik',
            'tgl_masuk' => Carbon::now()->format('Y-m-d'),
            'kategori_id' => '1',
        ]);

        Barang::create([
            'barang_code' => 'TKJ/LTP/02',
            'barang_name' => 'MSI Modern 14 B5M',
            'status' => 'rusak',
            'kondisi' => 'tidak dapat diperbaiki',
            'tgl_masuk' => Carbon::now()->format('Y-m-d'),
            'kategori_id' => '1',
        ]);

        Barang::create([
            'barang_code' => 'TKJ/LTP/03',
            'barang_name' => 'MSI Modern 14 B5M',
            'status' => 'rusak',
            'kondisi' => 'tidak dapat diperbaiki',
            'tgl_masuk' => Carbon::now()->format('Y-m-d'),
            'kategori_id' => '1',
        ]);

        Barang::create([
            'barang_code' => 'TKJ/LTP/04',
            'barang_name' => 'MSI Modern 14 B5M',
            'status' => 'rusak',
            'kondisi' => 'tidak dapat diperbaiki',
            'tgl_masuk' => Carbon::now()->format('Y-m-d'),
            'kategori_id' => '1',
        ]);
        
    }
}
