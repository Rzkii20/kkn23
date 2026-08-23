<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasbor - Sistem Informasi UMKM Desa Sebong Lagoi')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts (Outfit) -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom Style CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>

    <div class="dashboard-container">
        <!-- SIDEBAR -->
        <aside class="sidebar d-none d-md-block">
            <div class="brand-area">
                <i class="bi bi-speedometer2"></i>
                <div>
                    <span class="fw-bold d-block text-white" style="font-size: 1rem;">DESA SEBONG LAGOI</span>
                    <span class="small text-white-50 d-block" style="font-size: 0.7rem; letter-spacing: 1px;">
                        @if(Auth::user()->isAdmin())
                            ADMIN PORTAL
                        @else
                            MITRA PORTAL
                        @endif
                    </span>
                </div>
            </div>
            
            <nav class="nav flex-column">
                @if(Auth::user()->isAdmin())
                    <!-- Admin Sidebar Links -->
                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                    <a class="nav-link {{ Request::is('admin/profil-desa*') ? 'active' : '' }}" href="{{ route('admin.profil-desa') }}">
                        <i class="bi bi-building"></i> Profil Desa
                    </a>
                    <a class="nav-link {{ Request::is('admin/umkm*') ? 'active' : '' }}" href="{{ route('admin.umkm.index') }}">
                        <i class="bi bi-shop-window"></i> Profil UMKM
                    </a>
                    <a class="nav-link {{ Request::is('admin/kategori*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                        <i class="bi bi-tags-fill"></i> Kategori Produk
                    </a>
                    <a class="nav-link {{ Request::is('admin/produk*') ? 'active' : '' }}" href="{{ route('admin.produk.index') }}">
                        <i class="bi bi-box-seam-fill"></i> Monitoring Produk
                    </a>
                    <a class="nav-link {{ Request::is('admin/wisata*') ? 'active' : '' }}" href="{{ route('admin.wisata.index') }}">
                        <i class="bi bi-geo-alt-fill"></i> Objek Wisata
                    </a>
                    <a class="nav-link {{ Request::is('admin/artikel*') ? 'active' : '' }}" href="{{ route('admin.artikel.index') }}">
                        <i class="bi bi-journal-text"></i> Artikel & Berita
                    </a>
                    <a class="nav-link {{ Request::is('admin/event*') ? 'active' : '' }}" href="{{ route('admin.event.index') }}">
                        <i class="bi bi-calendar-event-fill"></i> Event Desa
                    </a>
                    <a class="nav-link {{ Request::is('admin/galeri*') ? 'active' : '' }}" href="{{ route('admin.galeri.index') }}">
                        <i class="bi bi-images"></i> Galeri
                    </a>
                    <a class="nav-link {{ Request::is('admin/dokumen*') ? 'active' : '' }}" href="{{ route('admin.dokumen.index') }}">
                        <i class="bi bi-folder-fill"></i> Dokumen & Administrasi
                    </a>
                    <a class="nav-link {{ Request::is('admin/slider*') ? 'active' : '' }}" href="{{ route('admin.slider.index') }}">
                        <i class="bi bi-card-image"></i> Slider Banner
                    </a>
                    <a class="nav-link {{ Request::is('admin/faq*') ? 'active' : '' }}" href="{{ route('admin.faq.index') }}">
                        <i class="bi bi-question-circle-fill"></i> FAQ
                    </a>
                    <a class="nav-link {{ Request::is('admin/pesan*') ? 'active' : '' }}" href="{{ route('admin.pesan.index') }}">
                        <i class="bi bi-envelope-open-fill"></i> Pesan Masuk
                    </a>
                    <a class="nav-link {{ Request::is('admin/pengaturan*') ? 'active' : '' }}" href="{{ route('admin.pengaturan.edit') }}">
                        <i class="bi bi-gear-fill"></i> Pengaturan Akun
                    </a>
                @else
                    <!-- Pemilik UMKM Sidebar Links -->
                    <a class="nav-link {{ Request::is('mitra/dashboard') ? 'active' : '' }}" href="{{ route('mitra.dashboard') }}">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                    <a class="nav-link {{ Request::is('mitra/profil*') ? 'active' : '' }}" href="{{ route('mitra.profil.edit') }}">
                        <i class="bi bi-shop-window"></i> Profil Usaha
                    </a>
                    <a class="nav-link {{ Request::is('mitra/produk*') ? 'active' : '' }}" href="{{ route('mitra.produk.index') }}">
                        <i class="bi bi-box-seam-fill"></i> Kelola Produk
                    </a>
                    <a class="nav-link {{ Request::is('mitra/pengaturan*') ? 'active' : '' }}" href="{{ route('mitra.pengaturan.edit') }}">
                        <i class="bi bi-shield-lock-fill"></i> Pengaturan Akun
                    </a>
                @endif
                
                <hr class="mx-3 my-2 text-white-50">
                <a class="nav-link" href="/" target="_blank">
                    <i class="bi bi-globe"></i> Lihat Website Utama
                </a>
            </nav>
        </aside>

        <!-- MAIN AREA -->
        <main class="main-content">
            <!-- TOP BAR -->
            <header class="top-bar">
                <button class="btn d-md-none text-dark fs-4 p-0 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
                <h5 class="mb-0 fw-semibold text-muted d-none d-sm-block">@yield('page_title', 'Ringkasan Sistem')</h5>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-md-block">
                        <span class="d-block fw-bold text-dark">{{ Auth::user()->name }}</span>
                        <span class="badge {{ Auth::user()->isAdmin() ? 'bg-danger' : 'bg-primary-custom' }} small" style="font-size: 0.7rem;">
                            {{ Auth::user()->isAdmin() ? 'Administrator' : 'Mitra UMKM' }}
                        </span>
                    </div>
                    
                    <div class="dropdown">
                        <a class="btn bg-white border rounded-circle p-0 d-flex align-items-center justify-content-center overflow-hidden" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 42px; height: 42px;">
                            @if(Auth::user()->foto_profil)
                                <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" alt="Foto" style="width:42px;height:42px;object-fit:cover;">
                            @else
                                <i class="bi bi-person text-dark fs-5"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2">
                            <li class="p-2 d-md-none text-center">
                                <span class="d-block fw-bold text-dark">{{ Auth::user()->name }}</span>
                                <span class="badge bg-danger small" style="font-size: 0.7rem;">Administrator</span>
                                <hr class="my-2">
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('admin.pengaturan.edit') }}">
                                    <i class="bi bi-gear me-2 text-muted"></i> Pengaturan Akun
                                </a>
                            </li>
                            <li><hr class="dropdown-divider m-0"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            
            <!-- MOBILE COLLAPSIBLE SIDEBAR -->
            <div class="collapse d-md-none bg-dark" id="mobileSidebar">
                <nav class="nav flex-column p-3">
                    @if(Auth::user()->isAdmin())
                        <a class="nav-link text-white py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-grid-fill me-2"></i> Dashboard</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.profil-desa') }}"><i class="bi bi-building me-2"></i> Profil Desa</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.pemilik-umkm') }}"><i class="bi bi-people-fill me-2"></i> Akun Pemilik</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.umkm.index') }}"><i class="bi bi-shop-window me-2"></i> Profil UMKM</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.kategori.index') }}"><i class="bi bi-tags-fill me-2"></i> Kategori</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.produk.index') }}"><i class="bi bi-box-seam-fill me-2"></i> Produk</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.wisata.index') }}"><i class="bi bi-geo-alt-fill me-2"></i> Objek Wisata</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.artikel.index') }}"><i class="bi bi-journal-text me-2"></i> Artikel</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.event.index') }}"><i class="bi bi-calendar-event-fill me-2"></i> Event</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.galeri.index') }}"><i class="bi bi-images me-2"></i> Galeri</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.slider.index') }}"><i class="bi bi-card-image me-2"></i> Slider Banner</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.faq.index') }}"><i class="bi bi-question-circle-fill me-2"></i> FAQ</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.pesan.index') }}"><i class="bi bi-envelope-open-fill me-2"></i> Pesan Masuk</a>
                        <a class="nav-link text-white py-2" href="{{ route('admin.pengaturan.edit') }}"><i class="bi bi-gear-fill me-2"></i> Pengaturan Akun</a>
                    @else
                        <a class="nav-link text-white py-2" href="{{ route('mitra.dashboard') }}"><i class="bi bi-grid-fill me-2"></i> Dashboard</a>
                        <a class="nav-link text-white py-2" href="{{ route('mitra.profil.edit') }}"><i class="bi bi-shop-window me-2"></i> Profil Usaha</a>
                        <a class="nav-link text-white py-2" href="{{ route('mitra.produk.index') }}"><i class="bi bi-box-seam-fill me-2"></i> Kelola Produk</a>
                        <a class="nav-link text-white py-2" href="{{ route('mitra.pengaturan.edit') }}"><i class="bi bi-shield-lock-fill me-2"></i> Pengaturan Akun</a>
                    @endif
                    <hr class="text-white-50">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm w-100"><i class="bi bi-box-arrow-right me-2"></i> Keluar</button>
                    </form>
                </nav>
            </div>

            <!-- CONTAINER ISI HALAMAN -->
            <div class="container-fluid p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 10px;">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 10px;">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
