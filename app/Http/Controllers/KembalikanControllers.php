<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class KembalikanControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengembalian');
    }

    public function kembalikanotomatis()
    {
        $barangs = barang::with('ruangans', 'kategori')->get();
        $peminjaman = Peminjaman::with('barangs')->latest()->get();
        return view('kembalikanotomatis', compact('barangs', 'peminjaman'));
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
        //
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
    public function updateStatus(Request $request)
    {
        $kodeBarang = $request->input('kode_barang');
        $item = Peminjaman::where('barang_id', $kodeBarang)
            ->where('status_peminjaman', 'Sedang digunakan')
            ->first();

        if ($item) {
            $item->status_peminjaman = 'Telah Dkembalikan';
            $item->save();

            return redirect()->back()->with('success', 'Status barang berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Mohon maaf, barang yang anda inginkan sudah dikembalikan.');
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
        //
    }
}
