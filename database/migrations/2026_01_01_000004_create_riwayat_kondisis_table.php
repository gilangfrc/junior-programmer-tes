<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Log Riwayat Perubahan Kondisi dan Servis KDO
     */
    public function up(): void
    {
        Schema::create('riwayat_kondisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_dinas_id')->constrained('kendaraan_dinas')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');
            $table->string('kondisi_sebelum', 50);
            $table->string('kondisi_sesudah', 50);
            $table->text('catatan_kerusakan')->nullable();
            $table->string('petugas_pemeriksa')->nullable();
            $table->decimal('estimasi_biaya', 15, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kondisis');
    }
};
