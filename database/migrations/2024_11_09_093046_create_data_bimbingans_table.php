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
        Schema::create('data_bimbingans', function (Blueprint $table) {
            $table->id('id_bimbingan');
            $table->bigInteger('id_prodi');
            $table->bigInteger('id_dosen');
            $table->string('nim');
            $table->string('nama');
            $table->string('dosen');
            $table->date('tgl_bimbigan');
            $table->string('hari');
            $table->text('keperluan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_bimbingans');
    }
};
