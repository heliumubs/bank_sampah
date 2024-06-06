<?php

namespace App\Http\Controllers;

use App\Models\sampah;
use Illuminate\Http\Request;

class SampahController extends Controller
{
    public function index()
    {
        return Sampah::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sampah' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'jenis' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
        ]);

        return Sampah::create($request->all());
    }

    public function show($id)
    {
        return Sampah::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $sampah = Sampah::findOrFail($id);

        $request->validate([
            'nama_sampah' => 'sometimes|required|string|max:255',
            'keterangan' => 'sometimes|required|string',
            'jenis' => 'sometimes|required|string|max:255',
            'harga' => 'sometimes|required|string|max:255',
        ]);

        $sampah->update($request->all());

        return $sampah;
    }

    public function destroy($id)
    {
        $sampah = Sampah::findOrFail($id);
        $sampah->delete();

        return response()->json(['message' => 'Sampah deleted successfully']);
    }
}