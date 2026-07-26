<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'judul'    => ['nullable', 'string', 'max:255'],
            'subjudul' => ['nullable', 'string', 'max:255'],
            'urutan'   => ['nullable', 'integer', 'min:0'],
        ];

        // foto_banner required only on create
        if ($this->isMethod('POST')) {
            $rules['foto_banner'] = ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'];
        } else {
            $rules['foto_banner'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'foto_banner.required' => 'Gambar banner wajib diunggah.',
            'foto_banner.image'    => 'Berkas harus berupa gambar.',
            'foto_banner.max'      => 'Ukuran gambar maksimal 3MB.',
            'urutan.integer'       => 'Urutan harus berupa angka.',
        ];
    }
}
