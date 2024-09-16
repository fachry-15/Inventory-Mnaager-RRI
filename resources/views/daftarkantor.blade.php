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
                            <h3>Daftar Kantor RRI Jawa Timur</h3>
                            <p class="text-subtitle text-muted">Informasi Daftar Kantor RRI Jawa Timur</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Daftar Kantor</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Modal Tambah Kantor start -->
                <div class="modal fade" id="tambahkaryawan" tabindex="-1" role="dialog" aria-labelledby="tambahKaryawanModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahKaryawanModalLabel">Tambah Kantor</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form Tambah Kantor -->
                                <form id="kantorForm" action="{{ route('tambahkantor') }}" method="POST">
                                    @csrf
                                    <div class="form-control mb-1">
                                        <label for="kantor">Nama Kantor:</label>
                                        <input type="text" class="form-control mt-2" id="kantor" name="kantor" placeholder="Masukkan nama kantor" required>
                                    </div>
                                    <div class="form-control mb-3">
                                        <label for="kota">Kabupaten / Kota</label>
                                        <select class="form-control mt-2" id="kota" name="kota" required>
                                            <option value="" disabled selected>Pilih Kabupaten / Kota</option>
                                        </select>
                                    </div>
                                    <div class="form-control mb-3">
                                        <label for="Alamat">Alamat</label>
                                        <input type="text" class="form-control mt-2" id="Alamat" name="Alamat" placeholder="Masukkan alamat" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Tambah Kantor</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Tambah Kantor end -->

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary block" data-bs-toggle="modal" data-bs-target="#tambahkaryawan">
                                Tambah Kantor
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kantor</th>
                                        <th>Kota</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kantor as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_kantor }}</td>
                                        <td>{{ $item->Kota }}</td>
                                        <td>{{ substr($item->alamat_kantor, 0, 50) }}{{ strlen($item->alamat_kantor) > 50 ? '...' : '' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editKaryawan{{ $item->id }}">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteKaryawan{{ $item->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Kantor -->
                                    <div class="modal fade" id="editKaryawan{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editKaryawanLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editKaryawanLabel{{ $item->id }}">Edit Kantor</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form Edit Kantor -->
                                                    <form action="{{ route('kantor.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="Nama{{ $item->id }}">Nama Kantor</label>
                                                            <input type="text" class="form-control" id="Nama{{ $item->id }}" name="kantor" value="{{ $item->nama_kantor }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Kota{{ $item->id }}">Kota</label>
                                                            <input type="text" class="form-control" id="Kota{{ $item->id }}" name="kota" value="{{ $item->Kota }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat{{ $item->id }}">Alamat</label>
                                                            <input type="text" class="form-control" id="alamat{{ $item->id }}" name="alamat" value="{{ $item->alamat_kantor }}" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Modal Edit Kantor -->

                                    <!-- Modal Delete Kantor -->
                                    <div class="modal fade" id="deleteKaryawan{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteKaryawanLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteKaryawanLabel{{ $item->id }}">Hapus Kantor</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus Kantor ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('kantor.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Modal Delete Kantor -->
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/kota')
                .then(response => response.json())
                .then(data => {
                    const kotaSelect = document.getElementById('kota');
                    data.forEach(kota => {
                        const option = document.createElement('option');
                        option.value = kota.name;
                        option.text = kota.name;
                        kotaSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
@endsection
