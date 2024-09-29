@extends('layouts.admin')

@section('content')
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
                <h3>Halaman Utama</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Barang</h6>
                                                <h6 class="font-extrabold mb-0">{{ count($barang) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Kantor</h6>
                                                <h6 class="font-extrabold mb-0">{{ count($kantor)}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Ruangan</h6>
                                                <h6 class="font-extrabold mb-0">{{ count($ruangan)}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Digunakan</h6>
                                                <h6 class="font-extrabold mb-0">{{ count($digunakan) > 0 ? count($digunakan) : 0 }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="assets/images/faces/1.jpg" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold"> {{ Auth::user()->role}} </h5>
                                        <h6 class="text-muted mb-0">{{ Auth::user()->email }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="card-body">
                    <div class="page-heading">
                        <h5>Barang Terbaru</h5>
                    </div>
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Ruangan</th>
                                <th>Sumber</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $item)
                                <tr>
                                    <th>{{ $item->kode_barang}}</th>
                                    <th>{{ $item->nama_barang}}</th>
                                    <th>{{ $item->kategori->nama_kategori}}</th>
                                    <th>{{ $item->ruangans->nama_ruang}}</th>
                                    <th>{{ $item->sumber_barang}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-body">
                    <div class="page-heading">
                        <h5>Barang Sedang Digunakan</h5>
                    </div>
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Ruangan</th>
                                <th>Sumber</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $item)
                                <tr>
                                    <th>{{ $item->kode_barang}}</th>
                                    <th>{{ $item->nama_barang}}</th>
                                    <th>{{ $item->kategori->nama_kategori}}</th>
                                    <th>{{ $item->ruangans->nama_ruang}}</th>
                                    <th>{{ $item->sumber_barang}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-body">
                    <div class="page-heading">
                        <h5>Ruangan</h5>
                    </div>
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th>Kode Ruangan</th>
                                <th>Nama Ruangan</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ruangan as $item)
                                <tr>
                                    <th>{{ $item->kode_ruang}}</th>
                                    <th>{{ $item->nama_ruang}}</th>
                                    <th>Lantai {{ $item->lantai}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
  
    @endsection