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
                        <h3>Pindah Barang</h3>
                        <p class="text-subtitle text-muted">Menu pindah barang dengan tepat dan lengkap</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pindah Barang</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="row mt-4">
                <div class="col-sm-6">
                    <div class="card border shadow">
                        <div class="card-body">
                            <h5 class="card-title">Pindah Barang Otomatis</h5>
                            <p class="card-text">Pengambilan Barang menggunakan kamera deteksi secara cepat</p>
                            <!-- Open Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#otomatisModal">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card border shadow">
                        <div class="card-body">
                            <h5 class="card-title">Pindah Barang Secara Manual</h5>
                            <p class="card-text">Pengambilan Barang secara manual dan pencatatan sistem</p>
                            <a href="{{ route('pemindahanmanual') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="otomatisModal" tabindex="-1" aria-labelledby="otomatisModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="otomatisModalLabel">Pengambilan Otomatis</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="pengambilanForm">
                                @csrf
                                <!-- Kegiatan Input -->
                                <div class="mb-3">
                                    <label for="ruangan" class="form-label">Nama Ruangan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-door-open"></i> <!-- Icon untuk mempercantik -->
                                            </span>
                                        </div>
                                        <select class="form-select" id="ruangan" name="ruangan" required>
                                            <option value="" disabled selected>Pilih ruangan tujuan pemindahan barang</option>
                                            @foreach($ruangan as $r)
                                                <option value="{{ $r->id }}">{{ $r->nama_ruang }} - {{$r->kode_ruang}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary" id="saveData">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.footer.footer')
        </div>
    </div>

    <script>
        // JavaScript to save form data in localStorage and redirect to Pengambilan Manual page
        document.getElementById('saveData').addEventListener('click', function() {
            let ruangan = document.getElementById('ruangan').value;

            // Simpan data ke localStorage
            localStorage.setItem('ruangan', ruangan);

            // Redirect ke halaman Pengambilan Manual setelah data disimpan
            window.location.href = "{{ route('pindahbarangotomatis') }}";
        });
    </script>

@endsection
