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
            
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
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
                        <form id="kategoriForm" method="POST" action="{{ route('kategori.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="kategoriName">Nama Kategori</label>
                                <input type="text" class="form-control" id="kategoriName" name="nama_kategori" placeholder="Masukkan nama kategori" required>
                            </div>
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
                <div class="row mt-4">
                    @foreach ($kategori as $item)
                    <div class="col-sm-6">
                        <div class="card border shadow">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->nama_kategori}}</h5>
                                <p class="card-text">Klik tombol di bawah ini untuk melihat lebih banyak informasi</p>
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editKategoriModal-{{ $item->id }}">
                                    <i class="far fa-edit"></i>
                                </button>
                                <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Form and scrolling Components end -->
            </div>

            @include('components.footer.footer')
        </div>
    </div>


    @foreach ($kategori as $item)
     <!-- Edit Modal -->
     <div class="modal fade" id="editKategoriModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editKategoriModalLabel-{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriModalLabel-{{ $item->id }}">Edit Kategori</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('kategori.update', $item->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kategoriName-{{ $item->id }}">Nama Kategori</label>
                            <input type="text" class="form-control" id="kategoriName-{{ $item->id }}" name="nama_kategori" value="{{ $item->nama_kategori }}" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection