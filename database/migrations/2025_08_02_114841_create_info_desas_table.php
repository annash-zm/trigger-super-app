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
        Schema::create('info_desas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prapemicuans');
            $table->foreign('id_prapemicuans')
                ->references('id')
                ->on('prapemicuans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('jumlah_rw')->nullable();
            $table->string('pendidikan_warga')->nullable();
            $table->string('pekerjaan_masyarakat')->nullable();
            $table->string('kelembagaan_sosial')->nullable();
            $table->string('nama_tokoh')->nullable();
            $table->string('nomor_hp_tokoh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_desas');
    }
};
