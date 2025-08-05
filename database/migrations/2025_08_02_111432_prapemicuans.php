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
        //
        Schema::create('prapemicuans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('village_id');
            $table->string('desa');
            $table->bigInteger('district_id');
            $table->string('kecamatan');
            $table->string('nama_kegiatan')->nullable();
            $table->date('tanggal')->nullable();
            $table->bigInteger('jumlah_dusun')->nullable();
            $table->bigInteger('jumlah_rt')->nullable();
            $table->bigInteger('jumlah_jiwa')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
         Schema::dropIfExists('prapemicuans');
    }
};
