<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Resmi Pemerintah</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width:210mm;
            height: 297mm;
            padding: 40px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header .title {
            text-align: center;
            flex-grow: 2;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            text-transform: uppercase;
        }
        .header p {
            font-size: 14px;
            margin: 0;
        }
        .content {
            margin-top: 20px;
        }
        .content p {
            margin: 15px 0;
            text-align: justify;
            line-height: 1.8;
        }
        .content .indent {
            text-indent: 40px;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
        }
        .footer .signature {
            margin-top: 80px;
            position: relative;
        }
        .footer .signature:before {
            content: '';
            display: block;
            border-top: 1px solid #000;
            width: 250px;
            margin: 0 auto 10px auto;
        }
        .footer p {
            margin: 0;
        }
        .signature-name {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="logo-pemerintah.png" alt="Logo Pemerintah">
            <div class="title">
                <h1>PEMERINTAH KOTA EXAMPLE</h1>
                <p>Kantor Walikota Example</p>
                <p>Jalan Pemerintah No. 1, Kota Example, 12345</p>
            </div>
        </div>

        <div class="content">
            <p>Nomor: 123/ABC/2024</p>
            <p>Lampiran: -</p>
            <p>Perihal: <strong>Pemberitahuan Penting</strong></p>

            <br>

            <p>Kepada Yth,</p>
            <p>Bapak/Ibu Warga Kota Example</p>
            <p>di Tempat</p>

            <br>

            <p class="indent">
                Dengan hormat, kami sampaikan bahwa sehubungan dengan adanya kegiatan pembangunan infrastruktur jalan raya di wilayah Kota Example, akan dilakukan penutupan jalan utama di beberapa titik.
            </p>

            <p class="indent">
                Pembangunan ini diharapkan dapat selesai dalam waktu 3 bulan, dimulai dari tanggal 1 September 2024 hingga 30 November 2024. Mohon maaf atas ketidaknyamanan yang mungkin terjadi selama masa pembangunan.
            </p>

            <p class="indent">
                Demikian pemberitahuan ini kami sampaikan. Atas perhatian dan kerjasama Bapak/Ibu, kami ucapkan terima kasih.
            </p>
        </div>

        <div class="footer">
            <p>Kota Example, 29 Agustus 2024</p>
            <p>Walikota Example,</p>
            
            <div class="signature">
                <p class="signature-name">Nama Walikota</p>
                <p>NIP: 1234567890</p>
            </div>
        </div>
    </div>
</body>
</html>
