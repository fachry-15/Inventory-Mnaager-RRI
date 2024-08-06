<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Tambahkan Barang</h5>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="InputName" class="form-label">Nama Barang</label>
                    <input type="text" name="nama" class="form-control" id="InputName"
                        placeholder="Masukkan Nama Barang" required>
                </div>
                <div class="mb-3">
                    <label for="InputCategory" class="form-label">Kategori Barang</label>
                    <select class="form-control" id="InputCategory" name="kategori" required>
                        <option value="" disabled selected>Pilih Kategori Barang</option>
                        @foreach ($kategori as $item)
                            <option value="{{$item->nama_kategori}}">{{$item->nama_kategori}}</option>
                        @endforeach
                        <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="InputCode" class="form-label">Kode Barang</label>
                    <input type="text" name="kode_barang" class="form-control" id="InputCode" required placeholder="Pilih kategori barang diatas atau masukkan kode barang yang sudah tersedia">
                    <small class="text-muted d-block mb-2">Tersedia</small>
                </div>
                <div class="mb-3">
                    <label for="InputQuantity" class="form-label">Jumlah Barang</label>
                    <input type="number" name="jumlah" class="form-control" id="InputQuantity"
                        placeholder="Masukkan Jumlah Barang" required>
                </div>
                <div class="mb-3">
                    <label for="InputUnit" class="form-label">Satuan Barang</label>
                    <input type="text" name="satuan" class="form-control" id="InputUnit"
                        placeholder="Masukkan Satuan Barang" required>
                </div>
                <div class="mb-3">
                    <label for="InputResponsible" class="form-label">Nama Penanggung
                        Jawab</label>
                    <input type="text" name="penanggungjawab" class="form-control" id="InputResponsible"
                        placeholder="Masukkan Nama Penanggung Jawab" required>
                </div>
                <div class="mb-3">
                    <label for="InputCategory" class="form-label">Ruangan</label>
                    <select class="form-control" id="InputCategory" name="ruangan" required>
                        <option value="" disabled selected>Pilih Ruangan tempat penyimpanan</option>
                        @foreach ($ruangans as $item)
                            <option value="{{$item->id}}">{{$item->kode}}-{{$item->nama_ruang}}</option>
                        @endforeach
                        <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="InputImage" class="form-label">Gambar Barang</label>
                    <input type="file" name="gambar" class="form-control" id="InputImage"
                        accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="InputDate" class="form-label">Tanggal Masuk</label>
                    <input type="date" name="masuk" class="form-control" id="InputDate" required>
                </div>
                <div class="mb-3">
                    <label for="InputExpiryDate" class="form-label">Tanggal Kadaluwarsa atau Maintenance</label>
                    <input type="date" name="maintenance" class="form-control" id="InputExpiryDate">
                </div>
        </div>
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

<script>
    document.getElementById('InputCategory').addEventListener('change', function() {
        const category = this.value;
        const codeInput = document.getElementById('InputCode');
        const uniqueCode = Math.random().toString(36).substring(2, 5).toUpperCase();
        const prefix = category.substring(0, 3).toUpperCase();

        codeInput.value = `${prefix}-${uniqueCode}`;
    });
</script>