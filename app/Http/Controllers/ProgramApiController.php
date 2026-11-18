<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Models\Program;
use Illuminate\Http\JsonResponse;

/** Menangani CRUD program untuk REST API dan mengirim hasil dalam format JSON. */
class ProgramApiController extends Controller
{
    /** GET /api/programs: ambil seluruh program dari database. */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Program::query()->orderBy('id')->get(),
        ]);
    }

    /** POST /api/programs: validasi dan simpan program baru, lalu balas dengan status 201. */
    public function store(StoreProgramRequest $request): JsonResponse
    {
        $program = Program::create($request->validated());

        return response()->json([
            'message' => 'Program berhasil ditambahkan.',
            'data' => $program,
        ], 201);
    }

    /** GET /api/programs/{program}: tampilkan satu program berdasarkan ID (route model binding). */
    public function show(Program $program): JsonResponse
    {
        return response()->json(['data' => $program]);
    }

    /** PUT/PATCH /api/programs/{program}: validasi dan perbarui program yang dipilih. */
    public function update(UpdateProgramRequest $request, Program $program): JsonResponse
    {
        $program->update($request->validated());

        return response()->json([
            'message' => 'Program berhasil diperbarui.',
            'data' => $program->refresh(),
        ]);
    }

    /** DELETE /api/programs/{program}: hapus program yang dipilih. */
    public function destroy(Program $program): JsonResponse
    {
        $program->delete();

        return response()->json(['message' => 'Program berhasil dihapus.']);
    }
}
