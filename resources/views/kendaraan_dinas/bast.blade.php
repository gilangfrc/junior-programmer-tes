<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Serah Terima KDO - {{ $kdo->no_polisi }}</title>
    <style>
        body { font-family: 'Times New Roman', serif; font-size: 11pt; line-height: 1.4; color: #000; margin: 30px; }
        .kop { text-align: center; border-bottom: 3px double #000; padding-bottom: 8px; margin-bottom: 20px; }
        .kop h2 { margin: 0; font-size: 13pt; text-transform: uppercase; }
        .kop h3 { margin: 2px 0; font-size: 15pt; font-weight: bold; text-transform: uppercase; }
        .kop p { margin: 2px 0; font-size: 10pt; }
        .title { text-align: center; font-weight: bold; margin-bottom: 5px; font-size: 12pt; text-transform: uppercase; text-decoration: underline; }
        .nomor { text-align: center; font-size: 10pt; margin-bottom: 20px; }
        .identitas-table { width: 100%; border-collapse: collapse; margin: 10px 0 15px 0; }
        .identitas-table td { padding: 4px 6px; vertical-align: top; }
        .ttd-container { margin-top: 40px; display: flex; justify-content: space-between; page-break-inside: avoid; }
        .ttd-box { width: 45%; text-align: center; font-size: 10pt; }
        @media print {
            .no-print { display: none !important; }
            body { margin: 0; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="margin-bottom: 15px; padding: 10px; background: #e0f2fe; border: 1px solid #7dd3fc; border-radius: 6px; display: flex; justify-content: space-between; align-items: center;">
        <span style="font-family: sans-serif; font-size: 12px; color: #0369a1;"><strong>Petunjuk:</strong> Cetak Berita Acara Serah Terima (BAST) untuk arsip fisik penanggung jawab kendaraan dinas.</span>
        <button onclick="window.print();" style="padding: 6px 16px; background: #0284c7; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Cetak BAST</button>
    </div>

    <!-- Kop Surat -->
    <div class="kop">
        <h2>Pemerintah Daerah Provinsi / Kabupaten / Kota</h2>
        <h3>{{ $kdo->perangkatDaerah->nama_instansi }}</h3>
        <p>{{ $kdo->perangkatDaerah->alamat ?? 'Kompleks Pusat Perkantoran Pemerintah Daerah' }}</p>
    </div>

    <div class="title">
        BERITA ACARA SERAH TERIMA KENDARAAN DINAS OPERASIONAL (KDO)
    </div>
    <div class="nomor">
        Nomor: 028 / BAST-KDO / {{ date('Y') }}
    </div>

    <p>Pada hari ini <strong>{{ \Carbon\Carbon::now()->translatedFormat('l') }}</strong> tanggal <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong>, bertempat di kantor {{ $kdo->perangkatDaerah->nama_instansi }}, kami yang bertanda tangan di bawah ini:</p>

    <!-- Pihak Pertama -->
    <table class="identitas-table">
        <tr>
            <td width="5%">I.</td>
            <td width="25%">Nama</td>
            <td width="3%">:</td>
            <td><strong>{{ $kdo->perangkatDaerah->nama_kepala ?? 'Kepala Perangkat Daerah' }}</strong></td>
        </tr>
        <tr>
            <td></td>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $kdo->perangkatDaerah->nip_kepala ?? '-' }}</td>
        </tr>
        <tr>
            <td></td>
            <td>Jabatan</td>
            <td>:</td>
            <td>Pengguna Barang / Kuasa Pengguna Barang {{ $kdo->perangkatDaerah->singkatan ?? $kdo->perangkatDaerah->nama_instansi }}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">Selanjutnya disebut sebagai <strong>PIHAK PERTAMA (Yang Menyerahkan)</strong>.</td>
        </tr>
    </table>

    <!-- Pihak Kedua -->
    <table class="identitas-table">
        <tr>
            <td width="5%">II.</td>
            <td width="25%">Nama Pegawai</td>
            <td width="3%">:</td>
            <td><strong>{{ $kdo->penanggungJawab ? $kdo->penanggungJawab->nama : '..........................................................' }}</strong></td>
        </tr>
        <tr>
            <td></td>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $kdo->penanggungJawab ? $kdo->penanggungJawab->nip : '..........................................................' }}</td>
        </tr>
        <tr>
            <td></td>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $kdo->penanggungJawab ? $kdo->penanggungJawab->jabatan : '..........................................................' }}</td>
        </tr>
        <tr>
            <td></td>
            <td>Pangkat / Golongan</td>
            <td>:</td>
            <td>{{ $kdo->penanggungJawab ? $kdo->penanggungJawab->golongan : '..........................................................' }}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">Selanjutnya disebut sebagai <strong>PIHAK KEDUA (Yang Menerima / Penanggung Jawab)</strong>.</td>
        </tr>
    </table>

    <p>PIHAK PERTAMA menyerahkan kepada PIHAK KEDUA, dan PIHAK KEDUA menerima dari PIHAK PERTAMA 1 (satu) unit Kendaraan Dinas Operasional milik Pemerintah Daerah dengan spesifikasi sebagai berikut:</p>

    <!-- Rincian Kendaraan -->
    <table class="identitas-table" style="border: 1px solid #ccc; padding: 5px; background: #fafafa;">
        <tr>
            <td width="30%"><strong>Nomor Polisi (Plat)</strong></td>
            <td width="3%">:</td>
            <td><strong>{{ $kdo->no_polisi }}</strong> (Plat Merah)</td>
        </tr>
        <tr>
            <td><strong>Merek / Tipe Model</strong></td>
            <td>:</td>
            <td>{{ $kdo->merek }} {{ $kdo->tipe }}</td>
        </tr>
        <tr>
            <td><strong>Jenis Kendaraan</strong></td>
            <td>:</td>
            <td>{{ $kdo->jenis_kendaraan }}</td>
        </tr>
        <tr>
            <td><strong>Tahun Produksi / Warna</strong></td>
            <td>:</td>
            <td>Tahun {{ $kdo->tahun_produksi }} / Warna {{ $kdo->warna }}</td>
        </tr>
        <tr>
            <td><strong>Kondisi Fisik Saat Serah Terima</strong></td>
            <td>:</td>
            <td><strong>{{ $kdo->kondisi }}</strong></td>
        </tr>
        <tr>
            <td><strong>Nomor Rangka (VIN)</strong></td>
            <td>:</td>
            <td>{{ $kdo->nomor_rangka ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Nomor Mesin</strong></td>
            <td>:</td>
            <td>{{ $kdo->nomor_mesin ?? '-' }}</td>
        </tr>
    </table>

    <p>PIHAK KEDUA berkewajiban merawat, menjaga keamanan fisik dan surat kelengkapan, serta menggunakan kendaraan tersebut semata-mata untuk kepentingan kedinasan dan operasional resmi Pemerintah Daerah.</p>

    <!-- Tanda Tangan -->
    <div class="ttd-container">
        <div class="ttd-box">
            <p>PIHAK KEDUA<br>Yang Menerima,</p>
            <br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">{{ $kdo->penanggungJawab ? $kdo->penanggungJawab->nama : '.......................................' }}</p>
            <p>NIP. {{ $kdo->penanggungJawab ? $kdo->penanggungJawab->nip : '.......................................' }}</p>
        </div>
        <div class="ttd-box">
            <p>PIHAK PERTAMA<br>Yang Menyerahkan,</p>
            <br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">{{ $kdo->perangkatDaerah->nama_kepala ?? 'Kepala Perangkat Daerah' }}</p>
            <p>NIP. {{ $kdo->perangkatDaerah->nip_kepala ?? '.......................................' }}</p>
        </div>
    </div>

</body>
</html>
