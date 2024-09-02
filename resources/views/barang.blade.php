@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        @include('components.sidebar.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Daftar Barang</h3>
                            <p class="text-subtitle text-muted">Informasi barang yang terdapat di RRI Surabaya</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Daftar Karyawan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary block" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter">
                            Tambah Barang
                             </button>
                             <a href="{{ route('export.pdf') }}">
                            Tambah Barang
                             </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>ID </th>
                                        <th>Nama Barang</th>
                                        <th>Kategori </th>
                                        <th>Ruangan</th>        
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Kadaluwarsa</th>
                                        <th>Gambar</th>
                                        <th>Barcode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $item)
                            <tr>
                              
                                <td>{{$item->kode_barang}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->Kategori->nama_kategori}}</td>
                                <td>{{$item->Ruangans->kode_ruang}}</td>
                                <td>{{$item->tanggal_masuk}}</td>
                                <td>{{$item->tanggal_kadaluarsa ?? '-'}}</td>
                                <td>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#imageModal" data-image-url="{{ asset('images/' . $item->bukti_gambar) }}">
                                        <i class="fas fa-image"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#modalbarcode-{{ $item->id }}">
                                        <i class="fas fa-qrcode"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateModal-{{ $item->id }}">
                                    <i class="far fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-barang-id="{{ $item->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                </td>
                            </tr>
                            @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            @include('components.footer.footer')
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gambar Bukti Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Gambar Barang" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@foreach ($barangs as $item)
<div class="modal fade" id="modalbarcode-{{ $item->id }}" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Barcode Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('barcodes/' . $item->kode_barang . '.png') }}" alt="Gambar Barang" class="img-fluid img-thumbnail">
                <a href="{{ asset('barcodes/' . $item->kode_barang . '.png') }}" download class="btn btn-success mt-3">Unduh Barcode Barang</a>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus barang ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>


    @include('components.Forms.tambahbarang')
    @include('components.Forms.updatebarang')
    <script>
        var imageModal = document.getElementById('imageModal');
        imageModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var imageUrl = button.getAttribute('data-image-url');
            var modalImage = imageModal.querySelector('#modalImage');
            modalImage.src = imageUrl;
        });
    </script>

<script>
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var barangId = button.getAttribute('data-barang-id');
        var deleteForm = deleteModal.querySelector('#deleteForm');
        deleteForm.action = '/barang/' + barangId;
    });
</script>
@endsection