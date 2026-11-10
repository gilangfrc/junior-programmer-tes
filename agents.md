# Dokumentasi Penggunaan Asisten AI (`agents.md`)

**Proyek:** SIM-KDO (Sistem Informasi Manajemen Kendaraan Dinas Operasional - BMD)  
**Kode Soal Ujian:** Ujian Praktik Junior Programmer (`JP-1` / `JP-3`)  
**Kategori Pengerjaan:** Full Stack (Frontend UI + Backend REST API Terintegrasi)  

---

## 1. Deklarasi Transparansi Penggunaan AI

Sesuai dengan ketentuan pengerjaan dan etika kejujuran akademik/seleksi pada dokumen soal **JP-3**, saya menyatakan secara terbuka dan jujur bahwa dalam pengerjaan proyek ini **menggunakan bantuan AI Coding Assistant (Google Antigravity Agent)** sebagai *pair programmer*.

Dokumen `agents.md` ini disusun dan di-commit ke repositori publik sebagai bentuk transparansi penuh mengenai bagaimana AI digunakan, bagian mana yang diarahkan oleh peserta, serta bagaimana seluruh kode diverifikasi kebenarannya.

---

## 2. Peran & Kontrol Peserta (*Human-in-the-Loop*)

Seluruh rancangan utama, validasi bisnis, peninjauan antarmuka di browser, serta uji coba hasil akhir dikendalikan langsung oleh peserta:

1. **Analisis Soal & Kebutuhan Bisnis:** Peserta menganalisis dokumen soal JP-1/JP-3 untuk menentukan 3 entitas wajib (`KendaraanDinas`, `Pegawai`, `PerangkatDaerah`), proses bisnis pengelolaan Barang Milik Daerah (BMD), serta merancang entitas nilai tambah `RiwayatKondisi` sebagai *Audit Trail* otomatis dan fitur cetak BAST/Rekap BMD.
2. **Pengendalian Desain & Quality Assurance UI/UX:** Peserta melakukan inspeksi visual langsung pada seluruh halaman di browser (menggunakan data uji nyata Pemda), mengidentifikasi bug layout, tabrakan kolom tabel, badge terpotong 2 baris, perilaku scroll sidebar/header, serta memberikan arahan perbaikan spesifik hingga UI mencapai standar *enterprise-grade*.
3. **Verifikasi Kepatuhan Soal:** Peserta mengaudit proyek terhadap bobot penilaian, ketentuan kelengkapan Git, RDBMS dump database, dan kelayakan endpoint REST API.

---

## 3. Cakupan Bantuan AI & Log Iterasi Pengembangan

AI digunakan secara terstruktur sebagai akselerator penulisan kode dan debugging dengan tahapan berikut:

### Tahap 1: Perancangan Database & Model Relasional (RDBMS)
- **Prompt/Arahan:** Merancang struktur tabel berurutan sesuai konvensi Laravel 11 + MySQL (`perangkat_daerahs`, `pegawais`, `kendaraan_dinas`, `riwayat_kondisis`).
- **Output & Review:** Validasi relasi *Foreign Key* (`ON DELETE CASCADE` untuk OPD & riwayat kondisi, `ON DELETE SET NULL` saat pegawai penanggung jawab dihapus agar unit otomatis kembali ke Pool Dinas).

### Tahap 2: Implementasi Backend Web & RESTful API
- **Prompt/Arahan:** Menyusun *Controller*, *Form Request Validation* (`Store*Request`, `Update*Request`), *API JsonResources*, dan memisahkan penamaan route `api.*` di `routes/api.php` agar tidak bentrok dengan route Blade di `routes/web.php`.
- **Logika Bisnis Audit Trail:** Setiap `store` atau perubahan `kondisi` pada `update` (baik via Web maupun REST API) otomatis memicu pencatatan historis ke tabel `riwayat_kondisis`.

### Tahap 3: Refactoring & Standardisasi UI/UX (Tailwind CSS)
Berdasarkan hasil pengecekan visual langsung oleh peserta di browser, AI diarahkan untuk melakukan beberapa kali iterasi perbaikan UI:
- Perubahan layout navigasi dari topbar ke **fixed sidebar** dengan main content scrollable independen dan top header solid (*opaque*).
- Penambahan **custom searchable dropdown** untuk pemilihan PNS Penanggung Jawab, custom checkbox, custom file upload foto unit, serta validasi langsung format Nomor Polisi (Plat Merah).
- Penyeragaman desain enterprise tanpa emoji, penggunaan `table-fixed` + `<colgroup>` agar seluruh kolom tabel terlihat tanpa *horizontal scrollbar*, pemotongan teks panjang (`truncate`) disertai hover tooltip (`title`), dan penyeragaman pill badge status 1 baris dengan *dot indicator*.
- Pembuatan komponen reusable **Modal Konfirmasi Delete** agar konsisten di seluruh modul CRUD.

### Tahap 4: Interactive REST API Tester (`/api-docs`) & Automated Testing
- Membangun halaman `/api-docs` yang merangkum **20 endpoint** (CRUD penuh 3 entitas + Statistik Dashboard) dilengkapi tab filter kategori, simulasi `PUT` yang memicu audit trail otomatis, modal konfirmasi `DELETE`, pengukur latency (`ms`), dan generator perintah `cURL`.
- Menulis serta menjalankan feature test suite di `tests/Feature/` (`KendaraanDinasTest` & `PegawaiAndPerangkatDaerahTest`) menggunakan `RefreshDatabase` untuk memastikan seluruh fitur Web CRUD, API CRUD, validasi, cetak laporan, dan audit trail berjalan tanpa regresi.

---

## 4. Pedoman & Standar Teknis Proyek untuk Agen / Pengembang

Jika pengembangan dilanjutkan menggunakan agen AI maupun secara manual, kode wajib mematuhi konvensi berikut:

1. **Arsitektur & Keamanan Dasar:**
   - Seluruh input wajib melewati kelas `FormRequest` di `app/Http/Requests/`.
   - Gunakan Eloquent ORM / parameter binding; dilarang melakukan string concatenation query SQL mentah dari input user.
   - Proteksi Mass-Assignment menggunakan properti `$fillable` secara eksplisit pada setiap Model.
   - Rute `/api/*` wajib mengembalikan respon JSON yang konsisten (`success`, `message`, `data`) termasuk untuk `404` dan `422` (dikonfigurasi di `bootstrap/app.php`).
2. **Standar Antarmuka (UI/UX):**
   - Tidak menggunakan emoji di komponen UI aplikasi; gunakan SVG icon yang rapi.
   - Tabel data di desktop wajib muat 100% lebar container tanpa *horizontal scroll* dengan kombinasi `table-fixed`, `<colgroup>`, dan `truncate`.
   - Badge kondisi kendaraan (`Baik`, `Rusak Ringan`, `Rusak Berat`) dan plat nomor polisi wajib menggunakan `whitespace-nowrap` agar tidak terpecah menjadi dua baris.
3. **Alur Verifikasi Sebelum Commit:**
   - Jalankan `npm run build` untuk memastikan seluruh kelas utility Tailwind CSS v4 ter-compile.
   - Jalankan `php artisan test` dan pastikan seluruh test suite berstatus **passed** sebelum melakukan `git push`.
