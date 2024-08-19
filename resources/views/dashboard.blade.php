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
                                                <h6 class="font-extrabold mb-0">112</h6>
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
                                                <h6 class="text-muted font-semibold">Kategori</h6>
                                                <h6 class="font-extrabold mb-0">10</h6>
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
                                                <h6 class="font-extrabold mb-0">8</h6>
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
                                                <h6 class="text-muted font-semibold">Booking</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                          <table class="table table-striped" id="table1">
                              <thead>
                                <tr>
                                  <th>ID </th>
                                  <th>Nama </th>
                                  <th>Jumlah </th>
                                  <th>Satuan </th>
                                  <th>Kategori </th>
                                  <th>Ruangan</th>
                                  <th>Pj</th>
                                  <th>Gambar</th>
                                  <th>Tanggal Masuk</th>
                                  <th>Tanggal Selesai</th>
                                  <th>Aksi</th>
                              </tr>
                              </thead>
                                  <tbody>
                                    <tr>
                                      <td>EDS324</td>
                                      <td>laptop ASUS</td>
                                      <td>10</td>
                                      <td>unit</td>
                                      <td>Laptop</td>
                                      <td>TMB</td>
                                      <td>Desi S.Tr</td>
                                      <td>-</td>
                                      <td>10 januari 2025</td>
                                      <td>2027</td>
                                      <td>
                                          <button class="btn btn-success">edit</button>
                                      </td>
                                  </tr>
                                  </tbody>
                          </table>
                      </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>ID </th>
                                        <th>Nama </th>
                                        <th>Jumlah </th>
                                        <th>Satuan </th>
                                        <th>Kategori </th>
                                        <th>Ruangan</th>
                                        <th>Pj</th>
                                        <th>Gambar</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr>
                                        <td>EDS324</td>
                                        <td>laptop ASUS</td>
                                        <td>10</td>
                                        <td>unit</td>
                                        <td>Laptop</td>
                                        <td>TMB</td>
                                        <td>Desi S.Tr</td>
                                        <td>-</td>
                                        <td>10 januari 2025</td>
                                        <td>2027</td>
                                        <td>
                                            <button class="btn btn-success">edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>EDS324</td>
                                        <td>laptop ASUS</td>
                                        <td>10</td>
                                        <td>unit</td>
                                        <td>Laptop</td>
                                        <td>TMB</td>
                                        <td>Jono S.E</td>
                                        <td>-</td>
                                        <td>10 januari 2025</td>
                                        <td>2027</td>
                                        <td>
                                            <button class="btn btn-success">edit</button>
                                        </td>
                                    </tr>
                                </thead>
                                </tbody>
                            </table>
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
                                        <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                        <h6 class="text-muted mb-0">{{ Auth::user()->email }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Kode Ruangan</th>
                                <th>Nama Ruangan</th>
                                <th>Lantai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                            <tbody>
                                <tr>
                                    <td>Graiden</td>
                                    <td>Teknik Media Baru</td>
                                    <td>1</td>
                                    <td>
                                        <span class="badge bg-success">Edit</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Graiden</td>
                                    <td>Teknik Media Baru</td>
                                    <td>1</td>
                                    <td>
                                        <span class="badge bg-success">Edit</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PPS</td>
                                    <td>Penyiaran Berita</td>
                                    <td>3</td>
                                    <td>
                                        <span class="badge bg-success">Edit</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PPS</td>
                                    <td>Penyiaran Berita</td>
                                    <td>3</td>
                                    <td>
                                        <span class="badge bg-success">Edit</span>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">nisa cans</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
  
    @endsection