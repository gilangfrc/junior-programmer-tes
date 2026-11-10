# SIM-KDO (Sistem Informasi Manajemen Kendaraan Dinas Operasional)
### Pengelolaan Barang Milik Daerah (BMD) Pemerintah Daerah
**Ujian Praktik Junior Programmer (Kode Soal: JP-1)**  
**Kategori Pengerjaan:** **Full Stack (Frontend UI + Backend REST API Terintegrasi)**

---

## 📌 1. Latar Belakang & Deskripsi Proyek

Aplikasi **SIM-KDO** dibangun untuk menjawab kebutuhan tata kelola **Barang Milik Daerah (BMD)**, khususnya dalam pendataan, pengawasan fisik, dan penelusuran akuntabilitas pemegang **Kendaraan Dinas Operasional (KDO)** milik satuan kerja Pemerintah Daerah.

Sistem ini mengintegrasikan:
1. **Frontend Modern (Tailwind CSS):** Dashboard eksekutif, tabel data interaktif dengan pencarian dan filter cepat, modal konfirmasi aksi, format cetak laporan resmi BMD, dan form input validatif.
2. **Backend Kuat & Terstruktur (Laravel 11 & MySQL):** RESTful API lengkap (CRUD) dengan standar response JSON, Form Request Validation, Eloquent Model Relations, dan database migration terurut.
3. **Interactive API Explorer (`/api-docs`):** Halaman pengujian langsung endpoint API di browser untuk memudahkan penilai/penguji memverifikasi status kode HTTP (`200 OK`, `201 Created`, dll).

---

## 🏛️ 2. Entitas Utama & Struktur Basis Data

Sistem mengelola 3 entitas wajib sesuai instruksi soal serta 1 entitas riwayat pemeliharaan sebagai nilai tambah:

### A. Perangkat Daerah (PD / OPD) — Entitas 3
Instansi pemerintah daerah yang memiliki dan mengalokasikan armada kendaraan dinas.
* `id` : Primary Key
* `kode_opd` : Kode unik satuan kerja (contoh: `1.01.01`)
* `nama_instansi` : Nama dinas (contoh: *Dinas Pendidikan*, *Dinas Kesehatan*, *Dinas PUPR*)
* `singkatan` : Akronim instansi (contoh: *Disdik*, *Dinkes*, *PUPR*)
* `alamat` & `telepon` : Lokasi kantor dan kontak
* `nama_kepala` & `nip_kepala` : Pimpinan/Kepala Dinas penandatangan BAST

### B. Pegawai Negeri Sipil (PNS) — Entitas 2
Aparatur Sipil Negara yang bertanggung jawab atas pengoperasian dan perawatan kendaraan.
* `id` : Primary Key
* `perangkat_daerah_id` : Relasi ke Perangkat Daerah bertugas (Foreign Key)
* `nip` : Nomor Induk Pegawai (18 digit unik)
* `nama` : Nama lengkap beserta gelar
* `jabatan` : Jabatan struktural / fungsional
* `golongan` : Pangkat/Golongan ruang (contoh: `IV/a (Pembina)`, `III/c (Penata)`)
* `no_hp` & `email` : Kontak pegawai
* `status_aktif` : Status keaktifan pegawai

### C. Kendaraan Dinas Operasional (KDO) — Entitas 1
Unit kendaraan bermotor dinas (plat merah) milik pemerintah daerah.
* `id` : Primary Key
* `perangkat_daerah_id` : Instansi pemilik aset (Foreign Key)
* `penanggung_jawab_id` : PNS penanggung jawab / pemegang kendaraan (Foreign Key, nullable)
* `no_polisi` : Nomor registrasi polisi plat merah (contoh: `B 1001 PQ`)
* `merek` : Pabrikan kendaraan (contoh: *Toyota*, *Honda*, *Mitsubishi*, *Isuzu*)
* `tipe` : Model/varian (contoh: *Kijang Innova 2.0 V*, *Hilux Double Cabin*, *Vario 160*)
* `jenis_kendaraan` : Klasifikasi (`Roda 2`, `Roda 4`, `Roda 6 / Truk / Bus`)
* `tahun_produksi` : Tahun pembuatan kendaraan
* `warna` : Warna fisik unit
* `kondisi` : Status kelayakan fisik (`Baik`, `Rusak Ringan`, `Rusak Berat`)
* `nomor_rangka` & `nomor_mesin` : Identifikasi fisik kendaraan
* `tgl_pajak` : Tanggal jatuh tempo pajak STNK
* `keterangan` : Catatan peruntukan dinas

