<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_upload', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('another_id');
            $table->string('nama_file');
            $table->string('jenis_file');
            $table->string('deskripsi')->nullable();
            $table->bigInteger('urutan')->default(0);
            $table->integer('is_sampul')->default(0);
            $table->uuid('pegawai_id')->nullable();
            $table->uuid('ruangan_id')->nullable();
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
        Schema::dropIfExists('file_upload');
    }
}
