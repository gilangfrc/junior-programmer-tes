<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi Kendaraan Dinas Operasional (BMD)</title>
    <style>
        body { font-family: 'Times New Roman', serif; font-size: 11pt; line-height: 1.3; color: #000; margin: 20px; }
        .kop { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .kop h2 { margin: 0; font-size: 14pt; text-transform: uppercase; }
        .kop h3 { margin: 2px 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; }
        .kop p { margin: 2px 0; font-size: 10pt; }
        .title { text-align: center; font-weight: bold; margin-bottom: 15px; font-size: 12pt; text-transform: uppercase; text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 9pt; }
        table, th, td { border: 1px solid #000; }
        th { background-color: #f2f2f2; padding: 6px; text-align: center; font-weight: bold; }
        td { padding: 5px 6px; }
        .text-center { text-align: center; }
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
        <span style="font-family: sans-serif; font-size: 12px; color: #0369a1;"><strong>Petunjuk Cetak:</strong> Klik tombol Cetak untuk mencetak atau simpan ke PDF.</span>
        <button onclick="window.print();" style="padding: 6px 16px; background: #0284c7; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Cetak Dokumen (Ctrl+P)</button>
    </div>

    <!-- Kop Surat -->
    <div class="kop">
        <h2>Pemerintah Daerah Provinsi / Kabupaten / Kota</h2>
        <h3>Badan Pengelola Keuangan dan Aset Daerah (BPKAD)</h3>
        <p>Bidang Pengelolaan Barang Milik Daerah &bull; Kompleks Balai Kota Jl. Jenderal Sudirman</p>
    </div>

    <div class="title">
        Daftar Rekapitulasi Inventaris Kendaraan Dinas Operasional (KDO)
    </div>

    <div style="font-size: 10pt; margin-bottom: 10px;">
        <div><strong>Instansi:</strong> {{ $filterOpd ? $filterOpd->nama_instansi : 'Seluruh Perangkat Daerah (OPD)' }}</div>
        <div><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
        <div><strong>Total Armada:</strong> {{ $kdos->count() }} Unit Kendaraan</div>
    </div>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="14%">Nomor Polisi</th>
                <th width="20%">Merek / Tipe Model</th>
                <th width="8%">Tahun</th>
                <th width="10%">Kondisi</th>
                <th width="22%">Perangkat Daerah</th>
                <th width="22%">PNS Penanggung Jawab</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kdos as $index => $kdo)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center" style="font-weight: bold;">{{ $kdo->no_polisi }}</td>
                <td>{{ $kdo->merek }} {{ $kdo->tipe }}</td>
                <td class="text-center">{{ $kdo->tahun_produksi }}</td>
                <td class="text-center" style="font-weight: bold;">{{ $kdo->kondisi }}</td>
                <td>{{ $kdo->perangkatDaerah->nama_instansi }}</td>
                <td>
                    @if($kdo->penanggungJawab)
                        {{ $kdo->penanggungJawab->nama }}<br>
                        <small>NIP. {{ $kdo->penanggungJawab->nip }}</small>
                    @else
                        <em>Pool Dinas (Belum Ditugaskan)</em>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data kendaraan dinas tercatat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <div class="ttd-container">
        <div class="ttd-box">
            <p>Mengetahui,<br>Kepala Bidang Aset & BMD</p>
            <br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">Drs. H. Fajar Nugroho, M.Si.</p>
            <p>NIP. 19840214 200801 1 003</p>
        </div>
        <div class="ttd-box">
            <p>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>Pengurus Barang Pengelola</p>
            <br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">Rian Hidayat, S.Kom.</p>
            <p>NIP. 19920104 201502 1 004</p>
        </div>
    </div>

</body>
</html>
