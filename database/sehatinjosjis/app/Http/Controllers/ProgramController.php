<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramController extends Controller
{
    /**
     * READ - tampilkan semua program dari database.
     */
    public function index(): View
    {
        $programs = Program::orderBy('id')->get();

        return view('programs.index', compact('programs'));
    }

    /**
     * CREATE - form tambah program.
     */
    public function create(): View
    {
        return view('programs.create');
    }

    /**
     * CREATE - simpan program baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        Program::create($this->validated($request));

        return redirect()->route('programs.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    /**
     * UPDATE - form edit program.
     */
    public function edit(Program $program): View
    {
        return view('programs.edit', compact('program'));
    }

    /**
     * UPDATE - simpan perubahan program.
     */
    public function update(Request $request, Program $program): RedirectResponse
    {
        $program->update($this->validated($request));

        return redirect()->route('programs.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    /**
     * DELETE - hapus program dari database.
     */
    public function destroy(Program $program): RedirectResponse
    {
        $program->delete();

        return redirect()->route('programs.index')
            ->with('success', 'Program berhasil dihapus.');
    }

    /**
     * Validasi dasar agar kolom tidak kosong dan tidak melebihi batas tabel.
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'max:5000'],
        ], [
            'nama.required' => 'Nama program wajib diisi.',
            'nama.max' => 'Nama program maksimal 255 karakter.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 5000 karakter.',
        ]);
    }
}
