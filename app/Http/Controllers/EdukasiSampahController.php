<?php

namespace App\Http\Controllers;

use App\Models\edukasi_sampah;
use Illuminate\Http\Request;

class EdukasiSampahController extends Controller
{
    public function index()
    {
        return Edukasi_sampah::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
        ]);

        return Edukasi_sampah::create($request->all());
    }

    public function show($id)
    {
        return Edukasi_sampah::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $edukasiSampah = Edukasi_sampah::findOrFail($id);
        

        $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'konten' => 'sometimes|required|string',
            'kategori' => 'sometimes|required|string|max:255',
            'penulis' => 'sometimes|required|string|max:255',
        ]);

        var_dump($request);die;
        $edukasiSampah->update($request->all());
        
        return $edukasiSampah;
    }

    public function destroy($id)
    {
        $edukasiSampah = Edukasi_sampah::findOrFail($id);
        $edukasiSampah->delete();

        return response()->json(['message' => 'Edukasi Sampah deleted successfully']);
    }
}