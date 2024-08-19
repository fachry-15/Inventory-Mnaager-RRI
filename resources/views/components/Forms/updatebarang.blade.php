@foreach ($barangs as $item)
<div class="modal fade" id="updateModal-{{ $item->id }}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Update Ruangan</h5>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <div class="modal-body">
            <form >
                @csrf
                <div class="mb-3">
                    <label for="InputName" class="form-label">Nama Barang</label>
                    <input type="text" name="nama" class="form-control" id="InputName"
                       value="{{$item->nama_barang}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="InputCategory" class="form-label">Kategori Barang</label>
                    <select class="form-control" id="InputCategory" name="kategori" required>
                        <option value="" disabled selected>Pilih Kategori Barang</option>
                        @foreach ($kategori as $kategoriItem)
                            <option value="{{ $kategoriItem->nama_kategori }}" {{ $kategoriItem->id == $item->kategori_id ? 'selected' : '' }}>{{ $kategoriItem->nama_kategori }}</option>
                        @endforeach
                        <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="InputCode" class="form-label">Kode Barang</label>
                    <input type="text" class="form-control" value="{{$item->kode_barang}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="InputResponsible" class="form-label">Nama Penanggung
                        Jawab</label>
                    <input type="text" name="penanggungjawab" class="form-control" id="InputResponsible"
                        placeholder="Masukkan Nama Penanggung Jawab" value="{{{$item->penanggung_jawab}}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="InputCategory" class="form-label">Ruangan</label>
                    <select class="form-control" id="InputCategory" name="ruangan" required>
                        <option value="" disabled selected>Pilih Ruangan tempat penyimpanan</option>
                        @foreach ($ruangans as $ruangan)
                            <option value="{{$ruangan->id}}">{{$ruangan->kode}}-{{$ruangan->nama_ruang}}</option>
                        @endforeach
                        <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="InputImage" class="form-label">Gambar Barang</label>
                    <div class="custom-file">
                        <input type="file" name="gambar" class="form-control" id="InputImage" accept="image/*">
                        <label class="custom-file-label" for="InputImage">Pilih gambar jika ingin memperbarui data bukti gambar</label>
                    </div>
                
                    @if ($item->bukti_gambar)
                        <div class="card mt-3" style="width: 18rem;">
                            
                            <div class="card-body">
                                <h5 class="card-title">Gambar Saat Ini</h5> 
                                <img src="{{ asset('images/' . $item->bukti_gambar) }}" class="card-img-top img-thumbnail" alt="Gambar Barang">
                                <p class="card-text">Nama file: {{ $item->bukti_gambar }}</p>
                                <p class="card-text">Tanggal unggah: {{ $item->tanggal_unggah ?? 'Tidak diketahui' }}</p>
                                <p class="card-text">Ukuran: {{ number_format(filesize(public_path('images/' . $item->bukti_gambar)) / 1024, 2) }} KB</p>
                            </div>
                        </div>
                    @else
                        <div class="mt-3 text-muted">
                            <p>Tidak ada gambar tersedia</p>
                        </div>
                    @endif
                </div>
                
                
                <div class="mb-3">
                    <label for="InputDate" class="form-label">Tanggal Masuk</label>
                    <input type="date" name="masuk" class="form-control" id="InputDate" value="{{$item->tanggal_masuk}}" required>
                </div>
                <div class="mb-3">
                    <label for="InputExpiryDate" class="form-label">Tanggal Kadaluwarsa</label>
                    <input type="date" name="maintenance" class="form-control" id="InputExpiryDate" value="{{$item->tanggal_maintenace}}">
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
@endforeach
