<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AuthorController;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/{slug}', [BeritaController::class, 'kategori'])->name('berita.kategori');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/author/{username}', [AuthorController::class, 'show'])->name('author.show');