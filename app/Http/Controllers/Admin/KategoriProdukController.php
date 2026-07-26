<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKategoriRequest;
use App\Models\KategoriProduk;
use App\Models\Umkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class KategoriProdukController extends Controller
{
    public function index(): View
    {
        $kategoris = KategoriProduk::withCount('produk')->latest()->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create(): View
    {
        $umkms = Umkm::orderBy('nama_usaha', 'asc')->get();
        return view('admin.kategori.create', compact('umkms'));
    }

    public function store(StoreKategoriRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $kategori = KategoriProduk::create([
            'nama_kategori' => $validated['nama_kategori'],
            'slug'          => Str::slug($validated['nama_kategori']) . '-' . rand(100, 999),
        ]);

        if (isset($validated['umkm_ids']) && is_array($validated['umkm_ids'])) {
            $kategori->umkm()->sync($validated['umkm_ids']);
        }

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori produk berhasil ditambahkan!');
    }

    public function edit(KategoriProduk $kategori): View
    {
        $umkms = Umkm::orderBy('nama_usaha', 'asc')->get();
        $selectedUmkms = $kategori->umkm->pluck('id')->toArray();
        return view('admin.kategori.edit', compact('kategori', 'umkms', 'selectedUmkms'));
    }

    public function update(StoreKategoriRequest $request, KategoriProduk $kategori): RedirectResponse
    {
        $validated = $request->validated();

        $kategori->update([
            'nama_kategori' => $validated['nama_kategori'],
        ]);

        if (isset($validated['umkm_ids']) && is_array($validated['umkm_ids'])) {
            $kategori->umkm()->sync($validated['umkm_ids']);
        } else {
            $kategori->umkm()->sync([]); // Kosongkan jika tidak ada yang diceklis
        }

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori produk berhasil diperbarui!');
    }

    public function destroy(KategoriProduk $kategori): RedirectResponse
    {
        // Prevent deletion if category has products
        if ($kategori->produk()->count() > 0) {
            return redirect()->route('admin.kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki ' . $kategori->produk()->count() . ' produk.');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori produk berhasil dihapus!');
    }
}
