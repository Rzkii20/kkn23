<?php

namespace App\Http\Requests\Mitra;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'kategori_id' => ['required', 'exists:kategori_produk,id'],
            'nama_produk' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'foto_produk' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'kategori_id.required' => 'Pilih kategori produk.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
            'harga.required' => 'Harga produk wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'stok.required' => 'Jumlah stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa bilangan bulat.',
            'foto_produk.image' => 'Berkas harus berupa gambar.',
            'foto_produk.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
