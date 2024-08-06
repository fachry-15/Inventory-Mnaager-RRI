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
                        <h3>Daftar Barang</h3>
                        <p class="text-subtitle text-muted">Informasi Barang Yang Tersimpan di Dalam Sistem</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Daftar Barang</li>
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

                       @include('components.Forms.tambahbarang')

                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>Nama </th>
                                <th>Jumlah</th>
                                <th>Kategori </th>
                                <th>Ruangan</th>        
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Maintenance</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $item)
                            <tr>
                              
                                <td>{{$item->kode_barang}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->jumlah_barang}}</td>
                                <td>{{$item->kategori_barang}}</td>
                                <td>{{$item->ruangan_id}}</td>
                                <td>{{$item->tanggal_masuk}}</td>
                                <td>{{$item->tanggal_maintenace}}</td>
                                <td><a href="{{ asset('images/'.$item->bukti_gambar) }}" class="btn btn-success" data-lightbox="image-1">Lihat Gambar</a></td>
                                <td>
                                    <a href="#" class="btn btn-warning">Edit</a>
                                    <a href="#" class="btn btn-danger">Hapus</a>
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

@endsection