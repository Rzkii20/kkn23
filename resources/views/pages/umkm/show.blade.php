@extends('layouts.app')

@section('title', $umkm->nama_usaha . ' - UMKM Desa Sebong Lagoi')

@section('styles')
    <!-- Leaflet Map CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        #map {
            height: 350px;
            border-radius: 12px;
            z-index: 1;
        }
    </style>
@endsection

@section('content')
    <!-- BREADCRUMB -->
    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('umkm.index') }}">Daftar UMKM</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $umkm->nama_usaha }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- PROFILE PANEL -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-5 align-items-center">
                <!-- Shop photo -->
                <div class="col-lg-5">
                    <img src="{{ $umkm->foto_toko ? asset('storage/' . $umkm->foto_toko) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=800&auto=format&fit=crop' }}" class="img-fluid rounded-4 shadow-sm w-100" style="height: 340px; object-fit: cover;" alt="{{ $umkm->nama_usaha }}">
                </div>
                
                <!-- Shop profile info -->
                <div class="col-lg-7">
                    <span class="badge bg-primary-custom mb-2">Profil Mitra UMKM</span>
                    <h2 class="fw-bold mb-3" style="color: var(--sea-blue-dark);">{{ $umkm->nama_usaha }}</h2>
                    <p class="text-muted leading-relaxed mb-4">{{ $umkm->deskripsi }}</p>
                    
                    <div class="d-flex flex-column gap-3 mb-4 text-muted small">
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi bi-geo-alt-fill text-danger fs-5 mt-1"></i>
                            <span>{{ $umkm->alamat }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-person-fill text-primary-custom fs-5"></i>
                            <span>Pemilik: <strong>{{ $umkm->user?->name ?? 'Pengelola Desa' }}</strong></span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-whatsapp text-success fs-5"></i>
                            <span>WhatsApp: <a href="https://wa.me/{{ $umkm->no_whatsapp }}" target="_blank" class="text-decoration-none fw-semibold text-success">+{{ $umkm->no_whatsapp }}</a></span>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-column flex-lg-row gap-2">
                        <a href="https://wa.me/{{ $umkm->no_whatsapp }}?text=Halo%20{{ urlencode($umkm->nama_usaha) }}%2C%20saya%20ingin%20bertanya%20mengenai%20produk%20Anda." target="_blank" class="btn btn-success w-100 w-lg-auto px-4 py-2" style="background-color: #25D366; border-color: #25D366; border-radius: 8px;">
                            <i class="bi bi-chat-left-text me-2"></i> Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INTERACTIVE MAP & PRODUCTS SECTION -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-5">
                <!-- Products list (Left/Main) -->
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-4" style="color: var(--sea-blue-dark);"><i class="bi bi-box-seam-fill text-primary-custom me-2"></i> Katalog Produk Usaha</h3>
                    
                    <div class="d-flex flex-nowrap overflow-x-auto pb-4 gap-4 hide-scrollbar" style="scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch; scroll-behavior: smooth;">
                        @if($produks->isNotEmpty())
                            @foreach($produks as $produk)
                                <div class="col-10 col-md-6 col-lg-5 flex-shrink-0" style="scroll-snap-align: start;">
                                    <div class="card card-custom h-100 border-0 shadow-sm">
                                        <div class="position-relative">
                                            <img src="{{ $produk->foto_produk ? asset('storage/' . $produk->foto_produk) : 'https://placehold.co/400x300/png?text=' . urlencode($produk->nama_produk) }}" class="card-img-top" alt="{{ $produk->nama_produk }}">
                                            <span class="badge bg-secondary-custom position-absolute top-0 end-0 m-3 px-3 py-2" style="border-radius: 20px;">
                                                {{ $produk->kategori->nama_kategori }}
                                            </span>
                                        </div>
                                        <div class="card-body p-4 d-flex flex-column">
                                            <h5 class="fw-bold mb-2 text-dark">{{ $produk->nama_produk }}</h5>
                                            <h6 class="fw-bold text-primary-custom mb-3">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h6>
                                            <p class="card-text text-muted small flex-grow-1">{{ Str::limit($produk->deskripsi, 85) }}</p>
                                        </div>
                                        <div class="card-footer bg-white border-0 p-4 pt-0">
                                            <a href="/produk/{{ $produk->slug }}" class="btn btn-outline-secondary w-100 btn-sm" style="border-radius: 8px;"><i class="bi bi-info-circle me-1"></i>Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12 w-100 text-center py-5 bg-white rounded-3 shadow-sm">
                                <div class="fs-1 text-muted"><i class="bi bi-box"></i></div>
                                <h5 class="fw-bold text-muted mt-3">Belum Ada Produk Terdaftar</h5>
                                <p class="text-muted small">Mitra ini belum menambahkan katalog produk dagangannya.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Location Map (Right/Sidebar) -->
                <div class="col-lg-4">
                    <h3 class="fw-bold mb-4" style="color: var(--sea-blue-dark);"><i class="bi bi-geo-alt-fill text-danger me-2"></i> Peta Lokasi</h3>
                    <div class="card card-custom border-0 shadow-sm p-3 bg-white">
                        @if($umkm->latitude && $umkm->longitude)
                            <div id="map"></div>
                            <div class="mt-3 text-muted small text-center">
                                <i class="bi bi-info-circle me-1"></i> Koordinat lokasi telah diverifikasi.
                            </div>
                        @else
                            <div class="py-5 text-center text-muted">
                                <i class="bi bi-map fs-1"></i>
                                <h6 class="fw-bold mt-3">Lokasi Belum Dipetakan</h6>
                                <p class="small mb-0">Pemilik toko belum mengatur koordinat peta lokasi usaha.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('scripts')
    @if($umkm->latitude && $umkm->longitude)
        <!-- Leaflet Map JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var lat = {{ $umkm->latitude }};
                var lng = {{ $umkm->longitude }};
                
                // Initialize map container
                var map = L.map('map').setView([lat, lng], 15);
                
                // Set tile layers
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);
                
                // Create pin marker
                var marker = L.marker([lat, lng]).addTo(map);
                marker.bindPopup("<b>{{ $umkm->nama_usaha }}</b><br>{{ $umkm->alamat }}").openPopup();
            });
        </script>
    @endif
@endsection
