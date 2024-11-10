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
        Schema::create('data_jadwals', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->bigInteger('id_matkul');
            $table->bigInteger('id_sesi');
            $table->bigInteger('id_dosen');
            $table->string('hari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_jadwals');
    }
};
