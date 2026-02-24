<!DOCTYPE html>
<html>
<head>
    <title>Data Alumni</title>
    <style>
        /* Reset dasar agar kertas bersih */
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        /* Header Laporan */
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px double #444;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
        }

        /* Tabel Data Utama - Kunci Kerapian */
        table {
            width: 100%;
            border-collapse: collapse; /* Menyatukan garis border */
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #999;
            padding: 8px 10px;
            vertical-align: top; /* Agar teks selalu mulai dari atas */
            text-align: left;
        }

        /* Warna Header Tabel */
        th {
            background-color: #eee;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }

        /* Zebra Striping (Warna selang-seling baris) */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Mencegah baris terpotong saat ganti halaman */
        tr {
            page-break-inside: avoid;
        }

        .footer {
            font-style: italic;
            font-size: 10px;
            text-align: right;
            margin-top: 20px;
            color: #777;
        }
        
        /* Badge Status */
        .badge {
            display: inline-block;
            padding: 2px 5px;
            font-size: 9px;
            background-color: #ddd;
            border-radius: 3px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Data Alumni</h1>
        <p>
            {{ $year ? 'Angkatan / Tahun Lulus: ' . $year : 'Seluruh Angkatan' }} <br>
            Dicetak Tanggal: {{ date('d F Y') }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama & NIM</th>
                <th style="width: 20%;">Jurusan & Angkatan</th>
                <th style="width: 25%;">Pekerjaan</th>
                <th style="width: 25%;">Kontak / Alamat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumnis as $index => $data)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>
                    <strong style="font-size: 13px;">{{ $data->user->name }}</strong><br>
                    <span style="color: #555;">NIM: {{ $data->nim }}</span>
                </td>
                <td>
                    {{ $data->major }} <br>
                    Lulus: <strong>{{ $data->graduation_year }}</strong>
                </td>
                <td>
                    @if($data->job_title)
                        <strong>{{ $data->job_title }}</strong><br>
                        at {{ $data->company }}
                    @else
                        <span style="color: #999;">- Belum diisi -</span>
                    @endif
                </td>
                <td>
                    Telp: {{ $data->phone }} <br>
                    <span style="font-size: 10px; color: #555;">{{ Str::limit($data->address, 50) }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px;">
                    Tidak ada data alumni yang ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak otomatis oleh Sistem Informasi Alumni.
    </div>

</body>
</html>