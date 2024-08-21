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
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Daftar Karyawan</h3>
                            <p class="text-subtitle text-muted">Informasi daftar Karyawan</p>
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
                <!-- Modal Sizes start -->
            <!-- Modal -->
            <div class="modal fade" id="tambahkaryawan" tabindex="-1" role="dialog"
            aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Karyawan</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form content for adding a category -->
                        <form id="kategoriForm" method="POST" action="{{ route('kategori.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="kategoriName">Nama pemilik akun</label>
                                <input type="text" class="form-control" id="kategoriName" name="name" placeholder="Masukkan nama pemilik akun" required>
                            </div>
                            <div class="form-group">
                                <label for="kategoriName">Email</label>
                                <input type="text" class="form-control" id="kategoriName" name="email" placeholder="Masukkan email yang akan anda gunakan" required>
                            </div>
                            <div class="form-group">
                                <label for="kategoriName">Password</label>
                                <input type="password" class="form-control" id="kategoriName" name="password" placeholder="Masukkan kata sandi yang kuat" required>
                            </div>
                            <input type="hidden" value="admin">
                            <div class="modal-footer">








































































































































































































































































































































































































































































































































































































































































































                                
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <!-- End of Modal -->
    

                    </div>
                </section>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary block" data-bs-toggle="modal"
                            data-bs-target="#tambahkaryawan">
                            Tambah Karyawan
                             </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Karyawan</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($akun as $item)
                                    <tr>
                                        <td>1</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter">
                                            <i class="far fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter">
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
                <!-- Form and scrolling Components end -->
            </div>

            @include('components.footer.footer')
        </div>
    </div>


@endsection