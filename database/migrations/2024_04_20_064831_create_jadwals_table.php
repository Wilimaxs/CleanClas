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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->integer('id_jadwal')->primary();
            $table->bigInteger('nis');
            $table->integer('hari');


            //foreign key
            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');
            $table->foreign('hari')->references('id')->on('haris')->onDelete('cascade');


            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
