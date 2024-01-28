<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use Illuminate\Database\Seeder;

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

        $this->call([
            UserSeeder::class,
            KategoriSeeder::class,
            JurusanSeeder::class,
            BarangSeeder::class
        ]);

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
    }
}
