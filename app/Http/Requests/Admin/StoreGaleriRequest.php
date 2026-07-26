<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreGaleriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'judul' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'in:foto,video'],
        ];

        // Custom validation based on tipe
        if ($this->input('tipe') === 'foto') {
            // For create, photo is required. For update, it might be optional
            if ($this->isMethod('POST')) {
                $rules['file_foto'] = ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'];
            } else {
                $rules['file_foto'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'];
            }
        } else {
            $rules['file_video'] = ['required', 'url'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul galeri wajib diisi.',
            'tipe.required' => 'Tipe galeri wajib dipilih.',
            'file_foto.required' => 'Berkas foto wajib diunggah.',
            'file_foto.image' => 'Berkas harus berupa gambar.',
            'file_foto.max' => 'Ukuran gambar maksimal 2MB.',
            'file_video.required' => 'URL Video wajib diisi.',
            'file_video.url' => 'Format URL video tidak valid.',
        ];
    }
}
