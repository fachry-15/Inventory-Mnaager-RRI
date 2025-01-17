<!-- Modal Tambahkan Barang -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambahkan Barang</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <!-- Isi Modal -->
            <div class="modal-body">
                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Nama Barang -->
                    <div class="mb-3">
                        <label for="InputName" class="form-label">Nama Barang</label>
                        <input type="text" name="nama" class="form-control" id="InputName" placeholder="Masukkan Nama Barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Merek Barang</label>
                        <input type="text" name="merek" class="form-control" id="" placeholder="Masukkan Merek Barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tipe Barang</label>
                        <input type="text" name="tipe" class="form-control" id="" placeholder="Masukkan Tipe Barang" required>
                    </div>
                    <!-- Kategori Barang -->
                    <div class="mb-3">
                        <label for="InputCategory" class="form-label">Kategori Barang</label>
                        <select class="form-control" id="InputCategory" name="kategori" required>
                            <option value="" disabled selected>Pilih Kategori Barang</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Processor Barang</label>
                        <input type="text" name="processor" class="form-control" id="" placeholder="Masukkan Processor Barang">
                        <small class="form-text text-muted">*Opsional (Jika Tidak terdapat Processor lewati saja)</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Ram Barang</label>
                        <input type="text" name="ram" class="form-control" id="" placeholder="Masukkan Ram Barang">
                        <small class="form-text text-muted">*Opsional (Jika Tidak terdapat Ram lewati saja)</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Storage Barang</label>
                        <input type="text" name="storage" class="form-control" id="" placeholder="Masukkan Storage Barang">
                        <small class="form-text text-muted">*Opsional (Jika Tidak terdapat Storage lewati saja)</small>
                    </div>
                    <!-- Kode Barang -->
                    <div class="mb-3">
                        <label for="InputCode" class="form-label">Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control" id="InputCode" required placeholder="Pilih kategori barang diatas atau masukkan kode barang yang sudah tersedia" readonly>
                    </div>
                    <div id="barcodeContainer" class="mb-3">
                        <!-- Gambar QR code akan ditampilkan di sini -->
                    </div>
                    <!-- Nama Penanggung Jawab -->
                    <div class="mb-3">
                        <label for="InputResponsible" class="form-label">Nama Penanggung Jawab</label>
                        <input type="text" name="penanggungjawab" class="form-control" id="InputResponsible" placeholder="Masukkan Nama Penanggung Jawab" value="{{ Auth::user()->name }}" readonly required>
                    </div>
                    <!-- Ruangan -->
                    <div class="mb-3">
                        <label for="InputRoom" class="form-label">Ruangan</label>
                        <select class="form-control" id="InputRoom" name="ruangan" required>
                            <option value="" disabled selected>Pilih Ruangan tempat penyimpanan</option>
                            @foreach ($ruangans as $item)
                                <option value="{{ $item->id }}">{{ $item->kode_ruang }} - {{ $item->nama_ruang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Gambar Barang -->
                    <div class="mb-3">
                        <label for="InputImage" class="form-label">Gambar Barang</label>
                        <input type="file" name="gambar" class="form-control" id="InputImage" accept="image/*">
                    </div>
                    <!-- Tanggal Masuk -->
                    <div class="mb-3">
                        <label for="InputDateMasuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" name="masuk" class="form-control" id="InputDateMasuk" required>
                    </div>
                    <!-- Tahun Perolehan -->
                    <div class="mb-3">
                        <label for="InputYear" class="form-label">Tahun Perolehan</label>
                        <input type="number" name="tahun" class="form-control" id="InputYear" placeholder="Masukkan Tahun Perolehan">
                        <small class="form-text text-muted">*Opsional (Jika Tidak terdapat Tahun Perolehan lewati saja)</small>
                    </div>
                    <!-- Kondisi Barang -->
                    <div class="mb-3">
                        <label for="InputCondition" class="form-label">Kondisi Barang</label>
                        <select class="form-control" id="InputCondition" name="kondisi" required>
                            <option value="" disabled selected>Pilih Kondisi Barang</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Perbaikan">Perbaikan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sumber" class="form-label">Sumber Barang</label>
                        <select class="form-control" id="InputSource" name="sumber" required>
                            <option value="" disabled selected>Pilih Sumber Barang</option>
                            <option value="Pembelian">Pembelian</option>
                            <option value="Hibah">Hibah</option>
                            <option value="Produksi Sendiri">Produksi Sendiri</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kantor" class="form-label">Kantor Pemilik Barang</label>
                        <select class="form-control" id="InputOffice" name="kantor" required>
                            <option value="" disabled selected>Pilih Kantor Pemilik Barang</option>
                            @foreach ($kantor as $item)
                                <option value="{{ $item->nama_kantor }}">{{ $item->nama_kantor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lampiran" class="form-label">Lampiran Dokumen Penunjang</label>
                        <input type="file" name="file" class="form-control" id="InputDateMasuk">
                        <small class="form-text text-muted">*Opsional (Jika Tidak terdapat file lampiran atau Nota Dinas lewati saja)</small>
                    </div>
            </div>
            <!-- Footer Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
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

<!-- Script untuk Membuat Kode Barang -->
<script>
    document.getElementById('InputCategory').addEventListener('change', function() {
        const category = this.value;
        const codeInput = document.getElementById('InputCode');
        const uniqueCode = Math.random().toString(36).substring(2, 9).toUpperCase(); // menghasilkan 7 karakter acak
        const prefix = category.substring(0, 3).toUpperCase(); // menghasilkan 3 huruf pertama dari kategori

        const generatedCode = `${prefix}${uniqueCode}`;
        codeInput.value = generatedCode;

        // Mengirim permintaan AJAX untuk mendapatkan gambar QR code tanpa menyimpannya
        fetch(`/generate-qrcode/${generatedCode}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('barcodeContainer').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    });
</script>

<!-- Script untuk Menghitung Tanggal Maintenance -->
<script>
    document.getElementById('InputDateMasuk').addEventListener('change', function() {
        var masukDate = new Date(this.value);
        var maintenanceDate = new Date(masukDate);
        maintenanceDate.setMonth(masukDate.getMonth() + 3);

        var day = ("0" + maintenanceDate.getDate()).slice(-2);
        var month = ("0" + (maintenanceDate.getMonth() + 1)).slice(-2);
        var year = maintenanceDate.getFullYear();

        document.getElementById('InputDateMaintenance').value = year + "-" + month + "-" + day;
    });
</script>

<script>
    $(document).ready(function() {
        $("#InputName").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('barang.nama') }}",
                    dataType: "json",
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.nama,
                                value: item.nama
                            };
                        }));
                    }
                });
            },
            minLength: 2
        });
    });
</script>