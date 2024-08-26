<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Peminjaman;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Http\Request;

class PengambilanControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengambilan');
    }

    public function pengambilanmanual()
    {
        $barangs = barang::with('ruangans', 'kategori')->get();
        $peminjaman = Peminjaman::with('barangs')->latest()->get();
        return view('pengambilanmanual', compact('barangs', 'peminjaman'));
    }

    public function pengambilanotomatis()
    {
        $barangs = barang::with('ruangans', 'kategori')->get();
        $peminjaman = Peminjaman::with('barangs')->latest()->get();
        return view('pengambilanotomatis', compact('barangs', 'peminjaman'));
    }


    public function scan(Request $request)
    {
        $cek = Peminjaman::where([
            'barang_id' => $request->kode_barang,
            'status_peminjaman' => 'sedang digunakan'
        ])->first();

        if ($cek) {
            return redirect()->back()->with('error', 'Mohon maaf barang sedang digunakan saat ini.');
        }

        $peminjaman = new Peminjaman();
        $peminjaman->barang_id = $request->kode_barang;
        $peminjaman->status_peminjaman = 'Sedang digunakan';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Barang berhasil dipinjam.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

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
            'kode_barang' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        $peminjaman = new Peminjaman();
        $peminjaman->barang_id = $validatedData['kode_barang'];
        $peminjaman->status_peminjaman = $validatedData['status'];
        $peminjaman->save();

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
        $item = Peminjaman::find($id);

        if ($item) {
            $item->delete();
            return redirect()->back()->with('success', 'Barang berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }
    }
}
