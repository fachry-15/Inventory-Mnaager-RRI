<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\TicketPerawatan;
use Illuminate\Http\Request;

class MaintenanceControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = barang::all();
        $ticket = TicketPerawatan::with('barang')->get();
        return view('maintenance', compact('barang', 'ticket'));
    }

    public function getBarang()
    {
        $barang = barang::select('id', 'nama_barang')->get();
        return response()->json($barang);
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
            'kode_ticket' => 'required|string',
            'barang' => 'required|string|max:255',
            'jenis_perawatan' => 'required|string',
            'diagnosa' => 'required|string',
            'deskripsi' => 'required|string',
            'NotaDinas' => 'required|mimes:pdf|max:2048', // Validasi file PDF
        ]);

        try {
            // Simpan file Nota Dinas
            if ($request->hasFile('NotaDinas')) {
                $file = $request->file('NotaDinas');
                $filename = $request->input('kode_ticket') . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('berkas/NotaDinasMaintenance', $filename, 'public');
            }

            // Simpan data ke database
            $ticket = new TicketPerawatan();
            $ticket->kode_ticket = $request->input('kode_ticket');
            $ticket->barang_id = $request->input('barang');
            $ticket->jenis_perawatan = $request->input('jenis_perawatan');
            $ticket->diagnosa = $request->input('diagnosa');
            $ticket->deskripsi_perawatan = $request->input('deskripsi');
            $ticket->lampiran_file = $path ?? null; // Simpan path file jika ada
            $ticket->save();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Ticket maintenance berhasil dibuat.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal membuat ticket maintenance: ' . $e->getMessage());
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
