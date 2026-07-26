<?php

namespace App\Http\Requests\Mitra;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMitraProfilRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'nama_usaha' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'no_whatsapp' => ['required', 'string', 'min:10', 'max:15'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'foto_toko' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama_usaha.required' => 'Nama usaha wajib diisi.',
            'no_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'alamat.required' => 'Alamat usaha wajib diisi.',
            'deskripsi.required' => 'Deskripsi usaha wajib diisi.',
            'latitude.numeric' => 'Format koordinat latitude tidak valid.',
            'longitude.numeric' => 'Format koordinat longitude tidak valid.',
            'foto_toko.image' => 'Berkas harus berupa gambar.',
            'foto_toko.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'foto_toko.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
