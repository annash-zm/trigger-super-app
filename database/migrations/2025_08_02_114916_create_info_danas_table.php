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
        Schema::create('info_danas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prapemicuans');
            $table->foreign('id_prapemicuans')
                ->references('id')
                ->on('prapemicuans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('dana_konsumsi_desa')->nullable();
            $table->string('dana_konsumsi_puskesmas')->nullable();
            $table->string('dana_konsumsi_dinkes')->nullable();
            $table->string('dana_konsumsi_bwihijau')->nullable();
            $table->string('dana_honor_desa')->nullable();
            $table->string('dana_honor_puskesmas')->nullable();
            $table->string('dana_honor_dinkes')->nullable();
            $table->string('dana_honor_bwihijau')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_danas');
    }
};
