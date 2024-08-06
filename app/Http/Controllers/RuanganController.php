<?php

namespace App\Http\Controllers;

use App\Models\ruangan;
use Illuminate\Http\Request;

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
                'nama' => 'required|string|max:255',
                'kode' => 'nullable|string',
                // Add more validation rules for other fields if needed
            ]);

            // Create a new Ruangan instance
            $ruangan = new ruangan();
            $ruangan->nama_ruang = $validatedData['nama'];
            $ruangan->kode_ruang = $validatedData['kode'];
            // Set other properties of the Ruangan instance if needed

            // Save the Ruangan instance to the database
            $ruangan->save();

            // Redirect to the index page or show a success message
            return redirect()->route('dashboard')->with('success', 'Ruangan created successfully');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', 'An error occurred while creating the Ruangan');
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
