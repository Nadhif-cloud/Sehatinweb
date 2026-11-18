<?php

use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/sehatin.html');
Route::get('/data/program.json', function () {
    $path = base_path('data/program.json');
    abort_unless(is_file($path), 404);

    return response()->json(
        json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR),
    );
})->name('program.config');

Route::resource('programs', ProgramController::class);
