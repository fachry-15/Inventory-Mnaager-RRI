<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Kategori;
use App\Models\ruangan;
use Illuminate\Http\Request;

class PindahBarangController extends Controller
{
    public function menu()
    {
        $ruangan = ruangan::all();
        return view('pemindahanMenu', compact('ruangan'));
    }


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
        return view('pindah', compact('barangs', 'ruangans', 'kategori'));
    }

    public function pindahotomatis()
    {
        $barangs = barang::with('ruangans', 'kategori')->get();
        return view('PindahBarangOtomatis', compact('barangs'));
    }

    public function updateRuangan(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'kode_barang' => 'required|string|max:255',
            'ruangan' => 'required|string|max:255',
        ]);

        // Cari barang berdasarkan kode_barang
        $barang = Barang::where('kode_barang', $validatedData['kode_barang'])->first();

        if ($barang) {
            // Update kolom ruangan
            $barang->ruangan_id = $validatedData['ruangan'];
            $barang->save();

            return redirect()->back()->with('success', 'Ruangan berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }
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
        // Validasi input
        $request->validate([
            'kode_barang' => 'required',
            'ruangan_id' => 'required',
            'jumlah' => 'required|integer|min:1',
        ]);

        $kodeBarang = $request->input('kode_barang');
        $ruanganId = $request->input('ruangan_id');
        $jumlah = $request->input('jumlah');
        $barang = Barang::where('kode_barang', $kodeBarang)->first();

        if (!$barang || $barang->jumlah < $jumlah) {
            return back()->withErrors(['msg' => 'Jumlah barang tidak mencukupi atau barang tidak ditemukan.']);
        }

        // Cek apakah barang dengan kode_barang dan ruangan_id sudah ada di database
        $barangDiRuangan = Barang::where('kode_barang', $kodeBarang)
            ->where('ruangan_id', $ruanganId)
            ->first();

        if ($barangDiRuangan) {
            // Update kuantitas barang di ruangan tujuan
            $barangDiRuangan->jumlah += $jumlah;
            $barangDiRuangan->save();
        } else {
            // Buat data baru untuk barang di ruangan tujuan
            Barang::create([
                'kode_barang' => $kodeBarang,
                'nama_barang' => $barang->nama_barang,
                'ruangan_id' => $ruanganId,
                'kategori_id' => $request->input('kategori_id'),
                'jumlah' => $jumlah,
                'satuan_barang' => $barang->satuan_barang,
                'tanggal_maintenace' => $request->input('tanggal_maintenace'),
                'tanggal_kadaluarsa' => $request->input('tanggal_kadaluarsa'),
                'penanggung_jawab' => $request->input('penanggung_jawab'),
                'bukti_gambar' => $request->file('bukti_gambar')->store('images'),
                'tanggal_pindah' => $request->input('tanggal_pindah'),
            ]);
        }

        // Kurangi jumlah barang dari ruangan asal
        $barang->jumlah -= $jumlah;
        $barang->save();

        return back()->with('success', 'Barang berhasil dipindahkan.');
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
