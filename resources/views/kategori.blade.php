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
                            <h3>Kategori</h3>
                            <p class="text-subtitle text-muted">Informasi Seluruh Kategori</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Modal</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Modal Sizes start -->
            
                <button type="button" class="btn btn-outline-secondary mt-3" data-bs-toggle="modal"
                data-bs-target="#tambahKategoriModal">
                Tambah Kategori
            </button>
            <!-- Modal -->
            <div class="modal fade" id="tambahKategoriModal" tabindex="-1" role="dialog"
            aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form content for adding a category -->
                        <form>
                            <div class="form-group">
                                <label for="kategoriName">Nama Kategori</label>
                                <input type="text" class="form-control" id="kategoriName"
                                    placeholder="Masukkan nama kategori">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Modal -->
    

                    </div>
                </section>
                <section id="basic-modals">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Kabel</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Button trigger for basic modal -->
                                    <a class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#default">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </section>
                <!-- Form and scrolling Components end -->
            </div>

            @include('components.footer.footer')
        </div>
    </div>
@endsection