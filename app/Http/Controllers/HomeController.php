<?php

namespace App\Http\Controllers;

use App\Models\BannerSlider;
use App\Models\Produk;
use App\Models\Wisata;
use App\Models\Artikel;
use App\Models\Event;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index(): View
    {
        $sliders = BannerSlider::orderBy('urutan')->get();
        
        // Eager load umkm and kategori relationships for products
        $produks = Produk::with(['umkm', 'kategori'])
            ->latest()
            ->take(4)
            ->get();
            
        $wisatas = Wisata::latest()
            ->take(3)
            ->get();
            
        $artikels = Artikel::latest()
            ->take(3)
            ->get();
            
        $events = Event::latest()
            ->take(3)
            ->get();

        return view('welcome', compact('sliders', 'produks', 'wisatas', 'artikels', 'events'));
    }
}
