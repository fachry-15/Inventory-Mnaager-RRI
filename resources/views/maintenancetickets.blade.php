<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karcis Maintenance</title>
    <style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .ticket-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .ticket {
            max-width: 15cm;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border-left: 8px solid #007bff;
            position: relative;
        }

        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px dashed #ddd;
           padding: 20px;
            margin-bottom: 20px;
        }

        img {
            max-width: 100px; /* Atur ukuran gambar sesuai kebutuhan */
        }

        .ticket-header h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .ticket-code {
            font-size: 18px;
            color: #555;
            background-color: #e9ecef;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }

        .ticket-body {
            position: relative;
            padding: 20px; /* Tambahkan padding agar teks tidak langsung menempel pada gambar */
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.8); /* Menambahkan latar belakang semi-transparan */
            overflow: hidden; /* Pastikan elemen pseudo tidak keluar dari batas */
        }

        .ticket-body .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('logo/logo.png') }}') no-repeat center center;
            background-size: 80% auto;
            opacity: 0.2; /* Mengatur transparansi gambar */
            z-index: -1; /* Menempatkan gambar di belakang teks */
            border-radius: 10px;
        }

        .ticket-body p {
            position: relative;
            z-index: 1; /* Pastikan teks berada di atas gambar latar belakang */
            opacity: 1; /* Pastikan teks tidak transparan */
        }

        .ticket-body p span {
            font-weight: bold;
            color: #007bff;
        }

        .ticket-footer {
            text-align: center;
            border-top: 2px dashed #ddd;
        }

        /* .ticket-footer p {
            font-size: 14px;
            color: #555;
        } */

        /* Gaya untuk cetak */
        @media print {
            body {
                background-color: #fff;
                margin: 0;
            }

            .ticket-container {
                min-height: auto;
                display: block;
                padding: 0;
                margin: 0;
            }

            .ticket {
                box-shadow: none;
                border: 1px solid #333;
                border-radius: 0;
            }

            .ticket-header,
            .ticket-footer {
                border: none;
            }
        }
    </style>
</head>

<body>
    <div class="ticket-container">
        <div class="ticket">
            <div class="ticket-header">
                <div>
                    <h2>{{$ticket->jenis_perawatan}}</h2>
                    <div class="ticket-code">#{{$ticket->kode_ticket}}</div> <!-- Kode tiket -->
                </div>
       
            </div>
            <div class="ticket-body">
                <div class="background-image"></div> <!-- Elemen div tambahan untuk gambar latar belakang -->
                <p><span>Nama Barang:</span> {{ $ticket->barang->nama_barang }}</p> <!-- Nama barang -->
                <p><span>Diagnosa:</span> {{ $ticket->diagnosa }}</p> <!-- Diagnosa -->
                <p><span>Deskripsi Perawatan:</span> {{ $ticket->deskripsi_perawatan }}</p> <!-- Deskripsi perawatan -->
                <p><span>Tanggal Perbaikan:</span> {{ $ticket->created_at }}</p> <!-- Tanggal perbaikan/pergantian -->
            </div>
            <div class="ticket-footer">
                <img src="{{ public_path('logo/logo.png') }}" alt="Logo">
            </div>

        </div>
    </div>
</body>

</html>