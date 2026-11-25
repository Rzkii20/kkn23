<?php

namespace App\Http\Controllers;

use App\Models\BannerSlider;
use App\Models\Produk;
use App\Models\Wisata;
use App\Models\Artikel;
use App\Models\Event;
use App\Models\Umkm;
use App\Models\KategoriProduk;
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
            ->take(10)
            ->get();
            
        $wisatas = Wisata::latest()
            ->take(5)
            ->get();
            
        $artikels = Artikel::latest()
            ->take(6)
            ->get();
            
        $events = Event::latest()
            ->take(3)
            ->get();

        // Statistik aktual dari database
        $statsUmkm    = Umkm::where('status_aktif', true)->count();
        $statsProduk  = Produk::count();
        $statsWisata  = Wisata::count();

        // Mitra UMKM aktif untuk etalase partner
        $homeUmkms = Umkm::where('status_aktif', true)
            ->latest()
            ->take(8)
            ->get();

        // Kategori dari database
        $homeKategoris = KategoriProduk::withCount('produk')->get();

        return view('welcome', compact(
            'sliders', 'produks', 'wisatas', 'artikels', 'events',
            'statsUmkm', 'statsProduk', 'statsWisata', 'homeUmkms', 'homeKategoris'
        ));
    }
}


