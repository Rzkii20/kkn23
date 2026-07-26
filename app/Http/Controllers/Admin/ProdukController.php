<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProdukRequest;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\Umkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProdukController extends Controller
{
    public function index(): View
    {
        $produk = Produk::with(['kategori', 'umkm'])->latest()->get();
        return view('admin.produk.index', compact('produk'));
    }

    public function create(): View
    {
        $kategoris = KategoriProduk::all();
        $umkms = Umkm::where('status_aktif', true)->get();
        return view('admin.produk.create', compact('kategoris', 'umkms'));
    }

    public function store(StoreProdukRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $fotoPath = null;
        if ($request->hasFile('foto_produk')) {
            $fotoPath = $request->file('foto_produk')->store('produk', 'public');
        }

        Produk::create([
            'umkm_id' => $validated['umkm_id'],
            'kategori_id' => $validated['kategori_id'],
            'nama_produk' => $validated['nama_produk'],
            'slug' => Str::slug($validated['nama_produk']) . '-' . rand(1000, 9999),
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'stok' => $validated['stok'],
            'foto_produk' => $fotoPath,
        ]);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk): View
    {
        $kategoris = KategoriProduk::all();
        $umkms = Umkm::all();
        return view('admin.produk.edit', compact('produk', 'kategoris', 'umkms'));
    }

    public function update(StoreProdukRequest $request, Produk $produk): RedirectResponse
    {
        $validated = $request->validated();

        $fotoPath = $produk->foto_produk;
        if ($request->hasFile('foto_produk')) {
            if ($fotoPath) Storage::disk('public')->delete($fotoPath);
            $fotoPath = $request->file('foto_produk')->store('produk', 'public');
        }

        $produk->update([
            'umkm_id' => $validated['umkm_id'],
            'kategori_id' => $validated['kategori_id'],
            'nama_produk' => $validated['nama_produk'],
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'stok' => $validated['stok'],
            'foto_produk' => $fotoPath,
        ]);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk): RedirectResponse
    {
        if ($produk->foto_produk) {
            Storage::disk('public')->delete($produk->foto_produk);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
