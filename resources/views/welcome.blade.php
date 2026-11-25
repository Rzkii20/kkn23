@extends('layouts.app')

@section('title', 'Desa Sebong Lagoi - Sistem Informasi UMKM & Wisata Terbaik')

@section('content')

    @php
        $heroImg = (isset($sliders) && $sliders->isNotEmpty())
            ? asset('storage/' . $sliders->first()->foto_banner)
            : asset('images/tentang-desa.jpg');

        $leftWisata = (isset($wisatas) && $wisatas->isNotEmpty()) ? $wisatas->first() : null;
        $leftImg = ($leftWisata && $leftWisata->foto_wisata)
            ? asset('storage/' . $leftWisata->foto_wisata)
            : asset('images/peta-desa.jpg');

        $rightProduk = (isset($produks) && $produks->isNotEmpty()) ? $produks->first() : null;
        $rightImg = ($rightProduk && $rightProduk->foto_produk)
            ? asset('storage/' . $rightProduk->foto_produk)
            : asset('images/tentang-desa.jpg');
    @endphp

    <!-- ====================================================
         00 / HERO SECTION (NAVY + WHITE + HOT PINK)
         ==================================================== -->
    <section class="tab-hero">
        <div class="container ed-container">
            <div class="tab-hero-center">
                <h1 class="tab-hero-title">
                    Karya UMKM &amp; pesona<br class="d-none d-md-inline">
                    <span class="serif-italic">Sebong Lagoi.</span>
                </h1>

                <p class="tab-hero-sub">
                    Temukan produk unggulan buatan warga lokal, jelajahi destinasi wisata mangrove dan pantai, serta dukung ekonomi kreatif Desa Sebong Lagoi langsung dari sumbernya.
                </p>

                <div class="tab-cta-row">
                    <a href="/produk" class="tab-btn-pink" id="btn-cari-produk">
                        Cari Produk &amp; UMKM <i class="bi bi-arrow-up-right"></i>
                    </a>
                    <a href="/wisata" class="tab-btn-ghost" id="btn-destinasi-wisata">
                        Destinasi Wisata
                    </a>
                </div>

                <div class="tab-hero-stats-inline">
                    <span><strong>{{ $statsUmkm }}</strong> UMKM Aktif</span>
                    <i class="tab-stat-sep"></i>
                    <span><strong>{{ $statsProduk }}</strong> Produk Terdaftar</span>
                    <i class="tab-stat-sep"></i>
                    <span><strong>{{ $statsWisata }}</strong> Destinasi Wisata</span>
                </div>
            </div>

            <!-- 3-Card Visual Showcase Collage -->
            <div class="tab-collage">
                <!-- Left Tilted Card -->
                <div class="tab-side-card left">
                    <img src="{{ $leftImg }}" alt="{{ $leftWisata ? $leftWisata->nama_wisata : 'Wisata Sebong Lagoi' }}">
                    <div class="tab-float-chip">
                        <div class="tab-chip-icon">
                            <i class="bi bi-compass"></i>
                        </div>
                        <div>
                            <div class="tab-chip-title">{{ $leftWisata ? Str::limit($leftWisata->nama_wisata, 22) : 'Wisata Pesisir' }}</div>
                            <div class="tab-chip-sub">Teluk Sebong, Bintan</div>
                        </div>
                    </div>
                </div>

                <!-- Center Showcase Card -->
                <div class="tab-center-card">
                    <div class="tab-pink-sticker">
                        100%<br>Lokal
                    </div>
                    <div class="tab-center-top">
                        <span><strong>Desa Sebong Lagoi</strong> · Bintan</span>
                        <span>{{ $statsUmkm }} UMKM</span>
                    </div>
                    <div class="tab-center-media">
                        <img src="{{ $heroImg }}" alt="{{ (isset($sliders) && $sliders->isNotEmpty()) ? $sliders->first()->judul : 'Desa Sebong Lagoi, Bintan' }}" id="heroBgImg">
                    </div>
                </div>

                <!-- Right Tilted Card -->
                <div class="tab-side-card right">
                    <img src="{{ $rightImg }}" alt="{{ $rightProduk ? $rightProduk->nama_produk : 'Produk UMKM Desa' }}">
                    <div class="tab-float-chip">
                        <div class="tab-chip-icon pink">
                            <i class="bi bi-bag-check-fill"></i>
                        </div>
                        <div>
                            <div class="tab-chip-title">{{ $rightProduk ? Str::limit($rightProduk->nama_produk, 22) : 'Produk Asli Desa' }}</div>
                            <div class="tab-chip-sub">Pesan langsung via WhatsApp</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         RUNNING MARQUEE TRANSITION (HERO -> SECTION 2)
         ==================================================== -->
    <div class="ed-marquee-band" aria-label="Sorotan Desa Sebong Lagoi">
        <div class="ed-marquee-track">
            <div class="ed-marquee-group">
                <span class="ed-marquee-item">UMKM Desa Sebong Lagoi</span>
                <span class="ed-marquee-sep" aria-hidden="true">✦</span>
                <span class="ed-marquee-item">Wisata Mangrove Bintan</span>
                <span class="ed-marquee-sep" aria-hidden="true">✦</span>
                <span class="ed-marquee-item">Kuliner Pesisir</span>
                <span class="ed-marquee-sep" aria-hidden="true">✦</span>
                <span class="ed-marquee-item">Kerajinan Kriya Lokal</span>
                <span class="ed-marquee-sep" aria-hidden="true">✦</span>
                <span class="ed-marquee-item">Teluk Sebong · Kepri</span>
                <span class="ed-marquee-sep" aria-hidden="true">✦</span>
                <span class="ed-marquee-item">100% Produk Warga Desa</span>
                <span class="ed-marquee-sep" aria-hidden="true">✦</span>
            </div>
            <div class="ed-marquee-group" aria-hidden="true">
                <span class="ed-marquee-item">UMKM Desa Sebong Lagoi</span>
                <span class="ed-marquee-sep">✦</span>
                <span class="ed-marquee-item">Wisata Mangrove Bintan</span>
                <span class="ed-marquee-sep">✦</span>
                <span class="ed-marquee-item">Kuliner Pesisir</span>
                <span class="ed-marquee-sep">✦</span>
                <span class="ed-marquee-item">Kerajinan Kriya Lokal</span>
                <span class="ed-marquee-sep">✦</span>
                <span class="ed-marquee-item">Teluk Sebong · Kepri</span>
                <span class="ed-marquee-sep">✦</span>
                <span class="ed-marquee-item">100% Produk Warga Desa</span>
                <span class="ed-marquee-sep">✦</span>
            </div>
        </div>
    </div>

    <!-- ====================================================
         01 / TENTANG DESA & MITRA UMKM (CHECKERBOARD GRID)
         ==================================================== -->
    @php
        $checkerFallbacks = [
            ['name' => 'UMKM Kuliner',    'icon' => 'bi-cup-hot-fill',     'url' => '/produk'],
            ['name' => 'Kerajinan Kriya', 'icon' => 'bi-palette-fill',     'url' => '/produk'],
            ['name' => 'Wisata Mangrove', 'icon' => 'bi-tree-fill',        'url' => '/wisata'],
            ['name' => 'Pantai Sebong',   'icon' => 'bi-water',            'url' => '/wisata'],
            ['name' => 'Olahan Laut',     'icon' => 'bi-bag-check-fill',   'url' => '/produk'],
            ['name' => 'BUMDes Lagoi',    'icon' => 'bi-building-fill',    'url' => '/tentang-desa'],
            ['name' => 'Agrowisata',      'icon' => 'bi-flower1',          'url' => '/wisata'],
            ['name' => 'Oleh-oleh Bintan','icon' => 'bi-gift-fill',        'url' => '/umkm'],
        ];

        $checkerItems = [];
        if (isset($homeUmkms) && $homeUmkms->isNotEmpty()) {
            foreach ($homeUmkms->take(8) as $umkm) {
                $checkerItems[] = [
                    'name' => Str::limit($umkm->nama_usaha, 18),
                    'icon' => 'bi-shop-window',
                    'img'  => $umkm->logo_umkm ? asset('storage/' . $umkm->logo_umkm) : null,
                    'url'  => '/umkm/' . $umkm->slug,
                ];
            }
        }
        $fbIndex = 0;
        while (count($checkerItems) < 8) {
            $fb = $checkerFallbacks[$fbIndex++];
            $checkerItems[] = [
                'name' => $fb['name'],
                'icon' => $fb['icon'],
                'img'  => null,
                'url'  => $fb['url'],
            ];
        }
    @endphp

    <section class="ed-checker-section">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / Mitra &amp; Sektor</span>
            </div>
            <div class="ed-checker-head reveal">
                <div class="ed-checker-head-left">
                    <span class="ed-checker-kicker">Tentang Desa Sebong Lagoi</span>
                    <h2 class="ed-checker-title">
                        Desa pesisir yang menumbuhkan UMKM lokal dan pariwisata unggulan <span class="serif-italic">Bintan.</span>
                    </h2>
                </div>
                <a href="/umkm" class="ed-checker-cta">
                    Lihat Mitra UMKM <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            <div class="ed-checker-grid reveal">
                @foreach($checkerItems as $idx => $item)
                    <a href="{{ $item['url'] }}" class="ed-checker-tile">
                        @if(!empty($item['img']))
                            <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}" class="ed-checker-logo-img">
                        @else
                            <span class="ed-checker-icon"><i class="bi {{ $item['icon'] }}"></i></span>
                        @endif
                        <span class="ed-checker-name">{{ $item['name'] }}</span>
                    </a>
                    @if($idx < 7)
                        <div class="ed-checker-empty" aria-hidden="true"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- ====================================================
         02 / DESTINASI WISATA (SPLIT EDITORIAL + STAGGERED BENTO)
         ==================================================== -->
    @php
        $wisataFallbacks = [
            [
                'title' => 'Pantai Sebong Eksotis',
                'desc'  => 'Hamparan pasir putih bersih dengan panorama laut biru Teluk Sebong dan pemandangan matahari terbenam yang tenang.',
                'loc'   => 'RT. 02 Desa Sebong Lagoi',
                'img'   => asset('images/tentang-desa.jpg'),
                'url'   => '/wisata',
            ],
            [
                'title' => 'Mangrove Adventure Tour',
                'desc'  => 'Menyusuri aliran sungai dan hutan mangrove purba bersama pemandu lokal sembari mengenal ekosistem pesisir.',
                'loc'   => 'Kawasan Konservasi Sungai Sebong',
                'img'   => asset('images/peta-desa.jpg'),
                'url'   => '/wisata',
            ],
            [
                'title' => 'Agrowisata Kebun Buah',
                'desc'  => 'Wisata edukasi kebun buah tropis sekaligus mencicipi hasil panen segar langsung dari lahan warga.',
                'loc'   => 'Dusun III Sebong Lagoi',
                'img'   => asset('images/tentang-desa.jpg'),
                'url'   => '/wisata',
            ],
            [
                'title' => 'Pesisir Teluk Sebong',
                'desc'  => 'Kawasan pantai landai dengan angin laut sejuk, tempat bersantai keluarga dan menikmati kuliner pesisir.',
                'loc'   => 'Pesisir Utara Sebong Lagoi',
                'img'   => asset('images/peta-desa.jpg'),
                'url'   => '/wisata',
            ],
            [
                'title' => 'Jembatan Konservasi Mangrove',
                'desc'  => 'Jalur jalan kaki kayu di tengah rimbunnya hutan bakau dengan spot foto alami dan udara pesisir yang segar.',
                'loc'   => 'Sungai Sebong, Teluk Sebong',
                'img'   => asset('images/tentang-desa.jpg'),
                'url'   => '/wisata',
            ],
        ];

        $bentoWisatas = [];
        if (isset($wisatas) && $wisatas->isNotEmpty()) {
            foreach ($wisatas->take(5) as $wisata) {
                $bentoWisatas[] = [
                    'title' => $wisata->nama_wisata,
                    'desc'  => Str::limit(strip_tags($wisata->deskripsi ?? ''), 120) ?: 'Destinasi wisata alam unggulan di Desa Sebong Lagoi, Kabupaten Bintan.',
                    'loc'   => Str::limit($wisata->alamat, 45),
                    'img'   => $wisata->foto_wisata ? asset('storage/' . $wisata->foto_wisata) : asset('images/tentang-desa.jpg'),
                    'url'   => '/wisata/' . $wisata->slug,
                ];
            }
        }
        $wIdx = 0;
        while (count($bentoWisatas) < 5) {
            $bentoWisatas[] = $wisataFallbacks[$wIdx++];
        }
    @endphp

    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / 02</span>
            </div>

            <div class="ed-wisata-split">
                <!-- Kolom Kiri (Editorial Copy) -->
                <div class="ed-wisata-info reveal">
                    <span class="ed-kicker">02 / Destinasi Wisata</span>
                    <h2 class="ed-wisata-heading">
                        Menjelajah Pesona Alam <span class="serif-italic">Sebong Lagoi</span> Lebih Dekat.
                    </h2>
                    <p class="ed-wisata-lead">
                        Terletak di Kecamatan Teluk Sebong, Kabupaten Bintan, Kepulauan Riau, Desa Sebong Lagoi menyimpan perpaduan lanskap pesisir yang tenang, hutan mangrove purba, serta ruang wisata alam yang dikelola bersama masyarakat desa.
                    </p>
                    <p class="ed-wisata-lead last">
                        Setiap kunjungan tidak hanya menghadirkan pengalaman alam yang asri, tetapi juga terhubung langsung dengan sentra kuliner, kerajinan tangan, dan produk unggulan pelaku UMKM setempat.
                    </p>

                    <div class="ed-wisata-bullets">
                        <div class="ed-wisata-bullet">
                            <span class="ed-wisata-bullet-icon"><i class="bi bi-water"></i></span>
                            <div class="ed-wisata-bullet-text">
                                <strong>Pantai &amp; Pesisir Asri</strong> — Hamparan pasir bersih dengan panorama laut biru Teluk Sebong yang tenang dan cocok untuk bersantai di sore hari.
                            </div>
                        </div>
                        <div class="ed-wisata-bullet">
                            <span class="ed-wisata-bullet-icon"><i class="bi bi-tree"></i></span>
                            <div class="ed-wisata-bullet-text">
                                <strong>Ekowisata Mangrove Alami</strong> — Susur sungai hutan bakau bersama pemandu lokal sembari mengenal konservasi dan keanekaragaman hayati pesisir Bintan.
                            </div>
                        </div>
                        <div class="ed-wisata-bullet">
                            <span class="ed-wisata-bullet-icon"><i class="bi bi-shop"></i></span>
                            <div class="ed-wisata-bullet-text">
                                <strong>Wisata Budaya &amp; Kuliner Lokal</strong> — Nikmati olahan seafood, keripik khas, dan cenderamata buatan warga tepat di sekitar kawasan destinasi.
                            </div>
                        </div>
                        <div class="ed-wisata-bullet">
                            <span class="ed-wisata-bullet-icon"><i class="bi bi-geo-alt"></i></span>
                            <div class="ed-wisata-bullet-text">
                                <strong>Akses Mudah &amp; Strategis</strong> — Berjarak dekat dari kawasan wisata terpadu Lagoi dengan jalur darat yang nyaman bagi wisatawan keluarga maupun rombongan.
                            </div>
                        </div>
                    </div>

                    <div class="ed-wisata-note">
                        <div>
                            <span class="ed-wisata-note-label">Kawasan</span>
                            <span class="ed-wisata-note-val">Teluk Sebong, Bintan</span>
                        </div>
                        <div>
                            <span class="ed-wisata-note-label">Waktu Kunjungan</span>
                            <span class="ed-wisata-note-val">Setiap Hari, 07.00–18.00 WIB</span>
                        </div>
                    </div>

                    <p class="ed-wisata-closing">
                        Arahkan kursor pada tiap foto di samping untuk melihat nama destinasi, deskripsi singkat, lokasi, dan detail lengkap rute kunjungannya.
                    </p>

                    <a href="/wisata" class="ed-link-arrow">
                        Semua Wisata <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>

                <!-- Kolom Kanan (5-Card Staggered Bento + Hover Reveal) -->
                <div class="ed-wisata-bento reveal">
                    <div class="ed-bento-row-top">
                        <a href="{{ $bentoWisatas[0]['url'] }}" class="ed-bento-card">
                            <img src="{{ $bentoWisatas[0]['img'] }}" alt="{{ $bentoWisatas[0]['title'] }}">
                            <div class="ed-bento-hover">
                                <div class="ed-bento-hover-top">
                                    <h3 class="ed-bento-hover-title">{{ $bentoWisatas[0]['title'] }}</h3>
                                    <p class="ed-bento-hover-desc">{{ $bentoWisatas[0]['desc'] }}</p>
                                </div>
                                <div class="ed-bento-hover-meta">
                                    <span class="ed-bento-hover-loc"><i class="bi bi-geo-alt me-1"></i>{{ $bentoWisatas[0]['loc'] }}</span>
                                    <span class="ed-bento-hover-cta">Lihat Detail <i class="bi bi-arrow-up-right"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="ed-bento-row-mid">
                        @foreach([$bentoWisatas[1], $bentoWisatas[2]] as $bw)
                            <a href="{{ $bw['url'] }}" class="ed-bento-card">
                                <img src="{{ $bw['img'] }}" alt="{{ $bw['title'] }}">
                                <div class="ed-bento-hover">
                                    <div class="ed-bento-hover-top">
                                        <h3 class="ed-bento-hover-title">{{ $bw['title'] }}</h3>
                                        <p class="ed-bento-hover-desc">{{ $bw['desc'] }}</p>
                                    </div>
                                    <div class="ed-bento-hover-meta">
                                        <span class="ed-bento-hover-loc"><i class="bi bi-geo-alt me-1"></i>{{ $bw['loc'] }}</span>
                                        <span class="ed-bento-hover-cta">Lihat Detail <i class="bi bi-arrow-up-right"></i></span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="ed-bento-row-bot">
                        @foreach([$bentoWisatas[3], $bentoWisatas[4]] as $bw)
                            <a href="{{ $bw['url'] }}" class="ed-bento-card">
                                <img src="{{ $bw['img'] }}" alt="{{ $bw['title'] }}">
                                <div class="ed-bento-hover">
                                    <div class="ed-bento-hover-top">
                                        <h3 class="ed-bento-hover-title">{{ $bw['title'] }}</h3>
                                        <p class="ed-bento-hover-desc">{{ $bw['desc'] }}</p>
                                    </div>
                                    <div class="ed-bento-hover-meta">
                                        <span class="ed-bento-hover-loc"><i class="bi bi-geo-alt me-1"></i>{{ $bw['loc'] }}</span>
                                        <span class="ed-bento-hover-cta">Lihat Detail <i class="bi bi-arrow-up-right"></i></span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         03 / KATALOG PRODUK & KATEGORI UMKM (3-CARD SHOWCASE)
         ==================================================== -->
    @php
        $produkFallbacks = [
            [
                'name'   => 'Keripik Singkong Gurih',
                'price'  => 15000,
                'unit'   => 'per kemasan 250g',
                'cat'    => 'Kuliner',
                'seller' => 'UMKM Rasa Nusantara',
                'pack'   => 'Kemasan 250g higienis',
                'img'    => asset('images/tentang-desa.jpg'),
                'url'    => '/produk',
            ],
            [
                'name'   => 'Kain Tenun Batik Melayu',
                'price'  => 250000,
                'unit'   => 'per lembar kain',
                'cat'    => 'Kerajinan',
                'seller' => 'UMKM Kriya Bintan',
                'pack'   => 'Ukuran 2m × 1,15m',
                'img'    => asset('images/peta-desa.jpg'),
                'url'    => '/produk',
            ],
            [
                'name'   => 'Sambal Lingkung Teri',
                'price'  => 35000,
                'unit'   => 'per toples 200g',
                'cat'    => 'Kuliner',
                'seller' => 'UMKM Dapur Sebong',
                'pack'   => 'Toples segel 200g',
                'img'    => asset('images/tentang-desa.jpg'),
                'url'    => '/produk',
            ],
            [
                'name'   => 'Tas Anyaman Pandan',
                'price'  => 180000,
                'unit'   => 'per pcs',
                'cat'    => 'Kerajinan',
                'seller' => 'UMKM Anyam Lagoi',
                'pack'   => 'Anyaman tangan rapi',
                'img'    => asset('images/peta-desa.jpg'),
                'url'    => '/produk',
            ],
        ];

        $showcaseProduks = [];
        if (isset($produks) && $produks->isNotEmpty()) {
            foreach ($produks->take(4) as $produk) {
                $showcaseProduks[] = [
                    'name'   => $produk->nama_produk,
                    'price'  => $produk->harga,
                    'unit'   => $produk->ukuran_kemasan ? 'per ' . $produk->ukuran_kemasan : 'harga satuan',
                    'cat'    => optional($produk->kategori)->nama_kategori ?? 'Umum',
                    'seller' => optional($produk->umkm)->nama_usaha ?? 'UMKM Sebong Lagoi',
                    'pack'   => $produk->ukuran_kemasan ?: 'Kemasan rapi siap kirim',
                    'img'    => $produk->foto_produk ? asset('storage/' . $produk->foto_produk) : asset('images/tentang-desa.jpg'),
                    'url'    => '/produk/' . $produk->slug,
                ];
            }
        }
        $pIdx = 0;
        while (count($showcaseProduks) < 4) {
            $showcaseProduks[] = $produkFallbacks[$pIdx++];
        }
    @endphp

    <section class="ed-section">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">02 / 03</span>
            </div>

            <div class="ed-produk-head reveal">
                <span class="ed-produk-kicker">Katalog UMKM · Produk Warga Desa</span>
                <h2 class="ed-produk-title">
                    Rekomendasi Produk Mitra. <span class="ed-muted-phrase">Asli Desa.</span>
                </h2>
            </div>

            <div class="ed-produk-pillbar-wrap reveal">
                <div class="ed-produk-pillbar">
                    <a href="/produk" class="ed-pillbar-item active">Semua Produk</a>
                    @if(isset($homeKategoris) && $homeKategoris->isNotEmpty())
                        @foreach($homeKategoris as $kategori)
                            <a href="/produk?kategori={{ $kategori->slug }}" class="ed-pillbar-item">
                                {{ $kategori->nama_kategori }}
                                <span>{{ $kategori->produk_count }}</span>
                            </a>
                        @endforeach
                    @else
                        <a href="/produk" class="ed-pillbar-item">Kuliner</a>
                        <a href="/produk" class="ed-pillbar-item">Kerajinan</a>
                        <a href="/produk" class="ed-pillbar-item">Olahan Laut</a>
                    @endif
                </div>
            </div>

            <div class="ed-showcase-grid reveal">
                @foreach($showcaseProduks as $idx => $sp)
                    @php $isFeatured = ($idx === 1); @endphp
                    <div class="ed-showcase-card {{ $isFeatured ? 'is-featured' : '' }}">
                        <div class="ed-showcase-top">
                            <div class="ed-showcase-meta">
                                <div class="ed-showcase-meta-left">
                                    <i class="bi bi-shop"></i>
                                    <strong>{{ $sp['cat'] }}</strong>
                                    <span>|</span>
                                    <span class="text-truncate">{{ $sp['seller'] }}</span>
                                </div>
                                @if($isFeatured)
                                    <span class="ed-featured-badge">Unggulan</span>
                                @endif
                            </div>

                            <div class="ed-showcase-thumb">
                                <img src="{{ $sp['img'] }}" alt="{{ $sp['name'] }}">
                            </div>

                            <h3 class="ed-showcase-name">{{ $sp['name'] }}</h3>
                            <div class="ed-showcase-price-row">
                                <span class="ed-showcase-price">Rp {{ number_format($sp['price'], 0, ',', '.') }}</span>
                                <span class="ed-showcase-unit">/ {{ $sp['unit'] }}</span>
                            </div>

                            <div class="ed-showcase-actions">
                                @if($isFeatured)
                                    <a href="{{ $sp['url'] }}" class="ed-sc-btn-white">
                                        Lihat Produk
                                    </a>
                                @elseif($idx === 3)
                                    <a href="{{ $sp['url'] }}" class="ed-sc-btn-navy">
                                        Lihat Produk
                                    </a>
                                    <a href="/produk" class="ed-sc-btn-light">
                                        Katalog
                                    </a>
                                @else
                                    <a href="{{ $sp['url'] }}" class="ed-sc-btn-light">
                                        Lihat Produk
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="ed-showcase-body">
                            <ul class="ed-showcase-list">
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span><strong>Produksi {{ $sp['seller'] }}</strong> terdata di desa</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span><strong>Kategori {{ $sp['cat'] }}</strong> unggulan Sebong Lagoi</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span><strong>{{ $sp['pack'] }}</strong> siap pesan</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span><strong>Pemesanan langsung</strong> via WhatsApp pemilik UMKM</span>
                                </li>
                            </ul>

                            <div class="ed-showcase-plus-wrap">
                                <a href="{{ $sp['url'] }}" class="ed-showcase-plus" title="Detail {{ $sp['name'] }}">
                                    <i class="bi bi-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="ed-produk-foot-note reveal">
                Harga dan ketersediaan langsung dari pelaku UMKM Desa Sebong Lagoi.
                <a href="/produk">Lihat Semua Produk <i class="bi bi-arrow-up-right"></i></a>
            </div>
        </div>
    </section>

    <!-- ====================================================
         04 / BERITA & AGENDA DESA (PORTRAIT STORY CARDS)
         ==================================================== -->
    @php
        $artikelFallbacks = [
            [
                'kicker' => 'Berita UMKM',
                'title'  => 'Pelatihan Pemasaran Digital bagi Pelaku UMKM Desa Sebong Lagoi',
                'date'   => '17 Jul 2026',
                'meta'   => '124 pembaca · Pemerintah Desa',
                'img'    => asset('images/tentang-desa.jpg'),
                'url'    => '/artikel',
            ],
            [
                'kicker' => 'Agenda Budaya',
                'title'  => 'Festival Kuliner & Budaya Sebong Lagoi 2026 Dihadiri Ribuan Pengunjung',
                'date'   => '10 Jul 2026',
                'meta'   => '320 pembaca · Liputan Desa',
                'img'    => asset('images/peta-desa.jpg'),
                'url'    => '/artikel',
            ],
            [
                'kicker' => 'Wisata & Alam',
                'title'  => 'Pengembangan Jalur Ekowisata Mangrove Berbasis Masyarakat Teluk Sebong',
                'date'   => '03 Jul 2026',
                'meta'   => '215 pembaca · Pokdarwis Desa',
                'img'    => asset('images/tentang-desa.jpg'),
                'url'    => '/artikel',
            ],
            [
                'kicker' => 'Kriya Lokal',
                'title'  => 'Anyaman Pandan & Batik Melayu Warga Sebong Lagoi Tembus Pasar Wisatawan',
                'date'   => '26 Jun 2026',
                'meta'   => '189 pembaca · Mitra UMKM',
                'img'    => asset('images/peta-desa.jpg'),
                'url'    => '/artikel',
            ],
            [
                'kicker' => 'Layanan Desa',
                'title'  => 'Digitalisasi Katalog Produk & Administrasi Desa untuk Kemudahan Akses Publik',
                'date'   => '19 Jun 2026',
                'meta'   => '142 pembaca · Pemerintah Desa',
                'img'    => asset('images/tentang-desa.jpg'),
                'url'    => '/artikel',
            ],
            [
                'kicker' => 'Lingkungan Pesisir',
                'title'  => 'Gerakan Bersih Pantai & Penanaman Bibit Bakau Bersama Pemuda Sebong Lagoi',
                'date'   => '11 Jun 2026',
                'meta'   => '276 pembaca · Karang Taruna',
                'img'    => asset('images/peta-desa.jpg'),
                'url'    => '/artikel',
            ],
        ];

        $storyArtikels = [];
        if (isset($artikels) && $artikels->isNotEmpty()) {
            foreach ($artikels->take(6) as $artikel) {
                $storyArtikels[] = [
                    'kicker' => 'Berita Desa',
                    'title'  => $artikel->judul,
                    'date'   => $artikel->created_at->format('d M Y'),
                    'meta'   => $artikel->views . ' pembaca · Sebong Lagoi',
                    'img'    => $artikel->foto_artikel ? asset('storage/' . $artikel->foto_artikel) : asset('images/tentang-desa.jpg'),
                    'url'    => '/artikel/' . $artikel->slug,
                ];
            }
        }
        $aIdx = 0;
        while (count($storyArtikels) < 6) {
            $storyArtikels[] = $artikelFallbacks[$aIdx++];
        }
    @endphp

    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">03 / 04</span>
            </div>

            <div class="ed-story-head reveal">
                <span class="ed-kicker">04 / Kabar Terkini</span>
                <h2 class="ed-story-heading">
                    Berita &amp; <span class="serif-italic">Artikel</span> Desa.
                </h2>
                <p class="ed-story-sub">
                    Liputan kegiatan masyarakat, perkembangan pelaku UMKM, serta kabar terbaru dari Desa Sebong Lagoi.
                </p>
            </div>

            <div class="ed-story-grid reveal">
                @foreach($storyArtikels as $sa)
                    <a href="{{ $sa['url'] }}" class="ed-story-card">
                        <img src="{{ $sa['img'] }}" alt="{{ $sa['title'] }}" class="ed-story-bg">
                        <div class="ed-story-scrim"></div>

                        <div class="ed-story-top">
                            <span class="ed-story-kicker">
                                <i class="bi bi-journal-text"></i> {{ $sa['kicker'] }}
                            </span>
                            <h3 class="ed-story-title">{{ $sa['title'] }}</h3>
                        </div>

                        <div class="ed-story-bottom">
                            <div class="ed-story-meta">
                                <strong>{{ $sa['date'] }}</strong>
                                <span>{{ $sa['meta'] }}</span>
                            </div>
                            <span class="ed-story-arrow" aria-hidden="true">
                                <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="ed-story-more-wrap reveal">
                <a href="/artikel" class="ed-link-arrow">
                    Semua Artikel <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            <!-- Kalender Acara / Event Desa -->
            <div class="ed-event-strip-wrap reveal">
                <div class="ed-event-strip-head">
                    <div>
                        <span class="ed-kicker">Kalender Acara</span>
                        <h3 class="ed-heading" style="font-size: clamp(1.4rem, 2.4vw, 1.9rem);">
                            Event <span class="serif-italic">Desa.</span>
                        </h3>
                    </div>
                    <a href="/event" class="ed-link-arrow">
                        Semua Event <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>

                <div class="ed-event-strip">
                    @if(isset($events) && $events->isNotEmpty())
                        @foreach($events->take(3) as $event)
                            <div class="ed-event-card">
                                <span class="ed-event-date">{{ $event->tanggal_mulai->format('d M Y') }}</span>
                                <h4 class="ed-event-title">{{ $event->nama_event }}</h4>
                                <p class="ed-event-loc"><i class="bi bi-geo-alt me-1"></i>{{ $event->lokasi }}</p>
                            </div>
                        @endforeach
                    @else
                        @php
                            $sampleEvents = [
                                ['date' => '20 Agu 2026', 'name' => 'Festival Kuliner & Budaya Sebong Lagoi', 'loc' => 'Lapangan Pantai Sebong'],
                                ['date' => '12 Sep 2026', 'name' => 'Penanaman 1000 Bibit Mangrove Pesisir', 'loc' => 'Hutan Mangrove Jembatan 2'],
                                ['date' => '05 Okt 2026', 'name' => 'Pameran UMKM Kabupaten Bintan 2026', 'loc' => 'Gedung Serbaguna Bintan'],
                            ];
                        @endphp
                        @foreach($sampleEvents as $se)
                            <div class="ed-event-card">
                                <span class="ed-event-date">{{ $se['date'] }}</span>
                                <h4 class="ed-event-title">{{ $se['name'] }}</h4>
                                <p class="ed-event-loc"><i class="bi bi-geo-alt me-1"></i>{{ $se['loc'] }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
