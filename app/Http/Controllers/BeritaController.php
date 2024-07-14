<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::all();
        return response()->json($beritas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $berita = Berita::create([
            'title' => $request->title,
            'content' => $request->content,
            'photo' => $photoPath,
        ]);

        return response()->json($berita, 201);
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return response()->json($berita);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $berita = Berita::findOrFail($id);
        $photoPath = $berita->photo;

        if ($request->hasFile('photo')) {
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $berita->update([
            'title' => $request->title,
            'content' => $request->content,
            'photo' => $photoPath,
        ]);

        return response()->json($berita);
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->photo) {
            Storage::disk('public')->delete($berita->photo);
        }
        $berita->delete();
        return response()->json(null, 204);
    }
}