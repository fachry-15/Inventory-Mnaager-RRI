<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Kategori;
use App\Models\ruangan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        $kategori = Kategori::all();
        $ruangans = ruangan::all();
        $barangs =  barang::with('ruangans', 'kategori')->get();
        return view('barang', compact('barangs', 'kategori', 'ruangans'));
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
                'maintenance' => 'nullable|date',
                'kadaluwarsa' => 'nullable|date',
            ]);

            // Upload gambar jika ada
            if ($request->hasFile('gambar')) {
                $imageName = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('images'), $imageName);
                $validatedData['gambar'] = $imageName;
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
            $barang->tanggal_maintenace = $validatedData['maintenance'] ?? null;
            $barang->tanggal_kadaluarsa = $validatedData['kadaluwarsa'] ?? null;
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
