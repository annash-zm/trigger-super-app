<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('info_pengelolaan_sampahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prapemicuans');
            $table->foreign('id_prapemicuans')
                ->references('id')
                ->on('prapemicuans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('pengelolaan_sampah')->nullable();
            $table->string('kondisi_geografis')->nullable();
            $table->string('sarana_dan_prasarana_umum_desa')->nullable();
            $table->string('layanan_kelola_sampah')->nullable();
            $table->string('kegiatan_rutin')->nullable();
            $table->string('waktu_keg_rutin')->nullable();
            $table->text('kandidat_pic_kelola_sampah')->nullable();
            $table->string('lokasi_pemicuan')->nullable();
            $table->string('lokasi_d2d')->nullable();
            $table->date('tanggal_pemicuan')->nullable();
            $table->integer('jumlah_titik_pemicuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_pengelolaan_sampahs');
    }
};
