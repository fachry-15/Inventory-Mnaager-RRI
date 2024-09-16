<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KantorControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kantor = Kantor::all();
        return view('daftarkantor', compact('kantor'));
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
                'kantor' => 'required|string|max:255',
                'kota' => 'required|string|max:255',
                'Alamat' => 'required|string|max:255',
            ]);

            // Simpan data ke database
            $kantor = new Kantor;
            $kantor->nama_kantor = $validatedData['kantor'];
            $kantor->Kota = $validatedData['kota'];
            $kantor->alamat_kantor = $validatedData['Alamat'];
            $kantor->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Kantor berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangani kesalahan validasi
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log kesalahan dan tampilkan pesan error
            Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambahkan kantor.');
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

    public function getKota()
    {
        $client = new Client();
        $response = $client->get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/35.json');
        $data = json_decode($response->getBody(), true);

        return response()->json($data);
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
            $validatedData = $request->validate([
                'kantor' => 'required|string|max:255',
                'kota' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
            ]);

            // Temukan kantor berdasarkan ID
            $kantor = Kantor::findOrFail($id);

            // Perbarui data kantor
            $kantor->nama_kantor = $validatedData['kantor'];
            $kantor->kota = $validatedData['kota'];
            $kantor->alamat_kantor = $validatedData['alamat'];
            $kantor->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Kantor berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangani kesalahan validasi
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log kesalahan dan tampilkan pesan error
            Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui kantor.');
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
        // Find the Karyawan model instance by ID
        $kantor = Kantor::findOrFail($id);

        // Delete the model instance from the database
        $kantor->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data Kantor Berhasil dihapus.');
    }
}
