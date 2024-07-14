<?php

namespace App\Http\Controllers;

use App\Models\jenis_sampah;
use Illuminate\Http\Request;

class JenisSampahController extends Controller
{
    public function index()
{
    $jenisSampahs = Jenis_sampah::all();
    return response()->json($jenisSampahs);
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255|unique:jenis_sampahs',
        'deskripsi' => 'nullable|string',
    ]);

    $jenisSampah = Jenis_sampah::create($request->all());

    return response()->json($jenisSampah, 201);
}

public function show($id)
{
    $jenisSampah = Jenis_sampah::findOrFail($id);
    return response()->json($jenisSampah);
}

public function update(Request $request, $id)
{
    $jenisSampah = Jenis_sampah::findOrFail($id);

    $request->validate([
        'nama' => 'sometimes|required|string|max:255|unique:jenis_sampahs,nama,' . $jenisSampah->id,
        'deskripsi' => 'nullable|string',
    ]);

    $jenisSampah->update($request->all());

    return response()->json($jenisSampah);
}

public function destroy($id)
{
    $jenisSampah = Jenis_sampah::findOrFail($id);
    $jenisSampah->delete();

    return response()->json(['message' => 'Jenis Sampah deleted successfully']);
}

}