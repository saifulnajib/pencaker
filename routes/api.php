<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RuteController;
use App\Http\Controllers\Api\SampahController;
use App\Http\Controllers\Api\KendaraanController;
use App\Http\Controllers\Api\JenisSampahController;
use App\Http\Controllers\Api\JenisKendaraanController;
use App\Http\Controllers\Api\KategoriPenyedotanController;
use App\Http\Controllers\Api\SuratRetribusiController;
use App\Http\Controllers\Api\PenyedotanTinjaController;
use App\Http\Controllers\Api\PemilahanSampahController;
use App\Http\Controllers\Api\PengolahanKomposController;
use App\Http\Controllers\Api\SurveyController;
use App\Http\Controllers\Api\QuestionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('', function(){
    return response()->json(["status" => true, "message" => "Hello from SIMLH APIv1"], 200);
});

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('user', 'userInfo');
    Route::get('logout', 'logout');
});

Route::middleware('auth.jwt')->group( function () {
    Route::apiResource('jenis-kendaraan', JenisKendaraanController::class);
    Route::get('option/jenis-kendaraan', [JenisKendaraanController::class, 'option']);
    Route::apiResource('kategori-penyedotan', KategoriPenyedotanController::class);
    Route::get('option/kategori-penyedotan', [KategoriPenyedotanController::class, 'option']);
    Route::apiResource('rute', RuteController::class);
    Route::get('option/rute', [RuteController::class, 'option']);
    Route::apiResource('kendaraan', KendaraanController::class);
    Route::get('option/kendaraan', [KendaraanController::class, 'option']);
    Route::apiResource('jenis-sampah', JenisSampahController::class);
    Route::get('option/jenis-sampah', [JenisSampahController::class, 'option']);
    Route::apiResource('sampah', SampahController::class);
    Route::apiResource('surat-retribusi', SuratRetribusiController::class);
    Route::apiResource('penyedotan-tinja', PenyedotanTinjaController::class);
    Route::apiResource('pemilahan-sampah', PemilahanSampahController::class);
    Route::apiResource('pengolahan-kompos', PengolahanKomposController::class);
    Route::apiResource('survey', SurveyController::class);
    Route::apiResource('question', QuestionController::class);
});
