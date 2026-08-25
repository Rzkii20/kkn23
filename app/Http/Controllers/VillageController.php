<?php

namespace App\Http\Controllers;

use App\Models\StrukturDesa;
use Illuminate\View\View;

class VillageController extends Controller
{
    /**
     * Display the 'About the Village' page (history, vision, mission).
     */
    public function about(): View
    {
        return view('pages.about');
    }

    public function potential(): View
    {
        $mangrove = \App\Models\Wisata::where('nama_wisata', 'like', '%mangrove%')
            ->whereNotNull('foto_wisata')
            ->first();

        $hasilLaut = \App\Models\Produk::where(function($q) {
            $q->where('nama_produk', 'like', '%ikan%')
              ->orWhere('nama_produk', 'like', '%laut%')
              ->orWhere('nama_produk', 'like', '%udang%')
              ->orWhere('nama_produk', 'like', '%kepiting%')
              ->orWhere('nama_produk', 'like', '%otak%');
        })->whereNotNull('foto_produk')->first();

        $kerajinan = \App\Models\Produk::whereHas('kategori', function($q) {
            $q->where('nama_kategori', 'like', '%kerajinan%')
              ->orWhere('nama_kategori', 'like', '%kriya%')
              ->orWhere('nama_kategori', 'like', '%tangan%');
        })->whereNotNull('foto_produk')->first();

        return view('pages.potential', compact('mangrove', 'hasilLaut', 'kerajinan'));
    }

    /**
     * Display the Village Structure page.
     */
    public function struktur(): View
    {
        $strukturs = StrukturDesa::aktif()->get();
        return view('pages.struktur-desa', compact('strukturs'));
    }
}
