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
                    <div class="card-header">
                        <button type="button" class="btn btn-primary block" data-bs-toggle="modal"
                        data-bs-target="#exampleModalCenter">
                        Tambah Barang
                         </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Kode Barang </th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Status Barang </th>
                                    <th>Tanggal penggunaan</th>        
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman as $item)
                                <tr>
                                    <td>{{$item->barang_id}}</td>
                                    <td>{{$item->barangs->nama_barang}}</td>
                                    <td>{{$item->barangs->kategori->nama_kategori}}</td>
                                    <td>
                                        @if($item->status_peminjaman == 'Sedang digunakan')
                                            <span class="badge rounded-pill bg-danger">{{$item->status_peminjaman}}</span>
                                        @else
                                            <span class="badge rounded-pill bg-success">{{$item->status_peminjaman}}</span>
                                        @endif
                                    </td>
                                    <td>{{$item->created_at->translatedFormat('l, d F Y H:i')}}</td>
                                    <td>
                                    <form action="{{ route('item.destroy', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
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

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambahkan Barang</h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <!-- Isi Modal -->
            <div class="modal-body">
                <form action="{{ route('pemindahanmanual.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Nama Penanggung Jawab -->
                    <div class="mb-3">
                        <label for="InputResponsible" class="form-label">Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control" id="InputResponsible"
                            placeholder="Cari Barang yang ingin anda gunakan" required autocomplete="off">
                        <div class="dropdown">
                            <div class="dropdown-menu" id="barangDropdown" aria-labelledby="InputResponsible">
                                @foreach($barangs as $kategori)
                                    <button class="dropdown-item" type="button" onclick="selectBarang('{{ $kategori->kode_barang }}')">
                                        {{ $kategori->kode_barang }} - {{ $kategori->nama_barang }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="InputResponsible" class="form-label">Status Pengambilan</label>
                        <input type="text" name="status" value="Sedang digunakan" class="form-control" id="InputResponsible"
                             required readonly>
                    </div>
            </div>
            <!-- Footer Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Batal</span>
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
        @include('components.footer.footer')
    </div>
</div>

<script>
    document.getElementById('InputResponsible').addEventListener('input', function() {
        let query = this.value.toLowerCase();
        let dropdown = document.getElementById('barangDropdown');
        let items = dropdown.getElementsByClassName('dropdown-item');
        let hasResults = false;

        for (let i = 0; i < items.length; i++) {
            let item = items[i];
            let text = item.textContent.toLowerCase();
            if (text.includes(query)) {
                item.style.display = 'block';
                hasResults = true;
            } else {
                item.style.display = 'none';
            }
        }

        if (hasResults) {
            dropdown.classList.add('show');
        } else {
            dropdown.classList.remove('show');
        }
    });

    function selectBarang(kodeBarang) {
        document.getElementById('InputResponsible').value = kodeBarang;
        document.getElementById('barangDropdown').classList.remove('show');
    }

    document.addEventListener('click', function(event) {
        let dropdown = document.getElementById('barangDropdown');
        if (!dropdown.contains(event.target) && event.target.id !== 'InputResponsible') {
            dropdown.classList.remove('show');
        }
    });
    </script>
@endsection