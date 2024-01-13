<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jurusan;
use App\Models\Kategori;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'no_hp' => '089123456789',
            'role_id' => 1
        ]);
        
        User::create([
            'name' => 'Kepala Staff',
            'username' => 'kepalastaff',
            'password' => bcrypt('smkavicena'),
            'no_hp' => '089123456789',
            'role_id' => 2
        ]);
        
        User::create([
            'name' => 'Staff Gudang',
            'username' => 'staffgudang',
            'password' => bcrypt('smkavicena'),
            'no_hp' => '089123456789',
            'role_id' => 3
        ]);
        
        User::create([
            'name' => 'Eko Budiono',
            'username' => 'ekobudiono',
            'password' => bcrypt('smkavicena'),
            'no_hp' => '089123456789',
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
            'kategori_code' => 'lpt',
            'jurusan_id' => 1,
        ]);

        Kategori::create([
            'kategori_name' => 'Monitor',
            'kategori_code' => 'mnt',
            'jurusan_id' => 1,
        ]);
        
    }
}
