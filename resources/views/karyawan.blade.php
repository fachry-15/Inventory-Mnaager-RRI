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
                            <h3>Daftar Karyawan</h3>
                            <p class="text-subtitle text-muted">Informasi daftar Karyawan</p>
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

                <!-- Modal Tambah Karyawan start -->
                <div class="modal fade" id="tambahkaryawan" tabindex="-1" role="dialog"
                     aria-labelledby="tambahKaryawanModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahKaryawanModalLabel">Tambah Karyawan</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form Tambah Karyawan -->
                                <form id="karyawanForm"  action="{{ route('buatakun') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="karyawanName">Nama Karyawan</label>
                                        <input type="text" class="form-control" id="karyawanName" name="name"
                                               placeholder="Masukkan nama karyawan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="karyawanEmail">Email</label>
                                        <input type="email" class="form-control" id="karyawanEmail" name="email"
                                               placeholder="Masukkan email karyawan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="karyawanPassword">Password</label>
                                        <input type="password" class="form-control" id="karyawanPassword" name="password"
                                               placeholder="Masukkan kata sandi yang kuat" required>
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
                <!-- End of Modal Tambah Karyawan -->

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary block" data-bs-toggle="modal"
                                    data-bs-target="#tambahkaryawan">
                                Tambah Karyawan
                            </button>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Karyawan</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($akun as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editKaryawan{{ $item->id }}">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteKaryawan{{ $item->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Karyawan -->
                                    <div class="modal fade" id="editKaryawan{{ $item->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="editKaryawanLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editKaryawanLabel{{ $item->id }}">Edit Karyawan</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form Edit Karyawan -->
                                                    <form>
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="editKaryawanName{{ $item->id }}">Nama Karyawan</label>
                                                            <input type="text" class="form-control" id="editKaryawanName{{ $item->id }}" name="name"
                                                                   value="{{ $item->name }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editKaryawanEmail{{ $item->id }}">Email</label>
                                                            <input type="email" class="form-control" id="editKaryawanEmail{{ $item->id }}" name="email"
                                                                   value="{{ $item->email }}" required>
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
                                    <!-- End of Modal Edit Karyawan -->

                                    <!-- Modal Delete Karyawan -->
                                    <div class="modal fade" id="deleteKaryawan{{ $item->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="deleteKaryawanLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteKaryawanLabel{{ $item->id }}">Hapus Karyawan</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus karyawan ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Modal Delete Karyawan -->
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
</body>
@endsection
