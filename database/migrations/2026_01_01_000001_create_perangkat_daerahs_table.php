<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Master data Perangkat Daerah (PD / OPD)
     */
    public function up(): void
    {
        Schema::create('perangkat_daerahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_opd', 50)->unique();
            $table->string('nama_instansi');
            $table->string('singkatan', 50)->nullable();
            $table->string('alamat')->nullable();
            $table->string('telepon', 30)->nullable();
            $table->string('nama_kepala')->nullable();
            $table->string('nip_kepala', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat_daerahs');
    }
};
