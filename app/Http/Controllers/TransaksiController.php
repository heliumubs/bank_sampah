<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        return Transaksi::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_Transaksi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'kontak' => 'required|string|max:255',
        ]);

        return Transaksi::create($request->all());
    }

    public function show($id)
    {
        return Transaksi::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $Transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'nama_Transaksi' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
            'kontak' => 'sometimes|required|string|max:255',
        ]);

        $Transaksi->update($request->all());

        return $Transaksi;
    }

    public function destroy($id)
    {
        $Transaksi = Transaksi::findOrFail($id);
        $Transaksi->delete();

        return response()->json(['message' => 'Transaksi deleted successfully']);
    }
}