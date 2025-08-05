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
        Schema::create('fasilitator', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prapemicuans');
            $table->foreign('id_prapemicuans')
                ->references('id')
                ->on('prapemicuans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->integer('jml_peserta')->nullable();
            $table->integer('jml_berlangganan')->nullable();
            $table->text('usulan_rkm')->nullable();
            $table->text('berkas')->nullable();
            $table->text('dokumentasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('fasilitator');
    }
};
