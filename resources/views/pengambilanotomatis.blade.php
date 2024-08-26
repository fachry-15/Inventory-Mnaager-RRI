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
                        <h3>Pengambilan Barang</h3>
                        <p class="text-subtitle text-muted">Menu pengambilan barang dengan tepat dan lengkap</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pengambilan Barang</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <h1>Scan QR Code</h1>
            <video id="video"></video>
            <p id="result">QR Code: </p>
        
            <script src="https://unpkg.com/@zxing/library@latest"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const codeReader = new ZXing.BrowserQRCodeReader();
                    const videoElement = document.getElementById('video');
                    const resultElement = document.getElementById('result');
                    let isScanning = false;  // Pembatasan untuk mencegah multiple scans
            
                    codeReader.getVideoInputDevices().then((videoInputDevices) => {
                        const firstDeviceId = videoInputDevices[0].deviceId;
                        codeReader.decodeFromVideoDevice(firstDeviceId, videoElement, (result, error) => {
                            if (result && !isScanning) {  // Cek apakah sudah scanning atau belum
                                isScanning = true;  // Set flag untuk menghentikan scanning lebih lanjut
                                console.log('QR Code detected:', result.text);
                                resultElement.innerText = 'QR Code: ' + result.text;
            
                                // Stop scanning to avoid multiple detections
                                codeReader.stopContinuousDecode();
            
                                // Delay 5 detik sebelum mengirim data
                                setTimeout(() => {
                                    // Send data to server
                                    fetch('{{ route("qr.scan") }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({ qrCode: result.text })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log(data);
                                        // Reload the page to refresh the data
                                        window.location.href = window.location.href;
                                    })
                                    .catch(error => console.error('Error:', error))
                                    .finally(() => {
                                        // Allow scanning again after the operation is complete
                                        isScanning = false;
                                        codeReader.decodeFromVideoDevice(firstDeviceId, videoElement, (result, error) => {
                                            // Restart scanning
                                        });
                                    });
                                }, 5000); // Delay 5000 ms (5 detik)
                            }
                            if (error && !(error instanceof ZXing.NotFoundException)) {
                                console.error(error);
                            }
                        });
                    }).catch((err) => {
                        console.error(err);
                    });
                });
            </script>
            
            <section class="section">
                <div class="card">

                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Kode Barang </th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Status Barang </th>
                                    <th>Tanggal penggunaan</th>        
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman as $item)
                                <tr>
                                    <td>{{$item->barang_id}}</td>
                                    <td>{{$item->barangs->nama_barang}}</td>
                                    <td>{{$item->barangs->kategori->nama_kategori}}</td>
                                    <td>
                                        @if($item->status_peminjaman == 'Sedang digunakan')
                                            <span class="badge rounded-pill bg-danger">{{$item->status_peminjaman}}</span>
                                        @else
                                            <span class="badge rounded-pill bg-success">{{$item->status_peminjaman}}</span>
                                        @endif
                                    </td>
                                    <td>{{$item->created_at->translatedFormat('l, d F Y H:i')}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter">
                                        Lihat Data
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- Form and scrolling Components end -->
        </div>

        @include('components.footer.footer')
    </div>
</div>

@endsection