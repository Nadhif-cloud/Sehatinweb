<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            ['Program Olahraga', 'Rangkaian latihan untuk menjaga kebugaran tubuh.'],
            ['Rekomendasi Menu Sehat', 'Pilihan resep sehat lengkap dengan bahan, kalori, dan waktu memasak.'],
            ['Kalkulator BMI', 'Hitung indeks massa tubuh berdasarkan tinggi dan berat badan.'],
            ['Agenda Harian', 'Rencana aktivitas harian untuk membantu membangun kebiasaan sehat.'],
        ] as [$nama, $deskripsi]) {
            Program::firstOrCreate(['nama' => $nama], ['deskripsi' => $deskripsi]);
        }
    }
}
