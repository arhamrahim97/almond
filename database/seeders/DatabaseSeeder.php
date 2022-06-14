<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RuanganSeeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Database\Seeders\PegawaiTableSeeder;
use Database\Seeders\FileUploadTableSeeder;
use Database\Seeders\AsetBergerakTableSeeder;
use Database\Seeders\JabatanStrukturalSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('/upload');
        Storage::makeDirectory('/upload');

        File::copyDirectory(
            public_path('file_dummy'),
            storage_path('app/public/upload')
        );


        // \App\Models\User::factory(10)->create();
        $this->call(JabatanStrukturalSeeder::class);
        $this->call(UserSeeder::class);
        // Pegawai::factory(50)->create();
        $this->call(RuanganSeeder::class);
        $this->call(PegawaiTableSeeder::class);
        $this->call(AsetBergerakTableSeeder::class);
        $this->call(FileUploadTableSeeder::class);
    }
}
