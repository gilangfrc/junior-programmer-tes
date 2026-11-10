<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Data Kendaraan Dinas Operasional (KDO)
     */
    public function up(): void
    {
        Schema::create('kendaraan_dinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perangkat_daerah_id')->constrained('perangkat_daerahs')->onDelete('cascade');
            $table->foreignId('penanggung_jawab_id')->nullable()->constrained('pegawais')->nullOnDelete();
            
            $table->string('no_polisi', 20)->unique(); // Plat merah / nomor polisi
            $table->string('merek', 100);             // Toyota, Honda, Isuzu, dll
            $table->string('tipe', 100);              // Avanza, Innova, Hilux, dll
            $table->enum('jenis_kendaraan', ['Roda 2', 'Roda 4', 'Roda 6 / Truk / Bus'])->default('Roda 4');
            $table->integer('tahun_produksi');
            $table->string('warna', 50);
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            
            // Atribut pelengkap aset BMD
            $table->string('nomor_rangka', 100)->nullable();
            $table->string('nomor_mesin', 100)->nullable();
            $table->date('tgl_pajak')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('foto_path')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan_dinas');
    }
};
