<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Form Tambah
                                                Ruangan
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('ruangan.store') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="InputName" class="form-label">Kode 
                                                        Ruangan</label>
                                                    <input type="text" name="kode_ruang" class="form-control" 
                                                        placeholder="Masukkan kode ruangan" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nama
                                                        Ruangan</label>
                                                    <input type="text" name="nama_ruang" class="form-control"
                                                        placeholder="Masukkan nama ruangan">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail2" class="form-label">Lantai
                                                        Ruangan</label>
                                                    <input type="number" name="lantai" class="form-control"
                                                        placeholder="Masukkan nomor lantai ruangan">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Batal</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Simpan</span>
                                            </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>