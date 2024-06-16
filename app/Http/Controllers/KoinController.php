<?php

namespace App\Http\Controllers;

use App\Models\koin;
use Illuminate\Http\Request;

class KoinController extends Controller
{
    public function index()
    {
        return Koin::all();
    }

    public function show($id)
    {
        return Koin::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengguna_id' => 'required|exists:penggunas,id',
            'jumlah' => 'required|numeric',
        ]);

        $koin = Koin::create($request->all());

        return response()->json($koin, 201);
    }

    public function update(Request $request, $id)
    {
        $koin = Koin::findOrFail($id);

        $request->validate([
            'jumlah' => 'required|numeric',
        ]);

        $koin->update($request->all());

        return response()->json($koin, 200);
    }

    public function destroy($id)
    {
        Koin::destroy($id);

        return response()->json(null, 204);
    }
}