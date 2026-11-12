<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Data awal program Sehatin (diambil dari fitur pada halaman utama).
     * Aman dijalankan berulang kali karena memakai updateOrCreate.
     */
    public function run(): void
    {
        $programs = [
            [
                'nama' => 'Kalkulator BMI & Kalori',
                'deskripsi' => 'Hitung Indeks Massa Tubuh (BMI) dan estimasi kebutuhan kalori harian sesuai usia, berat badan, tinggi badan, dan aktivitas fisik.',
            ],
            [
                'nama' => 'Daily Plan Adaptif',
                'deskripsi' => 'Rencana kesehatan harian pintar yang secara otomatis menyesuaikan target nutrisi dan jadwal waktu luang yang kamu miliki.',
            ],
            [
                'nama' => 'Panduan Latihan Fisik',
                'deskripsi' => 'Variasi gerakan olahraga efektif dari pemula hingga menengah yang hemat waktu, dapat dilakukan di kamar kost tanpa alat mahal.',
            ],
            [
                'nama' => 'Rekomendasi Makanan',
                'deskripsi' => 'Rekomendasi resep dan menu makanan sehat lengkap dengan informasi bahan, waktu memasak, dan kalori per sajian.',
            ],
        ];

        foreach ($programs as $program) {
            Program::updateOrCreate(['nama' => $program['nama']], $program);
        }
    }
}
