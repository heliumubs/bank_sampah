<?php

namespace App\Http\Controllers;

use App\Models\pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        return Pengguna::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
            // 'nomor_identifikasi' => 'required|string|unique:penggunas,nomor_identifikasi',
            'jenis_pengguna' => 'required|in:penyetor,pengelola,pembeli',
        ]);

        return Pengguna::create($request->all());
    }

    public function show($id)
    {
        return Pengguna::where('id_user',$id)->get();
    }

    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $request->validate([
            'id_user' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string',
            'telepon' => 'sometimes|required|string|max:15',
            'nomor_identifikasi' => 'sometimes|required|string|unique:penggunas,nomor_identifikasi,' . $id,
            'jenis_pengguna' => 'sometimes|required|in:penyetor,pengelola,pembeli',
        ]);

        $pengguna->update($request->all());

        return $pengguna;
    }

    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return response()->json(['message' => 'Pengguna deleted successfully']);
    }
}