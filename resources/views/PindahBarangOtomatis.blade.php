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
                        <h3>Pindah Barang Otomatis</h3>
                        <p class="text-subtitle text-muted">Menu pindah barang dengan cepat dan lebih efisien</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pindah Barang Otomatis</li>
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
            <form action="{{ route('update.ruangan') }}" method="POST" id="form">
                @csrf
                <input type="hidden" name="kode_barang" id="kode_barang">
            
                <!-- Input yang akan diisi dengan data dari localStorage -->
                <input type="hidden" name="ruangan" id="ruangan" value="">
            
                <!-- Button submit form -->
                <button style="display: none" type="submit" class="btn btn-primary">Submit</button>
            </form>
            <section class="section">
                <div class="card">

                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Kode Barang </th>
                                    <th>Nama Barang</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal Pengambilan</th>     
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $item)
                                <tr>
                                    <td>{{$item->kode_barang}}</td>
                                    <td>{{$item->nama_barang}}</td>
                                    <td>{{$item->Ruangans->nama_ruang}}</td>
                                    <td>{{$item->created_at}}</td>
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
    // JavaScript to retrieve form data from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('ruangan').value = localStorage.getItem('ruangan');
    });
</script>
@endsection