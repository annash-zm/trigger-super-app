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
        Schema::create('info_umums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prapemicuans');
            $table->foreign('id_prapemicuans')
                ->references('id')
                ->on('prapemicuans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('jml_spot_pembuangan')->nullable();
            $table->string('foto_spot_pembuangan')->nullable();
            $table->string('lokasi_spot_pembuangan')->nullable();
            $table->string('iuran')->nullable();
            $table->string('no_kontak_bumdes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_umums');
    }
};
