<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <td>Kode Barang</td>
        <td>Nama Barang</td>
        <td>Kategori</td>
        <td>Ruangan</td>
        <td>Bukti Gambar</td>
        <td>Kode Barang</td>
    </tr>
    @foreach ($barangs as $item)
    <tr>
        <td>{{ $item->kode_barang }}</td>
        <td>{{ $item->nama_barang }}</td>
        <td>{{ $item->Kategori->nama_kategori }}</td>
        <td>{{ $item->Ruangans->nama_ruang }}</td>
        <td><img src="{{ public_path('images/'.$item->bukti_gambar) }}" alt="gambar" width="100px"></td>
        <td><img src="{{ public_path('barcodes/' . $item->kode_barang . '.png') }}" alt="Gambar Barang" class="img-fluid img-thumbnail"></td>
    </tr>
    @endforeach
</table>
</body>
</html>