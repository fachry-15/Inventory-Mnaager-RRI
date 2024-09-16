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
                        <p class="text-subtitle text-muted">Informasi barang yang terdapat di RRI Surabaya</p>
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
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn btn-primary block" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                <i class="fas fa-plus"></i> Tambah Barang
                            </button>
                            <div class="dropdown" style="display: inline-block;">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton">
                                    Cetak Data
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="display: none;">
                                    <a class="dropdown-item" href="{{ route('export.pdf') }}">
                                        <i class="fas fa-file"></i> Cetak PDF
                                    </a>
                                    <a class="dropdown-item" href="{{ route('export.excel') }}">
                                        <i class="fas fa-file-alt"></i> Cetak Excel
                                    </a>
                                </div>
                                <a href="" class="btn btn-success" id="dropdownMenuButton">
                                    <i class="fas fa-qrcode"></i> Unduh Barcode
                                </a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">
                            <i class="fas fa-filter"></i> Filter Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Kuantitas</th>
                                    <th>Kategori</th>
                                    <th>Kode Ruang</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Kadaluarsa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="barangTableBody">
                                @foreach($barangs as $barang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>
                                            @php
                                                $jumlah = $barangCounts->firstWhere('nama_barang', $barang->nama_barang)->total ?? 0;
                                            @endphp
                                            {{ $jumlah }} Unit
                                        </td>
                                        <td>{{ $barang->kategori->nama_kategori ?? 'Tidak ada kategori' }}</td>
                                        <td>{{ $barang->ruangans->kode_ruang ?? 'Tidak ada ruangan' }}</td>
                                        <td>{{ $barang->tanggal_masuk }}</td>
                                        <td>{{ $barang->tanggal_kadaluarsa ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('detailbarang', $barang->nama_barang) }}" class="btn btn-primary">Lihat Data</a>
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

@include('components.Forms.tambahbarang')

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="startDate" class="form-label">Start Date:</label>
                    <input type="date" id="startDate" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="endDate" class="form-label">End Date:</label>
                    <input type="date" id="endDate" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" onclick="filterByDate()">Filter</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('dropdownMenuButton').addEventListener('click', function() {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
            dropdownMenu.style.display = 'block';
        } else {
            dropdownMenu.style.display = 'none';
        }
    });

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('#dropdownMenuButton')) {
            var dropdowns = document.getElementsByClassName("dropdown-menu");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === 'block') {
                    openDropdown.style.display = 'none';
                }
            }
        }
    }

    function filterByDate() {
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        var table = document.getElementById('barangTableBody');
        var rows = table.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var tanggalMasuk = rows[i].getElementsByTagName('td')[5].innerText;
            if (tanggalMasuk) {
                var date = new Date(tanggalMasuk);
                var start = new Date(startDate);
                var end = new Date(endDate);

                if (date >= start && date <= end) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
        // Close the modal after filtering
        var filterModal = new bootstrap.Modal(document.getElementById('filterModal'));
        filterModal.hide();
    }
</script>
@endsection