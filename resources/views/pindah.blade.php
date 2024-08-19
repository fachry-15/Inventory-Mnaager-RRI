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
                            <h3>Pindah Barang</h3>
                            <p class="text-subtitle text-muted">aktivitas untuk pemindahan barang</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Aktivitas</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Bordered table start -->
                <section class="section">
                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
    
                                        <!-- table bordered -->
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table1">
                                                <thead>
                                                    <tr>
                                                        <th>ID Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kategori</th>
                                                        <th>Ruangan</th>
                                                        <th>Jumlah</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($barangs as $item)
                                                    <tr>
                                                        <td class="text-bold-500">{{$item->kode_barang}}</td>
                                                        <td class="text-bold-500">{{$item->nama_barang}}</td>
                                                        <td>{{$item->Kategori->nama_kategori}}</td>
                                                        <td>{{$item->Ruangans->nama_ruang}}</td>
                                                        <td>{{$item->jumlah_barang}} {{$item->satuan_barang}}</td>
                                                           <!-- Edit Button -->
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal--{{$item->id}}">
                                                                Edit
                                                            </button>
                                                        </td>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Bordered table end -->

                <!-- Edit Modal -->
                @foreach ($barangs as $item)
<div class="modal fade" id="editModal--{{$item->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Pindah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form >
                    <div class="mb-3">
                        <label for="itemName" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="itemName" value="{{$item->nama_barang}}" name="itemName" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="itemLocation" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" id="itemLocation" value="{{$item->kode_barang}}" name="itemLocation" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="itemLocation" class="form-label">Ruangan</label>
                        <select class="form-select" id="itemLocation" name="itemLocation" required>
                            @foreach ($ruangans as $data)
                            <option value="{{$data->id}}" @if($data->id == $item->ruangan_id) selected @endif>{{$data->nama_ruang}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="itemLocation" required>
                            @foreach ($kategori as $data)
                            <option value="{{$data->id}}" @if($data->id == $item->kategori_id) selected @endif>{{$data->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="itemQuantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="itemQuantity" name="itemQuantity" placeholder="Masukkan jumlah barang yang ingin dipindahkan" required>
                    </div>
                    <div class="mb-3">
                        <label for="itemDate" class="form-label">Satuan</label>
                        <input type="text" class="form-control" id="itemDate" name="itemDate" value="{{$item->satuan_barang}}" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="itemName" class="form-label">Nama Penanggung Jawab</label>
                        <input type="text" class="form-control" id="itemName" name="itemDate" placeholder="Masukkan nama penanggung jawab ketika pemindahan" required>
                    </div>
                    <div class="mb-3">
                        <label for="itemImage" class="form-label">Bukti Gambar</label>
                        <input class="form-control" type="file" id="itemImage" name="itemImage" required>
                    </div>
                    <div class="mb-3">
                        <label for="itemName" class="form-label">Tanggal Pindah</label>
                        <input type="date" class="form-control" id="itemName" name="itemDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="itemName" class="form-label">Tanggal Maintenance</label>
                        <input type="date" class="form-control" id="itemName" name="itemDate" value="{{$item->tanggal_maintenace}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="itemExpirationDate" class="form-label">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" id="itemExpirationDate" name="itemExpirationDate" value="{{$item->tanggal_kadaluarsa}}" readonly required>
                    </div>
                    <!-- Add more form fields as needed --> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editForm" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endforeach

                @include('components.footer.footer')
            </div>
        </div>
@endsection