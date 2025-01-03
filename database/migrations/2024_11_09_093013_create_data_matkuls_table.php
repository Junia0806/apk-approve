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
        Schema::create('data_matkuls', function (Blueprint $table) {
            $table->id('id_matkul');
            $table->string('kd_matkul');
            $table->string('matkul');
            $table->integer('sks')->unsigned();
            $table->integer('semester')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_matkuls');
    }
};
