<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Kategori;
use App\Models\ruangan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = barang::all();
        $kategori = Kategori::all();
        $ruangans = ruangan::all();
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
                'kategori' => 'required|string|max:255',
                'kode_barang' => 'required|string|max:255|unique:barangs,kode_barang', // Mengganti nama kolom menjadi kode_barang
                'jumlah' => 'required|integer',
                'satuan' => 'required|string|max:255',
                'penanggungjawab' => 'required|string|max:255',
                'ruangan' => 'required|integer',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'masuk' => 'required|date',
                'maintenance' => 'nullable|date',
            ]);

            // Upload gambar jika ada
            // Upload gambar jika ada
            if ($request->hasFile('gambar')) {
                $imageName = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('images'), $imageName);
                $validatedData['gambar'] = $imageName;
            }

            // Simpan data ke database
            $barang = new Barang;
            $barang->nama_barang = $validatedData['nama'];
            $barang->kategori_barang = $validatedData['kategori'];
            $barang->kode_barang = $validatedData['kode_barang']; // Mengganti nama kolom menjadi kode_barang
            $barang->jumlah_barang = $validatedData['jumlah'];
            $barang->satuan_barang = $validatedData['satuan'];
            $barang->penanggung_jawab = $validatedData['penanggungjawab'];
            $barang->bukti_gambar = $validatedData['gambar'];
            $barang->ruangan_id = $validatedData['ruangan'];
            $barang->tanggal_masuk = $validatedData['masuk'];
            $barang->tanggal_maintenace = $validatedData['maintenance'];
            $barang->save();

            return redirect()->back()->with('success', 'Barang berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException | \Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Mohon Maaf, stok barang tidak mencukupi');
        }
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
        //
    }
}
