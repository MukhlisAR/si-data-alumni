<!DOCTYPE html>
<html>
<head>
    <title>Buku Kenangan Alumni</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        
        /* Mengubah struktur menjadi Tabel agar DomPDF tidak error saat pindah halaman */
        .alumni-card { width: 100%; border: 1px solid #ddd; margin-bottom: 15px; page-break-inside: avoid; border-collapse: collapse; }
        .alumni-card td { padding: 15px; vertical-align: top; }
        
        .photo-cell { width: 110px; text-align: center; }
        .photo { width: 100px; height: 100px; object-fit: cover; border-radius: 5px; background: #eee; }
        
        h3 { margin-top: 0; margin-bottom: 5px; }
        p { margin: 3px 0; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>BUKU KENANGAN ALUMNI</h2>
        <p>Sistem Informasi Data Alumni</p>
    </div>

    @foreach($alumnis as $data)
    <table class="alumni-card">
        <tr>
            <td class="photo-cell">
                @if($data->photo)
                    @php
                        $kemungkinan1 = storage_path('app/public/' . $data->photo);
                        $kemungkinan2 = public_path('storage/' . $data->photo);
                        $kemungkinan3 = storage_path('app/public/foto/' . $data->photo);
                        $kemungkinan4 = storage_path('app/public/photos/' . $data->photo);

                        $pathAsli = null;
                        if (file_exists($kemungkinan1)) { $pathAsli = $kemungkinan1; }
                        elseif (file_exists($kemungkinan2)) { $pathAsli = $kemungkinan2; }
                        elseif (file_exists($kemungkinan3)) { $pathAsli = $kemungkinan3; }
                        elseif (file_exists($kemungkinan4)) { $pathAsli = $kemungkinan4; }

                        $base64 = '';
                        if ($pathAsli != null) {
                            $type = pathinfo($pathAsli, PATHINFO_EXTENSION);
                            $fileData = file_get_contents($pathAsli);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($fileData);
                        }
                    @endphp
                    
                    @if($base64 != '')
                        <img src="{{ $base64 }}" class="photo">
                    @else
                        <div class="photo" style="line-height:100px; font-size:10px; color:#999; word-wrap: break-word;">
                            Cek DB: {{ $data->photo }}
                        </div>
                    @endif
                @else
                    <div class="photo" style="line-height:100px; color:#999;">No Photo</div>
                @endif
                </td>
            
            <td>
                <h3>{{ $data->user->name ?? 'N/A' }}</h3>
                <p><strong>NISN:</strong> {{ $data->nisn ?? '-' }}</p>
                <p><strong>TTL:</strong> {{ $data->tempat_lahir ?? '-' }}, {{ $data->tanggal_lahir ?? '-' }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $data->jenis_kelamin ?? '-' }}</p>
                <p><strong>Tahun Lulus:</strong> {{ $data->graduation_year ?? '-' }}</p>
                <p><strong>Jurusan:</strong> {{ $data->major ?? '-' }}</p>
                <p><strong>Pekerjaan:</strong> {{ $data->job_title ?? '-' }} di {{ $data->company ?? '-' }}</p>
                <p><strong>Alamat:</strong> {{ $data->address ?? '-' }}</p>
            </td>
        </tr>
    </table>
    @endforeach
</body>
</html>