### D. Riwayat Kondisi & Catatan Servis (Nilai Tambah / Inovasi)
Log audit trail perubahan kondisi fisik unit dan estimasi biaya perbaikan.
* `kendaraan_dinas_id` : Relasi unit KDO
* `tanggal_pemeriksaan` : Tanggal pengecekan berkala
* `kondisi_sebelum` & `kondisi_sesudah` : Perubahan status
* `catatan_kerusakan` : Diagnosa teknis atau kebutuhan suku cadang
* `petugas_pemeriksa` & `estimasi_biaya`

---

## 🗄️ 3. Diagram Relasi Entitas (ERD)

```text
[PERANGKAT DAERAH] 1 ────────────< N [PEGAWAI PNS]
       │                                   │
       │ 1                                 │ 1
       │                                   │
       v N                                 v N (nullable)
[KENDARAAN DINAS (KDO)] <──────────────────┘
       │ 1
       │
       v N
[RIWAYAT KONDISI]
```

---

## ✨ 4. Fitur-Fitur Aplikasi

### Fitur Wajib (Core CRUD):
* **Read (Menampilkan Data):**
  * Daftar tabel data lengkap dengan pagination, status pill, dan informasi relasi.
  * Halaman detail komprehensif untuk KDO, Pegawai, dan Perangkat Daerah.
* **Create (Menambah Data):**
  * Form input lengkap dengan validasi (*server-side* & *client-side*).
  * Dropdown dinamis berelasi (pilih OPD dan pilih PNS pemegang).
* **Update (Mengubah Data):**
  * Perbarui spesifikasi teknis, mutasi pemegang kendaraan, atau ubah status kondisi.
  * Otomatis mencatat perubahan status ke tabel riwayat pemeliharaan.
* **Delete (Menghapus Data):**
  * Modal konfirmasi aksi hapus untuk mencegah kehilangan data tidak sengaja.
  * *Foreign key constraint protection* (mencegah penghapusan instansi jika masih memiliki aset KDO aktif).

### Fitur Nilai Tambah & Inovasi (Poin Tambahan Ujian):
1. **Executive Dashboard BMD:**
   * 4 Kartu KPI: Total Armada, Total Unit Kondisi Baik, Rusak Ringan, dan Rusak Berat.
   * Progress bar visual rasio kelayakan kendaraan operasional.
   * Tabel rekapitulasi jumlah armada dan unit rusak per dinas.
2. **Filter & Pencarian Multi-Kriteria:**
   * Pencarian langsung berdasarkan Nomor Polisi, Merek, Tipe, atau Nama PNS.
   * Filter cepat berdasarkan kondisi fisik (`Baik`, `Rusak Ringan`, `Rusak Berat`).
   * Filter berdasarkan instansi Perangkat Daerah.
3. **Cetak Rekapitulasi Inventaris BMD:**
   * Halaman cetak laporan resmi lengkap dengan Kop Surat Pemda, rekap armada, dan kolom tanda tangan Pejabat Pengelola BMD.
4. **Cetak Berita Acara Serah Terima (BAST):**
   * Template surat resmi penyerahan kendaraan dari Kepala Perangkat Daerah kepada PNS penerima hak pakai.
5. **Interactive REST API Tester Page (`/api-docs`):**
   * Halaman uji API bawaan di web dengan tombol eksekusi live, latency counter, dan status code indicator.

---

## 🚀 5. Dokumentasi REST API

