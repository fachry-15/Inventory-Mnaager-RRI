<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KaryawanControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akun = User::where('role', 'admin')->get();
        return view('karyawan', compact('akun'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // pastikan email unik di tabel users
            'password' => 'required|string|min:8',
        ]);

        // Buat karyawan baru
        $karyawan = new User(); // atau model karyawan jika ada
        $karyawan->name = $request->name;
        $karyawan->email = $request->email;
        $karyawan->password = Hash::make($request->password); // Simpan password yang di-hash
        $karyawan->save();

        // Redirect atau response setelah berhasil menyimpan
        return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan.');
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
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Find the Karyawan model instance by ID
        $karyawan = User::findOrFail($id);

        // Update the model instance with validated data
        $karyawan->name = $validatedData['name'];
        $karyawan->email = $validatedData['email'];

        // Save the changes to the database
        $karyawan->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Karyawan updated successfully.');
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
        $karyawan = User::findOrFail($id);

        // Delete the model instance from the database
        $karyawan->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Akun Karyawan berhasil dihapus.');
    }
}
