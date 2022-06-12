<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AsetBergerakTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('aset_bergerak')->insert(array(
            0 =>
            array(
                'id' => '348d34d1-1f56-483c-9c3b-d9a18cd1aa20',
                'pegawai_id' => '17801721-0789-4777-b845-20c0d9240143',
                'nama_aset' => 'Motor',
                'merek' => 'Yamaha',
                'model' => 'Aerox',
                'kode_inventaris' => '404040',
                'deskripsi' => 'Warna Hitam',
                'status' => 'Digunakan',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'created_at' => '2022-06-12 17:30:52',
                'updated_at' => '2022-06-12 17:38:39',
            ),
            1 =>
            array(
                'id' => '6c42cb95-d450-4d50-9bd1-b5e6c39b4ab8',
                'pegawai_id' => '16dd6fc6-a558-4f06-be57-b9acccced24f',
                'nama_aset' => 'Mobil',
                'merek' => 'Honda',
                'model' => 'Brio',
                'kode_inventaris' => '202020',
                'deskripsi' => 'Warna Merah',
                'status' => 'Digunakan',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'created_at' => '2022-06-12 17:27:58',
                'updated_at' => '2022-06-12 17:38:01',
            ),
            2 =>
            array(
                'id' => '82d95155-a16c-4502-9f2d-dd5087b46ec7',
                'pegawai_id' => '0065b51c-49c0-4e81-a3b3-a6b4e21b3c95',
                'nama_aset' => 'Mobil',
                'merek' => 'Honda',
                'model' => 'Civic',
                'kode_inventaris' => '101010',
                'deskripsi' => 'Warna Kuning',
                'status' => 'Digunakan',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'created_at' => '2022-06-12 17:27:02',
                'updated_at' => '2022-06-12 17:34:12',
            ),
            3 =>
            array(
                'id' => '93adca74-8a80-4961-8859-ff83ac6bb299',
                'pegawai_id' => '144f0393-7806-43c9-906e-0577598a4095',
                'nama_aset' => 'Motor',
                'merek' => 'Yamaha',
                'model' => 'Nmax',
                'kode_inventaris' => '505050',
                'deskripsi' => 'Warna Hitam',
                'status' => 'Digunakan',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'created_at' => '2022-06-12 17:32:43',
                'updated_at' => '2022-06-12 17:37:28',
            ),
            4 =>
            array(
                'id' => 'a50f6f56-ea6e-459b-a51b-ed5929b0a766',
                'pegawai_id' => NULL,
                'nama_aset' => 'Mobil',
                'merek' => 'Toyota',
                'model' => 'Yaris',
                'kode_inventaris' => '303030',
                'deskripsi' => 'Warna Putih',
                'status' => 'Baru',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'created_at' => '2022-06-12 17:30:13',
                'updated_at' => '2022-06-12 17:30:13',
            ),
            5 =>
            array(
                'id' => 'f29198cb-f0be-4b96-9104-d5f8f78db284',
                'pegawai_id' => NULL,
                'nama_aset' => 'Motor',
                'merek' => 'Yamaha',
                'model' => 'Nmax',
                'kode_inventaris' => '505050',
                'deskripsi' => 'Warna Hitam',
                'status' => 'Baru',
                'created_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'updated_by' => '5gf9ba91-4778-404c-aa7f-5fd327e87e80',
                'created_at' => '2022-06-12 17:35:03',
                'updated_at' => '2022-06-12 17:35:03',
            ),
        ));
    }
}
