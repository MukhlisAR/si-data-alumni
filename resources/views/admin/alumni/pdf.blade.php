<!DOCTYPE html>
<html>
<head>
    <title>Data Alumni</title>
    <style>
        /* Reset dasar agar kertas bersih */
        body {
            font-family: sans-serif;
            font-size: 11px; /* Dikecilkan sedikit agar muat foto */
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

        /* Tabel Data Utama */
        table {
            width: 100%;
            border-collapse: collapse; 
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #999;
            padding: 6px 8px;
            vertical-align: top;
            text-align: left;
        }

        th {
            background-color: #eee;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

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
    </style>
</head>
<body>

    <div class="header">
        <h1>Buku Kenangan & Data Alumni</h1>
        <p>
            {{ $year ? 'Angkatan / Tahun Lulus: ' . $year : 'Seluruh Angkatan' }} <br>
            Dicetak Tanggal: {{ date('d F Y') }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 12%; text-align: center;">Foto</th>
                <th style="width: 25%;">Nama & NIM</th>
                <th style="width: 18%;">Jurusan & Angkatan</th>
                <th style="width: 20%;">Pekerjaan</th>
                <th style="width: 20%;">Kontak / Alamat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumnis as $index => $data)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                
                <td style="text-align: center;">
                    @if($data->photo)
                        <img src="{{ public_path('storage/' . $data->photo) }}" style="width: 50px; height: 60px; object-fit: cover; border: 1px solid #ccc;">
                    @else
                        <div style="width: 50px; height: 60px; background-color: #e2e8f0; border: 1px solid #ccc; display: inline-block;">
                            <span style="font-size: 9px; color: #94a3b8; display: block; margin-top: 25px;">No Photo</span>
                        </div>
                    @endif
                </td>

                <td>
                    <strong style="font-size: 12px;">{{ $data->user->name }}</strong><br>
                    <span style="color: #555;">NIM: {{ $data->nim }}</span>
                </td>
                <td>
                    {{ $data->major }} <br>
                    Lulus: <strong>{{ $data->graduation_year }}</strong>
                </td>
                <td>
                    @if($data->job_title)
                        <strong>{{ $data->job_title }}</strong><br>
                        <span style="font-size: 10px;">at {{ $data->company }}</span>
                    @else
                        <span style="color: #999;">-</span>
                    @endif
                </td>
                <td>
                    Telp: {{ $data->phone }} <br>
                    <span style="font-size: 10px; color: #555;">{{ Str::limit($data->address, 50) }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">
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