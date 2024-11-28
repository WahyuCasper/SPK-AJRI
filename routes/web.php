<?php

use App\Http\Controllers\analisisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataUserController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->name('tentang-kami');

Route::get('/analisis', [analisisController::class, 'index'])->name('data-users.analisis');
Route::get('/analisis/saw', [analisisController::class, 'hitungSAW'])->name('analisis-saw');

Route::get('/import-data', [DataUserController::class, 'index'])->name('data-users.index');
Route::post('/data-users/import', [DataUserController::class, 'import'])->name('data-users.import');
Route::delete('/data-users/{id}', [DataUserController::class, 'destroy'])->name('data-users.destroy');
Route::delete('/data-users', [DataUserController::class, 'destroyAll'])->name('data-users.destroyAll');

Route::get('/data-users/{id}/edit', [DataUserController::class, 'edit'])->name('data-users.edit');
Route::put('/data-users/{id}', [DataUserController::class, 'update'])->name('data-users.update');

Route::post('/update-data-users', [analisisController::class, 'updateDataUsers'])->name('update-data-users');

