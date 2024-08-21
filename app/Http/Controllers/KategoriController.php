<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
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
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);
    
        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->input('nama_kategori');
        $kategori->save();
    
        return back()->with('success', 'Kategori berhasil diubah');
=======
>>>>>>> Stashed changes
        try {
            // Validasi data
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
                'nama_ruang' => 'required|string|max:255',
                'lantai' => 'required|integer',
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
<<<<<<< Updated upstream
=======
>>>>>>> dc9228ed3150b2000358ddb9510bfb22c8fafe62
>>>>>>> Stashed changes
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
    
        return back()->with('success', 'Kategori berhasil dihapus');   
    }
}
