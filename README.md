# SIM-KDO (Sistem Informasi Manajemen Kendaraan Dinas Operasional)
### Pengelolaan Barang Milik Daerah (BMD) Pemerintah Daerah

**Ujian Praktik Junior Programmer (Kode Soal: `JP-1` / `JP-3`)**  
**Kategori Pengerjaan:** **Full Stack (Frontend UI + Backend REST API Terintegrasi)**  
**Status Penggunaan AI:** Menggunakan bantuan AI coding assistant secara transparan (didokumentasikan lengkap pada [`agents.md`](agents.md)).

---

## 1. Latar Belakang & Deskripsi Proyek

Aplikasi **SIM-KDO** dibangun untuk menjawab kebutuhan tata kelola **Barang Milik Daerah (BMD)**, khususnya dalam pendataan, pengawasan kondisi fisik, dan penelusuran akuntabilitas pemegang **Kendaraan Dinas Operasional (KDO)** milik satuan kerja Perangkat Daerah.

Sistem ini mengintegrasikan:
1. **Frontend Modern (Blade + Tailwind CSS v4):** Fixed sidebar layout, dashboard eksekutif KPI, tabel *enterprise* responsif (*fit-width* tanpa horizontal scroll dengan truncation & tooltip), filter multi-kriteria, modal konfirmasi hapus reusable, format cetak laporan resmi BMD & BAST, serta form input tervalidasi.
2. **Backend Terstruktur (Laravel 11 & MySQL):** RESTful API CRUD penuh (Create, Read, Update, Delete) dengan standar respon JSON konsisten, `FormRequest` validation, Eloquent API Resources, integritas relasi RDBMS (*Foreign Key*), dan database migration terurut.
3. **Interactive API Explorer (`/api-docs`):** Halaman pengujian langsung **20 endpoint REST API** di browser dengan tab kategori, trigger otomatis *Audit Trail*, pengukur latency, modal konfirmasi `DELETE`, serta generator `cURL`.

---

## 2. Entitas Utama & Struktur Basis Data (RDBMS)

Sistem mengelola **3 entitas wajib** sesuai instruksi soal serta **1 entitas relasional Audit Trail** sebagai nilai tambah:

### A. Perangkat Daerah (`perangkat_daerahs`) — Entitas 3
Instansi pemerintah daerah yang memiliki dan mengalokasikan armada kendaraan dinas.
* `id` (PK)
* `kode_opd`: Kode unik satuan kerja (contoh: `1.01.01`)
* `nama_instansi`: Nama resmi OPD (contoh: *Dinas Pendidikan*, *Dinas Kesehatan*, *Dinas PUPR*, *BPKAD*, *Dishub*)
* `singkatan`: Akronim instansi
* `alamat` & `telepon`: Lokasi kantor dan kontak
* `nama_kepala` & `nip_kepala`: Pimpinan OPD penandatangan BAST

### B. Pegawai Negeri Sipil (`pegawais`) — Entitas 2
Aparatur Sipil Negara penanggung jawab kendaraan dinas.
* `id` (PK)
* `perangkat_daerah_id` (FK &rarr; `perangkat_daerahs.id`, `ON DELETE CASCADE`)
* `nip`: Nomor Induk Pegawai (18 digit, unik)
* `nama`, `jabatan`, `golongan` (contoh: `IV/a (Pembina)`, `III/c (Penata)`)
* `no_hp`, `email`, `status_aktif`

### C. Kendaraan Dinas Operasional (`kendaraan_dinas`) — Entitas 1
Unit kendaraan bermotor dinas (plat merah) milik pemerintah daerah.
* `id` (PK)
* `perangkat_daerah_id` (FK &rarr; `perangkat_daerahs.id`, `ON DELETE CASCADE`)
* `penanggung_jawab_id` (FK &rarr; `pegawais.id`, `ON DELETE SET NULL`, nullable untuk status *Pool Dinas*)
* `no_polisi`: Nomor registrasi plat merah unik (contoh: `B 1001 PQ`)
* `merek`, `tipe`, `jenis_kendaraan` (`Roda 2`, `Roda 4`, `Roda 6 / Truk / Bus`)
* `tahun_produksi`, `warna`, `kondisi` (`Baik`, `Rusak Ringan`, `Rusak Berat`)
* `nomor_rangka`, `nomor_mesin`, `tgl_pajak`, `keterangan`, `foto_path`

