@extends('layouts.admin')

@section('content')
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
                        <h3>Pengembalian Barang</h3>
                        <p class="text-subtitle text-muted">Menu pengembalian barang dengan tepat dan lengkap</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pengembalian Barang</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button id="toggleButton" class="btn btn-primary mb-3">Tutup Kamera Scan Barcode</button>
            </div>
            <div id="videoPreviewSection" class="card-body text-center" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <h4>Preview Scan Barcode</h4>
                <div class="embed-responsive embed-responsive-16by9">
                    <video id="preview" class="embed-responsive-item"></video>
                </div>
            </div>
            <form action="{{ route('update.status') }}" method="POST" id="form">
                @csrf
                <input type="hidden" name="kode_barang" id="kode_barang">
            </form>

            <section class="section">
                <div class="card">

                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Kode Barang </th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Status Barang </th>
                                    <th>Tanggal Digunakan</th>        
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman as $item)
                                <tr>
                                    <td>{{$item->barang_id}}</td>
                                    <td>{{$item->barangs->nama_barang}}</td>
                                    <td>{{$item->barangs->kategori->nama_kategori}}</td>
                                    <td>{{$item->barangs->ruangans->nama_ruang}}</td>
                                    <td>
                                        @if($item->status_peminjaman == 'Sedang digunakan')
                                            <span class="badge rounded-pill bg-danger">{{$item->status_peminjaman}}</span>
                                        @else
                                            <span class="badge rounded-pill bg-success">{{$item->status_peminjaman}}</span>
                                        @endif
                                    </td>
                                    <td>{{$item->created_at->translatedFormat('l, d F Y H:i')}}</td>
                                    <td>
                                        <form id="deleteForm-{{$item->id}}" action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, 'deleteForm-{{$item->id}}')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- Form and scrolling Components end -->
        </div>

        @include('components.footer.footer')
    </div>
</div>

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
      console.log(content);
      document.getElementById('kode_barang').value = content;
      document.getElementById('form').submit();
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });
  </script>

<script>
    document.getElementById('toggleButton').addEventListener('click', function() {
        var videoPreviewSection = document.getElementById('videoPreviewSection');
        if (videoPreviewSection.style.display === 'none') {
            videoPreviewSection.style.display = 'block';
            this.textContent = 'Tutup Kamera Scan Barcode';
        } else {
            videoPreviewSection.style.display = 'none';
            this.textContent = 'Buka Kamera Scan Barcode';
        }
    });

    function confirmDeletion(event, formId) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this item?')) {
            document.getElementById(formId).submit();
        }
    }
</script>

@endsection