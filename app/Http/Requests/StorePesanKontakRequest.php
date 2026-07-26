<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePesanKontakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', 'max:255'],
            'subjek' => ['required', 'string', 'max:255'],
            'pesan'  => ['required', 'string', 'min:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'   => 'Nama wajib diisi.',
            'email.required'  => 'Email wajib diisi.',
            'email.email'     => 'Format email tidak valid.',
            'subjek.required' => 'Subjek wajib diisi.',
            'pesan.required'  => 'Pesan wajib diisi.',
            'pesan.min'       => 'Pesan minimal 10 karakter.',
        ];
    }
}
