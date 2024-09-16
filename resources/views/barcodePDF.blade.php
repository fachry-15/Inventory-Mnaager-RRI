<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .container {
            width: 100%;
            margin-top: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-3 {
            flex: 0 0 25%;
            max-width: 25%;
            padding: 10px;
            box-sizing: border-box;
        }

        .card {
            border: 1px solid #181818;
            padding: 10px;
            height: 20%;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card-body img {
            width: 100%;
            max-width: 300px; /* Adjust the max-width as necessary */
            height: auto;
            margin-bottom: 10px;
        }

        .card-body p {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            border-top: 1px solid #000;
            padding-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            @foreach($barangs as $barcode)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ public_path('barcodes/' . $barcode->kode_barang . '.png') }}" alt="Barcode">
                            <p>{{ $barcode->kode_barang }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
