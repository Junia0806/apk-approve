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
        Schema::create('data_presensis', function (Blueprint $table) {
            $table->id('id_presensi');
            $table->integer('id_dosen')->unsigned();
            $table->date('tgl_presensi');
            $table->string('hari');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_presensis');
    }
};
