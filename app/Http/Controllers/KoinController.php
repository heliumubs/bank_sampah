<?php

namespace App\Http\Controllers;

use App\Models\koin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KoinController extends Controller
{
    public function index()
    {
        return Koin::all();
    }

    public function show($id)
    {
        return Koin::where('penggunas.id_user',$id)
        ->join('penggunas', 'koins.pengguna_id', '=', 'penggunas.id')
        ->get();
    }
    public function show_total($id)
    {
        return DB::table('koins')
        ->select(DB::raw('SUM(koins.jumlah) as total_jumlah'))
        ->join('penggunas', 'koins.pengguna_id', '=', 'penggunas.id')
        ->where('penggunas.id_user', $id)
        ->orderBy('koins.pengguna_id')
        ->groupBy('koins.pengguna_id')
        ->get();
    }

    public function store(Request $request)
    {
        // echo("ok");die;
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