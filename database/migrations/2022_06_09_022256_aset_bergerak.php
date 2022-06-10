<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsetBergerak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset_bergerak', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pegawai_id')->nullable();
            $table->string('nama_aset');
            $table->string('merek');
            $table->string('model');
            $table->string('kode_inventaris');
            $table->text('deskripsi')->nullable();
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
        Schema::dropIfExists('aset_bergerak');
    }
}
