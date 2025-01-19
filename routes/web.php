<?php

use App\Http\Controllers\mobilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\sewaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('layout.master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/mobil',[mobilController::class,'index']);
    Route::get('/mobil/create',[mobilController::class,'create']);
    Route::post('/mobil',[mobilController::class,'store']);
    Route::get('/mobil/{mobil_id}',[mobilController::class,'show']);
    Route::get('/mobil/{mobil_id}/edit',[mobilController::class,'edit']);
    Route::put('/mobil/{mobil_id}',[mobilController::class,'update']);
    Route::delete('/mobil/{mobil_id}',[mobilController::class, 'destroy']);

    Route::get('/sewaMobil/{mobil_id}',[sewaController::class,'detailMobilSewa']);
    Route::get('/listMobil',[sewaController::class,'index']);
    Route::put('/sewaMobil/{mobil_id}',[sewaController::class,'sewa']);

    Route::get('/daftarSewa',[sewaController::class,'showPeminjaman']);
    Route::get('/kembalikanMobil/{mobil_id}',[sewaController::class,'detailPengembalian']);
    Route::put('/kembalikanMobil/{mobil_id}',[sewaController::class,'kembali']);

});

require __DIR__.'/auth.php';
