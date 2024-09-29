<?php

namespace App\Http\Controllers;

use App\Imports\BarangImport;
use App\Models\barang;
use App\Models\Kantor;
use App\Models\Kategori;
use App\Models\ruangan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data kategori dan ruangan
        $kategori = Kategori::all();
        $ruangans = Ruangan::all();
        $kantor = Kantor::all();

        // Mengambil data barang dengan nama_barang yang unik saja
        $barangs = Barang::select('nama_barang', DB::raw('MIN(kategori_id) as kategori_id'), DB::raw('MIN(ruangan_id) as ruangan_id'), DB::raw('MIN(tanggal_masuk) as tanggal_masuk'))
            ->where('status', 0)
            ->groupBy('nama_barang')
            ->get();

        // Menghitung jumlah barang berdasarkan nama_barang
        $barangCounts = Barang::select('nama_barang', DB::raw('count(*) as total'))
            ->groupBy('nama_barang')
            ->get();

        // Mengirim data ke view
        return view('barang', compact('barangs', 'kategori', 'ruangans', 'barangCounts', 'kantor'));
    }

    public function detailbarang($nama_barang)
    {
        $kategori = Kategori::all();
        $ruangans = Ruangan::all();
        $barang = Barang::with(['kategori', 'ruangans'])->where('nama_barang', $nama_barang)->get();
        return view('detailbarang', compact('barang', 'kategori', 'ruangans'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getBarang()
    {
        $barang = barang::select('nama_barang')->get();
        return response()->json($barang);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validasi data
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'merek' => 'required|string|max:255',
                'kategori' => 'required|integer',
                'kode_barang' => 'required|string|max:255|unique:barangs,kode_barang',
                'penanggungjawab' => 'required|string|max:255',
                'ruangan' => 'required|integer',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'masuk' => 'required|date',
                'sumber' => 'required|string|max:255',
                'kantor' => 'required|string|max:255',
                'file' => 'nullable|file|mimes:pdf|max:2048',
            ]);

            // Upload gambar jika ada
            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $extension = $image->getClientOriginalExtension();
                $imageName = $request->nama . '_' . time() . '.' . $extension;
                $imagePath = public_path('images/' . $imageName);

                // Resize gambar menggunakan fungsi bawaan PHP
                list($width, $height) = getimagesize($image);
                $newWidth = 800;
                $newHeight = ($height / $width) * $newWidth; // Menyesuaikan tinggi berdasarkan rasio asli

                $thumb = imagecreatetruecolor($newWidth, $newHeight);
                switch ($extension) {
                    case 'jpeg':
                    case 'jpg':
                        $source = imagecreatefromjpeg($image);
                        break;
                    case 'png':
                        $source = imagecreatefrompng($image);
                        break;
                    case 'gif':
                        $source = imagecreatefromgif($image);
                        break;
                    default:
                        throw new \Exception('Unsupported image type');
                }

                imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                switch ($extension) {
                    case 'jpeg':
                    case 'jpg':
                        imagejpeg($thumb, $imagePath);
                        break;
                    case 'png':
                        imagepng($thumb, $imagePath);
                        break;
                    case 'gif':
                        imagegif($thumb, $imagePath);
                        break;
                }

                $validatedData['gambar'] = $imageName;
            }
            // Upload file lampiran jika ada
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $fileName = $request->nama . '_' . time() . '.' . $extension;
                $file->move(public_path('files'), $fileName);
                $validatedData['file'] = $fileName;
            }

            // Simpan data ke database
            $barang = new Barang;
            $barang->nama_barang = $validatedData['nama'];
            $barang->merek = $validatedData['merek'];
            $barang->kategori_id = $validatedData['kategori'];
            $barang->kode_barang = $validatedData['kode_barang'];
            $barang->penanggung_jawab = $validatedData['penanggungjawab'];
            $barang->bukti_gambar = $validatedData['gambar'] ?? null;
            $barang->ruangan_id = $validatedData['ruangan'];
            $barang->tanggal_masuk = $validatedData['masuk'];
            $barang->status = 0;
            $barang->sumber_barang = $validatedData['sumber'];
            $barang->lokasi = $validatedData['kantor'];
            $barang->lampiran = $validatedData['file'] ?? null;
            $barang->save();

            // Generate dan simpan barcode
            $qrCode = QrCode::format('png')->size(200)->generate($validatedData['kode_barang']);
            $fileName = $validatedData['kode_barang'] . '.png';
            $path = public_path('barcodes/' . $fileName);
            file_put_contents($path, $qrCode);

            return redirect()->back()->with('success', 'Barang berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambahkan barang.');
        }
    }

    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        // Proses import
        Excel::import(new BarangImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data barang berhasil diimport dan barcode dibuat.');
    }



    public function generateQRCode($kode)
    {
        // Generate QR code sebagai gambar PNG untuk ditampilkan saja
        $qrCode = QrCode::format('png')->size(200)->generate($kode);

        // Return HTML image tag
        return '<img src="data:image/png;base64,' . base64_encode($qrCode) . '" alt="Barcode" />';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Hapus data berdasarkan ID
            barang::findOrFail($id)->delete();

            return redirect()->back()->with('success', 'Barang berhasil dihapus.');
        } catch (\Illuminate\Validation\ValidationException | \Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data barang.');
        }
    }
}
