<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Event;
use App\Models\Galeri;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\Umkm;
use App\Models\User;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_umkm' => Umkm::count(),
            'total_produk' => Produk::count(),
            'total_kategori' => KategoriProduk::count(),
            'total_wisata' => Wisata::count(),
            'total_artikel' => Artikel::count(),
            'total_event' => Event::count(),
            'total_galeri' => Galeri::count(),
            'total_user' => User::count(),
        ];

        // For charts
        $umkmByStatus = [
            'aktif' => Umkm::where('status_aktif', true)->count(),
            'nonaktif' => Umkm::where('status_aktif', false)->count(),
        ];

        $latestUmkms = Umkm::with('user')->latest()->take(5)->get();
        $latestProduks = Produk::with('umkm')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'umkmByStatus', 'latestUmkms', 'latestProduks'));
    }
}
