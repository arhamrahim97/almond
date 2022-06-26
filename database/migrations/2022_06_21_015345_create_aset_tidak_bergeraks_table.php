<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsetTidakBergeraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset_tidak_bergerak', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kategori');
            $table->string('kode_barang');
            $table->string('register');
            $table->string('nama_barang');
            $table->string('merek_tipe');
            $table->string('nomor_sertifikat_pabrik_chasis_mesin');
            $table->string('bahan');
            $table->string('asal_barang');
            $table->integer('tahun_pembelian');
            $table->string('ukuran_barang_kontruksi');
            $table->string('satuan');
            $table->string('keadaan_barang');
            $table->string('jumlah_barang')->default(1);
            $table->string('harga_barang');
            // $table->string('nomor_polisi');
            $table->text('keterangan')->nullable();
            $table->uuid('ruangan_id')->nullable();
            $table->string('status')->default('Baru');
            $table->uuid('created_by');
            $table->uuid('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aset_tidak_bergerak');
    }
}
