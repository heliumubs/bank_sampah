<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\SampahController;

Route::apiResource('sampahs', SampahController::class);
use App\Http\Controllers\JenisSampahController;

Route::apiResource('jenis-sampahs', JenisSampahController::class);
use App\Http\Controllers\EdukasiSampahController;

Route::apiResource('edukasi-sampahs', EdukasiSampahController::class);
use App\Http\Controllers\PenggunaController;

Route::apiResource('penggunas', PenggunaController::class);
use App\Http\Controllers\TransaksiController;

Route::apiResource('transaksis', TransaksiController::class);
use App\Http\Controllers\LokasiController;

Route::apiResource('lokasis', LokasiController::class);
use App\Http\Controllers\LokasiBankSampahController;

Route::apiResource('lokasi-bank-sampah', LokasiBankSampahController::class);