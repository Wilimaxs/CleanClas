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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->bigInteger('nip');
            $table->bigInteger('nis');
            $table->integer('poin');

            // foreign ky
            $table->foreign('nip')->references('nip')->on('gurus')->onDelete('cascade');
            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
