<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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


//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/jenis', [JenisController::class, 'store']);
    Route::delete('/jenis/{id}', [JenisController::class, 'destroy']);
    Route::put('/jenis/{id}', [JenisController::class, 'update']);

    Route::post('/satuan', [SatuanController::class, 'store']);
    Route::delete('/satuan/{id}', [SatuanController::class, 'destroy']);
    Route::put('/satuan/{id}', [SatuanController::class, 'update']);

    Route::post('/barang', [BarangController::class, 'store']);
    Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
    Route::put('/barang/{id}', [BarangController::class, 'update']);

    Route::post('/supplier', [SupplierController::class, 'store']);
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']);
    Route::put('/supplier/{id}', [SupplierController::class, 'update']);

    Route::post('/barang_masuk', [BarangMasukController::class, 'store']);
    Route::delete('/barang_masuk/{id}', [BarangMasukController::class, 'destroy']);
    Route::put('/barang_masuk/{id}', [BarangMasukController::class, 'update']);

    Route::post('/barang_keluar', [BarangKeluarController::class, 'store']);
    Route::delete('/barang_keluar/{id}', [BarangKeluarController::class, 'destroy']);
    Route::put('/barang_keluar/{id}', [BarangKeluarController::class, 'update']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

//public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/jenis', [JenisController::class, 'index']);
Route::get('/jenis/{id}', [JenisController::class, 'show']);

Route::get('/satuan', [SatuanController::class, 'index']);
Route::get('/satuan/{id}', [SatuanController::class, 'show']);

Route::get('/supplier', [SupplierController::class, 'index']);
Route::get('/supplier/{id}', [SupplierController::class, 'show']);

Route::get('/barang_masuk', [BarangMasukController::class, 'index']);
Route::get('/barang_masuk/{id}', [BarangMasukController::class, 'show']);

Route::get('/barang_keluar', [BarangKeluarController::class, 'index']);
Route::get('/barang_keluar/{id}', [BarangKeluarController::class, 'show']);
//Route::resource('jenis', JenisController::class)->except('edit', 'create');
