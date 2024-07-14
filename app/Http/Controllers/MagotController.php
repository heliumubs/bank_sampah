<?php

namespace App\Http\Controllers;

use App\Models\magot;
use Illuminate\Http\Request;

class MagotController extends Controller
{
    public function index()
    {
        return Magot::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
            'deskripsi' => 'required|string',
        ]);

        $fotoPath = $request->file('foto')->store('magot_photos'); // Simpan foto ke storage

        $magot = new Magot([
            'nama' => $request->get('nama'),
            'jenis' => $request->get('jenis'),
            'foto' => $fotoPath,
            'deskripsi' => $request->get('deskripsi'),
        ]);

        $magot->save();

        return response()->json(['message' => 'Magot created', 'data' => $magot]);
    }

    public function show(Magot $magot)
    {
        return $magot;
    }

    public function update(Request $request, Magot $magot)
    {
        $request->validate([
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        if ($request->hasFile('foto')) {
            Storage::delete($magot->foto); // Hapus foto lama dari storage
            $fotoPath = $request->file('foto')->store('magot_photos'); // Simpan foto baru ke storage
            $magot->foto = $fotoPath;
        }

        $magot->nama = $request->get('nama');
        $magot->jenis = $request->get('jenis');
        $magot->deskripsi = $request->get('deskripsi');
        $magot->save();

        return response()->json(['message' => 'Magot updated', 'data' => $magot]);
    }

    public function destroy(Magot $magot)
    {
        Storage::delete($magot->foto); // Hapus foto dari storage sebelum menghapus data
        $magot->delete();

        return response()->json(['message' => 'Magot deleted']);
    }
}