# Daftar Screenshot Wajib (Ketentuan Track Full Stack — JP-1)

Direktori ini memuat bukti hasil aplikasi yang berjalan secara nyata (*Frontend UI* + *Pengujian REST API*) sesuai ketentuan ujian praktik Junior Programmer (`JP-1`).

## Checklist Screenshot yang Wajib Dimasukkan:

### A. Tampilan Aplikasi Web (Frontend)
1. `01-dashboard.png` — Halaman **Dashboard Eksekutif** (KPI card, bar distribusi kondisi, tabel KDO terakhir, dan rekap per OPD).
2. `02-kdo-list-filter.png` — Halaman **List Kendaraan Dinas (KDO)** lengkap dengan toolbar filter & pencarian.
3. `03-kdo-form-create.png` — Halaman **Form Tambah / Ubah KDO** (menampilkan validasi plat nomor & custom select PNS).
4. `04-kdo-detail-audit-trail.png` — Halaman **Detail Unit KDO (KIB)** menampilkan spesifikasi, instansi, penanggung jawab, dan timeline **Audit Trail BMD**.
5. `05-pegawai-list-detail.png` — Halaman **List / Detail Pegawai PNS**.
6. `06-perangkat-daerah-list-detail.png` — Halaman **List / Detail Perangkat Daerah (OPD)**.
7. `07-cetak-rekap-bast.png` — Tampilan fitur nilai tambah **Cetak Rekapitulasi BMD / BAST**.

### B. Bukti Pengujian REST API (Backend)
8. `08-api-tester-get.png` — Bukti eksekusi **GET** (`/api/kendaraan-dinas` atau `/api/dashboard/stats`) pada Interactive API Tester (`/api-docs`) atau Postman/cURL yang memperlihatkan Request URL, HTTP Status `200 OK`, dan JSON payload.
9. `09-api-tester-post-put-audit.png` — Bukti eksekusi **POST (`201 Created`)** & **PUT (`200 OK`)** yang membuktikan respon JSON sukses serta penambahan riwayat kondisi (*Audit Trail*).
