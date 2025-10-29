<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

Route::get('/', [userController::class, 'index'])->name('index');
Route::post('/save', [userController::class, 'saveUser'])->name('saveUser');
Route::get('/fetch', [userController::class, 'fetchData'])->name('fetch');
Route::get('/getcsv', [userController::class, 'exportCsv'])->name('getcsv');
Route::get('/getpdf', [userController::class, 'exportPdf'])->name('getpdf');
Route::post('/search', [userController::class, 'search'])->name('search');
Route::get('/edit', [userController::class, 'edit'])->name('edit');
Route::post('/delete', [userController::class, 'delete'])->name('delete');
Route::post('/update', [userController::class, 'update'])->name('update');