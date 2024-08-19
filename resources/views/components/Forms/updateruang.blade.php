@foreach ($ruangans as $item)
    <div class="modal fade" id="updateModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Form Update Ruangan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.ruang', $item->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="InputCode-{{ $item->id }}" class="form-label">Kode Ruangan</label>
                            <input type="text" name="kode_ruang" class="form-control" id="InputCode-{{ $item->id }}" placeholder="Masukkan kode ruangan" value="{{$item->kode_ruang}}">
                            <small class="text-muted d-block mb-2">Barcode:</small>
                            <div id="barcode-{{ $item->id }}" class="barcode"></div> <!-- Barcode -->
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Ruangan</label>
                            <input type="text" name="nama_ruang" class="form-control" placeholder="Masukkan nama ruangan" value="{{$item->nama_ruang}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail2" class="form-label">Lantai Ruangan</label>
                            <input type="number" name="lantai" class="form-control" placeholder="Masukkan nomor lantai ruangan" value="{{$item->lantai}}">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Batal</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Perbarui</span>
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach ($ruangans as $item)
                // Generate barcode for each modal
                JsBarcode("#barcode-{{ $item->id }}", "{{ $item->kode_ruang }}", {
                    format: "CODE128", // Use your desired barcode format
                    displayValue: true,
                    fontSize: 18,
                    width: 2,
                    height: 100
                });
            @endforeach
        });
    </script>