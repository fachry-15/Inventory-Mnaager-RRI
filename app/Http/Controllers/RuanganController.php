<?php

namespace App\Http\Controllers;

use App\Models\ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruangans = ruangan::all();
        return view('ruangan', compact('ruangans'));
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
            $data = $request->all();

            // Validate the request data
            $validatedData = $request->validate([
                'kode_ruang' => 'nullable|string',
                'nama_ruang' => 'required|string|max:255',
                'lantai' => 'required|integer',

                // Add more validation rules for other fields if needed
            ]);

            // Create a new Ruangan instance
            $ruangan = new ruangan();
            $ruangan->kode_ruang = $validatedData['kode_ruang'];
            $ruangan->nama_ruang = $validatedData['nama_ruang'];
            $ruangan->lantai = $validatedData['lantai'];

            // Set other properties of the Ruangan instance if needed

            // Save the Ruangan instance to the database
            $ruangan->save();

            // Redirect to the index page or show a success message
            return redirect()->route('dashboard')->with('success', 'Ruangan created successfully');
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
        try {
            // Validasi data
            $request->validate([
                'kode_ruang' => 'required|string|max:255',
                'nama_ruang' => 'required|string|max:255',
                'lantai' => 'required|integer',
            ]);

            // Temukan data berdasarkan ID
            $ruang = ruangan::findOrFail($id);

            // Update data
            $ruang->kode_ruang = $request->kode_ruang;
            $ruang->nama_ruang = $request->nama_ruang;
            $ruang->lantai = $request->lantai;
            $ruang->save();

            // Redirect atau response
            return redirect()->back()->with('success', 'Data ruangan berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException | \Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data ruangan.');
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
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();
    
        return back()->with('success', 'Ruangan berhasil dihapus');
    }
}
