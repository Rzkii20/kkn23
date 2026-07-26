<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\View\View;

class ArtikelController extends Controller
{
    public function index(): View
    {
        $artikels = Artikel::latest()->paginate(6);
        return view('pages.artikel.index', compact('artikels'));
    }

    public function show(string $slug): View
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        
        // Increment view count
        $artikel->increment('views');

        $latest_artikels = Artikel::where('id', '!=', $artikel->id)->latest()->take(5)->get();
        return view('pages.artikel.show', compact('artikel', 'latest_artikels'));
    }
}
