<?php

namespace Database\Seeders;

use App\Models\KendaraanDinas;
use App\Models\Pegawai;
use App\Models\PerangkatDaerah;
use App\Models\RiwayatKondisi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 0. Akun Pengelola / Admin BMD
        User::updateOrCreate(
            ['email' => 'admin@bmd.go.id'],
            [
                'name' => 'Administrator BMD',
                'password' => Hash::make('password'),
            ]
        );

        // 1. Data Perangkat Daerah (PD / OPD)
        $pds = [
            [
                'kode_opd' => '1.01.01',
                'nama_instansi' => 'Dinas Pendidikan',
                'singkatan' => 'Disdik',
                'alamat' => 'Jl. Jenderal Sudirman No. 45, Kompleks Perkantoran Pemda',
                'telepon' => '(021) 555-1021',
                'nama_kepala' => 'Dr. H. Bambang Sutrisno, M.Pd.',
                'nip_kepala' => '196805121994031002',
            ],
            [
                'kode_opd' => '1.02.01',
                'nama_instansi' => 'Dinas Kesehatan',
                'singkatan' => 'Dinkes',
                'alamat' => 'Jl. Kesehatan Raya No. 12, Area Rumah Sakit Umum Daerah',
                'telepon' => '(021) 555-1022',
                'nama_kepala' => 'dr. Hj. Ratna Indrayani, Sp.A.',
                'nip_kepala' => '197203151998032004',
            ],
            [
                'kode_opd' => '1.03.01',
                'nama_instansi' => 'Dinas Pekerjaan Umum dan Penataan Ruang (PUPR)',
                'singkatan' => 'Dinas PUPR',
                'alamat' => 'Jl. Bina Marga No. 88, Kawasan Terpadu',
                'telepon' => '(021) 555-1023',
                'nama_kepala' => 'Ir. Hendra Kusuma, M.T.',
                'nip_kepala' => '197008201996031001',
            ],
            [
                'kode_opd' => '4.01.01',
                'nama_instansi' => 'Badan Pengelola Keuangan dan Aset Daerah (BPKAD)',
                'singkatan' => 'BPKAD',
                'alamat' => 'Gedung Sayap Timur Balai Kota Lt. 2',
                'telepon' => '(021) 555-1024',
                'nama_kepala' => 'Drs. Agus Supriyadi, M.Si.',
                'nip_kepala' => '196912011993031003',
            ],
            [
                'kode_opd' => '1.05.01',
                'nama_instansi' => 'Dinas Perhubungan',
                'singkatan' => 'Dishub',
                'alamat' => 'Jl. Terminal Induk No. 5, Terminal Terpadu',
                'telepon' => '(021) 555-1025',
                'nama_kepala' => 'H. Wahyu Pratama, S.SiT., M.M.',
                'nip_kepala' => '197504101999031005',
            ],
        ];

        $createdPds = [];
        foreach ($pds as $data) {
            $createdPds[$data['singkatan']] = PerangkatDaerah::create($data);
        }

        // 2. Data Pegawai Negeri Sipil (PNS)
        $pegawais = [
            // Dinas Pendidikan
            [
                'perangkat_daerah_id' => $createdPds['Disdik']->id,
                'nip' => '198204152006041008',
                'nama' => 'Ahmad Fauzi, S.Pd., M.M.',
                'jabatan' => 'Kepala Bidang Pembinaan SMP',
                'golongan' => 'IV/a (Pembina)',
                'no_hp' => '081234567801',
                'email' => 'ahmad.fauzi@disdik.go.id',
            ],
            [
                'perangkat_daerah_id' => $createdPds['Disdik']->id,
                'nip' => '198809122011012015',
                'nama' => 'Dewi Sartika, S.E.',
                'jabatan' => 'Kasubag Umum & Kepegawaian',
                'golongan' => 'III/d (Penata Tingkat I)',
                'no_hp' => '081234567802',
                'email' => 'dewi.sartika@disdik.go.id',
            ],
            [
                'perangkat_daerah_id' => $createdPds['Disdik']->id,
                'nip' => '199201042015021004',
                'nama' => 'Rian Hidayat, S.Kom.',
                'jabatan' => 'Pengelola Data Aset & BMD',
                'golongan' => 'III/b (Penata Muda Tingkat I)',
                'no_hp' => '081234567803',
                'email' => 'rian.hidayat@disdik.go.id',
            ],

            // Dinas Kesehatan
            [
                'perangkat_daerah_id' => $createdPds['Dinkes']->id,
                'nip' => '198007232005012009',
                'nama' => 'drg. Maya Anggraini, M.Kes.',
                'jabatan' => 'Kabid Pelayanan Kesehatan',
                'golongan' => 'IV/b (Pembina Tingkat I)',
                'no_hp' => '081234567804',
                'email' => 'maya.anggraini@dinkes.go.id',
            ],
            [
                'perangkat_daerah_id' => $createdPds['Dinkes']->id,
                'nip' => '198603182010011012',
                'nama' => 'Budi Setiawan, S.Kep., Ns.',
                'jabatan' => 'Koordinator Satgas Tanggap Darurat & Ambulans',
                'golongan' => 'III/c (Penata)',
                'no_hp' => '081234567805',
                'email' => 'budi.setiawan@dinkes.go.id',
            ],

            // Dinas PUPR
            [
                'perangkat_daerah_id' => $createdPds['Dinas PUPR']->id,
                'nip' => '197906102003121005',
                'nama' => 'Ir. Eko Prasetyo, S.T., M.Eng.',
                'jabatan' => 'Kabid Bina Marga & Jembatan',
                'golongan' => 'IV/a (Pembina)',
                'no_hp' => '081234567806',
                'email' => 'eko.prasetyo@pupr.go.id',
            ],
            [
                'perangkat_daerah_id' => $createdPds['Dinas PUPR']->id,
                'nip' => '199011282014031002',
                'nama' => 'Danang Wijaya, S.T.',
                'jabatan' => 'Pengawas Lapangan Proyek Jalan',
                'golongan' => 'III/b (Penata Muda Tingkat I)',
                'no_hp' => '081234567807',
                'email' => 'danang.wijaya@pupr.go.id',
            ],

            // BPKAD
            [
                'perangkat_daerah_id' => $createdPds['BPKAD']->id,
                'nip' => '198402142008011003',
                'nama' => 'Fajar Nugroho, S.E., Ak., M.Ak.',
                'jabatan' => 'Kabid Pengelolaan Barang Milik Daerah',
                'golongan' => 'IV/a (Pembina)',
                'no_hp' => '081234567808',
                'email' => 'fajar.nugroho@bpkad.go.id',
            ],

            // Dinas Perhubungan
            [
                'perangkat_daerah_id' => $createdPds['Dishub']->id,
                'nip' => '198705052011021001',
                'nama' => 'Surya Pratama, A.Ma.PKB., S.Sos.',
                'jabatan' => 'Kepala Seksi Rekayasa Lalu Lintas',
                'golongan' => 'III/c (Penata)',
                'no_hp' => '081234567809',
                'email' => 'surya.pratama@dishub.go.id',
            ],
        ];

        $createdPegawais = [];
        foreach ($pegawais as $data) {
            $createdPegawais[] = Pegawai::create($data);
        }

        // 3. Data Kendaraan Dinas Operasional (KDO)
        $kdos = [
            // Disdik
            [
                'perangkat_daerah_id' => $createdPds['Disdik']->id,
                'penanggung_jawab_id' => $createdPegawais[0]->id, // Ahmad Fauzi
                'no_polisi' => 'B 1001 PQ',
                'merek' => 'Toyota',
                'tipe' => 'Kijang Innova 2.0 V A/T',
                'jenis_kendaraan' => 'Roda 4',
                'tahun_produksi' => 2022,
                'warna' => 'Hitam Metalik',
                'kondisi' => 'Baik',
                'nomor_rangka' => 'MHF11BK43N0092144',
                'nomor_mesin' => '1TR-FE-8291042',
                'tgl_pajak' => '2027-04-15',
                'keterangan' => 'Kendaraan operasional monitoring sekolah di wilayah perkotaan.',
            ],
            [
                'perangkat_daerah_id' => $createdPds['Disdik']->id,
                'penanggung_jawab_id' => $createdPegawais[1]->id, // Dewi Sartika
                'no_polisi' => 'B 1002 PQ',
                'merek' => 'Toyota',
                'tipe' => 'Avanza 1.5 G M/T',
                'jenis_kendaraan' => 'Roda 4',
                'tahun_produksi' => 2019,
                'warna' => 'Silver Metalik',
                'kondisi' => 'Rusak Ringan',
                'nomor_rangka' => 'MHF11AA32K0041235',
                'nomor_mesin' => '2NR-VE-5120391',
                'tgl_pajak' => '2026-11-20',
                'keterangan' => 'Kompresor AC kurang dingin, rem tangan perlu penyetelan.',
            ],
            [
                'perangkat_daerah_id' => $createdPds['Disdik']->id,
                'penanggung_jawab_id' => $createdPegawais[2]->id, // Rian Hidayat
                'no_polisi' => 'B 2110 PQ',
                'merek' => 'Honda',
                'tipe' => 'Vario 160 CBS',
                'jenis_kendaraan' => 'Roda 2',
                'tahun_produksi' => 2023,
                'warna' => 'Hitam Doff',
                'kondisi' => 'Baik',
                'nomor_rangka' => 'MH1KF1118PK019283',
                'nomor_mesin' => 'KF11E-1029384',
                'tgl_pajak' => '2027-08-10',
                'keterangan' => 'Operasional kurir berkas dinas dan inventarisasi aset sekolah.',
            ],

            // Dinkes
            [
                'perangkat_daerah_id' => $createdPds['Dinkes']->id,
                'penanggung_jawab_id' => $createdPegawais[3]->id, // drg. Maya Anggraini
                'no_polisi' => 'B 1003 PQ',
                'merek' => 'Mitsubishi',
                'tipe' => 'Pajero Sport 2.4 Dakar 4x2',
                'jenis_kendaraan' => 'Roda 4',
                'tahun_produksi' => 2021,
                'warna' => 'Putih Mutiara',
                'kondisi' => 'Baik',
                'nomor_rangka' => 'MMBJJKS11MH088192',
                'nomor_mesin' => '4N15-U819230',
                'tgl_pajak' => '2027-02-14',
                'keterangan' => 'Kendaraan peninjauan puskesmas daerah perbatasan dan pelosok.',
            ],
            [
                'perangkat_daerah_id' => $createdPds['Dinkes']->id,
                'penanggung_jawab_id' => $createdPegawais[4]->id, // Budi Setiawan
                'no_polisi' => 'B 9001 PQ',
                'merek' => 'Toyota',
                'tipe' => 'HiAce Commuter 2.5 (Ambulans Emergency)',
                'jenis_kendaraan' => 'Roda 4',
                'tahun_produksi' => 2020,
                'warna' => 'Putih / Lis Merah',
                'kondisi' => 'Baik',
                'nomor_rangka' => 'JTFB22HP5K0081290',
                'nomor_mesin' => '2KD-FTV-991203',
                'tgl_pajak' => '2027-05-18',
                'keterangan' => 'Unit Ambulans Siaga PSC 119 lengkap alat resusitasi dan oksigen.',
            ],
            [
                'perangkat_daerah_id' => $createdPds['Dinkes']->id,
                'penanggung_jawab_id' => null, // Belum ditugaskan pemegang baru
                'no_polisi' => 'B 1014 PQ',
                'merek' => 'Suzuki',
                'tipe' => 'APV Arena GL 1.5 M/T',
                'jenis_kendaraan' => 'Roda 4',
                'tahun_produksi' => 2015,
                'warna' => 'Abu-abu Metalik',
                'kondisi' => 'Rusak Berat',
                'nomor_rangka' => 'MHYDN42V1FJ001923',
                'nomor_mesin' => 'G15A-7781293',
                'tgl_pajak' => '2024-03-12',
                'keterangan' => 'Mesin overheat, silinder head melengkung, transmisi macet di pool dinas.',
            ],

            // Dinas PUPR
            [
                'perangkat_daerah_id' => $createdPds['Dinas PUPR']->id,
                'penanggung_jawab_id' => $createdPegawais[5]->id, // Ir. Eko Prasetyo
                'no_polisi' => 'B 1005 PQ',
                'merek' => 'Toyota',
                'tipe' => 'Hilux 2.4 Double Cabin 4x4',
                'jenis_kendaraan' => 'Roda 4',
                'tahun_produksi' => 2021,
                'warna' => 'Hitam',
                'kondisi' => 'Baik',
                'nomor_rangka' => 'MROHA3CD6M1092834',
                'nomor_mesin' => '2GD-FTV-881920',
                'tgl_pajak' => '2027-09-30',
                'keterangan' => 'Patroli konstruksi jalan kabupaten dan inspeksi tanggap bencana.',
            ],
            [
                'perangkat_daerah_id' => $createdPds['Dinas PUPR']->id,
                'penanggung_jawab_id' => $createdPegawais[6]->id, // Danang Wijaya
                'no_polisi' => 'B 2201 PQ',
                'merek' => 'Kawasaki',
                'tipe' => 'KLX 150 BF SE',
                'jenis_kendaraan' => 'Roda 2',
                'tahun_produksi' => 2022,
                'warna' => 'Hijau / Hitam',
                'kondisi' => 'Baik',
                'nomor_rangka' => 'MH4LX150DPP029341',
                'nomor_mesin' => 'LX150CE-88192',
                'tgl_pajak' => '2027-10-15',
                'keterangan' => 'Survei jalur medan berat dan inspeksi saluran irigasi pedesaan.',
            ],
            [
                'perangkat_daerah_id' => $createdPds['Dinas PUPR']->id,
                'penanggung_jawab_id' => null,
                'no_polisi' => 'B 9005 PQ',
                'merek' => 'Hino',
                'tipe' => 'Dutro 130 HD (Dump Truk Aset)',
                'jenis_kendaraan' => 'Roda 6 / Truk / Bus',
                'tahun_produksi' => 2017,
                'warna' => 'Hijau Muda',
                'kondisi' => 'Rusak Ringan',
                'nomor_rangka' => 'MJEC17KL4HJ009182',
                'nomor_mesin' => 'W04D-TN-991283',
                'tgl_pajak' => '2026-12-05',
                'keterangan' => 'Hidrolik bak bocor halus, perlu penggantian seal dan oli hidrolik.',
            ],

            // BPKAD
            [
                'perangkat_daerah_id' => $createdPds['BPKAD']->id,
                'penanggung_jawab_id' => $createdPegawais[7]->id, // Fajar Nugroho
                'no_polisi' => 'B 1004 PQ',
                'merek' => 'Toyota',
                'tipe' => 'Innova Zenix 2.0 V CVT',
                'jenis_kendaraan' => 'Roda 4',
                'tahun_produksi' => 2024,
                'warna' => 'Hitam Metalik',
                'kondisi' => 'Baik',
                'nomor_rangka' => 'MHF11MAG8P0019283',
                'nomor_mesin' => 'M20A-FKS-109283',
                'tgl_pajak' => '2028-01-10',
                'keterangan' => 'Operasional koordinasi BPK/Inspektorat dan sensus BMD provinsi.',
            ],

            // Dishub
            [
                'perangkat_daerah_id' => $createdPds['Dishub']->id,
                'penanggung_jawab_id' => $createdPegawais[8]->id, // Surya Pratama
                'no_polisi' => 'B 1009 PQ',
                'merek' => 'Isuzu',
                'tipe' => 'D-Max 1.9 Rodeo 4x4',
                'jenis_kendaraan' => 'Roda 4',
                'tahun_produksi' => 2020,
                'warna' => 'Putih / Biru Dishub',
                'kondisi' => 'Baik',
                'nomor_rangka' => 'MPATFR87JKH019283',
                'nomor_mesin' => 'RZ4E-TC-091823',
                'tgl_pajak' => '2027-06-25',
                'keterangan' => 'Patroli ketertiban rambu lalu lintas dan pengawalan jalur kedinasan.',
            ],
            [
                'perangkat_daerah_id' => $createdPds['Dishub']->id,
                'penanggung_jawab_id' => null,
                'no_polisi' => 'B 9010 PQ',
                'merek' => 'Mitsubishi Fuso',
                'tipe' => 'Colt Diesel FE 74 HD (Truk Derek Dishub)',
                'jenis_kendaraan' => 'Roda 6 / Truk / Bus',
                'tahun_produksi' => 2016,
                'warna' => 'Kuning / Biru',
                'kondisi' => 'Rusak Ringan',
                'nomor_rangka' => 'MHFFE74HDG0019283',
                'nomor_mesin' => '4D34-T81920',
                'tgl_pajak' => '2026-10-01',
                'keterangan' => 'Kabel sling derek aus, memerlukan kalibrasi winch berkala.',
            ],
        ];

        $createdKdos = [];
        foreach ($kdos as $data) {
            $createdKdos[] = KendaraanDinas::create($data);
        }

        // 4. Data Riwayat Kondisi
        RiwayatKondisi::create([
            'kendaraan_dinas_id' => $createdKdos[1]->id, // Avanza Rusak Ringan
            'tanggal_pemeriksaan' => '2026-10-15',
            'kondisi_sebelum' => 'Baik',
            'kondisi_sesudah' => 'Rusak Ringan',
            'catatan_kerusakan' => 'Pemeriksaan triwulan: ditemukan kebocoran freon AC dan kampas rem depan menipis.',
            'petugas_pemeriksa' => 'Mulyono (Montir Bengkel Resmi Rekanan Pemda)',
            'estimasi_biaya' => 2450000,
        ]);

        RiwayatKondisi::create([
            'kendaraan_dinas_id' => $createdKdos[5]->id, // Suzuki APV Rusak Berat
            'tanggal_pemeriksaan' => '2026-08-20',
            'kondisi_sebelum' => 'Rusak Ringan',
            'kondisi_sesudah' => 'Rusak Berat',
            'catatan_kerusakan' => 'Mesin mati total akibat overheating parah, blok silinder retak. Direkomendasikan lelang atau peremajaan.',
            'petugas_pemeriksa' => 'Hadi Sucipto (Inspektur Teknis BMD)',
            'estimasi_biaya' => 18500000,
        ]);
    }
}
