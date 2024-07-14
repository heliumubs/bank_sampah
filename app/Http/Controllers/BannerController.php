<?php

namespace App\Http\Controllers;

use App\Models\banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $Banners = Banner::all();
        return response()->json($Banners);
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $Banner = Banner::create([
            'photo' => $photoPath,
        ]);

        return response()->json($Banner, 201);
    }

    public function show($id)
    {
        $Banner = Banner::findOrFail($id);
        return response()->json($Banner);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $Banner = Banner::findOrFail($id);
        $photoPath = $Banner->photo;

        if ($request->hasFile('photo')) {
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $Banner->update([
            'photo' => $photoPath,
        ]);

        return response()->json($Banner);
    }

    public function destroy($id)
    {
        $Banner = Banner::findOrFail($id);
        if ($Banner->photo) {
            Storage::disk('public')->delete($Banner->photo);
        }
        $Banner->delete();
        return response()->json(null, 204);
    }
}