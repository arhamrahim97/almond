<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ruangan')->insert(array(
            0 =>
            array(
                'id' => '1b81e382-b8b6-49e7-9632-06ec27b7f849',
                'nama_ruangan' => 'Gedung 1',
                'deskripsi' => 'Di TI',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e81',
                'created_at' => '2022-06-07 23:39:10',
                'updated_at' => '2022-06-07 23:49:50',
                'deleted_at' => NULL,
            ),
            1 =>
            array(
                'id' => '89a8aca4-ad2c-4422-9438-ea324d160f0b',
                'nama_ruangan' => 'Gedung 3',
                'deskripsi' => 'Di Kedokteran',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e81',
                'created_at' => '2022-06-07 23:40:23',
                'updated_at' => '2022-06-07 23:49:27',
                'deleted_at' => NULL,
            ),
            2 =>
            array(
                'id' => '9ebe89f1-f1bf-454a-90b2-73f239ea622b',
                'nama_ruangan' => 'Gedung 2',
                'deskripsi' => 'Di SI',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'created_at' => '2022-06-07 23:39:48',
                'updated_at' => '2022-06-07 23:39:48',
                'deleted_at' => NULL,
            ),
            3 =>
            array(
                'id' => 'd7bfe858-dbb9-4692-b91a-959c9140ef70',
                'nama_ruangan' => 'Gedung 5',
                'deskripsi' => '',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e81',
                'created_at' => '2022-06-07 23:42:11',
                'updated_at' => '2022-06-07 23:48:10',
                'deleted_at' => NULL,
            ),
            4 =>
            array(
                'id' => 'fd14f1b1-def3-41fc-a016-48c74f4fee19',
                'nama_ruangan' => 'Gedung 4',
                'deskripsi' => 'Di Kehutanan',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'created_at' => '2022-06-07 23:41:12',
                'updated_at' => '2022-06-07 23:41:12',
                'deleted_at' => NULL,
            ),
        ));
    }
}
