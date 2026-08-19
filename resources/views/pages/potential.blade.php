@extends('layouts.app')

@section('title', 'Potensi Desa - Pemerintah Desa Sebong Lagoi')

@section('content')
    <!-- HEADER COVER -->
    <div class="py-4 py-md-5 text-white position-relative" style="background: linear-gradient(rgba(0, 48, 73, 0.7), rgba(0, 48, 73, 0.7)), url('https://images.unsplash.com/photo-1519451241324-20b4ea2c4220?q=80&w=2000&auto=format&fit=crop') no-repeat center center; background-size: cover;">
        <div class="container text-center py-2 py-md-3">
            <h1 class="fs-2 fs-md-1 fw-bold mb-2">Potensi Desa Sebong Lagoi</h1>
            <p class="lead text-white-50 fs-6 fs-md-5 mb-0">Sektor Unggulan Pariwisata, Kelautan, dan Industri Kreatif Lokal</p>
        </div>
    </div>

    <!-- POTENSI LISTING SECTION -->
    <section class="py-4 py-md-5 bg-white">
        <div class="container">
            <!-- 1. Pariwisata -->
            <div class="row align-items-center g-4 g-lg-5 mb-4 mb-lg-5">
                <div class="col-lg-6">
                    @if(isset($mangrove) && $mangrove->foto_wisata)
                        <img src="{{ asset('storage/' . $mangrove->foto_wisata) }}" class="img-fluid rounded-4 shadow-sm" style="object-fit: cover; width: 100%; aspect-ratio: 16/10; max-height: 350px;" alt="{{ $mangrove->nama_wisata }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1473448912268-2022ce9509d8?q=80&w=800&auto=format&fit=crop" class="img-fluid rounded-4 shadow-sm" style="object-fit: cover; width: 100%; aspect-ratio: 16/10; max-height: 350px;" alt="Potensi Wisata Mangrove">
                    @endif
                </div>
                <div class="col-lg-6">
                    <span class="badge bg-primary-custom mb-2">Sektor Utama</span>
                    <h3 class="fw-bold mb-3 fs-4 fs-md-3" style="color: var(--sea-blue-dark);">Ekowisata Hutan Mangrove & Pantai</h3>
                    <p class="text-muted">Desa Sebong Lagoi memiliki aset ekosistem pesisir alami berupa sungai dan hutan mangrove seluas puluhan hektar yang terjaga dengan baik. Kawasan ini telah dikembangkan secara kolaboratif menjadi salah satu ikon wisata susur sungai (*Mangrove Tour*) terpopuler di Pulau Bintan.</p>
                    <p class="text-muted">Selain hutan mangrove, desa kami dikaruniai gugusan pantai berpasir putih menghadap Laut Natuna Utara yang memiliki ombak bersahabat dan keasrian pohon kelapa pesisir, menjadikannya destinasi piknik keluarga favorit.</p>
                    <a href="/wisata" class="btn btn-primary-custom"><i class="bi bi-compass me-2"></i> Jelajahi Destinasi Wisata</a>
                </div>
            </div>

            <hr class="my-4 my-md-5 text-muted opacity-25">

            <!-- 2. Perikanan & Hasil Laut -->
            <div class="row align-items-center g-4 g-lg-5 mb-4 mb-lg-5 flex-lg-row-reverse">
                <div class="col-lg-6">
                    @if(isset($hasilLaut) && $hasilLaut->foto_produk)
                        <img src="{{ asset('storage/' . $hasilLaut->foto_produk) }}" class="img-fluid rounded-4 shadow-sm" style="object-fit: cover; width: 100%; aspect-ratio: 16/10; max-height: 350px;" alt="{{ $hasilLaut->nama_produk }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1534080391025-09795d197a5b?q=80&w=800&auto=format&fit=crop" class="img-fluid rounded-4 shadow-sm" style="object-fit: cover; width: 100%; aspect-ratio: 16/10; max-height: 350px;" alt="Potensi Hasil Laut" onerror="this.src='https://placehold.co/800x500/0891b2/FFF?text=Potensi+Hasil+Laut'">
                    @endif
                </div>
                <div class="col-lg-6">
                    <span class="badge bg-success mb-2">Sektor Kelautan</span>
                    <h3 class="fw-bold mb-3 fs-4 fs-md-3" style="color: var(--mangrove-green);">Kelautan & Hasil Perikanan Melimpah</h3>
                    <p class="text-muted">Sebagai wilayah kepulauan, sektor maritim dan perikanan merupakan penopang hidup sebagian warga desa. Tangkapan ikan segar, udang, kepiting, serta biota laut unik khas Kepulauan Riau seperti *Gonggong* (siput laut) melimpah sepanjang tahun.</p>
                    <p class="text-muted">Potensi laut ini juga didistribusikan ke restoran seafood lokal di sekitar wilayah Lagoi, serta diolah secara kreatif oleh UMKM rumah tangga menjadi produk makanan kemasan seperti kerupuk atom, otak-otak panggang, dan abon ikan berkualitas tinggi.</p>
                    <a href="/produk" class="btn btn-secondary-custom"><i class="bi bi-bag-check me-2"></i> Lihat Produk Olahan Laut</a>
                </div>
            </div>

            <hr class="my-4 my-md-5 text-muted opacity-25">

            <!-- 3. UMKM & Kerajinan Tangan -->
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    @if(isset($kerajinan) && $kerajinan->foto_produk)
                        <img src="{{ asset('storage/' . $kerajinan->foto_produk) }}" class="img-fluid rounded-4 shadow-sm" style="object-fit: cover; width: 100%; aspect-ratio: 16/10; max-height: 350px;" alt="{{ $kerajinan->nama_produk }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1513519245088-0e12902e5a38?q=80&w=800&auto=format&fit=crop" class="img-fluid rounded-4 shadow-sm" style="object-fit: cover; width: 100%; aspect-ratio: 16/10; max-height: 350px;" alt="Kerajinan Tangan Lokal" onerror="this.src='https://placehold.co/800x500/d97706/FFF?text=Kerajinan+Lokal'">
                    @endif
                </div>
                <div class="col-lg-6">
                    <span class="badge bg-warning text-dark mb-2">Ekonomi Kreatif</span>
                    <h3 class="fw-bold mb-3 fs-4 fs-md-3" style="color: var(--sea-blue-dark);">Kerajinan Kreatif Serat Kelapa & Kerang</h3>
                    <p class="text-muted">Tumbuhnya pariwisata mendorong masyarakat mengolah limbah alam pesisir menjadi souvenir berharga tinggi. Cangkang kerang laut dirangkai menjadi gantungan kunci dan ornamen interior rumah yang unik.</p>
                    <p class="text-muted">Sabut kelapa kering juga dimanfaatkan untuk kerajinan pot tanaman organik, anyaman tali, hingga tas ramah lingkungan. Dukungan promosi digital terus ditingkatkan agar jangkauan pasar kerajinan tangan Desa Sebong Lagoi menembus pasar nasional.</p>
                    <a href="/umkm" class="btn btn-outline-primary" style="border-radius: 8px;"><i class="bi bi-shop me-2"></i> Kunjungi Toko UMKM</a>
                </div>
            </div>
        </div>
    </section>
@endsection
