<!-- resources/views/pdf/barang.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 20mm;
        }
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #000;
            box-sizing: border-box;
            overflow: hidden;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            text-transform: uppercase;
        }
        .header p {
            font-size: 14px;
            margin: 0;
        }
        .content {
            margin-top: 10px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
        }
        .content th, .content td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
        }
        .content img {
            max-width: 80px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Daftar Barang</h1>
            <p>Kantor Walikota Example</p>
            <p>Jalan Pemerintah No. 1, Kota Example, 12345</p>
        </div>

        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Ruangan</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Kadaluwarsa</th>
                        <th>Gambar</th>
                        <th>Barcode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $barang)
                    <tr>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->Kategori->nama_kategori }}</td>
                        <td>{{ $barang->Ruangans->kode_ruang }}</td>
                        <td>{{ $barang->tanggal_masuk }}</td>
                        <td>{{ $barang->tanggal_kadaluarsa ? $barang->tanggal_kadaluarsa : '-' }}</td>
                        <td><img src="{{ public_path('images/' . $barang->bukti_gambar) }}" alt="Gambar Barang"></td>
                        <td><img src="{{ public_path('barcodes/' . $barang->kode_barang . '.png') }}" alt="Barcode"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
