<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RuanganTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ruangan')->insert(array(
            0 =>
            array(
                'created_at' => '2022-06-07 23:39:10',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'deleted_at' => NULL,
                'deskripsi' => 'Di Lantai 1',
                'id' => '1b81e382-b8b6-49e7-9632-06ec27b7f849',
                'nama_ruangan' => 'Ruangan A',
                'updated_at' => '2022-06-23 16:29:12',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
            ),
            1 =>
            array(
                'created_at' => '2022-06-07 23:40:23',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'deleted_at' => NULL,
                'deskripsi' => 'Di Lantai 2',
                'id' => '89a8aca4-ad2c-4422-9438-ea324d160f0b',
                'nama_ruangan' => 'Ruangan C',
                'updated_at' => '2022-06-23 16:28:55',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
            ),
            2 =>
            array(
                'created_at' => '2022-06-07 23:39:48',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'deleted_at' => NULL,
                'deskripsi' => 'Di Lantai 1',
                'id' => '9ebe89f1-f1bf-454a-90b2-73f239ea622b',
                'nama_ruangan' => 'Ruangan B',
                'updated_at' => '2022-06-23 16:29:03',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
            ),
            3 =>
            array(
                'created_at' => '2022-06-07 23:42:11',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'deleted_at' => NULL,
                'deskripsi' => 'Di Lantai 3',
                'id' => 'd7bfe858-dbb9-4692-b91a-959c9140ef70',
                'nama_ruangan' => 'Ruangan E',
                'updated_at' => '2022-06-23 16:30:04',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
            ),
            4 =>
            array(
                'created_at' => '2022-06-07 23:41:12',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'deleted_at' => NULL,
                'deskripsi' => 'Di Lantai 2',
                'id' => 'fd14f1b1-def3-41fc-a016-48c74f4fee19',
                'nama_ruangan' => 'Ruangan D',
                'updated_at' => '2022-06-23 16:29:43',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
            ),
        ));
    }
}