### D. Riwayat Kondisi & Catatan Servis (`riwayat_kondisis`) — Nilai Tambah / Audit Trail BMD
Log historis otomatis perubahan kondisi fisik unit KDO dan estimasi biaya perbaikan.
* `id` (PK)
* `kendaraan_dinas_id` (FK &rarr; `kendaraan_dinas.id`, `ON DELETE CASCADE`)
* `tanggal_pemeriksaan`, `kondisi_sebelum`, `kondisi_sesudah`
* `catatan_kerusakan`, `petugas_pemeriksa`, `estimasi_biaya`

---

## 3. Diagram Relasi Entitas (ERD)

```text
[PERANGKAT DAERAH] 1 ────────────< N [PEGAWAI PNS]
       │                                   │
       │ 1                                 │ 1
       │                                   │ (ON DELETE SET NULL)
       v N (ON DELETE CASCADE)             v N (nullable)
[KENDARAAN DINAS (KDO)] <──────────────────┘
       │ 1
       │
       v N (ON DELETE CASCADE)
[RIWAYAT KONDISI (AUDIT TRAIL)]
```

---

## 4. Fitur-Fitur Aplikasi

### Fitur Wajib (Core CRUD — 3 Entitas):
* **Read:** Daftar tabel rapi *enterprise-grade*, pagination, pencarian real-time, serta halaman detail (*KIB KDO*, *Profil PNS*, dan *Profil OPD*).
* **Create:** Form terstruktur bernomor urut langkah, custom searchable dropdown PNS, custom file upload preview, validasi server-side & client-side plat nomor.
* **Update:** Pembaruan spesifikasi, mutasi pemegang, dan pembaruan kondisi yang otomatis mencatat histori ke `riwayat_kondisis`.
* **Delete:** Komponen modal konfirmasi hapus yang konsisten dan aman di seluruh halaman (`components/delete-modal.blade.php`).

### Fitur Nilai Tambah & Inovasi:
1. **Executive Dashboard BMD:** 4 Kartu KPI (Total Armada, Baik, Rusak Ringan, Rusak Berat), visual rasio kelayakan operasional, dan rekapitulasi aset per OPD.
2. **Audit Trail BMD Otomatis:** Perekaman historis otomatis di tabel `riwayat_kondisis` setiap pencatatan awal (`store`) maupun perubahan kondisi fisik (`update`) baik lewat Web maupun REST API.
3. **Filter & Pencarian Multi-Kriteria:** Pencarian instan no polisi/merek/nama PNS, filter kondisi, jenis kendaraan, status pemegang (Aktif dipegang vs Pool Dinas), dan filter OPD.
4. **Cetak Rekapitulasi BMD & BAST:** Template cetak surat resmi lengkap dengan kop instansi dan kolom tanda tangan.
5. **Interactive REST API Tester (`/api-docs`):** Pengujian 20 endpoint API lengkap secara live beserta generator `cURL`.

---

## 5. Dokumentasi REST API

Seluruh endpoint tersedia di prefix `/api/...` dan `/api/v1/...`, mengembalikan format JSON standar (`success`, `message`, `data`) termasuk penanganan validasi `422` dan `404` JSON (dikonfigurasi di `bootstrap/app.php`).

