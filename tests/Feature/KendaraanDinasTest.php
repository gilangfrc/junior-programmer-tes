<?php

namespace Tests\Feature;

use App\Models\KendaraanDinas;
use App\Models\Pegawai;
use App\Models\PerangkatDaerah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KendaraanDinasTest extends TestCase
{
    use RefreshDatabase;

    private PerangkatDaerah $opd;
    private Pegawai $pegawai;

    protected function setUp(): void
    {
        parent::setUp();

        $this->opd = PerangkatDaerah::create([
            'nama_instansi' => 'Dinas Pendidikan',
            'kode_opd' => '1.01.01',
            'singkatan' => 'Disdik',
            'kepala_instansi' => 'Dr. Budi Santoso',
            'alamat' => 'Jl. Pemuda No. 10',
            'telepon' => '021-123456',
        ]);

        $this->pegawai = Pegawai::create([
            'perangkat_daerah_id' => $this->opd->id,
            'nama' => 'Ahmad Fauzi, S.T.',
            'nip' => '198501012010011001',
            'jabatan' => 'Kepala Seksi Sarana',
            'golongan' => 'IV/a',
            'no_hp' => '081234567890',
            'status_aktif' => true,
        ]);
    }

    public function test_can_render_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('SIM-KDO');
        $response->assertSee('Dashboard Eksekutif');
    }

    public function test_can_render_kendaraan_dinas_list(): void
    {
        KendaraanDinas::create([
            'perangkat_daerah_id' => $this->opd->id,
            'pegawai_id' => $this->pegawai->id,
            'no_polisi' => 'B 1001 PQ',
            'merek' => 'Toyota',
            'tipe' => 'Innova Zenix',
            'tahun_produksi' => 2023,
            'warna' => 'Hitam Metalik',
            'kondisi' => 'Baik',
            'jenis_kendaraan' => 'Roda 4',
        ]);

        $response = $this->get('/kendaraan-dinas');
        $response->assertStatus(200);
        $response->assertSee('B 1001 PQ');
        $response->assertSee('Innova Zenix');

        // Test filter status pemegang & kondisi
        $filterResponse = $this->get('/kendaraan-dinas?kondisi=Baik&status_pemegang=assigned');
        $filterResponse->assertStatus(200);
        $filterResponse->assertSee('B 1001 PQ');
    }

    public function test_can_create_kendaraan_dinas(): void
    {
        $data = [
            'perangkat_daerah_id' => $this->opd->id,
            'pegawai_id' => $this->pegawai->id,
            'no_polisi' => 'B 2024 PQ',
            'merek' => 'Honda',
            'tipe' => 'CR-V 1.5 Turbo',
            'tahun_produksi' => 2024,
            'warna' => 'Putih Mutiara',
            'kondisi' => 'Baik',
            'jenis_kendaraan' => 'Roda 4',
        ];

        $response = $this->post('/kendaraan-dinas', $data);
        $response->assertRedirect('/kendaraan-dinas');
        $this->assertDatabaseHas('kendaraan_dinas', [
            'no_polisi' => 'B 2024 PQ',
            'merek' => 'Honda',
        ]);
    }

    public function test_can_update_kendaraan_dinas(): void
    {
        $kdo = KendaraanDinas::create([
            'perangkat_daerah_id' => $this->opd->id,
            'no_polisi' => 'B 3000 PQ',
            'merek' => 'Daihatsu',
            'tipe' => 'Terios',
            'tahun_produksi' => 2020,
            'warna' => 'Silver',
            'kondisi' => 'Baik',
            'jenis_kendaraan' => 'Roda 4',
        ]);

        $response = $this->put("/kendaraan-dinas/{$kdo->id}", [
            'perangkat_daerah_id' => $this->opd->id,
            'no_polisi' => 'B 3000 PQ',
            'merek' => 'Daihatsu',
            'tipe' => 'Terios R Custom',
            'tahun_produksi' => 2020,
            'warna' => 'Silver Metalik',
            'kondisi' => 'Rusak Ringan',
            'catatan_kondisi' => 'Perlu ganti oli dan kampas rem',
            'jenis_kendaraan' => 'Roda 4',
        ]);

        $response->assertRedirect('/kendaraan-dinas');
        $this->assertDatabaseHas('kendaraan_dinas', [
            'id' => $kdo->id,
            'kondisi' => 'Rusak Ringan',
            'tipe' => 'Terios R Custom',
        ]);
    }

    public function test_can_delete_kendaraan_dinas(): void
    {
        $kdo = KendaraanDinas::create([
            'perangkat_daerah_id' => $this->opd->id,
            'no_polisi' => 'B 4000 PQ',
            'merek' => 'Suzuki',
            'tipe' => 'APV',
            'tahun_produksi' => 2018,
            'warna' => 'Hitam',
            'kondisi' => 'Rusak Berat',
            'jenis_kendaraan' => 'Roda 4',
        ]);

        $response = $this->delete("/kendaraan-dinas/{$kdo->id}");
        $response->assertRedirect('/kendaraan-dinas');
        $this->assertDatabaseMissing('kendaraan_dinas', ['id' => $kdo->id]);
    }

    public function test_api_rest_endpoints_work_properly(): void
    {
        // 1. GET List via REST API
        $response = $this->getJson('/api/v1/kendaraan-dinas');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data',
            'pagination' => ['current_page', 'per_page', 'total', 'last_page'],
        ]);

        // 2. POST Store via REST API
        $storeResponse = $this->postJson('/api/v1/kendaraan-dinas', [
            'perangkat_daerah_id' => $this->opd->id,
            'no_polisi' => 'B 5555 PQ',
            'merek' => 'Toyota',
            'tipe' => 'Hilux Double Cabin',
            'tahun_produksi' => 2022,
            'warna' => 'Hitam',
            'kondisi' => 'Baik',
            'jenis_kendaraan' => 'Roda 4',
        ]);

        $storeResponse->assertStatus(201);
        $storeResponse->assertJsonPath('data.no_polisi', 'B 5555 PQ');
        $createdId = $storeResponse->json('data.id');

        // 3. GET Detail via REST API
        $showResponse = $this->getJson("/api/v1/kendaraan-dinas/{$createdId}");
        $showResponse->assertStatus(200);
        $showResponse->assertJsonPath('data.merek', 'Toyota');

        // 4. PUT Update via REST API
        $updateResponse = $this->putJson("/api/v1/kendaraan-dinas/{$createdId}", [
            'perangkat_daerah_id' => $this->opd->id,
            'no_polisi' => 'B 5555 PQ',
            'merek' => 'Toyota',
            'tipe' => 'Hilux Double Cabin 4x4',
            'tahun_produksi' => 2022,
            'warna' => 'Hitam',
            'kondisi' => 'Rusak Ringan',
            'jenis_kendaraan' => 'Roda 4',
        ]);
        $updateResponse->assertStatus(200);
        $updateResponse->assertJsonPath('data.kondisi', 'Rusak Ringan');

        // 5. DELETE via REST API
        $deleteResponse = $this->deleteJson("/api/v1/kendaraan-dinas/{$createdId}");
        $deleteResponse->assertStatus(200);
    }
}
