<?php

namespace App\Http\Controllers;

use App\Models\jenis_sampah;
use Illuminate\Http\Request;

class JenisSampahController extends Controller
{
    public function index()
    {
        return JenisSampah::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_sampahs',
            'deskripsi' => 'nullable|string',
        ]);

        return JenisSampah::create($request->all());
    }

    public function show($id)
    {
        return JenisSampah::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $jenisSampah = JenisSampah::findOrFail($id);

        $request->validate([
            'nama' => 'sometimes|required|string|max:255|unique:jenis_sampahs,nama,' . $jenisSampah->id,
            'deskripsi' => 'nullable|string',
        ]);

        $jenisSampah->update($request->all());

        return $jenisSampah;
    }

    public function destroy($id)
    {
        $jenisSampah = JenisSampah::findOrFail($id);
        $jenisSampah->delete();

        return response()->json(['message' => 'Jenis Sampah deleted successfully']);
    }
}