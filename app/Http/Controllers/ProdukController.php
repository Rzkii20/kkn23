<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdukController extends Controller
{
    /**
     * Display a listing of products (public catalog).
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $kategoriSlug = $request->input('kategori');
        $kategoris = KategoriProduk::all();

        $produks = Produk::with(['umkm', 'kategori'])
            ->when($search, fn($q) => $q->where('nama_produk', 'like', "%$search%")->orWhere('deskripsi', 'like', "%$search%"))
            ->when($kategoriSlug, fn($q) => $q->whereHas('kategori', fn($q2) => $q2->where('slug', $kategoriSlug)))
            ->latest()
            ->paginate(8);

        return view('pages.produk.index', compact('produks', 'kategoris', 'search', 'kategoriSlug'));
    }

    /**
     * Display a single product (public detail view) and increment view count.
     */
    public function show(string $slug): View
    {
        $produk = Produk::with(['umkm', 'kategori'])->where('slug', $slug)->firstOrFail();

        // Increment view counter
        $produk->increment('views');

        // Related products (same category, different product)
        $related = Produk::with(['umkm', 'kategori'])
            ->where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->take(4)
            ->get();

        return view('pages.produk.show', compact('produk', 'related'));
    }
}
