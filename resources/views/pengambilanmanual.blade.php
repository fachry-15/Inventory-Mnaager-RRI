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
                        <h3>Pengambilan Barang</h3>
                        <p class="text-subtitle text-muted">Menu pengambilan barang dengan tepat dan lengkap</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pengambilan Barang</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Status Barang</th>
                                    <th>Tanggal Penggunaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman as $item)
                                <tr>
                                    <td>{{ $item->barang_id }}</td>
                                    <td>{{ $item->barangs->nama_barang }}</td>
                                    <td>{{ $item->barangs->kategori->nama_kategori }}</td>
                                    <td>
                                        @if($item->status_peminjaman == 'Sedang digunakan')
                                            <span class="badge rounded-pill bg-danger">{{ $item->status_peminjaman }}</span>
                                        @else
                                            <span class="badge rounded-pill bg-success">{{ $item->status_peminjaman }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->translatedFormat('l, d F Y H:i') }}</td>
                                    <td>

                                        <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @if($item->status_peminjaman == 'Sedang digunakan')
                                        <form action="{{ route('peminjaman.updateStatus', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-undo-alt"></i> Kembalikan
                                            </button>
                                        </form>
                                    @endif
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
@endsection