<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Dudi;
use App\Models\Berkas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call DudiSeeder to populate DUDI data
        $this->call(DudiSeeder::class);
        
        // Buat admin user
        User::updateOrCreate(
            ['username' => 'gwadmin'],
            [
                'name' => 'Administrator',
                'role' => 'admin',
                'password' => Hash::make('acm'),
            ]
        );

        // Buat sample siswa
        $siswas = [
            ['nis' => '001', 'nama' => 'Ari Pratama', 'kelas' => '12 SIJA 1'],
            ['nis' => '002', 'nama' => 'Budi Santoso', 'kelas' => '12 SIJA 1'],
            ['nis' => '003', 'nama' => 'Citra Dewi', 'kelas' => '12 SIJA 2'],
            ['nis' => '004', 'nama' => 'Dina Kusuma', 'kelas' => '12 SIJA 2'],
            ['nis' => '005', 'nama' => 'Eka Wijaya', 'kelas' => '12 SIJA 3'],
        ];

        foreach ($siswas as $siswa) {
            Siswa::updateOrCreate(['nis' => $siswa['nis']], $siswa);
            
            // Buat user untuk setiap siswa
            User::updateOrCreate(
                ['username' => $siswa['nis']],
                [
                    'name' => $siswa['nama'],
                    'role' => 'siswa',
                    'password' => Hash::make($siswa['nis']),
                ]
            );

            // Buat berkas untuk setiap siswa
            Berkas::updateOrCreate(
                ['nis' => $siswa['nis']],
                ['lengkap' => false]
            );
        }
    }
}
