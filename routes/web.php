<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\Admin\PengaturanController;
use Illuminate\Support\Facades\Route;

// Halaman Utama / Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Profil Desa
Route::get('/tentang-desa', [VillageController::class, 'about'])->name('about');
Route::get('/potensi-desa', [VillageController::class, 'potential'])->name('potential');

// Halaman Katalog UMKM Publik
use App\Http\Controllers\UmkmController;
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{slug}', [UmkmController::class, 'show'])->name('umkm.show');

// Halaman Katalog Produk Publik
use App\Http\Controllers\ProdukController;
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{slug}', [ProdukController::class, 'show'])->name('produk.show');

// Halaman Wisata Publik
use App\Http\Controllers\WisataController;
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata/{slug}', [WisataController::class, 'show'])->name('wisata.show');

// Halaman Artikel Publik
use App\Http\Controllers\ArtikelController;
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');

// Halaman Event Publik
use App\Http\Controllers\EventController;
Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/{slug}', [EventController::class, 'show'])->name('event.show');

// Halaman Galeri Publik
use App\Http\Controllers\GaleriController;
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

// Halaman Kontak (GET = tampil halaman, POST = kirim pesan)
use App\Http\Controllers\KontakController;
Route::get('/kontak', function () {
    return view('pages.kontak');
})->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// Auth Routes (GUEST) — hanya login, tidak ada register publik
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Auth Routes (AUTHENTICATED)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout']);
});

// Admin Dashboard Routes (Protected by Auth and role:admin)
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // UMKM & Produk
    Route::resource('umkm', \App\Http\Controllers\Admin\UmkmController::class);
    Route::resource('produk', \App\Http\Controllers\Admin\ProdukController::class);

    // Kategori Produk
    Route::resource('kategori', \App\Http\Controllers\Admin\KategoriProdukController::class)->except(['show']);

    // Wisata, Artikel, Event, Galeri
    Route::resource('wisata', \App\Http\Controllers\Admin\WisataController::class);
    Route::resource('artikel', \App\Http\Controllers\Admin\ArtikelController::class);
    Route::resource('event', \App\Http\Controllers\Admin\EventController::class);
    Route::resource('galeri', \App\Http\Controllers\Admin\GaleriController::class);

    // Slider Banner
    Route::resource('slider', \App\Http\Controllers\Admin\SliderController::class)->except(['show']);

    // FAQ
    Route::resource('faq', \App\Http\Controllers\Admin\FaqController::class)->except(['show']);

    // Pesan Kontak Masuk
    Route::get('/pesan', [\App\Http\Controllers\Admin\PesanController::class, 'index'])->name('pesan.index');
    Route::get('/pesan/{pesan}', [\App\Http\Controllers\Admin\PesanController::class, 'show'])->name('pesan.show');
    Route::delete('/pesan/{pesan}', [\App\Http\Controllers\Admin\PesanController::class, 'destroy'])->name('pesan.destroy');

    // Alias navigasi sidebar
    Route::get('/pemilik-umkm', function () {
        return redirect()->route('admin.umkm.index');
    })->name('pemilik-umkm');

    Route::get('/profil-desa', function () {
        return redirect('/tentang-desa');
    })->name('profil-desa');

    // Pengaturan Akun Admin
    Route::get('/pengaturan', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
    Route::put('/pengaturan/profil', [PengaturanController::class, 'updateProfil'])->name('pengaturan.profil');
    Route::put('/pengaturan/password', [PengaturanController::class, 'updatePassword'])->name('pengaturan.password');
    Route::delete('/pengaturan/hapus-foto', [PengaturanController::class, 'hapusFoto'])->name('pengaturan.hapus-foto');
});
