<!DOCTYPE html>
<html lang="id" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- SEO Primary Meta Tags --}}
    <title>@yield('title', 'Desa Sebong Lagoi - Sistem Informasi UMKM & Potensi Desa')</title>
    <meta name="title" content="@yield('title', 'Desa Sebong Lagoi - Sistem Informasi UMKM & Potensi Desa')">
    <meta name="description" content="@yield('meta_description', 'Portal Resmi Sistem Informasi Promosi & Pemasaran UMKM serta Potensi Wisata dan Administrasi Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan, Kepulauan Riau.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Desa Sebong Lagoi, UMKM Sebong Lagoi, Wisata Bintan, Teluk Sebong, Kepulauan Riau, Produk Lokal Bintan, Kerajinan Bintan, Oleh-oleh Bintan, Wisata Mangrove, Pemerintahan Desa Sebong Lagoi')">
    <meta name="author" content="Pemerintah Desa Sebong Lagoi">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="google-site-verification" content="google7296a5e8e936d655">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Favicon & App Icons --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bintan.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-bintan.png') }}">
    <meta name="theme-color" content="#0F1B3D">

    {{-- Open Graph / Facebook / WhatsApp --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Desa Sebong Lagoi">
    <meta property="og:title" content="@yield('title', 'Desa Sebong Lagoi - Sistem Informasi UMKM & Potensi Desa')">
    <meta property="og:description" content="@yield('meta_description', 'Portal Resmi Sistem Informasi Promosi & Pemasaran UMKM serta Potensi Wisata dan Administrasi Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan, Kepulauan Riau.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/logo-bintan.png'))">
    <meta property="og:image:alt" content="Logo Desa Sebong Lagoi, Bintan">

    {{-- Twitter Cards --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Desa Sebong Lagoi - Sistem Informasi UMKM & Potensi Desa')">
    <meta name="twitter:description" content="@yield('meta_description', 'Portal Resmi Sistem Informasi Promosi & Pemasaran UMKM serta Potensi Wisata dan Administrasi Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan, Kepulauan Riau.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo-bintan.png'))">

    {{-- Structured Data (Schema.org JSON-LD) --}}
    @php
        $schemaOrg = [
            chr(64) . 'context' => 'https://schema.org',
            chr(64) . 'graph' => [
                [
                    chr(64) . 'type' => 'GovernmentOrganization',
                    chr(64) . 'id' => url('/') . '#organization',
                    'name' => 'Pemerintah Desa Sebong Lagoi',
                    'url' => url('/'),
                    'logo' => [
                        chr(64) . 'type' => 'ImageObject',
                        'url' => asset('images/logo-bintan.png'),
                    ],
                    'address' => [
                        chr(64) . 'type' => 'PostalAddress',
                        'streetAddress' => 'Jl. Pancamarga No. 3A',
                        'addressLocality' => 'Kecamatan Teluk Sebong',
                        'addressRegion' => 'Kabupaten Bintan',
                        'postalCode' => '29152',
                        'addressCountry' => 'ID',
                    ],
                    'telephone' => '+6281261554737',
                    'email' => 'sebonglagoi11@gmail.com',
                ],
                [
                    chr(64) . 'type' => 'WebSite',
                    chr(64) . 'id' => url('/') . '#website',
                    'url' => url('/'),
                    'name' => 'Desa Sebong Lagoi',
                    'description' => 'Sistem Informasi Promosi UMKM & Potensi Desa Sebong Lagoi, Bintan',
                    'publisher' => [
                        chr(64) . 'id' => url('/') . '#organization',
                    ],
                    'inLanguage' => 'id-ID',
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">
    {!! json_encode($schemaOrg, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts (Navy + White + Hot Pink Reference Typography) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom Style CSS -->
    <link href="{{ asset('css/style.css') }}?v={{ file_exists(public_path('css/style.css')) ? filemtime(public_path('css/style.css')) : '1' }}" rel="stylesheet">
    @yield('styles')
</head>
<body>

    <!-- ====================================================
         NAVBAR UTAMA
         ==================================================== -->
    <nav class="navbar navbar-expand-lg navbar-custom {{ !Route::is('home') ? 'navbar-solid' : '' }}" id="mainNavbar">
        @php
            $logoAdmin = null;
            try {
                $logoAdmin = \App\Models\User::where('role', 'admin')->value('foto_profil');
            } catch (\Throwable $e) {
                $logoAdmin = null;
            }
        @endphp
        <div class="container ed-container">
            <a class="navbar-brand" href="{{ route('home') }}">
                @if($logoAdmin)
                    <img src="{{ asset('storage/' . $logoAdmin) }}"
                         alt="Logo Desa"
                         style="width:38px;height:38px;object-fit:cover;border-radius:6px;flex-shrink:0;">
                @else
                    <img src="{{ asset('images/logo-bintan.png') }}"
                         alt="Logo Kabupaten Bintan"
                         style="width:38px;height:38px;object-fit:contain;flex-shrink:0;">
                @endif
                <div class="navbar-brand-text">
                    <span class="brand-name">Desa Sebong Lagoi</span>
                    <span class="brand-sub">UMKM &amp; Potensi Desa</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-3"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('tentang-desa') || Request::is('struktur-desa') || Request::is('potensi-desa') ? 'active' : '' }}"
                           href="#" id="navbarTentang" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profil Desa <i class="bi bi-chevron-down nav-caret" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="navbarTentang">
                            <li><a class="dropdown-item" href="/tentang-desa"><i class="bi bi-info-circle me-2 text-muted"></i>Tentang Desa</a></li>
                            <li><a class="dropdown-item" href="/struktur-desa"><i class="bi bi-diagram-3 me-2 text-muted"></i>Struktur Desa</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('umkm*') || Request::is('produk*') ? 'active' : '' }}" href="#" id="navbarUmkm" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            UMKM <i class="bi bi-chevron-down nav-caret" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="navbarUmkm">
                            <li><a class="dropdown-item" href="/umkm">Daftar UMKM</a></li>
                            <li><a class="dropdown-item" href="/produk">Katalog Produk</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('wisata*') ? 'active' : '' }}" href="/wisata">Wisata</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('artikel*') || Request::is('event*') || Request::is('dokumen*') ? 'active' : '' }}" href="#" id="navbarInformasi" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Informasi <i class="bi bi-chevron-down nav-caret" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="navbarInformasi">
                            <li><a class="dropdown-item" href="/artikel">Artikel & Berita</a></li>
                            <li><a class="dropdown-item" href="/event">Event Desa</a></li>
                            <li><a class="dropdown-item" href="/dokumen">Dokumen & Administrasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/galeri">Galeri</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="/kontak">Kontak</a>
                    </li>

                    @auth
                        <li class="nav-item dropdown">
                            <a class="btn-admin-nav dropdown-toggle" href="#" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                                {{ Auth::user()->isAdmin() ? 'Admin' : Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" aria-labelledby="navbarUser">
                                <li class="px-3 py-2">
                                    <span class="d-block text-muted small">Masuk sebagai:</span>
                                    <span class="d-block fw-bold text-dark">{{ Auth::user()->name }}</span>
                                </li>
                                <li><hr class="dropdown-divider m-1"></li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('mitra.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2 text-primary"></i> Buka Dashboard
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger py-2">
                                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT UTAMA -->
    <main style="{{ !Route::is('home') ? 'padding-top: 82px;' : '' }}">
        @if(session('success'))
            <div class="container mt-4">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 12px;">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- ====================================================
         FOOTER UTAMA
         ==================================================== -->
    @hasSection('minimal_footer')
        <footer class="footer-custom ft-minimal">
            <div class="container">
                <div class="ft-giant-wordmark" aria-hidden="true">SEBONG LAGOI</div>
            </div>
        </footer>
    @else
        <footer class="footer-custom">
            <div class="container">
            <!-- Top 3-Column Row -->
            <div class="ft-top-grid">
                <!-- Left: Brand & Socials -->
                <div>
                    <div class="ft-brand-block">
                        <img src="{{ asset('images/logo-bintan.png') }}"
                             alt="Logo Kabupaten Bintan"
                             style="width:46px;height:46px;object-fit:contain;flex-shrink:0;">
                        <div>
                            <div class="footer-brand-name">Desa Sebong Lagoi</div>
                            <div class="footer-brand-sub">Sistem UMKM &amp; Potensi Desa</div>
                        </div>
                    </div>

                    <span class="ft-label">Sosial Media</span>
                    <div class="ft-socials">
                        <a href="#" class="ft-social-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="ft-social-btn" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="ft-social-btn" title="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="ft-social-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Center: Navigasi & Informasi (3 Sub-Columns) -->
                <div>
                    <span class="ft-label">Navigasi &amp; Informasi</span>
                    <div class="ft-nav-cols">
                        <ul class="ft-nav-list">
                            <li><a href="{{ route('home') }}">Beranda</a></li>
                            <li><a href="/tentang-desa">Tentang Desa</a></li>
                            <li><a href="/umkm">Daftar UMKM</a></li>
                            <li><a href="/produk">Katalog Produk</a></li>
                        </ul>
                        <ul class="ft-nav-list">
                            <li><a href="/wisata">Destinasi Wisata</a></li>
                            <li><a href="/artikel">Berita &amp; Artikel</a></li>
                            <li><a href="/event">Event Desa</a></li>
                        </ul>
                        <ul class="ft-nav-list">
                            <li><a href="/galeri">Galeri Kegiatan</a></li>
                            <li><a href="/dokumen">Dokumen &amp; Administrasi</a></li>
                            <li><a href="/kontak">Hubungi Kami</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Right: Deskripsi Singkat -->
                <div>
                    <span class="ft-label">Portal Resmi Desa</span>
                    <p class="ft-desc">
                        Platform digital untuk promosi dan pemasaran UMKM serta potensi wisata Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan, Kepulauan Riau.
                    </p>
                    <div class="ft-badge-row">
                        <span class="ft-mini-pill"><i class="bi bi-shop"></i> UMKM Terdata</span>
                        <span class="ft-mini-pill"><i class="bi bi-compass"></i> Wisata Bintan</span>
                        <span class="ft-mini-pill"><i class="bi bi-whatsapp"></i> Pesan Langsung</span>
                    </div>
                </div>
            </div>

            <!-- Middle Faint Marquee Band -->
            <div class="ft-ticker-band">
                <div class="ft-ticker-tags">
                    <span class="ft-ticker-pill is-active">Potensi Desa</span>
                    <span class="ft-ticker-pill">UMKM &amp; Wisata</span>
                </div>
                <div class="ft-ticker-wrap" aria-hidden="true">
                    <div class="ft-ticker-track">
                        <div class="ft-ticker-group">
                            <span>· Kuliner Pesisir</span>
                            <span>· Kerajinan Kriya</span>
                            <span>· Wisata Mangrove</span>
                            <span>· Pantai Sebong</span>
                            <span>· Produk UMKM</span>
                            <span>· Administrasi Desa</span>
                        </div>
                        <div class="ft-ticker-group">
                            <span>· Kuliner Pesisir</span>
                            <span>· Kerajinan Kriya</span>
                            <span>· Wisata Mangrove</span>
                            <span>· Pantai Sebong</span>
                            <span>· Produk UMKM</span>
                            <span>· Administrasi Desa</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lower 3-Column Info Row (Photo + Contact Details + Map) -->
            <div class="ft-mid-grid">
                <div class="ft-photo-box">
                    <img src="{{ asset('images/tentang-desa.jpg') }}" alt="Kantor Desa Sebong Lagoi">
                </div>

                <div class="ft-contact-grid">
                    <div>
                        <span class="ft-label">Kantor Desa</span>
                        <p class="ft-contact-val">
                            Jl. Pancamarga No. 3A, Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan, Kepulauan Riau 29152
                        </p>
                        <a href="/kontak" class="ft-map-link">↳ Hubungi Kami</a>
                    </div>
                    <div>
                        <span class="ft-label">Email</span>
                        <p class="ft-contact-val mb-3">sebonglagoi11@gmail.com</p>

                        <span class="ft-label">WhatsApp</span>
                        <p class="ft-contact-val">+62 812-6155-4737</p>
                    </div>
                    <div>
                        <span class="ft-label">Wilayah</span>
                        <p class="ft-contact-val">Teluk Sebong / Kab. Bintan / Kepulauan Riau</p>
                    </div>
                    <div>
                        <span class="ft-label">Jam Pelayanan</span>
                        <p class="ft-contact-val">Senin – Jumat: 08.00 – 16.00 WIB</p>
                    </div>
                </div>

                <div class="ft-map-box">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18926.907047619676!2d104.3739710586819!3d1.1704165844118797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97e00baa46fb1%3A0xd174c0cffc0fd3d6!2sLagoi%2C%20Sebong%20Lagoi%2C%20Kec.%20Tlk.%20Sebong%2C%20Kabupaten%20Bintan%2C%20Kepulauan%20Riau!5e1!3m2!1sid!2sid!4v1795613223979!5m2!1sid!2sid"
                        title="Peta Lokasi Desa Sebong Lagoi"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin">
                    </iframe>
                </div>
            </div>

            <!-- Legal Bar -->
            <div class="ft-legal-bar">
                <span>&copy; {{ date('Y') }} Pemerintah Desa Sebong Lagoi. All Rights Reserved.</span>
                <div class="ft-legal-links">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat &amp; Ketentuan</a>
                    <a href="/kontak">Bantuan</a>
                    <a href="{{ route('login') }}"><i class="bi bi-person-fill-lock me-1"></i>Login Admin</a>
                </div>
            </div>

            <!-- Giant Halftone Dotted Wordmark -->
            <div class="ft-giant-wordmark" aria-hidden="true">SEBONG LAGOI</div>
        </div>
    </footer>
    @endif

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Navbar Scroll Effect -->
    <script>
        const navbar = document.getElementById('mainNavbar');
        if (navbar) {
            function updateNavbar() {
                if (window.scrollY > 80) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
            // Jalankan langsung saat halaman dimuat
            updateNavbar();
            window.addEventListener('scroll', updateNavbar);
        }

        // Scroll reveal
        const revealElements = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        revealElements.forEach(el => revealObserver.observe(el));
    </script>

    @yield('scripts')
</body>
</html>
