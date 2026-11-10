-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 10 Nov 2026 pada 06.11
-- Versi server: 9.7.1
-- Versi PHP: 8.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pusdatin_tes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan_dinas`
--

CREATE TABLE `kendaraan_dinas` (
  `id` bigint UNSIGNED NOT NULL,
  `perangkat_daerah_id` bigint UNSIGNED NOT NULL,
  `penanggung_jawab_id` bigint UNSIGNED DEFAULT NULL,
  `no_polisi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merek` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kendaraan` enum('Roda 2','Roda 4','Roda 6 / Truk / Bus') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Roda 4',
  `tahun_produksi` int NOT NULL,
  `warna` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` enum('Baik','Rusak Ringan','Rusak Berat') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Baik',
  `nomor_rangka` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_mesin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_pajak` date DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `foto_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kendaraan_dinas`
--

INSERT INTO `kendaraan_dinas` (`id`, `perangkat_daerah_id`, `penanggung_jawab_id`, `no_polisi`, `merek`, `tipe`, `jenis_kendaraan`, `tahun_produksi`, `warna`, `kondisi`, `nomor_rangka`, `nomor_mesin`, `tgl_pajak`, `keterangan`, `foto_path`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'B 1001 PQ', 'Toyota', 'Kijang Innova 2.0 V A/T', 'Roda 4', 2022, 'Hitam Metalik', 'Baik', 'MHF11BK43N0092144', '1TR-FE-8291042', '2027-04-15', 'Kendaraan operasional monitoring sekolah di wilayah perkotaan.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(2, 1, 2, 'B 1002 PQ', 'Toyota', 'Avanza 1.5 G M/T', 'Roda 4', 2019, 'Silver Metalik', 'Rusak Ringan', 'MHF11AA32K0041235', '2NR-VE-5120391', '2026-11-20', 'Kompresor AC kurang dingin, rem tangan perlu penyetelan.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(3, 1, 3, 'B 2110 PQ', 'Honda', 'Vario 160 CBS', 'Roda 2', 2023, 'Hitam Doff', 'Baik', 'MH1KF1118PK019283', 'KF11E-1029384', '2027-08-10', 'Operasional kurir berkas dinas dan inventarisasi aset sekolah.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(4, 2, 4, 'B 1003 PQ', 'Mitsubishi', 'Pajero Sport 2.4 Dakar 4x2', 'Roda 4', 2021, 'Putih Mutiara', 'Baik', 'MMBJJKS11MH088192', '4N15-U819230', '2027-02-14', 'Kendaraan peninjauan puskesmas daerah perbatasan dan pelosok.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(5, 2, 5, 'B 9001 PQ', 'Toyota', 'HiAce Commuter 2.5 (Ambulans Emergency)', 'Roda 4', 2020, 'Putih / Lis Merah', 'Baik', 'JTFB22HP5K0081290', '2KD-FTV-991203', '2027-05-18', 'Unit Ambulans Siaga PSC 119 lengkap alat resusitasi dan oksigen.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(6, 2, NULL, 'B 1014 PQ', 'Suzuki', 'APV Arena GL 1.5 M/T', 'Roda 4', 2015, 'Abu-abu Metalik', 'Rusak Berat', 'MHYDN42V1FJ001923', 'G15A-7781293', '2024-03-12', 'Mesin overheat, silinder head melengkung, transmisi macet di pool dinas.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(7, 3, 6, 'B 1005 PQ', 'Toyota', 'Hilux 2.4 Double Cabin 4x4', 'Roda 4', 2021, 'Hitam', 'Baik', 'MROHA3CD6M1092834', '2GD-FTV-881920', '2027-09-30', 'Patroli konstruksi jalan kabupaten dan inspeksi tanggap bencana.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(8, 3, 7, 'B 2201 PQ', 'Kawasaki', 'KLX 150 BF SE', 'Roda 2', 2022, 'Hijau / Hitam', 'Baik', 'MH4LX150DPP029341', 'LX150CE-88192', '2027-10-15', 'Survei jalur medan berat dan inspeksi saluran irigasi pedesaan.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(9, 3, NULL, 'B 9005 PQ', 'Hino', 'Dutro 130 HD (Dump Truk Aset)', 'Roda 6 / Truk / Bus', 2017, 'Hijau Muda', 'Rusak Ringan', 'MJEC17KL4HJ009182', 'W04D-TN-991283', '2026-12-05', 'Hidrolik bak bocor halus, perlu penggantian seal dan oli hidrolik.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(10, 4, 8, 'B 1004 PQ', 'Toyota', 'Innova Zenix 2.0 V CVT', 'Roda 4', 2024, 'Hitam Metalik', 'Baik', 'MHF11MAG8P0019283', 'M20A-FKS-109283', '2028-01-10', 'Operasional koordinasi BPK/Inspektorat dan sensus BMD provinsi.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(11, 5, 9, 'B 1009 PQ', 'Isuzu', 'D-Max 1.9 Rodeo 4x4', 'Roda 4', 2020, 'Putih / Biru Dishub', 'Baik', 'MPATFR87JKH019283', 'RZ4E-TC-091823', '2027-06-25', 'Patroli ketertiban rambu lalu lintas dan pengawalan jalur kedinasan.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(12, 5, NULL, 'B 9010 PQ', 'Mitsubishi Fuso', 'Colt Diesel FE 74 HD (Truk Derek Dishub)', 'Roda 6 / Truk / Bus', 2016, 'Kuning / Biru', 'Rusak Ringan', 'MHFFE74HDG0019283', '4D34-T81920', '2026-10-01', 'Kabel sling derek aus, memerlukan kalibrasi winch berkala.', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_01_000001_create_perangkat_daerahs_table', 1),
(5, '2026_01_01_000002_create_pegawais_table', 1),
(6, '2026_01_01_000003_create_kendaraan_dinas_table', 1),
(7, '2026_01_01_000004_create_riwayat_kondisis_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint UNSIGNED NOT NULL,
  `perangkat_daerah_id` bigint UNSIGNED NOT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawais`
--

INSERT INTO `pegawais` (`id`, `perangkat_daerah_id`, `nip`, `nama`, `jabatan`, `golongan`, `no_hp`, `email`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 1, '198204152006041008', 'Ahmad Fauzi, S.Pd., M.M.', 'Kepala Bidang Pembinaan SMP', 'IV/a (Pembina)', '081234567801', 'ahmad.fauzi@disdik.go.id', 1, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(2, 1, '198809122011012015', 'Dewi Sartika, S.E.', 'Kasubag Umum & Kepegawaian', 'III/d (Penata Tingkat I)', '081234567802', 'dewi.sartika@disdik.go.id', 1, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(3, 1, '199201042015021004', 'Rian Hidayat, S.Kom.', 'Pengelola Data Aset & BMD', 'III/b (Penata Muda Tingkat I)', '081234567803', 'rian.hidayat@disdik.go.id', 1, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(4, 2, '198007232005012009', 'drg. Maya Anggraini, M.Kes.', 'Kabid Pelayanan Kesehatan', 'IV/b (Pembina Tingkat I)', '081234567804', 'maya.anggraini@dinkes.go.id', 1, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(5, 2, '198603182010011012', 'Budi Setiawan, S.Kep., Ns.', 'Koordinator Satgas Tanggap Darurat & Ambulans', 'III/c (Penata)', '081234567805', 'budi.setiawan@dinkes.go.id', 1, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(6, 3, '197906102003121005', 'Ir. Eko Prasetyo, S.T., M.Eng.', 'Kabid Bina Marga & Jembatan', 'IV/a (Pembina)', '081234567806', 'eko.prasetyo@pupr.go.id', 1, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(7, 3, '199011282014031002', 'Danang Wijaya, S.T.', 'Pengawas Lapangan Proyek Jalan', 'III/b (Penata Muda Tingkat I)', '081234567807', 'danang.wijaya@pupr.go.id', 1, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(8, 4, '198402142008011003', 'Fajar Nugroho, S.E., Ak., M.Ak.', 'Kabid Pengelolaan Barang Milik Daerah', 'IV/a (Pembina)', '081234567808', 'fajar.nugroho@bpkad.go.id', 1, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(9, 5, '198705052011021001', 'Surya Pratama, A.Ma.PKB., S.Sos.', 'Kepala Seksi Rekayasa Lalu Lintas', 'III/c (Penata)', '081234567809', 'surya.pratama@dishub.go.id', 1, '2026-11-09 21:19:26', '2026-11-09 21:19:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perangkat_daerahs`
--

CREATE TABLE `perangkat_daerahs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_opd` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kepala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip_kepala` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `perangkat_daerahs`
--

INSERT INTO `perangkat_daerahs` (`id`, `kode_opd`, `nama_instansi`, `singkatan`, `alamat`, `telepon`, `nama_kepala`, `nip_kepala`, `created_at`, `updated_at`) VALUES
(1, '1.01.01', 'Dinas Pendidikan', 'Disdik', 'Jl. Jenderal Sudirman No. 45, Kompleks Perkantoran Pemda', '(021) 555-1021', 'Dr. H. Bambang Sutrisno, M.Pd.', '196805121994031002', '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(2, '1.02.01', 'Dinas Kesehatan', 'Dinkes', 'Jl. Kesehatan Raya No. 12, Area Rumah Sakit Umum Daerah', '(021) 555-1022', 'dr. Hj. Ratna Indrayani, Sp.A.', '197203151998032004', '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(3, '1.03.01', 'Dinas Pekerjaan Umum dan Penataan Ruang (PUPR)', 'Dinas PUPR', 'Jl. Bina Marga No. 88, Kawasan Terpadu', '(021) 555-1023', 'Ir. Hendra Kusuma, M.T.', '197008201996031001', '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(4, '4.01.01', 'Badan Pengelola Keuangan dan Aset Daerah (BPKAD)', 'BPKAD', 'Gedung Sayap Timur Balai Kota Lt. 2', '(021) 555-1024', 'Drs. Agus Supriyadi, M.Si.', '196912011993031003', '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(5, '1.05.01', 'Dinas Perhubungan', 'Dishub', 'Jl. Terminal Induk No. 5, Terminal Terpadu', '(021) 555-1025', 'H. Wahyu Pratama, S.SiT., M.M.', '197504101999031005', '2026-11-09 21:19:26', '2026-11-09 21:19:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_kondisis`
--

CREATE TABLE `riwayat_kondisis` (
  `id` bigint UNSIGNED NOT NULL,
  `kendaraan_dinas_id` bigint UNSIGNED NOT NULL,
  `tanggal_pemeriksaan` date NOT NULL,
  `kondisi_sebelum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi_sesudah` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan_kerusakan` text COLLATE utf8mb4_unicode_ci,
  `petugas_pemeriksa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimasi_biaya` decimal(15,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `riwayat_kondisis`
--

INSERT INTO `riwayat_kondisis` (`id`, `kendaraan_dinas_id`, `tanggal_pemeriksaan`, `kondisi_sebelum`, `kondisi_sesudah`, `catatan_kerusakan`, `petugas_pemeriksa`, `estimasi_biaya`, `created_at`, `updated_at`) VALUES
(1, 2, '2026-10-15', 'Baik', 'Rusak Ringan', 'Pemeriksaan triwulan: ditemukan kebocoran freon AC dan kampas rem depan menipis.', 'Mulyono (Montir Bengkel Resmi Rekanan Pemda)', 2450000.00, '2026-11-09 21:19:26', '2026-11-09 21:19:26'),
(2, 6, '2026-08-20', 'Rusak Ringan', 'Rusak Berat', 'Mesin mati total akibat overheating parah, blok silinder retak. Direkomendasikan lelang atau peremajaan.', 'Hadi Sucipto (Inspektur Teknis BMD)', 18500000.00, '2026-11-09 21:19:26', '2026-11-09 21:19:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('19a3XCYLss0FnhRuG7TuFudh1I1UPVRIXRvKNjFT', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiJ2bXZUSnpVQ3BoalpKek5wV3RIZE10VVljaHlqTTFSOFNCb0pEb0x1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvZGFzaGJvYXJkIiwicm91dGUiOiJkYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1794286150),
('RcSc1gJMdfYRyWyCmZUekpyyLrXIWKdHF4aWlij8', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIxMlo2ekw0dmlWQzhsSnVnNmdYaDBscnpra0d0ZEo4Z0hvR3VwRXFqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1794290290),
('T5jEEj9UF2GoNxxWdIzYXien9wjSPCozpRGAKTs5', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJycFJ6TzVFRVBJQ2Q5dlpWTENhQnhhMG14eGNuanVtcWdDbHNQZ3ViIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9rZW5kYXJhYW4tZGluYXNcL2NyZWF0ZSIsInJvdXRlIjoia2VuZGFyYWFuLWRpbmFzLmNyZWF0ZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1794290855),
('ydkDZZB4D3gr5jOKpjkK6SBrMz9uSD57ibO8Lw8s', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiJHMXd5SEpFMXA3VjRodnhQVHRueVBPYzRQb0dqbkltZGZJaDZienpXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1794284992),
('YgJl1IdV3fYlOCI6vOAr9DLRTzVjoB0dSKD4W1Qv', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiJJcTZyTlhZbkVpNUZlRDBTdnFsdVAycUpyNTlMckcyb244cnNGVU5vIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvZGFzaGJvYXJkIiwicm91dGUiOiJkYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1794285722);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator BMD', 'admin@bmd.go.id', NULL, '$2y$12$Un5U7vFNWh2u7sjr8iCGQujCoL/gX8P2cVKof0kAvh69rbMVbJh4e', NULL, '2026-11-09 21:19:26', '2026-11-09 21:19:26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kendaraan_dinas`
--
ALTER TABLE `kendaraan_dinas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kendaraan_dinas_no_polisi_unique` (`no_polisi`),
  ADD KEY `kendaraan_dinas_perangkat_daerah_id_foreign` (`perangkat_daerah_id`),
  ADD KEY `kendaraan_dinas_penanggung_jawab_id_foreign` (`penanggung_jawab_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawais_nip_unique` (`nip`),
  ADD KEY `pegawais_perangkat_daerah_id_foreign` (`perangkat_daerah_id`);

--
-- Indeks untuk tabel `perangkat_daerahs`
--
ALTER TABLE `perangkat_daerahs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `perangkat_daerahs_kode_opd_unique` (`kode_opd`);

--
-- Indeks untuk tabel `riwayat_kondisis`
--
ALTER TABLE `riwayat_kondisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_kondisis_kendaraan_dinas_id_foreign` (`kendaraan_dinas_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kendaraan_dinas`
--
ALTER TABLE `kendaraan_dinas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `perangkat_daerahs`
--
ALTER TABLE `perangkat_daerahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `riwayat_kondisis`
--
ALTER TABLE `riwayat_kondisis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kendaraan_dinas`
--
ALTER TABLE `kendaraan_dinas`
  ADD CONSTRAINT `kendaraan_dinas_penanggung_jawab_id_foreign` FOREIGN KEY (`penanggung_jawab_id`) REFERENCES `pegawais` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kendaraan_dinas_perangkat_daerah_id_foreign` FOREIGN KEY (`perangkat_daerah_id`) REFERENCES `perangkat_daerahs` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  ADD CONSTRAINT `pegawais_perangkat_daerah_id_foreign` FOREIGN KEY (`perangkat_daerah_id`) REFERENCES `perangkat_daerahs` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_kondisis`
--
ALTER TABLE `riwayat_kondisis`
  ADD CONSTRAINT `riwayat_kondisis_kendaraan_dinas_id_foreign` FOREIGN KEY (`kendaraan_dinas_id`) REFERENCES `kendaraan_dinas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