| Method | Endpoint | Deskripsi | Status Code |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/dashboard/stats` | Ringkasan statistik eksekutif & rasio kelayakan armada | `200 OK` |
| `GET` | `/api/kendaraan-dinas` | Daftar KDO paginated (filter: `search`, `kondisi`, `perangkat_daerah_id`, `jenis_kendaraan`) | `200 OK` |
| `POST` | `/api/kendaraan-dinas` | Tambah KDO baru (otomatis catat audit trail awal) | `201 Created` |
| `GET` | `/api/kendaraan-dinas/{id}` | Detail KDO lengkap dengan relasi OPD, PNS, & riwayat kondisi | `200 OK` / `404` |
| `PUT` | `/api/kendaraan-dinas/{id}` | Update data & kondisi KDO (otomatis catat audit trail jika kondisi berubah) | `200 OK` / `422` |
| `DELETE` | `/api/kendaraan-dinas/{id}` | Hapus KDO beserta file foto di storage | `200 OK` / `404` |
| `GET` | `/api/pegawai` | Daftar PNS penanggung jawab (filter: `search`, `perangkat_daerah_id`) | `200 OK` |
| `POST` | `/api/pegawai` | Tambah PNS baru dengan validasi NIP unik | `201 Created` |
| `GET` | `/api/pegawai/{id}` | Detail profil PNS & unit KDO yang dipertanggungjawabkan | `200 OK` / `404` |
| `PUT` | `/api/pegawai/{id}` | Perbarui data PNS | `200 OK` |
| `DELETE` | `/api/pegawai/{id}` | Hapus PNS (unit KDO terkait otomatis menjadi Pool Dinas) | `200 OK` |
| `GET` | `/api/perangkat-daerah` | Daftar OPD/SKPD beserta total pegawai & aset KDO | `200 OK` |
| `POST` | `/api/perangkat-daerah` | Tambah instansi OPD baru | `201 Created` |
| `GET` | `/api/perangkat-daerah/{id}` | Detail profil instansi OPD | `200 OK` / `404` |
| `PUT` | `/api/perangkat-daerah/{id}` | Perbarui data instansi OPD | `200 OK` |
| `DELETE` | `/api/perangkat-daerah/{id}` | Hapus instansi OPD | `200 OK` |

### Contoh Pengujian cURL:
```bash
# 1. Ambil statistik dashboard
curl -X GET "http://127.0.0.1:8000/api/dashboard/stats" -H "Accept: application/json"

# 2. Filter kendaraan kondisi Rusak Berat
curl -X GET "http://127.0.0.1:8000/api/kendaraan-dinas?kondisi=Rusak+Berat" -H "Accept: application/json"

# 3. Tambah kendaraan baru via API
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
    "warna": "Hitam Metalik",
    "kondisi": "Baik",
    "nomor_rangka": "MHF11MAG8P0019283",
    "nomor_mesin": "M20A-FKS-109283",
    "tgl_pajak": "2028-01-10",
    "keterangan": "Kendaraan operasional baru"
  }'
```

---

## 6. Panduan Instalasi & Menjalankan Aplikasi (Manual Setup)

### Kebutuhan Sistem:
* PHP >= 8.2 (`pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`)
* MySQL >= 8.0 / MariaDB Server
* Composer >= 2.x
* Node.js & npm

### Langkah Instalasi:

1. **Clone Repositori & Masuk Direktori:**
   ```bash
   git clone https://github.com/gilangfrc/junior-programmer-tes.git
   cd junior-programmer-tes
   ```

2. **Instal Dependensi & Generate App Key:**
   ```bash
   composer install
   npm install
   cp .env.example .env
   php artisan key:generate
   ```

3. **Konfigurasi Database MySQL di `.env`:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pusdatin_tes
   DB_USERNAME=root
   DB_PASSWORD=root
   ```
   *(Pastikan database `pusdatin_tes` telah dibuat di MySQL server Anda: `CREATE DATABASE pusdatin_tes;`)*

4. **Setup Skema & Data Awal (Pilih Salah Satu Cara):**
   * **Cara A — Via Laravel Migration & Seeder (Direkomendasikan):**
     ```bash
     php artisan migrate --seed
     ```
   * **Cara B — Via Import Dump SQL (`database/dump_sim_kdo.sql`):**
     ```bash
     mysql -h 127.0.0.1 -u root -p pusdatin_tes < database/dump_sim_kdo.sql
     ```
   *Kedua cara di atas menghasilkan data riil operasional Pemda: 5 Perangkat Daerah, 9 PNS, 12 unit Kendaraan Dinas plat merah, dan riwayat audit trail pemeriksaan kondisi.*

5. **Kompilasi Aset Frontend & Link Storage:**
   ```bash
   php artisan storage:link
   npm run build
   ```

