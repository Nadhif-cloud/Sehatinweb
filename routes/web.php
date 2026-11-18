<?php

use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/sehatin.html');
Route::resource('programs', ProgramController::class);
