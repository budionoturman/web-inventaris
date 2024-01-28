<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
