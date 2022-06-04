<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80', //1 // JANGAN DIUBAH ATAU DIHAPUS
                'nama_lengkap' => 'Admin 1',
                'username' => 'admin',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'Admin',
                'status' => 1,
                'created_at' => now(),
            ],
            [
                'id' => '5gf9ba91-4778-404c-aa7f-5fd327e87e81', //1 // JANGAN DIUBAH ATAU DIHAPUS
                'nama_lengkap' => 'Staf 1',
                'username' => 'staf',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'Staf',
                'status' => 1,
                'created_at' => now(),
            ],
        ];
        DB::table('users')->insert($data);
    }
}
