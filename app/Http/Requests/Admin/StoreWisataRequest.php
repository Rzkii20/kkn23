<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreWisataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_wisata' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'foto_wisata' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_wisata.required' => 'Nama objek wisata wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'latitude.numeric' => 'Format latitude tidak valid.',
            'longitude.numeric' => 'Format longitude tidak valid.',
            'foto_wisata.image' => 'Berkas harus berupa gambar.',
            'foto_wisata.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
