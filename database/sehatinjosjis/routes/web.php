<?php

use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

// Halaman awal diarahkan ke Program Management Sehatin
Route::redirect('/', '/programs');

// CRUD Program: index, create, store, edit, update, destroy
Route::resource('programs', ProgramController::class)->except(['show']);
