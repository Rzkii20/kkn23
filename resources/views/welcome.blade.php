@extends('layouts.app')

@section('title', 'Desa Sebong Lagoi - Sistem Informasi UMKM & Wisata Terbaik')

@section('content')

    <!-- ====================================================
         HERO SECTION
         ==================================================== -->
    <section class="hero-section">
        <!-- Background -->
        <div class="hero-bg">
            @if(isset($sliders) && $sliders->isNotEmpty())
                <img src="{{ asset('storage/' . $sliders->first()->foto_banner) }}" alt="{{ $sliders->first()->judul }}" id="heroBgImg">
            @else
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1920&auto=format&fit=crop" alt="Pantai Sebong Lagoi" id="heroBgImg">
            @endif
        </div>
        <div class="hero-overlay"></div>

        <!-- Content -->
        <div class="container hero-content">
            <div class="row align-items-center hero-row">
                <div class="col-lg-7">
                    <div class="hero-badge animate-fade-in">
                        <i class="bi bi-star-fill"></i>
                        Desa Sebong Lagoi — Bintan
                    </div>

                    <h1 class="hero-title animate-fade-in-delay-1">
                        Informasi<br class="d-none d-lg-inline">
                        <span class="text-gold-highlight">UMKM & Wisata</span><br class="d-none d-lg-inline">
                        Desa Sebong Lagoi
                    </h1>

                    <p class="hero-subtitle animate-fade-in-delay-2">
                        Temukan berbagai produk unggulan buatan lokal, jelajahi destinasi wisata mangrove yang eksotis, dan dukung kemajuan ekonomi digital Desa Sebong Lagoi.
                    </p>

                    <div class="d-flex flex-wrap gap-3 animate-fade-in-delay-3">
                        <a href="/produk" class="btn-hero-primary" id="btn-cari-produk">
                            <i class="bi bi-search"></i> Cari Produk & UMKM
                        </a>
                        <a href="/wisata" class="btn-hero-outline" id="btn-destinasi-wisata">
                            <i class="bi bi-compass"></i> Destinasi Wisata
                        </a>
                    </div>
                </div>

                <!-- Hero Cards (Desktop Only) -->
                <div class="col-lg-5 d-none d-lg-flex justify-content-end animate-fade-in-delay-2">
                    <div class="d-flex flex-column gap-3" style="width: 300px;">
                        <div style="background: rgba(255,255,255,0.12); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.2); border-radius: 16px; padding: 20px;">
                            <div class="d-flex align-items-center gap-12 mb-2">
                                <div style="background: var(--mangrove-green); width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-right: 12px;">
                                    <i class="bi bi-shop-window text-white fs-5"></i>
                                </div>
                                <div>
                                    <p style="font-size:0.75rem; color:rgba(255,255,255,0.7); margin:0;">Total UMKM Aktif</p>
                                    <h4 style="color:white; font-weight:800; margin:0; font-size:1.5rem;">{{ $statsUmkm }}</h4>
                                </div>
                            </div>
                            <div style="height:4px; background:rgba(255,255,255,0.1); border-radius:2px; overflow:hidden;">
                                <div style="height:100%; width:75%; background:var(--mangrove-green); border-radius:2px;"></div>
                            </div>
                        </div>
                        <div style="background: rgba(255,255,255,0.12); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.2); border-radius: 16px; padding: 20px;">
                            <div class="d-flex align-items-center gap-12 mb-2">
                                <div style="background: var(--sea-blue); width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-right: 12px;">
                                    <i class="bi bi-geo-alt-fill text-white fs-5"></i>
                                </div>
                                <div>
                                    <p style="font-size:0.75rem; color:rgba(255,255,255,0.7); margin:0;">Destinasi Wisata</p>
                                    <h4 style="color:white; font-weight:800; margin:0; font-size:1.5rem;">{{ $statsWisata }}</h4>
                                </div>
                            </div>
                            <div style="height:4px; background:rgba(255,255,255,0.1); border-radius:2px; overflow:hidden;">
                                <div style="height:100%; width:60%; background:var(--sea-blue); border-radius:2px;"></div>
                            </div>
                        </div>
                        <div style="background: rgba(255,255,255,0.12); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.2); border-radius: 16px; padding: 20px;">
                            <div class="d-flex align-items-center gap-12 mb-2">
                                <div style="background: #D4A017; width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-right: 12px;">
                                    <i class="bi bi-box-seam-fill text-dark fs-5"></i>
                                </div>
                                <div>
                                    <p style="font-size:0.75rem; color:rgba(255,255,255,0.7); margin:0;">Produk Terdaftar</p>
                                    <h4 style="color:white; font-weight:800; margin:0; font-size:1.5rem;">{{ $statsProduk }}</h4>
                                </div>
                            </div>
                            <div style="height:4px; background:rgba(255,255,255,0.1); border-radius:2px; overflow:hidden;">
                                <div style="height:100%; width:85%; background:#D4A017; border-radius:2px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="hero-scroll-indicator">
            <div class="scroll-mouse"><div class="scroll-dot"></div></div>
            <span>Gulir</span>
        </div>
    </section>

    <!-- ====================================================
         STATS SECTION
         ==================================================== -->
    <section class="stats-section pb-4">
        <div class="container">
            <div class="stats-card">
                <div class="stat-item">
                    <div class="stat-number">{{ $statsUmkm }}</div>
                    <div class="stat-label"><i class="bi bi-shop-window me-1"></i> UMKM Aktif</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $statsProduk }}</div>
                    <div class="stat-label"><i class="bi bi-box-seam me-1"></i> Produk Terdaftar</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $statsWisata }}</div>
                    <div class="stat-label"><i class="bi bi-geo-alt me-1"></i> Destinasi Wisata</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         PRODUK UNGGULAN SECTION
         ==================================================== -->
    <section class="py-5 mt-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5 reveal">
                <div>
                    <div class="section-tagline">Produk Terbaru</div>
                    <h2 class="section-title">Rekomendasi Produk Mitra</h2>
                    <p class="section-subtitle mt-2">Temukan berbagai produk pilihan dari pelaku UMKM unggulan Desa Sebong Lagoi.</p>
                </div>
                <a href="/produk" class="btn-view-all d-none d-md-inline-flex">
                    Lihat Semua Produk <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="d-flex flex-nowrap overflow-x-auto pb-4 gap-4 hide-scrollbar" style="scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch; scroll-behavior: smooth;">
                @if(isset($produks) && $produks->isNotEmpty())
                    @foreach($produks as $produk)
                        <div class="col-10 col-md-5 col-lg-3 flex-shrink-0 reveal" style="scroll-snap-align: start;">
                            <div class="product-card">
                                <div class="card-img-wrapper">
                                    <img src="{{ $produk->foto_produk ? asset('storage/' . $produk->foto_produk) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=400&auto=format&fit=crop' }}" alt="{{ $produk->nama_produk }}">
                                    <span class="product-category-badge">{{ $produk->kategori->nama_kategori }}</span>
                                </div>
                                <div class="card-body">
                                    <p class="product-seller">
                                        <i class="bi bi-shop"></i> {{ $produk->umkm->nama_usaha }}
                                    </p>
                                    <h5 class="product-title">{{ $produk->nama_produk }}</h5>
                                    <div class="product-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex gap-2">
                                        <a href="/produk/{{ $produk->slug }}" class="btn-outline-primary-custom flex-fill text-center" style="font-size: 0.82rem; padding: 8px;">
                                            <i class="bi bi-eye"></i> Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @php
                        $sampleProducts = [
                            ['name'=>'Keripik Singkong Gurih', 'price'=>'15.000', 'cat'=>'Kuliner', 'seller'=>'UMKM Rasa Nusantara', 'img'=>'https://images.unsplash.com/photo-1622542796254-5b9c46ab0d2f?q=80&w=400&auto=format&fit=crop'],
                            ['name'=>'Kain Tenun Batik Melayu', 'price'=>'250.000', 'cat'=>'Kerajinan', 'seller'=>'UMKM Kriya Bintan', 'img'=>'https://images.unsplash.com/photo-1558171813-6ea1ac50d44d?q=80&w=400&auto=format&fit=crop'],
                            ['name'=>'Sambal Lingkung Teri', 'price'=>'35.000', 'cat'=>'Kuliner', 'seller'=>'UMKM Dapur Sebong', 'img'=>'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?q=80&w=400&auto=format&fit=crop'],
                            ['name'=>'Tas Anyaman Pandan', 'price'=>'180.000', 'cat'=>'Kerajinan', 'seller'=>'UMKM Anyam Lagoi', 'img'=>'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=400&auto=format&fit=crop'],
                        ];
                    @endphp
                    @foreach($sampleProducts as $sp)
                        <div class="col-10 col-md-5 col-lg-3 flex-shrink-0 reveal" style="scroll-snap-align: start;">
                            <div class="product-card">
                                <div class="card-img-wrapper">
                                    <img src="{{ $sp['img'] }}" alt="{{ $sp['name'] }}">
                                    <span class="product-category-badge">{{ $sp['cat'] }}</span>
                                </div>
                                <div class="card-body">
                                    <p class="product-seller"><i class="bi bi-shop"></i> {{ $sp['seller'] }}</p>
                                    <h5 class="product-title">{{ $sp['name'] }}</h5>
                                    <div class="product-price">Rp {{ $sp['price'] }}</div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex gap-2">
                                        <a href="/produk" class="btn-outline-primary-custom flex-fill text-center" style="font-size: 0.82rem; padding: 8px;">
                                            <i class="bi bi-eye"></i> Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="text-center mt-4 d-md-none reveal">
                <a href="/produk" class="btn-outline-primary-custom">
                    Lihat Semua Produk <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ====================================================
         KATEGORI PRODUK SECTION
         ==================================================== -->
    <section class="py-5" style="background: var(--sea-blue-light);">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <div class="section-tagline justify-content-center" style="color: var(--sea-blue);">
                    <span style="width:20px; height:2px; background: var(--sea-blue); display:inline-block;"></span>
                    Pilihan Kategori
                </div>
                <h2 class="section-title">Kategori Produk UMKM</h2>
                <p class="section-subtitle mx-auto mt-2">Temukan produk sesuai kategori favoritmu dari berbagai pelaku UMKM desa.</p>
            </div>

            <div class="row g-3 justify-content-center">
                @php
                    // Fungsi pembantu untuk menentukan icon, warna, dan deskripsi kategori berdasarkan nama/slug
                    $mapKategori = function($name, $slug) {
                        $nameLower = strtolower($name);
                        $slugLower = strtolower($slug);
                        
                        if (str_contains($nameLower, 'makanan') || str_contains($nameLower, 'kuliner') || str_contains($nameLower, 'snack') || str_contains($nameLower, 'kue') || str_contains($slugLower, 'makanan') || str_contains($slugLower, 'kuliner')) {
                            return [
                                'icon' => 'bi-egg-fried',
                                'desc' => 'Makanan khas, kuliner & cemilan lokal',
                                'color' => '#0F4C81',
                                'bg' => '#EBF3FA'
                            ];
                        }
                        if (str_contains($nameLower, 'minuman') || str_contains($nameLower, 'jus') || str_contains($nameLower, 'kopi') || str_contains($nameLower, 'teh') || str_contains($slugLower, 'minuman') || str_contains($slugLower, 'drink')) {
                            return [
                                'icon' => 'bi-cup-straw',
                                'desc' => 'Minuman segar, kopi, jus & olahan lokal',
                                'color' => '#0891B2',
                                'bg' => '#ECFEFF'
                            ];
                        }
                        if (str_contains($nameLower, 'kerajinan') || str_contains($nameLower, 'kriya') || str_contains($nameLower, 'tangan') || str_contains($slugLower, 'kerajinan') || str_contains($slugLower, 'craft')) {
                            return [
                                'icon' => 'bi-gift-fill',
                                'desc' => 'Cinderamata khas berbahan alam lokal',
                                'color' => '#1B6B3A',
                                'bg' => '#E8F5E9'
                            ];
                        }
                        if (str_contains($nameLower, 'pertanian') || str_contains($nameLower, 'kebun') || str_contains($nameLower, 'tani') || str_contains($slugLower, 'pertanian') || str_contains($slugLower, 'tani')) {
                            return [
                                'icon' => 'bi-flower1',
                                'desc' => 'Hasil kebun segar & produk pertanian',
                                'color' => '#D97706',
                                'bg' => '#FFFBEB'
                            ];
                        }
                        if (str_contains($nameLower, 'fesyen') || str_contains($nameLower, 'fashion') || str_contains($nameLower, 'pakaian') || str_contains($nameLower, 'baju') || str_contains($nameLower, 'batik') || str_contains($slugLower, 'fesyen') || str_contains($slugLower, 'fashion')) {
                            return [
                                'icon' => 'bi-scissors',
                                'desc' => 'Pakaian, batik & aksesoris fashion',
                                'color' => '#7C3AED',
                                'bg' => '#F5F3FF'
                            ];
                        }
                        if (str_contains($nameLower, 'herbal') || str_contains($nameLower, 'kesehatan') || str_contains($nameLower, 'jamu') || str_contains($slugLower, 'herbal') || str_contains($slugLower, 'sehat')) {
                            return [
                                'icon' => 'bi-flower3',
                                'desc' => 'Produk herbal & minuman tradisional',
                                'color' => '#059669',
                                'bg' => '#ECFDF5'
                            ];
                        }
                        if (str_contains($nameLower, 'laut') || str_contains($nameLower, 'ikan') || str_contains($nameLower, 'seafood') || str_contains($slugLower, 'laut') || str_contains($slugLower, 'ikan')) {
                            return [
                                'icon' => 'bi-bag-check-fill',
                                'desc' => 'Produk olahan ikan & seafood segar',
                                'color' => '#0891B2',
                                'bg' => '#ECFEFF'
                            ];
                        }
                        
                        // Default fallback
                        return [
                            'icon' => 'bi-tag-fill',
                            'desc' => 'Berbagai macam produk UMKM pilihan',
                            'color' => '#475569',
                            'bg' => '#F1F5F9'
                        ];
                    };
                @endphp

                @if(isset($homeKategoris) && $homeKategoris->isNotEmpty())
                    @foreach($homeKategoris as $kategori)
                        @php
                            $style = $mapKategori($kategori->nama_kategori, $kategori->slug);
                        @endphp
                        <div class="col-lg-3 col-md-4 col-6 reveal">
                            <a href="/produk?kategori={{ $kategori->slug }}" style="text-decoration: none;">
                                <div class="text-center p-4" style="background: white; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: all 0.3s; cursor: pointer; h-100" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.1)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.05)'">
                                    <div style="width: 60px; height: 60px; background: {{ $style['bg'] }}; border-radius: 14px; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px;">
                                        <i class="bi {{ $style['icon'] }}" style="font-size: 1.6rem; color: {{ $style['color'] }};"></i>
                                    </div>
                                    <h6 style="font-weight: 700; color: #1E293B; font-size: 0.88rem; margin-bottom: 4px;">{{ $kategori->nama_kategori }}</h6>
                                    <p style="font-size: 0.72rem; color: #64748B; margin: 0; line-height: 1.4;">{{ $style['desc'] }}</p>
                                    <span class="badge bg-light text-muted mt-2" style="font-size: 0.68rem; font-weight: normal; border: 1px solid #E2E8F0;">
                                        {{ $kategori->produk_count }} Produk
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-4">
                        <p class="text-muted mb-0">Belum ada kategori produk yang terdaftar.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- ====================================================
         TENTANG DESA & UMKM SECTION
         ==================================================== -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal">
                    <div class="position-relative">
                        <img src="{{ asset('images/tentang-desa.jpg') }}"
                             class="img-fluid rounded-4 w-100"
                             style="height: 400px; object-fit: cover;"
                             alt="Desa Sebong Lagoi">
                    </div>
                </div>
                <div class="col-lg-6 reveal">
                    <div class="section-tagline">Selayang Pandang</div>
                    <h2 class="section-title">Kenali Desa<br>Sebong Lagoi</h2>
                    <p class="text-muted mt-3" style="line-height: 1.8;">
                        Desa Sebong Lagoi terletak di kawasan strategis pariwisata Kabupaten Bintan, Kepulauan Riau. Selain kaya akan keindahan alam pantai dan wisata mangrove, desa kami menjadi pusat tumbuhnya industri kreatif dan kuliner lokal melalui UMKM yang terus berkembang.
                    </p>
                    <p class="text-muted" style="line-height: 1.8;">
                        Platform ini dirancang untuk mempermudah pemasaran produk UMKM desa agar dapat dinikmati oleh masyarakat luas serta wisatawan asing maupun domestik.
                    </p>

                    <div class="row g-3 mt-2">
                        <div class="col-6">
                            <div style="background: #F8FAFC; border-radius: 12px; padding: 16px;">
                                <i class="bi bi-shield-check-fill text-success fs-4 mb-2 d-block"></i>
                                <div style="font-weight: 700; color: #1E293B; font-size: 0.9rem;">Produk Terverifikasi</div>
                                <div style="font-size: 0.78rem; color: #64748B;">Kualitas terjamin & terstandar</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background: #F8FAFC; border-radius: 12px; padding: 16px;">
                                <i class="bi bi-truck-front-fill text-primary fs-4 mb-2 d-block"></i>
                                <div style="font-weight: 700; color: #1E293B; font-size: 0.9rem;">Pengiriman Mudah</div>
                                <div style="font-size: 0.78rem; color: #64748B;">Hubungi langsung via WhatsApp</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4 flex-wrap">
                        <a href="/tentang-desa" class="btn-secondary-custom">
                            <i class="bi bi-info-circle"></i> Selengkapnya
                        </a>
                        <a href="/umkm" class="btn-outline-primary-custom">
                            <i class="bi bi-shop-window"></i> Jelajahi UMKM
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- ====================================================
         DESTINASI WISATA SECTION
         ==================================================== -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5 reveal">
                <div>
                    <div class="section-tagline">Destinasi Populer</div>
                    <h2 class="section-title">Objek Wisata<br>Sebong Lagoi</h2>
                </div>
                <a href="/wisata" class="btn-view-all d-none d-md-inline-flex">
                    Semua Wisata <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- Wisata Grid Layout -->
            <div class="wisata-grid reveal">
                @if(isset($wisatas) && $wisatas->isNotEmpty())
                    @foreach($wisatas->take(5) as $index => $wisata)
                        @php $isTall = ($index === 0); @endphp
                        <div class="wisata-card {{ $isTall ? 'wisata-card-tall' : 'wisata-card-medium' }}">
                            <img src="{{ $wisata->foto_wisata ? asset('storage/' . $wisata->foto_wisata) : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=600&auto=format&fit=crop' }}" alt="{{ $wisata->nama_wisata }}">
                            <div class="wisata-card-overlay"></div>
                            <div class="wisata-card-content">
                                <span class="wisata-cat-badge">Wisata Alam</span>
                                <h3>{{ $wisata->nama_wisata }}</h3>
                                <p class="wisata-desc">{{ Str::limit($wisata->deskripsi, 80) }}</p>
                                <div class="wisata-location">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    {{ Str::limit($wisata->alamat, 50) }}
                                </div>
                                <a href="/wisata/{{ $wisata->slug }}" class="btn-hero-primary mt-2" style="font-size: 0.8rem; padding: 8px 16px;">Lihat Detail</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    @php
                        $sampleWisata = [
                            ['title'=>'Pantai Sebong Eksotis', 'loc'=>'RT. 02 Desa Sebong Lagoi', 'desc'=>'Hamparan pasir putih bersih dengan panorama laut biru yang memukau dan sunset menawan di sore hari.', 'img'=>'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=800&auto=format&fit=crop', 'tall'=>true],
                            ['title'=>'Mangrove Adventure Tour', 'loc'=>'Kawasan Konservasi Sungai Sebong', 'desc'=>'Menelusuri hutan mangrove purba menggunakan boat, melihat satwa liar eksotis.', 'img'=>'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=600&auto=format&fit=crop', 'tall'=>false],
                            ['title'=>'Agrowisata Kebun Buah', 'loc'=>'Dusun III Sebong Lagoi', 'desc'=>'Edukasi pertanian buah tropis langsung dari kebunnya.', 'img'=>'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=600&auto=format&fit=crop', 'tall'=>false],
                            ['title'=>'Danau Biru Telaga', 'loc'=>'Kawasan Telaga Sebong', 'desc'=>'Keindahan danau alami dengan air jernih berwarna biru kehijauan.', 'img'=>'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=600&auto=format&fit=crop', 'tall'=>false],
                            ['title'=>'Air Terjun Sepeti', 'loc'=>'Hutan Perbukitan Sebong', 'desc'=>'Air terjun tersembunyi di antara lebatnya hutan tropis Sebong Lagoi.', 'img'=>'https://images.unsplash.com/photo-1448375240586-882707db888b?q=80&w=600&auto=format&fit=crop', 'tall'=>false],
                        ];
                    @endphp
                    @foreach($sampleWisata as $sw)
                        <div class="wisata-card {{ $sw['tall'] ? 'wisata-card-tall' : 'wisata-card-medium' }}">
                            <img src="{{ $sw['img'] }}" alt="{{ $sw['title'] }}">
                            <div class="wisata-card-overlay"></div>
                            <div class="wisata-card-content">
                                <span class="wisata-cat-badge">Wisata Alam</span>
                                <h3>{{ $sw['title'] }}</h3>
                                @if($sw['tall'])
                                    <p class="wisata-desc">{{ $sw['desc'] }}</p>
                                @endif
                                <div class="wisata-location">
                                    <i class="bi bi-geo-alt-fill"></i> {{ $sw['loc'] }}
                                </div>
                                <a href="/wisata" class="btn-hero-primary mt-2" style="font-size: 0.8rem; padding: 8px 16px; display: inline-flex;">Lihat Detail</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="text-center mt-4 d-md-none">
                <a href="/wisata" class="btn-outline-primary-custom">
                    Semua Destinasi <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ====================================================
         ARTIKEL & EVENT SECTION
         ==================================================== -->
    <section class="py-5" style="background: #F8FAFC;">
        <div class="container">
            <div class="row g-5">
                <!-- Kiri: Artikel/Berita -->
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-end mb-4 reveal">
                        <div>
                            <div class="section-tagline" style="font-size: 0.72rem;">Kabar Terkini</div>
                            <h2 class="section-title" style="font-size: 1.6rem;">Berita & Artikel Desa</h2>
                        </div>
                        <a href="/artikel" class="btn-view-all d-none d-md-inline-flex">
                            Semua Artikel <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    <div class="row g-4">
                        @if(isset($artikels) && $artikels->isNotEmpty())
                            @foreach($artikels as $artikel)
                                <div class="col-md-6 reveal">
                                    <div class="artikel-card">
                                        <div class="card-img-wrapper">
                                            <img src="{{ $artikel->foto_artikel ? asset('storage/' . $artikel->foto_artikel) : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=400&auto=format&fit=crop' }}" alt="{{ $artikel->judul }}">
                                            <span class="artikel-category-badge bg-primary-custom text-white">Artikel</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="artikel-meta">
                                                <span><i class="bi bi-calendar3"></i> {{ $artikel->created_at->format('d M Y') }}</span>
                                                <span><i class="bi bi-eye"></i> {{ $artikel->views }} views</span>
                                            </div>
                                            <h5 class="artikel-title">{{ $artikel->judul }}</h5>
                                            <p class="artikel-excerpt">{{ Str::limit(strip_tags($artikel->konten), 100) }}</p>
                                            <a href="/artikel/{{ $artikel->slug }}" class="btn-read-more">
                                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @php
                                $sampleArtikel = [
                                    ['title'=>'Pelatihan Pemasaran Digital bagi Pelaku UMKM Desa Sebong Lagoi', 'date'=>'17 Jul 2026', 'views'=>124, 'excerpt'=>'Pemerintah Desa menyelenggarakan workshop intensif untuk memperkenalkan strategi promosi media sosial dan kemudahan pendaftaran e-catalog bagi pelaku UMKM.', 'img'=>'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=400&auto=format&fit=crop'],
                                    ['title'=>'Festival Kuliner & Budaya Sebong Lagoi 2026 Dihadiri Ribuan Pengunjung', 'date'=>'10 Jul 2026', 'views'=>320, 'excerpt'=>'Festival tahunan ini sukses menghadirkan berbagai pertunjukan seni budaya Melayu dan pameran produk UMKM unggulan desa.', 'img'=>'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=400&auto=format&fit=crop'],
                                ];
                            @endphp
                            @foreach($sampleArtikel as $sa)
                                <div class="col-md-6 reveal">
                                    <div class="artikel-card">
                                        <div class="card-img-wrapper">
                                            <img src="{{ $sa['img'] }}" alt="{{ $sa['title'] }}">
                                            <span class="artikel-category-badge bg-primary-custom text-white">Artikel</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="artikel-meta">
                                                <span><i class="bi bi-calendar3"></i> {{ $sa['date'] }}</span>
                                                <span><i class="bi bi-eye"></i> {{ $sa['views'] }} views</span>
                                            </div>
                                            <h5 class="artikel-title">{{ $sa['title'] }}</h5>
                                            <p class="artikel-excerpt">{{ $sa['excerpt'] }}</p>
                                            <a href="/artikel" class="btn-read-more">
                                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Kanan: Event Mendatang -->
                <div class="col-lg-4">
                    <div class="d-flex justify-content-between align-items-end mb-4 reveal">
                        <div>
                            <div class="section-tagline" style="font-size: 0.72rem; color: var(--mangrove-green);">
                                <span style="width:20px; height:2px; background: var(--mangrove-green); display:inline-block;"></span>
                                Kalender Acara
                            </div>
                            <h2 class="section-title" style="font-size: 1.6rem;">Event Desa</h2>
                        </div>
                        <a href="/event" class="btn-view-all" style="font-size: 0.82rem;">
                            Semua <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    <div class="d-flex flex-column gap-3 reveal">
                        @if(isset($events) && $events->isNotEmpty())
                            @foreach($events as $event)
                                <div style="background: white; border-radius: 14px; padding: 18px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border-left: 4px solid var(--sea-blue);">
                                    <span class="badge mb-2" style="background: var(--sea-blue-light); color: var(--sea-blue); font-weight: 700;">
                                        <i class="bi bi-calendar-event me-1"></i>{{ $event->tanggal_mulai->format('d M Y') }}
                                    </span>
                                    <h6 style="font-weight: 700; color: var(--navy); margin-bottom: 6px; font-size: 0.92rem;">{{ $event->nama_event }}</h6>
                                    <p style="font-size: 0.78rem; color: #64748B; margin: 0;"><i class="bi bi-geo-alt me-1 text-danger"></i> {{ $event->lokasi }}</p>
                                </div>
                            @endforeach
                        @else
                            @php
                                $sampleEvents = [
                                    ['date'=>'20 Agu 2026', 'name'=>'Festival Kuliner & Budaya Sebong Lagoi', 'loc'=>'Lapangan Pantai Sebong', 'color'=>'var(--sea-blue)'],
                                    ['date'=>'12 Sep 2026', 'name'=>'Penanaman 1000 Bibit Mangrove Pesisir', 'loc'=>'Hutan Mangrove Jembatan 2', 'color'=>'var(--mangrove-green)'],
                                    ['date'=>'05 Okt 2026', 'name'=>'Pameran UMKM Kabupaten Bintan 2026', 'loc'=>'Gedung Serbaguna Bintan', 'color'=>'#D97706'],
                                ];
                            @endphp
                            @foreach($sampleEvents as $se)
                                <div style="background: white; border-radius: 14px; padding: 18px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border-left: 4px solid {{ $se['color'] }};">
                                    <span class="badge mb-2" style="background: #F8FAFC; color: {{ $se['color'] }}; font-weight: 700; border: 1px solid #E2E8F0;">
                                        <i class="bi bi-calendar-event me-1"></i>{{ $se['date'] }}
                                    </span>
                                    <h6 style="font-weight: 700; color: var(--navy); margin-bottom: 6px; font-size: 0.9rem; line-height: 1.4;">{{ $se['name'] }}</h6>
                                    <p style="font-size: 0.78rem; color: #64748B; margin: 0;"><i class="bi bi-geo-alt me-1 text-danger"></i> {{ $se['loc'] }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
