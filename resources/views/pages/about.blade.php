@extends('layouts.app')

@section('title', 'Tentang Desa - Pemerintah Desa Sebong Lagoi')

@section('content')
    <!-- HEADER COVER -->
    <div class="py-4 py-md-5 text-white" style="background: linear-gradient(135deg, var(--sea-blue) 0%, var(--mangrove-green) 100%);">
        <div class="container text-center py-2 py-md-3">
            <h1 class="fs-2 fs-md-1 fw-bold mb-2">Tentang Desa Sebong Lagoi</h1>
            <p class="lead text-white-50 fs-6 fs-md-5 mb-0">Sejarah Singkat, Visi, Misi, dan Struktur Organisasi Desa</p>
        </div>
    </div>

    <!-- MAIN ABOUT CONTENT -->
    <section class="py-4 py-md-5 bg-white">
        <div class="container">
            <div class="row g-4 g-lg-5">
                <!-- Sejarah & Profil -->
                <div class="col-lg-7">
                    <h3 class="fw-bold text-primary-custom mb-3 border-bottom pb-2">Sejarah Desa</h3>
                    <p class="text-muted leading-relaxed">Desa Sebong Lagoi merupakan salah satu desa yang terletak di Kecamatan Teluk Sebong, Kabupaten Bintan, Provinsi Kepulauan Riau. Wilayah ini pada awalnya dikenal sebagai kawasan pesisir yang didominasi oleh hutan bakau (mangrove) dan menjadi persinggahan para nelayan tradisional karena letaknya yang terlindung dan strategis.</p>
                    <p class="text-muted leading-relaxed">Seiring dengan perkembangan waktu dan didukung oleh ekspansi industri pariwisata bertaraf internasional di kawasan pariwisata terpadu Lagoi, Desa Sebong Lagoi mengalami transformasi yang pesat. Penduduk lokal yang semula mayoritas bermata pencaharian sebagai nelayan dan berkebun mulai mengembangkan sektor penunjang jasa pariwisata dan industri kreatif rumah tangga (UMKM) untuk menyambut wisatawan lokal dan asing.</p>
                    <p class="text-muted leading-relaxed">Kini, Desa Sebong Lagoi tidak hanya menjadi penyokong tenaga kerja pariwisata Bintan, tetapi juga berkembang secara mandiri sebagai destinasi ekowisata mangrove yang tersohor serta produsen olahan kuliner seafood dan produk kerajinan tangan pesisir yang khas.</p>
                </div>
                
                <!-- Visi & Misi Sidecard -->
                <div class="col-lg-5">
                    <div class="card card-custom bg-light p-3 p-md-4 border-0 shadow-sm">
                        <div class="text-center mb-4">
                            <i class="bi bi-award-fill text-warning fs-1"></i>
                            <h4 class="fw-bold mt-2 text-dark fs-5 fs-md-4">Visi & Misi Desa</h4>
                            <p class="small text-muted mb-0">Periode Kepemimpinan 2021 - 2027</p>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="fw-bold text-primary-custom"><i class="bi bi-eye-fill me-2"></i> Visi</h5>
                            <p class="text-muted small">"Terwujudnya Desa Sebong Lagoi yang Mandiri, Sejahtera, Berbudaya, dan Unggul di Sektor Pariwisata Serta Ekonomi Kreatif Berbasis Pemberdayaan Masyarakat."</p>
                        </div>

                        <div>
                            <h5 class="fw-bold text-secondary-custom"><i class="bi bi-card-checklist me-2"></i> Misi</h5>
                            <ol class="text-muted small ps-3">
                                <li class="mb-2">Meningkatkan tata kelola pemerintahan desa yang bersih, transparan, akuntabel, dan melayani masyarakat dengan prima.</li>
                                <li class="mb-2">Mengembangkan infrastruktur desa yang merata guna memperlancar perputaran ekonomi dan pariwisata.</li>
                                <li class="mb-2">Mendorong pemberdayaan ekonomi lokal melalui pelatihan intensif dan promosi digital produk pelaku UMKM.</li>
                                <li class="mb-2">Melestarikan nilai budaya lokal serta memelihara kelestarian ekosistem lingkungan pesisir dan hutan mangrove.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GEOGRAFIS & STATISTIK SECTION -->
    <section class="py-4 py-md-5 bg-light">
        <div class="container">
            <div class="text-center mb-4 mb-md-5">
                <h3 class="fw-bold text-dark mb-2 fs-3 fs-md-2">Profil Geografis & Demografi</h3>
                <p class="text-muted small">Gambaran umum kondisi wilayah dan jumlah penduduk Desa Sebong Lagoi</p>
            </div>

            <div class="row g-3 g-md-4">
                <div class="col-md-4">
                    <div class="card card-custom p-3 p-md-4 border-0 shadow-sm text-center h-100">
                        <div class="fs-1 text-primary-custom mb-3"><i class="bi bi-globe-asia-australia"></i></div>
                        <h5 class="fw-bold">Batas Wilayah</h5>
                        <ul class="list-unstyled text-muted small mt-2">
                            <li class="mb-1"><strong>Utara:</strong> Laut Natuna</li>
                            <li class="mb-1"><strong>Selatan:</strong> Desa Sebong Pereh</li>
                            <li class="mb-1"><strong>Timur:</strong> Kelurahan Kota Baru</li>
                            <li class="mb-1"><strong>Barat:</strong> Selat Riau</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card card-custom p-4 border-0 shadow-sm text-center h-100">
                        <div class="fs-1 text-success mb-3"><i class="bi bi-people-fill"></i></div>
                        <h5 class="fw-bold">Jumlah Penduduk</h5>
                        <p class="text-muted small mt-2">Berdasarkan data kependudukan mutakhir semester II:</p>
                        <h3 class="fw-bold text-success">3.450 Jiwa</h3>
                        <p class="small text-muted mb-0">Terbagi dalam 940 Kepala Keluarga (KK)</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom p-4 border-0 shadow-sm text-center h-100">
                        <div class="fs-1 text-warning mb-3"><i class="bi bi-geo-alt-fill"></i></div>
                        <h5 class="fw-bold">Luas Wilayah</h5>
                        <p class="text-muted small mt-2">Total luas daratan beserta kawasan konservasi mangrove:</p>
                        <h3 class="fw-bold text-warning">12,45 Km²</h3>
                        <p class="small text-muted mb-0">Dengan pantai terpanjang di Teluk Sebong</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