6. **Jalankan Server & Pengujian:**
   ```bash
   # Menjalankan server development
   php artisan serve

   # Menjalankan automated test suite (12 feature tests)
   php artisan test
   ```
   Akses di browser:
   * **Dashboard Utama:** `http://127.0.0.1:8000`
   * **Interactive API Tester:** `http://127.0.0.1:8000/api-docs`

---

## 7. Transparansi Penggunaan AI & Bukti Screenshot

* **Dokumentasi Agen AI ([`agents.md`](agents.md)):** Berisi deklarasi jujur penggunaan asisten AI, pembagian kontrol *human-in-the-loop*, log iterasi pengembangan, serta standar teknis kode proyek.
* **Dump Database SQL:** Tersimpan di [`database/dump_sim_kdo.sql`](database/dump_sim_kdo.sql).
* **Dokumentasi Screenshot Aplikasi & Pengujian REST API:** Tersimpan di direktori [`docs/screenshots/`](docs/screenshots/).

---

## 8. Struktur Direktori Proyek

```text
junior-programmer-tes/
├── agents.md                                    # Dokumentasi transparansi AI (Wajib JP-3)
├── README.md                                    # Dokumentasi teknis & manual setup
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/                             # REST API Controllers
│   │   │   │   ├── DashboardApiController.php
│   │   │   │   ├── KendaraanDinasApiController.php
│   │   │   │   ├── PegawaiApiController.php
│   │   │   │   └── PerangkatDaerahApiController.php
│   │   │   ├── ApiDocsController.php            # Interactive API Tester Controller
│   │   │   ├── DashboardController.php          # Web Dashboard Controller
│   │   │   ├── KendaraanDinasController.php
│   │   │   ├── PegawaiController.php
│   │   │   └── PerangkatDaerahController.php
│   │   ├── Requests/                            # Form Request Validation
│   │   │   ├── StoreKendaraanDinasRequest.php
│   │   │   ├── UpdateKendaraanDinasRequest.php
│   │   │   ├── StorePegawaiRequest.php
│   │   │   ├── UpdatePegawaiRequest.php
│   │   │   ├── StorePerangkatDaerahRequest.php
│   │   │   └── UpdatePerangkatDaerahRequest.php
│   │   └── Resources/                           # Eloquent API JSON Resources
│   │       ├── KendaraanDinasResource.php
│   │       ├── PegawaiResource.php
│   │       └── PerangkatDaerahResource.php
│   └── Models/                                  # Models & Eloquent Relations
│       ├── KendaraanDinas.php
│       ├── Pegawai.php
│       ├── PerangkatDaerah.php
│       └── RiwayatKondisi.php
├── database/
│   ├── dump_sim_kdo.sql                         # SQL Database Dump MySQL (Bonus RDBMS)
│   ├── migrations/                              # Migrasi RDBMS terurut
│   │   ├── 2026_01_01_000001_create_perangkat_daerahs_table.php
│   │   ├── 2026_01_01_000002_create_pegawais_table.php
│   │   ├── 2026_01_01_000003_create_kendaraan_dinas_table.php
│   │   └── 2026_01_01_000004_create_riwayat_kondisis_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── docs/
│   └── screenshots/                             # Tangkapan layar UI & bukti REST API
├── resources/
│   ├── css/app.css                              # Tailwind CSS v4 config
│   └── views/                                   # Blade Templates
│       ├── components/delete-modal.blade.php    # Reusable Delete Confirmation Modal
│       ├── layouts/app.blade.php                # Fixed Sidebar Layout
│       ├── dashboard/index.blade.php
│       ├── kendaraan_dinas/ (index, create, edit, show, cetak, bast)
│       ├── pegawai/ (index, create, edit, show)
│       ├── perangkat_daerah/ (index, create, edit, show)
│       └── api_docs/index.blade.php             # Interactive REST API Tester
├── routes/
│   ├── web.php
│   └── api.php
└── tests/Feature/                               # Automated PHPUnit Test Suite
    ├── KendaraanDinasTest.php
    └── PegawaiAndPerangkatDaerahTest.php
```

---

## 9. Lisensi
Proyek ini dibuat sebagai penyelesaian **Ujian Praktik Junior Programmer (JP-1)** pengelolaan Kendaraan Dinas Operasional (BMD). Bersifat *open-source* di bawah lisensi MIT.
