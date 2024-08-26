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
                            <p class="text-subtitle text-muted">Menu pengembalia barang dengan tepat dan lengkap</p>
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
                <div class="row mt-4">
                    <div class="col-sm-6">
                        <div class="card border shadow">
                            <div class="card-body">
                                <h5 class="card-title">Pengembalian Barang Otomatis</h5>
                                <p class="card-text">Pengembalian Barang menggunakan kamera deteksi secara cepat</p>
                                <a href=" {{ route('pengembalianotomatis') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card border shadow">
                            <div class="card-body">
                                <h5 class="card-title">Pengembalian Barang Secara Manual</h5>
                                <p class="card-text">Pengembalian Barang secara manual dan pancataan sistem</p>
                                <a href="{{ route('pemindahanmanual') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form and scrolling Components end -->
            </div>

            @include('components.footer.footer')
        </div>
    </div>
@endsection