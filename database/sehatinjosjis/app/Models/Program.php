<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    // Kolom yang boleh diisi lewat Program::create() / update()
    protected $fillable = [
        'nama',
        'deskripsi',
    ];
}
