<!DOCTYPE html>
<html>
<head>
    <title>Buku Kenangan Alumni</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .alumni-card { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; page-break-inside: avoid; }
        .photo { width: 100px; height: 100px; object-fit: cover; border-radius: 5px; float: left; margin-right: 15px; background: #eee; }
        .info { overflow: hidden; }
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
    <div class="alumni-card">
        @if($data->photo)
            <img src="{{ public_path('storage/' . $data->photo) }}" class="photo">
        @else
            <div class="photo" style="text-align:center; line-height:100px; color:#999;">No Photo</div>
        @endif
        
        <div class="info">
            <h3>{{ $data->user->name ?? 'N/A' }}</h3>
            <p><strong>NISN:</strong> {{ $data->nisn ?? '-' }}</p>
            <p><strong>TTL:</strong> {{ $data->tempat_lahir ?? '-' }}, {{ $data->tanggal_lahir ?? '-' }}</p>
            <p><strong>Jenis Kelamin:</strong> {{ $data->jenis_kelamin ?? '-' }}</p>
            <p><strong>Tahun Lulus:</strong> {{ $data->graduation_year ?? '-' }}</p>
            <p><strong>Jurusan:</strong> {{ $data->major ?? '-' }}</p>
            <p><strong>Pekerjaan:</strong> {{ $data->job_title ?? '-' }} di {{ $data->company ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $data->address ?? '-' }}</p>
        </div>
        <div style="clear: both;"></div>
    </div>
    @endforeach
</body>
</html>