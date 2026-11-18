<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Aturan update sama dengan tambah agar nama dan deskripsi selalu valid.
        return [
            'nama' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama program wajib diisi.',
            'nama.max' => 'Nama program maksimal 100 karakter.',
            'deskripsi.required' => 'Deskripsi program wajib diisi.',
        ];
    }
}
