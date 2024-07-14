<?php

namespace App\Http\Controllers;

use App\Models\pupuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PupukController extends Controller
{
    public function index()
    {
        $pupuks = Pupuk::all();
        return response()->json($pupuks);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string',
            'fungsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/pupuks', $fileName, 'public');

            $data = [
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'foto' => $filePath,
                'deskripsi' => $request->deskripsi,
                'fungsi' => $request->fungsi,
            ];

            $pupuk = Pupuk::create($data);

            return response()->json($pupuk, 201);
        } else {
            return response()->json(['message' => 'Foto pupuk tidak ditemukan'], 400);
        }
    }

    public function show($id)
    {
        $pupuk = Pupuk::find($id);

        if (!$pupuk) {
            return response()->json(['message' => 'Pupuk not found'], 404);
        }

        return response()->json($pupuk);
    }

    public function update(Request $request, $id)
    {
        $pupuk = Pupuk::find($id);

        if (!$pupuk) {
            return response()->json(['message' => 'Pupuk not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'deskripsi' => 'required|string',
            'fungsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Handle file upload if there's a new photo
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/pupuks', $fileName, 'public');

            // Delete old photo if exists
            if (Storage::disk('public')->exists($pupuk->foto)) {
                Storage::disk('public')->delete($pupuk->foto);
            }

            $pupuk->foto = $filePath;
        }

        $pupuk->nama = $request->nama;
        $pupuk->jenis = $request->jenis;
        $pupuk->deskripsi = $request->deskripsi;
        $pupuk->fungsi = $request->fungsi;
        $pupuk->save();

        return response()->json($pupuk);
    }

    public function destroy($id)
    {
        $pupuk = Pupuk::find($id);

        if (!$pupuk) {
            return response()->json(['message' => 'Pupuk not found'], 404);
        }

        // Delete photo from storage
        if (Storage::disk('public')->exists($pupuk->foto)) {
            Storage::disk('public')->delete($pupuk->foto);
        }

        $pupuk->delete();

        return response()->json(['message' => 'Pupuk deleted']);
    }
}