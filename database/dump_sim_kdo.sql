-- MySQL dump 10.13  Distrib 9.7.1, for macos26.4 (arm64)
--
-- Host: 127.0.0.1    Database: pusdatin_tes
-- ------------------------------------------------------
-- Server version	9.7.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kendaraan_dinas`
--

DROP TABLE IF EXISTS `kendaraan_dinas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kendaraan_dinas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `perangkat_daerah_id` bigint unsigned NOT NULL,
  `penanggung_jawab_id` bigint unsigned DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kendaraan_dinas_no_polisi_unique` (`no_polisi`),
  KEY `kendaraan_dinas_perangkat_daerah_id_foreign` (`perangkat_daerah_id`),
  KEY `kendaraan_dinas_penanggung_jawab_id_foreign` (`penanggung_jawab_id`),
  CONSTRAINT `kendaraan_dinas_penanggung_jawab_id_foreign` FOREIGN KEY (`penanggung_jawab_id`) REFERENCES `pegawais` (`id`) ON DELETE SET NULL,
  CONSTRAINT `kendaraan_dinas_perangkat_daerah_id_foreign` FOREIGN KEY (`perangkat_daerah_id`) REFERENCES `perangkat_daerahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kendaraan_dinas`
--

LOCK TABLES `kendaraan_dinas` WRITE;
/*!40000 ALTER TABLE `kendaraan_dinas` DISABLE KEYS */;
INSERT INTO `kendaraan_dinas` VALUES (1,1,1,'B 1001 PQ','Toyota','Kijang Innova 2.0 V A/T','Roda 4',2022,'Hitam Metalik','Baik','MHF11BK43N0092144','1TR-FE-8291042','2027-04-15','Kendaraan operasional monitoring sekolah di wilayah perkotaan.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(2,1,2,'B 1002 PQ','Toyota','Avanza 1.5 G M/T','Roda 4',2019,'Silver Metalik','Rusak Ringan','MHF11AA32K0041235','2NR-VE-5120391','2026-11-20','Kompresor AC kurang dingin, rem tangan perlu penyetelan.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(3,1,3,'B 2110 PQ','Honda','Vario 160 CBS','Roda 2',2023,'Hitam Doff','Baik','MH1KF1118PK019283','KF11E-1029384','2027-08-10','Operasional kurir berkas dinas dan inventarisasi aset sekolah.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(4,2,4,'B 1003 PQ','Mitsubishi','Pajero Sport 2.4 Dakar 4x2','Roda 4',2021,'Putih Mutiara','Baik','MMBJJKS11MH088192','4N15-U819230','2027-02-14','Kendaraan peninjauan puskesmas daerah perbatasan dan pelosok.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(5,2,5,'B 9001 PQ','Toyota','HiAce Commuter 2.5 (Ambulans Emergency)','Roda 4',2020,'Putih / Lis Merah','Baik','JTFB22HP5K0081290','2KD-FTV-991203','2027-05-18','Unit Ambulans Siaga PSC 119 lengkap alat resusitasi dan oksigen.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(6,2,NULL,'B 1014 PQ','Suzuki','APV Arena GL 1.5 M/T','Roda 4',2015,'Abu-abu Metalik','Rusak Berat','MHYDN42V1FJ001923','G15A-7781293','2024-03-12','Mesin overheat, silinder head melengkung, transmisi macet di pool dinas.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(7,3,6,'B 1005 PQ','Toyota','Hilux 2.4 Double Cabin 4x4','Roda 4',2021,'Hitam','Baik','MROHA3CD6M1092834','2GD-FTV-881920','2027-09-30','Patroli konstruksi jalan kabupaten dan inspeksi tanggap bencana.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(8,3,7,'B 2201 PQ','Kawasaki','KLX 150 BF SE','Roda 2',2022,'Hijau / Hitam','Baik','MH4LX150DPP029341','LX150CE-88192','2027-10-15','Survei jalur medan berat dan inspeksi saluran irigasi pedesaan.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(9,3,NULL,'B 9005 PQ','Hino','Dutro 130 HD (Dump Truk Aset)','Roda 6 / Truk / Bus',2017,'Hijau Muda','Rusak Ringan','MJEC17KL4HJ009182','W04D-TN-991283','2026-12-05','Hidrolik bak bocor halus, perlu penggantian seal dan oli hidrolik.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(10,4,8,'B 1004 PQ','Toyota','Innova Zenix 2.0 V CVT','Roda 4',2024,'Hitam Metalik','Baik','MHF11MAG8P0019283','M20A-FKS-109283','2028-01-10','Operasional koordinasi BPK/Inspektorat dan sensus BMD provinsi.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(11,5,9,'B 1009 PQ','Isuzu','D-Max 1.9 Rodeo 4x4','Roda 4',2020,'Putih / Biru Dishub','Baik','MPATFR87JKH019283','RZ4E-TC-091823','2027-06-25','Patroli ketertiban rambu lalu lintas dan pengawalan jalur kedinasan.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(12,5,NULL,'B 9010 PQ','Mitsubishi Fuso','Colt Diesel FE 74 HD (Truk Derek Dishub)','Roda 6 / Truk / Bus',2016,'Kuning / Biru','Rusak Ringan','MHFFE74HDG0019283','4D34-T81920','2026-10-01','Kabel sling derek aus, memerlukan kalibrasi winch berkala.',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26');
/*!40000 ALTER TABLE `kendaraan_dinas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_01_01_000001_create_perangkat_daerahs_table',1),(5,'2026_01_01_000002_create_pegawais_table',1),(6,'2026_01_01_000003_create_kendaraan_dinas_table',1),(7,'2026_01_01_000004_create_riwayat_kondisis_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pegawais`
--

DROP TABLE IF EXISTS `pegawais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pegawais` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `perangkat_daerah_id` bigint unsigned NOT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pegawais_nip_unique` (`nip`),
  KEY `pegawais_perangkat_daerah_id_foreign` (`perangkat_daerah_id`),
  CONSTRAINT `pegawais_perangkat_daerah_id_foreign` FOREIGN KEY (`perangkat_daerah_id`) REFERENCES `perangkat_daerahs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pegawais`
