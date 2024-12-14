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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->integer('id_keg')->primary();
            $table->string('nama_keg');
            $table->text('deskripsi');
            $table->date('tanggal');
            $table->string('status');
            $table->integer('hari');
            $table->text('image')->nullable();
            
            $table->foreign('hari')->references('id')->on('haris')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
