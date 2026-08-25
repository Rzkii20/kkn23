@extends('layouts.app')

@section('title', $wisata->nama_wisata . ' - Wisata Desa Sebong Lagoi, Bintan')
@section('meta_description', Str::limit(strip_tags($wisata->deskripsi), 160))
@section('og_image', $wisata->foto_wisata ? asset('storage/' . $wisata->foto_wisata) : asset('images/logo-bintan.png'))
@section('og_type', 'place')

@section('content')
    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('wisata.index') }}">Destinasi Wisata</a></li>
                    <li class="breadcrumb-item active">{{ $wisata->nama_wisata }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h1 class="fw-bold text-dark mb-3">{{ $wisata->nama_wisata }}</h1>
                    <div class="d-flex align-items-center justify-content-center text-muted gap-3">
                        <span><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $wisata->alamat }}</span>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <img src="{{ $wisata->foto_wisata ? asset('storage/' . $wisata->foto_wisata) : 'https://placehold.co/1000x500/png?text=' . urlencode($wisata->nama_wisata) }}" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 500px; object-fit: cover;" alt="{{ $wisata->nama_wisata }}">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-custom border-0 shadow-sm mb-5">
                        <div class="card-body p-5">
                            <h4 class="fw-bold mb-4 border-bottom pb-3">Tentang Wisata Ini</h4>
                            <div class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                                {!! nl2br(e($wisata->deskripsi)) !!}
                            </div>
                        </div>
                    </div>

                    @if($wisata->latitude && $wisata->longitude)
                        <div class="card card-custom border-0 shadow-sm">
                            <div class="card-body p-5">
                                <h4 class="fw-bold mb-4 border-bottom pb-3"><i class="bi bi-map me-2"></i> Peta Lokasi</h4>
                                <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                                    <iframe src="https://maps.google.com/maps?q={{ $wisata->latitude }},{{ $wisata->longitude }}&hl=es;z=14&amp;output=embed" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $wisata->latitude }},{{ $wisata->longitude }}" target="_blank" class="btn btn-primary-custom px-4 rounded-pill">
                                        <i class="bi bi-geo-alt-fill me-2"></i> Buka di Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- OTHER DESTINATIONS -->
    @if($related->isNotEmpty())
        <section class="py-5 bg-light">
            <div class="container">
                <h3 class="fw-bold mb-4 text-center">Destinasi Menarik Lainnya</h3>
                <div class="row justify-content-center g-4">
                    @foreach($related as $rel)
                        <div class="col-lg-4 col-md-6">
                            <div class="card card-custom h-100 border-0 shadow-sm overflow-hidden">
                                <img src="{{ $rel->foto_wisata ? asset('storage/' . $rel->foto_wisata) : 'https://placehold.co/600x400/png?text=' . urlencode($rel->nama_wisata) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $rel->nama_wisata }}">
                                <div class="card-body p-4 text-center">
                                    <h5 class="fw-bold mb-2">{{ $rel->nama_wisata }}</h5>
                                    <a href="{{ route('wisata.show', $rel->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 mt-2">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
