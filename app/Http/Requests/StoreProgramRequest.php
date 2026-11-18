<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProgramRequest extends FormRequest
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
        // Aturan ini tetap memeriksa data di server, meskipun validasi browser dilewati.
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
