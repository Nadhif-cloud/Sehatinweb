<?php
class Sehatin
{
    private array $profile;
    private array $programs;
    private string $programError = '';

    public function __construct()
    {
        $this->profile = [
            'name' => 'Sehatin',
            'pageTitle' => 'Rekomendasi Menu Sehat',
            'label' => 'Rekomendasi Sehatin',
            'description' => 'Pilihan resep lengkap dengan informasi bahan, waktu memasak, dan kalori per sajian.',
        ];
        $this->programs = $this->loadPrograms();
    }

    public function getProfile(): array { return $this->profile; }
    public function getPrograms(): array { return $this->programs; }
    public function getProgramError(): string { return $this->programError; }

    private function loadPrograms(): array
    {
        $programFile = __DIR__ . '/../data/program.json';
        if (!is_file($programFile) || !is_readable($programFile)) {
            $this->programError = 'Data program tidak dapat dibaca.';
            return [];
        }
        $programJson = file_get_contents($programFile);
        if ($programJson === false) {
            $this->programError = 'Data program gagal dimuat.';
            return [];
        }
        $programData = json_decode($programJson, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->programError = 'Format data program tidak valid.';
            return [];
        }
        if (!isset($programData['recipes']) || !is_array($programData['recipes'])) {
            $this->programError = 'Daftar menu belum tersedia.';
            return [];
        }
        return $programData['recipes'];
    }
}
