<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Promosi & Pemasaran UMKM Desa Sebong Lagoi, Bintan - Temukan produk lokal unggulan dan destinasi wisata terbaik.">
    <title>@yield('title', 'Desa Sebong Lagoi - UMKM & Wisata Terbaik')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom Style CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>

    <!-- ====================================================
         NAVBAR UTAMA
         ==================================================== -->
    <nav class="navbar navbar-expand-lg navbar-custom {{ !Route::is('home') ? 'navbar-solid' : '' }}" id="mainNavbar">
        @php
            $logoAdmin = \App\Models\User::where('role', 'admin')->value('foto_profil');
        @endphp
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                @if($logoAdmin)
                    <img src="{{ asset('storage/' . $logoAdmin) }}"
                         alt="Logo Desa"
                         style="width:44px;height:44px;object-fit:cover;border-radius:10px;flex-shrink:0;">
                @else
                    <div class="navbar-brand-logo">SL</div>
                @endif
                <div class="navbar-brand-text">
                    <span class="brand-name">Desa Sebong Lagoi</span>
                    <span class="brand-sub">Informasi UMKM &amp; Potensi Desa</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="color: white;">
                <i class="bi bi-list fs-3"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('tentang-desa') ? 'active' : '' }}" href="/tentang-desa">Tentang Desa</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarUmkm" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            UMKM
                        </a>
                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="navbarUmkm">
                            <li><a class="dropdown-item" href="/umkm">Daftar UMKM</a></li>
                            <li><a class="dropdown-item" href="/produk">Katalog Produk</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/wisata">Wisata</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarInformasi" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Informasi
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
    <main style="{{ !Route::is('home') ? 'padding-top: 90px;' : '' }}">
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
    <footer class="footer-custom">
        <div class="container">
            <div class="row g-5">
                <!-- Brand & Description -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-logo">
                        <div class="footer-logo-icon">SL</div>
                        <div>
                            <div class="footer-brand-name">Desa Sebong Lagoi</div>
                            <div class="footer-brand-sub">Sistem UMKM & Potensi Desa</div>
                        </div>
                    </div>
                    <p class="footer-description">
                        Platform digital untuk promosi dan pemasaran UMKM serta potensi wisata Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan, Kepulauan Riau.
                    </p>
                    <div class="footer-social">
                        <a href="#" class="social-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-btn" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-btn" title="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="social-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Navigasi -->
                <div class="col-lg-2 col-6">
                    <h5>Navigasi</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i>Beranda</a></li>
                        <li><a href="/tentang-desa"><i class="bi bi-chevron-right"></i>Tentang Desa</a></li>
                        <li><a href="/umkm"><i class="bi bi-chevron-right"></i>Daftar UMKM</a></li>
                        <li><a href="/produk"><i class="bi bi-chevron-right"></i>Katalog Produk</a></li>
                        <li><a href="/wisata"><i class="bi bi-chevron-right"></i>Destinasi Wisata</a></li>
                    </ul>
                </div>

                <!-- Informasi -->
                <div class="col-lg-2 col-6">
                    <h5>Informasi</h5>
                    <ul class="footer-links">
                        <li><a href="/artikel"><i class="bi bi-chevron-right"></i>Berita & Artikel</a></li>
                        <li><a href="/event"><i class="bi bi-chevron-right"></i>Event Desa</a></li>
                        <li><a href="/galeri"><i class="bi bi-chevron-right"></i>Galeri Kegiatan</a></li>
                        <li><a href="/dokumen"><i class="bi bi-chevron-right"></i>Dokumen & Administrasi</a></li>
                        <li><a href="/kontak"><i class="bi bi-chevron-right"></i>Hubungi Kami</a></li>
                        <li><a href="/register"><i class="bi bi-chevron-right"></i>Daftar Mitra</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div class="col-lg-4 col-md-6">
                    <h5>Kontak Kami</h5>
                    <div class="footer-contact-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Kantor Desa Sebong Lagoi, Jl. Pariwisata KM. 46, Sebong Lagoi, Bintan, Kepulauan Riau 29155</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bi bi-envelope-fill"></i>
                        <span>info@sebonglagoi.desa.id</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bi bi-whatsapp"></i>
                        <span>+62 812-3456-7890</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bi bi-clock-fill"></i>
                        <span>Senin – Jumat: 08.00 – 16.00 WIB</span>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="footer-bottom-text mb-0">
                    &copy; {{ date('Y') }} Pemerintah Desa Sebong Lagoi. All Rights Reserved.
                </p>
                <div class="footer-bottom-links">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat & Ketentuan</a>
                    <a href="/kontak">Bantuan</a>
                    <a href="{{ route('login') }}" style="opacity: 0.7;"><i class="bi bi-person-fill-lock"></i> Login Admin</a>
                </div>
            </div>
        </div>
    </footer>

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