Semua endpoint API mengembalikan format JSON standar:
```json
{
  "success": true,
  "message": "Pesan deskriptif",
  "data": { ... }
}
```

### Daftar Endpoint:

| Method | Endpoint | Deskripsi | Status Code |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/dashboard/stats` | Ringkasan statistik eksekutif KDO | `200 OK` |
| `GET` | `/api/kendaraan-dinas` | Daftar seluruh KDO (mendukung query `search`, `kondisi`, `perangkat_daerah_id`) | `200 OK` |
| `POST` | `/api/kendaraan-dinas` | Tambah unit kendaraan dinas baru | `201 Created` |
| `GET` | `/api/kendaraan-dinas/{id}` | Detail 1 unit KDO beserta relasi & riwayat | `200 OK` / `404 Not Found` |
| `PUT` | `/api/kendaraan-dinas/{id}` | Ubah data kendaraan dinas | `200 OK` |
| `DELETE` | `/api/kendaraan-dinas/{id}` | Hapus data kendaraan dinas | `200 OK` |
| `GET` | `/api/pegawai` | Daftar pegawai PNS | `200 OK` |
| `POST` | `/api/pegawai` | Tambah pegawai PNS baru | `201 Created` |
| `GET` | `/api/pegawai/{id}` | Detail profil pegawai & KDO yang dipegang | `200 OK` |
| `PUT` | `/api/pegawai/{id}` | Ubah data pegawai | `200 OK` |
| `DELETE` | `/api/pegawai/{id}` | Hapus data pegawai | `200 OK` |
| `GET` | `/api/perangkat-daerah` | Daftar Perangkat Daerah (OPD) | `200 OK` |
| `POST` | `/api/perangkat-daerah` | Tambah Perangkat Daerah | `201 Created` |
| `GET` | `/api/perangkat-daerah/{id}` | Detail instansi beserta daftar aset & pegawai | `200 OK` |
| `PUT` | `/api/perangkat-daerah/{id}` | Ubah data instansi | `200 OK` |
| `DELETE` | `/api/perangkat-daerah/{id}` | Hapus data instansi | `200 OK` |

#### Contoh Request cURL:
```bash
# 1. Mengambil statistik dashboard
curl -X GET "http://127.0.0.1:8000/api/dashboard/stats" -H "Accept: application/json"

# 2. Mengambil daftar kendaraan dalam kondisi Rusak Ringan
curl -X GET "http://127.0.0.1:8000/api/kendaraan-dinas?kondisi=Rusak+Ringan" -H "Accept: application/json"

# 3. Menambahkan kendaraan baru
curl -X POST "http://127.0.0.1:8000/api/kendaraan-dinas" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "perangkat_daerah_id": 1,
    "penanggung_jawab_id": 1,
    "no_polisi": "B 1234 PQ",
    "merek": "Toyota",
    "tipe": "Innova Zenix 2.0 V",
    "jenis_kendaraan": "Roda 4",
    "tahun_produksi": 2024,
    "warna": "Hitam",
    "kondisi": "Baik",
    "nomor_rangka": "MHF11MAG8P0019283",
    "nomor_mesin": "M20A-FKS-109283",
    "tgl_pajak": "2028-01-10",
    "keterangan": "Kendaraan operasional baru"
  }'
```

---

## ⚙️ 6. Panduan Instalasi & Menjalankan Aplikasi

### Kebutuhan Sistem:
* PHP >= 8.2 (ekstensi `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`)
* MySQL / MariaDB Server
* Composer >= 2.x
* Node.js & npm (untuk kompilasi Tailwind CSS)

### Langkah Instalasi:

1. **Clone Repositori:**
   ```bash
   git clone https://github.com/gilangfrc/junior-programmer-tes.git
   cd junior-programmer-tes
   ```

2. **Instal Dependensi PHP & Node:**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment Database (`.env`):**
   Pastikan pengaturan database di `.env` telah sesuai:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pusadatin_tes
   DB_USERNAME=root
   DB_PASSWORD=root
   ```

