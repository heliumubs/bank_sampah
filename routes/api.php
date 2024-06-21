<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\JenisSampahController;
use App\Http\Controllers\EdukasiSampahController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KoinController;

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


Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);