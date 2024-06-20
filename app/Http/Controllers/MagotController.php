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
            'nama_Magot' => 'required|string|max:255',
            'alamat' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'kontak' => 'required|string|max:255',
        ]);

        return Magot::create($request->all());
    }

    public function show($id)
    {
        return Magot::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $Magot = Magot::findOrFail($id);

        $request->validate([
            'nama_Magot' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
            'kontak' => 'sometimes|required|string|max:255',
        ]);

        $Magot->update($request->all());

        return $Magot;
    }

    public function destroy($id)
    {
        $Magot = Magot::findOrFail($id);
        $Magot->delete();

        return response()->json(['message' => 'Magot deleted successfully']);
    }
}