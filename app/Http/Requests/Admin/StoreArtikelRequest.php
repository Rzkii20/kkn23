<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreArtikelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string'],
            'foto_artikel' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul artikel wajib diisi.',
            'konten.required' => 'Konten artikel wajib diisi.',
            'foto_artikel.image' => 'Berkas harus berupa gambar.',
            'foto_artikel.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
