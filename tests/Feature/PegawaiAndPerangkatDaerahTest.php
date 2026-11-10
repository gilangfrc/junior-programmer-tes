<?php

namespace Tests\Feature;

use App\Models\KendaraanDinas;
use App\Models\Pegawai;
use App\Models\PerangkatDaerah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PegawaiAndPerangkatDaerahTest extends TestCase
{
    use RefreshDatabase;

    public function test_perangkat_daerah_crud_and_api(): void
    {
        // 1. Create OPD via Web
        $response = $this->post('/perangkat-daerah', [
            'kode_opd' => '1.02.01',
            'nama_instansi' => 'Dinas Kesehatan',
            'singkatan' => 'Dinkes',
            'alamat' => 'Jl. Kesehatan No. 5',
        ]);
        $response->assertRedirect('/perangkat-daerah');
        $this->assertDatabaseHas('perangkat_daerahs', ['kode_opd' => '1.02.01']);

        $opd = PerangkatDaerah::where('kode_opd', '1.02.01')->first();

        // 2. Index & Show View
        $this->get('/perangkat-daerah')->assertStatus(200)->assertSee('Dinas Kesehatan');
        $this->get("/perangkat-daerah/{$opd->id}")->assertStatus(200)->assertSee('Dinkes');

        // 3. API GET list & show
        $this->getJson('/api/v1/perangkat-daerah')->assertStatus(200)->assertJsonPath('data.0.kode_opd', '1.02.01');
        $this->getJson("/api/v1/perangkat-daerah/{$opd->id}")->assertStatus(200);

        // 4. Update via API
        $this->putJson("/api/v1/perangkat-daerah/{$opd->id}", [
            'kode_opd' => '1.02.01',
            'nama_instansi' => 'Dinas Kesehatan Daerah',
            'singkatan' => 'Dinkesda',
        ])->assertStatus(200)->assertJsonPath('data.nama_instansi', 'Dinas Kesehatan Daerah');

        // 5. Delete OPD
        $this->delete("/perangkat-daerah/{$opd->id}")->assertRedirect('/perangkat-daerah');
        $this->assertDatabaseMissing('perangkat_daerahs', ['id' => $opd->id]);
    }

    public function test_pegawai_crud_and_api(): void
    {
        $opd = PerangkatDaerah::create([
            'kode_opd' => '1.03.01',
            'nama_instansi' => 'Dinas Perhubungan',
            'singkatan' => 'Dishub',
        ]);

        // 1. Create Pegawai via Web
        $response = $this->post('/pegawai', [
            'perangkat_daerah_id' => $opd->id,
            'nama' => 'Bambang Irawan',
            'nip' => '198701012015011002',
            'jabatan' => 'Staff Penguji Kendaraan',
            'golongan' => 'III/b',
            'status_aktif' => 1,
        ]);
        $response->assertRedirect('/pegawai');
        $this->assertDatabaseHas('pegawais', ['nip' => '198701012015011002']);

        $pegawai = Pegawai::where('nip', '198701012015011002')->first();

        // 2. Index & Show
        $this->get('/pegawai')->assertStatus(200)->assertSee('Bambang Irawan');
        $this->get("/pegawai/{$pegawai->id}")->assertStatus(200)->assertSee('III/b');

        // 3. API GET List & Show
        $this->getJson('/api/v1/pegawai')->assertStatus(200)->assertJsonPath('data.0.nama', 'Bambang Irawan');
        $this->getJson("/api/v1/pegawai/{$pegawai->id}")->assertStatus(200);

        // 4. Update via API
        $this->putJson("/api/v1/pegawai/{$pegawai->id}", [
            'perangkat_daerah_id' => $opd->id,
            'nama' => 'Bambang Irawan, S.T.',
            'nip' => '198701012015011002',
            'jabatan' => 'Kepala Seksi Angkutan',
            'golongan' => 'III/c',
            'status_aktif' => 1,
        ])->assertStatus(200)->assertJsonPath('data.jabatan', 'Kepala Seksi Angkutan');

        // 5. Delete Pegawai
        $this->delete("/pegawai/{$pegawai->id}")->assertRedirect('/pegawai');
        $this->assertDatabaseMissing('pegawais', ['id' => $pegawai->id]);
    }

    public function test_cetak_laporan_and_bast_renders(): void
    {
        $opd = PerangkatDaerah::create([
            'kode_opd' => '1.04.01',
            'nama_instansi' => 'Badan Pengelola Keuangan dan Aset Daerah',
            'singkatan' => 'BPKAD',
        ]);

        $kdo = KendaraanDinas::create([
            'perangkat_daerah_id' => $opd->id,
            'no_polisi' => 'B 7777 PQ',
            'merek' => 'Toyota',
            'tipe' => 'Camry',
            'tahun_produksi' => 2021,
            'warna' => 'Hitam',
            'kondisi' => 'Baik',
            'jenis_kendaraan' => 'Roda 4',
        ]);

        // Rekapitulasi Cetak BMD
        $this->get('/kendaraan-dinas/cetak')->assertStatus(200)->assertSee('Rekapitulasi Inventaris');

        // Berita Acara Serah Terima (BAST)
        $this->get("/kendaraan-dinas/{$kdo->id}/bast")->assertStatus(200)->assertSee('BERITA ACARA SERAH TERIMA');
    }
}
