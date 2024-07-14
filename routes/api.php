<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\JenisSampahController;
use App\Http\Controllers\EdukasiSampahController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KoinController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\MagotController;
use App\Http\Controllers\PupukController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('sampahs', SampahController::class);

Route::apiResource('jenis-sampahs', JenisSampahController::class);

Route::apiResource('edukasi-sampahs', EdukasiSampahController::class);

Route::apiResource('penggunas', PenggunaController::class);


Route::apiResource('transaksis', TransaksiController::class);

Route::apiResource('lokasis', LokasiController::class);
Route::apiResource('koins', KoinController::class);


Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::apiResource('beritas', BeritaController::class);
Route::apiResource('banners', BannerController::class);
Route::get('/koins/total/{id}', [KoinController::class,'show_total']);


Route::get('magots', [MagotController::class, 'index']);
Route::post('magots', [MagotController::class, 'store']);
Route::get('magots/{id}', [MagotController::class, 'show']);
Route::put('magots/{id}', [MagotController::class, 'update']);
Route::delete('magots/{id}', [MagotController::class, 'destroy']);

Route::get('pupuks', [PupukController::class, 'index']);
Route::post('pupuks', [PupukController::class, 'store']);
Route::get('pupuks/{id}', [PupukController::class, 'show']);
Route::put('pupuks/{id}', [PupukController::class, 'update']);
Route::delete('pupuks/{id}', [PupukController::class, 'destroy']);


Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);