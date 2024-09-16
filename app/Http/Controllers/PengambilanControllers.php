<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Peminjaman;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Concerns\FromView;

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

    public function updateStatus($id)
    {
        $item = Peminjaman::find($id);

        if ($item && $item->status_peminjaman == 'Sedang digunakan') {
            // Update status peminjaman
            $item->status_peminjaman = 'Telah Dikembalikan';
            $item->save();

            // Update status barang menjadi kosong
            $barang = Barang::where('id', $item->barang_id)->first();
            if ($barang) {
                $barang->status = null;
                $barang->save();
            }

            return redirect()->back()->with('success', 'Barang berhasil dikembalikan.');
        } else {
            return redirect()->back()->with('danger', 'Mohon maaf, barang sudah dikembalikan.');
        }
    }

    public function scan(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'kode_barang' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
        ]);

        // Cek apakah barang sedang digunakan
        $cek = Peminjaman::where([
            'barang_id' => $validatedData['kode_barang'],
            'status_peminjaman' => 'sedang digunakan',
        ])->first();

        if ($cek) {
            Log::info('Barang sedang digunakan', ['kode_barang' => $validatedData['kode_barang']]);
            return redirect()->back()->with('error', 'Mohon maaf barang sedang digunakan saat ini.');
        }

        // Simpan data ke database
        $peminjaman = new Peminjaman();
        $peminjaman->barang_id = $validatedData['kode_barang'];
        $peminjaman->status_peminjaman = 'sedang digunakan';
        $peminjaman->kegiatan = $validatedData['kegiatan'];
        $peminjaman->tanggal_peminjaman = $validatedData['tanggal_kegiatan'];
        $peminjaman->mulai_acara = $validatedData['jam_mulai'];
        $peminjaman->selesai_acara = $validatedData['jam_selesai'];
        $peminjaman->save();

        // Update status barang menjadi 1
        $barang = Barang::where('id', $validatedData['kode_barang'])->first();
        if ($barang) {
            $barang->status = 1;
            $barang->save();
        }

        Log::info('Barang berhasil dipinjam', ['kode_barang' => $validatedData['kode_barang']]);

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

    public function exportExcel()
    {
        return Excel::download(new class implements FromView {
            public function view(): \Illuminate\Contracts\View\View
            {
                return view('excelbarang', [
                    'barangs' => Barang::with('ruangans', 'kategori')->get()
                ]);
            }
        }, 'peminjaman.xlsx');
    }
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'kode_barang' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'jam_mulai' => 'required|string|max:255',
            'jam_selesai' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        $peminjaman = new Peminjaman();
        $peminjaman->barang_id = $validatedData['kode_barang'];
        $peminjaman->kegiatan = $validatedData['kegiatan'];
        $peminjaman->tanggal_kegiatan = $validatedData['tanggal_kegiatan'];
        $peminjaman->jam_mulai = $validatedData['jam_mulai'];
        $peminjaman->jam_selesai = $validatedData['jam_selesai'];
        $peminjaman->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
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
