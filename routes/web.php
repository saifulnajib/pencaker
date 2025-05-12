<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\TingkatPendidikanController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\BahasaAsingController;
use App\Http\Controllers\StatusPerkawinanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DisabilitasController;
use App\Http\Controllers\SektorUsahaController;
use App\Http\Controllers\KelompokJabatanController;
use App\Http\Controllers\BesaranUpahController;
use App\Http\Controllers\AK1Controller;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// =========================
// ROUTES UNTUK AUTENTIKASI
// =========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =========================
// ROUTES YANG MEMBUTUHKAN LOGIN
// =========================
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


    // =========================
    // ROUTES MASTER (CRUD MASTER)
    // =========================
    Route::get('/master', [MasterController::class, 'index'])->name('master.index');

    Route::prefix('master')->name('master.')->group(function () {
        Route::get('/', [MasterController::class, 'index'])->name('index'); // Menampilkan data master
        Route::post('/store', [MasterController::class, 'store'])->name('store'); // Simpan data baru
        Route::get('/edit/{id}', [MasterController::class, 'edit'])->name('edit'); // Form edit data
        Route::post('/update/{id}', [MasterController::class, 'update'])->name('update'); // Proses update
        Route::delete('/delete/{id}', [MasterController::class, 'destroy'])->name('destroy'); // Hapus data
    });

    // =========================
    // ROUTES PERUSAHAAN 
    // =========================
    Route::get('/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan.index');
    Route::get('/perusahaan/create', [PerusahaanController::class, 'create'])->name('perusahaan.create');
    Route::post('/perusahaan', [PerusahaanController::class, 'store'])->name('perusahaan.store');
    Route::get('/perusahaan/{id}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
    Route::put('/perusahaan/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
    Route::delete('/perusahaan/{id}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
    Route::post('/perusahaan/{id}/status', [PerusahaanController::class, 'updateStatus'])->name('perusahaan.status');

    // =========================
    // ROUTES LOKER (LOWONGAN KERJA)
    // =========================
    Route::get('/loker', [LokerController::class, 'index'])->name('loker.index');
    Route::resource('loker', LokerController::class);

   // Tingkat Pendidikan
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pendidikan', TingkatPendidikanController::class);
    });

    // Agama
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('agama', AgamaController::class);
    });

    // Bahasa Asing
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('bahasa_asing', BahasaAsingController::class);
    });

    // Status Perkawinan
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('status_perkawinan', StatusPerkawinanController::class);
    });

    // Kelurahan
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kecamatan', KecamatanController::class);
    Route::resource('kelurahan', KelurahanController::class);
    });

    // Kecamatan
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kecamatan', KecamatanController::class);
    });

    // Disabilitas
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/disabilitas', [DisabilitasController::class, 'index'])->name('disabilitas.index');
        Route::get('/disabilitas/create', [DisabilitasController::class, 'create'])->name('disabilitas.create');
        Route::post('/disabilitas', [DisabilitasController::class, 'store'])->name('disabilitas.store');
        Route::get('/disabilitas/{disabilitas}/edit', [DisabilitasController::class, 'edit'])->name('disabilitas.edit');
        Route::put('/disabilitas/{disabilitas}', [DisabilitasController::class, 'update'])->name('disabilitas.update');
        Route::delete('/disabilitas/{disabilitas}', [DisabilitasController::class, 'destroy'])->name('disabilitas.destroy');
    });

    //Sektor Usaha
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('sektor_usaha', SektorUsahaController::class);
    });

    //Kelompok Jabatan
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kelompok_jabatan', KelompokJabatanController::class);
    });

    //Besaran Upah
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('besaran_upah', BesaranUpahController::class);
    });


    //AK1
    Route::middleware(['auth'])->group(function () {
    Route::get('/ak1', [AK1Controller::class, 'index'])->name('admin.ak1.index');
    Route::get('/ak1/create', [AK1Controller::class, 'create'])->name('admin.ak1.create');
    Route::post('/ak1/store', [AK1Controller::class, 'store'])->name('admin.ak1.store');
    });


    //Logout
    Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login'); // Langsung kembali ke halaman login
    })->name('logout');


    Route::prefix('admin')->group(function () {
    Route::get('/ak1', [AK1Controller::class, 'index'])->name('ak1.index');
    Route::get('/ak1/create', [AK1Controller::class, 'create'])->name('ak1.create');
    Route::post('/admin/ak1', [Ak1Controller::class, 'store'])->name('ak1.store');
    Route::get('/ak1/{id}', [AK1Controller::class, 'show'])->name('ak1.show');
    Route::get('/ak1/{id}/edit', [AK1Controller::class, 'edit'])->name('ak1.edit');
    Route::put('/ak1/{id}', [AK1Controller::class, 'update'])->name('ak1.update');
    Route::delete('/ak1/{id}', [AK1Controller::class, 'destroy'])->name('ak1.destroy');
    });

    
});

