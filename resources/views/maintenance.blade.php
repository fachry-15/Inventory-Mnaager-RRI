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
                            <h3>Ticket Perawatan Barang</h3>
                            <p class="text-subtitle text-muted">Informasi Ticket Pembayaran </p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Ticket Perawatan Barang</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Modal Tambah Karyawan start -->
                <div class="modal fade" id="tambahkaryawan" tabindex="-1" role="dialog"
                     aria-labelledby="tambahKaryawanModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahKaryawanModalLabel">Form Ticket Maintenance</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form Tambah Karyawan -->
                                <form id="karyawanForm" action="{{ route('maintenance.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="kode_ticket" id="kode_barang">

                                    <div class="form-group">
                                        <label for="Barang">Barang</label>
                                        <select class="form-control mt-1" id="Barang" name="barang" required>
                                            <option value="" disabled selected>Pilihlah barang apa yang ingin anda perbaiki atau ganti</option>
                                            @foreach($barang as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_perawatan">Jenis Perawatan</label>
                                        <select class="form-control mt-1" id="jenis_perawatan" name="jenis_perawatan" required>
                                            <option value="" disabled selected>Pilih jenis perawatan</option>
                                            <option value="Perawatan">Perawatan</option>
                                            <option value="Penggantian Alat atau Device">Penggantian Alat atau Device</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="diagnosa">Diagnosa</label>
                                        <input type="text" class="form-control mt-1" id="diagnosa" name="diagnosa"
                                               placeholder="Tuliskan Diagnosa kerusakan atau penggantian" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Deskripsi">Deskripsi</label>
                                        <textarea class="form-control mt-1" id="Deskripsi" name="deskripsi" cols="4"
                                                  placeholder="Tuliskan deskripsi perbaikan yang telah anda lakukan" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="NotaDinas">Lampiran Nota Dinas</label>
                                        <input type="file" class="form-control mt-1" id="NotaDinas" name="NotaDinas" accept="application/pdf" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Tambah Perbaikan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Modal Tambah Karyawan -->

                <section class="section">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-success block" data-bs-toggle="modal"
                                    data-bs-target="#tambahkaryawan">
                                    <i class="fas fa-ticket-alt me-1"></i> Buat Ticket Maintenance
                            </button>

                            <div class="input-group mb-3 w-25">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                <input type="text"  id="searchBox" class="form-control" placeholder="Cari Nama Barang .." aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="karyawanList">
                                @foreach ($ticket as $item)
                                <div class="col-md-6 mb-4 karyawan-item">
                                    <div class="card shadow-lg border-0 rounded-3">
                                        <div class="row g-0">
                                            <!-- Bagian Tanggal -->
                                            <div class="col-4 bg-{{ $item->jenis_perawatan == 'Perawatan' ? 'warning' : 'danger' }} text-center d-flex flex-column justify-content-center rounded-start">
                                                <h2 class="mb-0 fw-bold text-white">{{$item->created_at->format('d')}}</h2>
                                                <span class=" text-white">{{$item->created_at->format('M')}}</span>
                                            </div>
                                            <!-- Bagian Informasi -->
                                            <div class="col-8">
                                                <div class="card-body p-4">
                                                    <h5 class="card-title mb-2">{{$item->barang->nama_barang}}</h5>
                                                    <p class="card-text text-muted"><strong>#{{$item->kode_ticket}}</strong></p>
                                                    <p class="card-text mb-2">
                                                        <i class="fas fa-calendar-alt me-2"></i> {{ $item->created_at->format('l, d F Y') }}
                                                    </p>
                                                    <p class="card-text mb-2">
                                                        <i class="fas fa-wrench me-2"></i> {{$item->diagnosa}}
                                                    </p>
                                                    <p class="card-text mb-3">
                                                        <i class="fas fa-stream me-2"></i> {{ Str::limit($item->deskripsi_perawatan, 30) }}
                                                    </p>
                                                    <!-- Tombol Aksi -->
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-outline-{{ $item->jenis_perawatan == 'Perawatan' ? 'warning' : 'danger' }} btn-sm px-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#staticBackdrop--{{$item->id}}">
                                                           Lihat Detail
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @endforeach
                                <h2 id="noResultsMessage" class="text-center w-100" style="display: none;">Mohon maaf ticket yang anda maksud tidak ditemukan</h2>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            @include('components.footer.footer')
        </div>
    </div>
    @foreach ($ticket as $item)
    <div class="modal fade" id="staticBackdrop--{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">{{$item->barang->nama_barang}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="card-body">
                        <h5 class="card-title mb-2">{{$item->barang->nama_barang}}</h5>
                        <p class="card-text text-muted"><strong>#{{$item->kode_ticket}}</strong></p>
                        <p class="card-text mb-2">
                            <i class="fas fa-calendar-alt me-2"></i> {{ $item->created_at->format('l, d F Y') }}
                        </p>
                        <p class="card-text mb-2">
                            <strong>Diagnosa :</strong> <br> {{$item->diagnosa}}
                        </p>
                        <p class="card-text mb-3">
                            <strong>Deskripsi Perawatan :</strong> <br> {{$item->deskripsi_perawatan}}
                        </p>
                        <p class="card-text mb-3">
                            <strong>Kategori Perawatan :</strong> <br><span class="badge rounded-pill bg-{{ $item->jenis_perawatan == 'Perawatan' ? 'warning' : 'danger' }} ">{{$item->jenis_perawatan}}</span>
                        </p>
                        <p class="card-text mb-3">
                            <strong>Utilitas :</strong><br>
                            <a href="{{ route('ticketmaintenance', $item->id) }}" class="btn btn-danger"><i class="fas fa-ticket-alt me-1"></i> Cetak Ticket</a>
                            @if ($item->lampiran_file)
                                <a href="{{ asset('storage/' . $item->lampiran_file) }}" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-file-pdf me-1"></i> Lihat Lampiran
                                </a>
                            @endif
                        </p>
                       
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jenisPerawatanSelect = document.getElementById('jenis_perawatan');
            const kodeBarangInput = document.getElementById('kode_barang');
    
            jenisPerawatanSelect.addEventListener('change', function () {
                let prefix = '';
    
                // Tentukan prefix berdasarkan jenis perawatan
                if (jenisPerawatanSelect.value === 'Perawatan') {
                    prefix = 'PRW';
                } else if (jenisPerawatanSelect.value === 'Penggantian Alat atau Device') {
                    prefix = 'GNT';
                }
    
                // Generate timecode dan ambil 5 karakter terakhir
                const timeCode = new Date().getTime().toString().slice(-5); // Mengambil 5 karakter terakhir dari milidetik saat ini
                const generatedCode = `${prefix}${timeCode}`;
    
                // Set nilai input hidden dengan kode barang yang dihasilkan
                kodeBarangInput.value = generatedCode;
            });

            // Pencarian
            const searchBox = document.getElementById('searchBox');
            const karyawanList = document.getElementById('karyawanList');
            const karyawanItems = karyawanList.getElementsByClassName('karyawan-item');
            const noResultsMessage = document.getElementById('noResultsMessage');

            searchBox.addEventListener('input', function () {
                const searchTerm = searchBox.value.toLowerCase();
                let found = false;

                Array.from(karyawanItems).forEach(function (item) {
                    const itemName = item.querySelector('.card-title').textContent.toLowerCase();
                    if (itemName.includes(searchTerm)) {
                        item.style.display = '';
                        found = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                noResultsMessage.style.display = found ? 'none' : 'block';
            });
        });
    </script>
</body>
@endsection