<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff0f5; /* pink lembut */
            color: #333;
        }

        h1 {
            text-align: center;
            color: #d63384; /* pink elegan */
            margin-bottom: 30px;
        }

        .fasilitas-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(214, 51, 132, 0.2);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .fasilitas-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(214, 51, 132, 0.3);
        }

        .fasilitas-card h2 {
            margin: 0;
            color: #d63384;
            font-size: 1.3em;
        }

        .fasilitas-card p {
            margin: 8px 0;
            line-height: 1.5;
        }

        strong {
            color: #a61e4d;
        }
    </style>
</head>
<body>
    <h1>{{ $judul }}</h1>
    
    @foreach ($fasilitas as $f)
    <div class="fasilitas-card">
        <h2>{{ $f['nama'] }} ({{ $f['jenis'] }})</h2>
        <p><strong>Alamat:</strong> {{ $f['Alamat'] }} RT {{ $f['rt'] }}/RW {{ $f['rw']}}</p>
        <p><strong>Kapasitas:</strong> {{ $f['Kapasitas'] }} orang</p>
        <p><strong>Deskripsi:</strong> {{ $f['deskripsi'] }}</p>
    </div>
    @endforeach

</body>
</html>
