<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Event;
use App\Models\Produk;
use App\Models\Umkm;
use App\Models\Wisata;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $baseUrl = config('app.url', url('/'));

        // Halaman Statis Utama
        $staticPages = [
            ['url' => $baseUrl . '/', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => $baseUrl . '/tentang-desa', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => $baseUrl . '/potensi-desa', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => $baseUrl . '/struktur-desa', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => $baseUrl . '/umkm', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => $baseUrl . '/produk', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => $baseUrl . '/wisata', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => $baseUrl . '/artikel', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => $baseUrl . '/event', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => $baseUrl . '/dokumen', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => $baseUrl . '/galeri', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => $baseUrl . '/kontak', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ];

        // Halaman Dinamis
        $umkms = Umkm::select('slug', 'updated_at')->get();
        $produks = Produk::select('slug', 'updated_at')->get();
        $wisatas = Wisata::select('slug', 'updated_at')->get();
        $artikels = Artikel::select('slug', 'updated_at')->get();
        $events = Event::select('slug', 'updated_at')->get();

        $content = '<?xml version="1.0" encoding="UTF-8"?>';
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

        // 1. Static Pages
        foreach ($staticPages as $page) {
            $content .= '<url>';
            $content .= '<loc>' . htmlspecialchars($page['url']) . '</loc>';
            $content .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $content .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
            $content .= '<priority>' . $page['priority'] . '</priority>';
            $content .= '</url>';
        }

        // 2. UMKM Pages
        foreach ($umkms as $umkm) {
            $content .= '<url>';
            $content .= '<loc>' . htmlspecialchars($baseUrl . '/umkm/' . $umkm->slug) . '</loc>';
            $content .= '<lastmod>' . ($umkm->updated_at ? $umkm->updated_at->format('Y-m-d') : date('Y-m-d')) . '</lastmod>';
            $content .= '<changefreq>weekly</changefreq>';
            $content .= '<priority>0.8</priority>';
            $content .= '</url>';
        }

        // 3. Produk Pages
        foreach ($produks as $produk) {
            $content .= '<url>';
            $content .= '<loc>' . htmlspecialchars($baseUrl . '/produk/' . $produk->slug) . '</loc>';
            $content .= '<lastmod>' . ($produk->updated_at ? $produk->updated_at->format('Y-m-d') : date('Y-m-d')) . '</lastmod>';
            $content .= '<changefreq>weekly</changefreq>';
            $content .= '<priority>0.8</priority>';
            $content .= '</url>';
        }

        // 4. Wisata Pages
        foreach ($wisatas as $wisata) {
            $content .= '<url>';
            $content .= '<loc>' . htmlspecialchars($baseUrl . '/wisata/' . $wisata->slug) . '</loc>';
            $content .= '<lastmod>' . ($wisata->updated_at ? $wisata->updated_at->format('Y-m-d') : date('Y-m-d')) . '</lastmod>';
            $content .= '<changefreq>monthly</changefreq>';
            $content .= '<priority>0.8</priority>';
            $content .= '</url>';
        }

        // 5. Artikel Pages
        foreach ($artikels as $artikel) {
            $content .= '<url>';
            $content .= '<loc>' . htmlspecialchars($baseUrl . '/artikel/' . $artikel->slug) . '</loc>';
            $content .= '<lastmod>' . ($artikel->updated_at ? $artikel->updated_at->format('Y-m-d') : date('Y-m-d')) . '</lastmod>';
            $content .= '<changefreq>monthly</changefreq>';
            $content .= '<priority>0.8</priority>';
            $content .= '</url>';
        }

        // 6. Event Pages
        foreach ($events as $event) {
            $content .= '<url>';
            $content .= '<loc>' . htmlspecialchars($baseUrl . '/event/' . $event->slug) . '</loc>';
            $content .= '<lastmod>' . ($event->updated_at ? $event->updated_at->format('Y-m-d') : date('Y-m-d')) . '</lastmod>';
            $content .= '<changefreq>monthly</changefreq>';
            $content .= '<priority>0.7</priority>';
            $content .= '</url>';
        }

        $content .= '</urlset>';

        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }
}
