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
        Schema::create('data_prodis', function (Blueprint $table) {
            $table->id('id_prodi');
            $table->bigInteger('id_kampus');
            $table->string('kd_prodi');
            $table->string('prodi');
            $table->string('jurusan');
            $table->string('kampus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_prodis');
    }
};