--

LOCK TABLES `pegawais` WRITE;
/*!40000 ALTER TABLE `pegawais` DISABLE KEYS */;
INSERT INTO `pegawais` VALUES (1,1,'198204152006041008','Ahmad Fauzi, S.Pd., M.M.','Kepala Bidang Pembinaan SMP','IV/a (Pembina)','081234567801','ahmad.fauzi@disdik.go.id',1,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(2,1,'198809122011012015','Dewi Sartika, S.E.','Kasubag Umum & Kepegawaian','III/d (Penata Tingkat I)','081234567802','dewi.sartika@disdik.go.id',1,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(3,1,'199201042015021004','Rian Hidayat, S.Kom.','Pengelola Data Aset & BMD','III/b (Penata Muda Tingkat I)','081234567803','rian.hidayat@disdik.go.id',1,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(4,2,'198007232005012009','drg. Maya Anggraini, M.Kes.','Kabid Pelayanan Kesehatan','IV/b (Pembina Tingkat I)','081234567804','maya.anggraini@dinkes.go.id',1,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(5,2,'198603182010011012','Budi Setiawan, S.Kep., Ns.','Koordinator Satgas Tanggap Darurat & Ambulans','III/c (Penata)','081234567805','budi.setiawan@dinkes.go.id',1,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(6,3,'197906102003121005','Ir. Eko Prasetyo, S.T., M.Eng.','Kabid Bina Marga & Jembatan','IV/a (Pembina)','081234567806','eko.prasetyo@pupr.go.id',1,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(7,3,'199011282014031002','Danang Wijaya, S.T.','Pengawas Lapangan Proyek Jalan','III/b (Penata Muda Tingkat I)','081234567807','danang.wijaya@pupr.go.id',1,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(8,4,'198402142008011003','Fajar Nugroho, S.E., Ak., M.Ak.','Kabid Pengelolaan Barang Milik Daerah','IV/a (Pembina)','081234567808','fajar.nugroho@bpkad.go.id',1,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(9,5,'198705052011021001','Surya Pratama, A.Ma.PKB., S.Sos.','Kepala Seksi Rekayasa Lalu Lintas','III/c (Penata)','081234567809','surya.pratama@dishub.go.id',1,'2026-11-09 21:19:26','2026-11-09 21:19:26');
/*!40000 ALTER TABLE `pegawais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perangkat_daerahs`
--

DROP TABLE IF EXISTS `perangkat_daerahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perangkat_daerahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_opd` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kepala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip_kepala` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `perangkat_daerahs_kode_opd_unique` (`kode_opd`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perangkat_daerahs`
--

LOCK TABLES `perangkat_daerahs` WRITE;
/*!40000 ALTER TABLE `perangkat_daerahs` DISABLE KEYS */;
INSERT INTO `perangkat_daerahs` VALUES (1,'1.01.01','Dinas Pendidikan','Disdik','Jl. Jenderal Sudirman No. 45, Kompleks Perkantoran Pemda','(021) 555-1021','Dr. H. Bambang Sutrisno, M.Pd.','196805121994031002','2026-11-09 21:19:26','2026-11-09 21:19:26'),(2,'1.02.01','Dinas Kesehatan','Dinkes','Jl. Kesehatan Raya No. 12, Area Rumah Sakit Umum Daerah','(021) 555-1022','dr. Hj. Ratna Indrayani, Sp.A.','197203151998032004','2026-11-09 21:19:26','2026-11-09 21:19:26'),(3,'1.03.01','Dinas Pekerjaan Umum dan Penataan Ruang (PUPR)','Dinas PUPR','Jl. Bina Marga No. 88, Kawasan Terpadu','(021) 555-1023','Ir. Hendra Kusuma, M.T.','197008201996031001','2026-11-09 21:19:26','2026-11-09 21:19:26'),(4,'4.01.01','Badan Pengelola Keuangan dan Aset Daerah (BPKAD)','BPKAD','Gedung Sayap Timur Balai Kota Lt. 2','(021) 555-1024','Drs. Agus Supriyadi, M.Si.','196912011993031003','2026-11-09 21:19:26','2026-11-09 21:19:26'),(5,'1.05.01','Dinas Perhubungan','Dishub','Jl. Terminal Induk No. 5, Terminal Terpadu','(021) 555-1025','H. Wahyu Pratama, S.SiT., M.M.','197504101999031005','2026-11-09 21:19:26','2026-11-09 21:19:26');
/*!40000 ALTER TABLE `perangkat_daerahs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `riwayat_kondisis`
--

DROP TABLE IF EXISTS `riwayat_kondisis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `riwayat_kondisis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kendaraan_dinas_id` bigint unsigned NOT NULL,
  `tanggal_pemeriksaan` date NOT NULL,
  `kondisi_sebelum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi_sesudah` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan_kerusakan` text COLLATE utf8mb4_unicode_ci,
  `petugas_pemeriksa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimasi_biaya` decimal(15,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `riwayat_kondisis_kendaraan_dinas_id_foreign` (`kendaraan_dinas_id`),
  CONSTRAINT `riwayat_kondisis_kendaraan_dinas_id_foreign` FOREIGN KEY (`kendaraan_dinas_id`) REFERENCES `kendaraan_dinas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat_kondisis`
--

LOCK TABLES `riwayat_kondisis` WRITE;
/*!40000 ALTER TABLE `riwayat_kondisis` DISABLE KEYS */;
INSERT INTO `riwayat_kondisis` VALUES (1,2,'2026-10-15','Baik','Rusak Ringan','Pemeriksaan triwulan: ditemukan kebocoran freon AC dan kampas rem depan menipis.','Mulyono (Montir Bengkel Resmi Rekanan Pemda)',2450000.00,'2026-11-09 21:19:26','2026-11-09 21:19:26'),(2,6,'2026-08-20','Rusak Ringan','Rusak Berat','Mesin mati total akibat overheating parah, blok silinder retak. Direkomendasikan lelang atau peremajaan.','Hadi Sucipto (Inspektur Teknis BMD)',18500000.00,'2026-11-09 21:19:26','2026-11-09 21:19:26');
/*!40000 ALTER TABLE `riwayat_kondisis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator BMD','admin@bmd.go.id',NULL,'$2y$12$Un5U7vFNWh2u7sjr8iCGQujCoL/gX8P2cVKof0kAvh69rbMVbJh4e',NULL,'2026-11-09 21:19:26','2026-11-09 21:19:26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'pusdatin_tes'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-10 13:03:52