4. **Jalankan Migrasi & Database Seeder:**
   ```bash
   php artisan migrate --seed
   ```
   *Seeder akan otomatis mengisi data realistis: 5 instansi Perangkat Daerah (Dinas Pendidikan, Dinas Kesehatan, Dinas PUPR, BPKAD, Dishub), 9 Pegawai PNS, 12 unit Kendaraan Dinas plat merah dengan aneka kondisi, dan log riwayat pemeliharaan.*

5. **Hubungkan Symlink Penyimpanan Media:**
   ```bash
   php artisan storage:link
   ```

6. **Kompilasi Aset Frontend (Tailwind CSS):**
   ```bash
   npm run build
   ```

7. **Jalankan Server Development:**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui browser pada:
   * **Dashboard Utama:** [http://127.0.0.1:8000](http://127.0.0.1:8000)
   * **Interactive API Tester:** [http://127.0.0.1:8000/api-docs](http://127.0.0.1:8000/api-docs)

---

## 📂 7. Struktur Direktori Utama

```text
junior-programmer-tes/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/                     # REST API Controllers
│   │   │   │   ├── DashboardApiController.php
│   │   │   │   ├── KendaraanDinasApiController.php
│   │   │   │   ├── PegawaiApiController.php
│   │   │   │   └── PerangkatDaerahApiController.php
│   │   │   ├── ApiDocsController.php    # Interactive API Tester Controller
│   │   │   ├── DashboardController.php  # Web Dashboard Controller
│   │   │   ├── KendaraanDinasController.php
│   │   │   ├── PegawaiController.php
│   │   │   └── PerangkatDaerahController.php
│   │   ├── Requests/                    # Form Request Validations
│   │   │   ├── StoreKendaraanDinasRequest.php
│   │   │   ├── UpdateKendaraanDinasRequest.php
│   │   │   ├── StorePegawaiRequest.php
│   │   │   ├── UpdatePegawaiRequest.php
│   │   │   ├── StorePerangkatDaerahRequest.php
│   │   │   └── UpdatePerangkatDaerahRequest.php
│   │   └── Resources/                   # API Json Resources
│   │       ├── KendaraanDinasResource.php
│   │       ├── PegawaiResource.php
│   │       └── PerangkatDaerahResource.php
│   └── Models/                          # Eloquent Models & Relasi
│       ├── KendaraanDinas.php
│       ├── Pegawai.php
│       ├── PerangkatDaerah.php
│       └── RiwayatKondisi.php
├── database/
│   ├── migrations/                      # 4 Migrasi Terstruktur Berurutan
│   │   ├── 2026_01_01_000001_create_perangkat_daerahs_table.php
│   │   ├── 2026_01_01_000002_create_pegawais_table.php
│   │   ├── 2026_01_01_000003_create_kendaraan_dinas_table.php
│   │   └── 2026_01_01_000004_create_riwayat_kondisis_table.php
│   └── seeders/
│       └── DatabaseSeeder.php           # Data Awal Aset BMD
├── resources/
│   ├── css/app.css                      # Tailwind CSS Setup
│   └── views/                           # Blade Templates
│       ├── layouts/app.blade.php
│       ├── dashboard/index.blade.php
│       ├── kendaraan_dinas/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── show.blade.php
│       │   ├── cetak.blade.php          # Print Rekap BMD
│       │   └── bast.blade.php           # Berita Acara Serah Terima
│       ├── pegawai/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── perangkat_daerah/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       └── api_docs/
│           └── index.blade.php          # Interactive Tester UI
└── routes/
    ├── web.php                          # Rute Antarmuka Web
    └── api.php                          # Rute RESTful API
```

---

## ⚖️ 8. Lisensi & Hak Penggunaan
Proyek ini dibuat sebagai penyelesaian **Ujian Praktik Junior Programmer (JP-1)** dalam rangka seleksi teknis pengelolaan sistem Barang Milik Daerah (BMD). Bersifat *open-source* di bawah lisensi MIT.
