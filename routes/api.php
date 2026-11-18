<?php

use App\Http\Controllers\ProgramApiController;
use Illuminate\Support\Facades\Route;

// Membuat endpoint CRUD JSON; Laravel menambahkan prefix /api dari bootstrap/app.php.
Route::apiResource('programs', ProgramApiController::class)
    ->names('api.programs');
