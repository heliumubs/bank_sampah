<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();
        return response()->json($transaksis);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // echo("ok");die;
        $request->validate([
            'pengguna_id' => 'required|exists:penggunas,id',
            // 'sampah_id' => 'required|exists:sampahs,id',
            'kuantitas' => 'required|numeric',
            'nilai' => 'required|numeric',
        ]);

        $transaksi = Transaksi::create($request->all());
        return response()->json($transaksi, 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return response()->json($transaksi);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'pengguna_id' => 'required|exists:penggunas,id',
            'sampah_id' => 'required|exists:sampahs,id',
            'kuantitas' => 'required|numeric',
            'nilai' => 'required|numeric',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());
        return response()->json($transaksi);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return response()->json(null, 204);
    }
}