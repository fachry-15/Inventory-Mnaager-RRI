<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Kategori;
use App\Models\ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori', compact('kategori'));
    }

    public function detailkategori($id)
    {
        // Mengambil semua data kategori dan ruangan
        $kategori = Kategori::all();
        $ruangans = Ruangan::all();

        // Mengambil data barang dengan nama_barang yang unik saja dan sesuai dengan kategori_id
        $barangs = Barang::select('nama_barang', DB::raw('MIN(kategori_id) as kategori_id'), DB::raw('MIN(ruangan_id) as ruangan_id'), DB::raw('MIN(tanggal_masuk) as tanggal_masuk'), DB::raw('MIN(tanggal_kadaluarsa) as tanggal_kadaluarsa'))
            ->where('kategori_id', $id)
            ->groupBy('nama_barang')
            ->get();

        // Menghitung jumlah barang berdasarkan nama_barang dan sesuai dengan kategori_id
        $barangCounts = Barang::select('nama_barang', DB::raw('count(*) as total'))
            ->where('kategori_id', $id)
            ->groupBy('nama_barang')
            ->get();

        // Mengirim data ke view
        return view('daftarkategori', compact('barangs', 'kategori', 'ruangans', 'barangCounts'));
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
        // Validasi data
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        $kategori = new Kategori;
        $kategori->nama_kategori = $validatedData['nama_kategori'];
        $kategori->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
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
        try {
            // Validasi data
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);

            // Temukan data berdasarkan ID
            $kategori = Kategori::findOrFail($id);

            // Update data
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->save();

            // Redirect atau response
            return redirect()->back()->with('success', 'Data Kategori berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException | \Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data kategori.');
        }
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
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();

            return back()->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus kategori.');
        }
    }
}
