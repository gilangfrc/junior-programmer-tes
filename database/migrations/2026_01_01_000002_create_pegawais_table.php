<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Data Pegawai Negeri Sipil (PNS) penanggung jawab kendaraan
     */
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perangkat_daerah_id')->constrained('perangkat_daerahs')->onDelete('cascade');
            $table->string('nip', 30)->unique();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('golongan', 50); // e.g. IV/a - Pembina, III/c - Penata
            $table->string('no_hp', 25)->nullable();
            $table->string('email', 100)->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
