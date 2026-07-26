@extends('layouts.app')

@section('title', $produk->nama_produk . ' - Katalog Produk UMKM Desa Sebong Lagoi')
@section('meta_description', Str::limit($produk->deskripsi, 160))

@section('content')

    {{-- ===== BREADCRUMB ===== --}}
    <div class="bg-white py-3 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Katalog Produk</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('produk.index', ['kategori' => $produk->kategori->slug]) }}">{{ $produk->kategori->nama_kategori }}</a></li>
                    <li class="breadcrumb-item active">{{ $produk->nama_produk }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- ===== DETAIL PRODUK ===== --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-5">

                {{-- Foto Produk --}}
                <div class="col-lg-5">
                    <div class="produk-detail-img-wrap rounded-4 overflow-hidden shadow-sm">
                        <img src="{{ $produk->foto_produk ? asset('storage/' . $produk->foto_produk) : 'https://placehold.co/600x500/png?text=' . urlencode($produk->nama_produk) }}"
                            class="produk-detail-img w-100"
                            alt="{{ $produk->nama_produk }}">
                    </div>
                    {{-- Stats --}}
                    <div class="d-flex gap-3 mt-3 text-muted small">
                        <span><i class="bi bi-eye me-1"></i>{{ $produk->views }} kali dilihat</span>
                        <span><i class="bi bi-whatsapp me-1 text-success"></i>{{ $produk->clicks_whatsapp }} hubungi penjual</span>
                    </div>
                </div>

                {{-- Info Produk --}}
                <div class="col-lg-7">

                    {{-- Badge status --}}
                    <div class="d-flex gap-2 mb-3 flex-wrap">
                        <span class="badge bg-secondary-custom px-3 py-2" style="border-radius: 20px;">
                            {{ $produk->kategori->nama_kategori }}
                        </span>
                        @if($produk->stok > 0)
                            <span class="badge bg-success px-3 py-2" style="border-radius: 20px;">
                                <i class="bi bi-check-circle me-1"></i>Tersedia (Stok: {{ $produk->stok }})
                            </span>
                        @else
                            <span class="badge bg-danger px-3 py-2" style="border-radius: 20px;">
                                <i class="bi bi-x-circle me-1"></i>Stok Habis
                            </span>
                        @endif
                    </div>

                    <h1 class="fw-bold mb-2 text-dark" style="font-size: 1.7rem; line-height:1.3;">{{ $produk->nama_produk }}</h1>
                    <h2 class="fw-bold text-primary-custom mb-4" style="font-size: 1.5rem;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h2>

                    <p class="text-muted mb-4" style="line-height: 1.8;">{{ $produk->deskripsi }}</p>

                    {{-- Info Toko --}}
                    <div class="mb-4 p-3 bg-light rounded-3">
                        <a href="{{ route('umkm.show', $produk->umkm->slug) }}" class="text-decoration-none d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-primary-custom d-flex align-items-center justify-content-center text-white flex-shrink-0"
                                style="width: 44px; height: 44px; font-size: 1.1rem;">
                                <i class="bi bi-shop"></i>
                            </div>
                            <div>
                                <span class="fw-bold text-dark d-block">{{ $produk->umkm->nama_usaha }}</span>
                                <span class="small text-muted">Lihat Profil Toko &rarr;</span>
                            </div>
                        </a>
                    </div>

                    {{-- ===== CARA PEMESANAN BOX ===== --}}
                    <div class="alert border-0 mb-4 p-4" style="background: #f0fdf4; border-radius: 14px;">
                        <div class="d-flex align-items-start gap-3">
                            <div class="flex-shrink-0 rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 36px; height: 36px; background:#dcfce7;">
                                <i class="bi bi-info-circle-fill" style="color:#16a34a;"></i>
                            </div>
                            <div>
                                <p class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">Cara Mendapatkan Produk Ini</p>
                                <p class="text-muted small mb-0">
                                    Produk ini <strong>tidak dapat dipesan langsung</strong> melalui website.
                                    Klik tombol di bawah untuk menghubungi penjual via <strong class="text-success">WhatsApp</strong>,
                                    lalu diskusikan ketersediaan, pengiriman, dan pembayaran langsung dengan penjual.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- ===== TOMBOL AKSI ===== --}}
                    <div class="d-flex flex-wrap gap-3">
                        @if($produk->stok > 0)
                            <a href="https://wa.me/{{ $produk->umkm->no_whatsapp }}?text=Halo%20{{ urlencode($produk->umkm->nama_usaha) }}%2C%20saya%20tertarik%20dengan%20produk%20%22{{ urlencode($produk->nama_produk) }}%22%20seharga%20Rp%20{{ number_format($produk->harga, 0, ',', '.') }}.%20Apakah%20masih%20tersedia%3F"
                                target="_blank"
                                onclick="fetch('/produk-click/{{ $produk->id }}')"
                                class="btn btn-lg py-3 px-4 text-white fw-bold flex-grow-1"
                                style="background-color: #25D366; border-color: #25D366; border-radius: 12px; max-width: 320px;">
                                <i class="bi bi-whatsapp fs-5 me-2"></i>Hubungi Penjual via WhatsApp
                            </a>
                        @else
                            <button class="btn btn-lg py-3 px-4 btn-secondary fw-bold flex-grow-1"
                                style="border-radius: 12px; max-width: 320px; opacity:0.65; cursor:not-allowed;" disabled>
                                <i class="bi bi-x-circle me-2"></i>Stok Sedang Habis
                            </button>
                        @endif
                        <button onclick="navigator.share
                                ? navigator.share({title:'{{ $produk->nama_produk }}', url: window.location.href})
                                : navigator.clipboard.writeText(window.location.href).then(() => alert('Tautan disalin!'))"
                            class="btn btn-lg btn-outline-secondary py-3 px-4"
                            style="border-radius: 12px;" title="Bagikan produk ini">
                            <i class="bi bi-share fs-5"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ===== PRODUK SERUPA ===== --}}
    @if($related->isNotEmpty())
    <section class="py-5 bg-light">
        <div class="container">
            <h4 class="fw-bold mb-4" style="color: var(--sea-blue-dark);">
                <i class="bi bi-grid me-2"></i>Produk Serupa Lainnya
            </h4>
            <div class="row g-4">
                @foreach($related as $rel)
                    <div class="col-lg-3 col-md-6">
                        <div class="card produk-rel-card h-100 border-0 shadow-sm overflow-hidden">
                            <div class="produk-rel-img-wrap overflow-hidden" style="height:180px;">
                                <img src="{{ $rel->foto_produk ? asset('storage/' . $rel->foto_produk) : 'https://placehold.co/400x300/png?text=' . urlencode($rel->nama_produk) }}"
                                    class="produk-rel-img w-100 h-100"
                                    style="object-fit:cover; transition: transform 0.4s ease;"
                                    alt="{{ $rel->nama_produk }}">
                            </div>
                            <div class="card-body p-3">
                                <p class="small text-muted mb-1"><i class="bi bi-shop me-1 text-warning"></i>{{ $rel->umkm->nama_usaha }}</p>
                                <h6 class="fw-bold mb-1 text-dark">{{ $rel->nama_produk }}</h6>
                                <p class="text-primary-custom fw-bold small mb-0">Rp {{ number_format($rel->harga, 0, ',', '.') }}</p>
                            </div>
                            <div class="card-footer bg-white border-0 p-3 pt-0">
                                <a href="{{ route('produk.show', $rel->slug) }}"
                                    class="btn btn-outline-primary btn-sm w-100"
                                    style="border-radius: 8px;">
                                    <i class="bi bi-eye me-1"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== STYLES ===== --}}
    @section('styles')
    <style>
        .produk-detail-img-wrap { max-height: 460px; }
        .produk-detail-img { object-fit: cover; height: 100%; max-height: 460px; }

        .produk-rel-card {
            border-radius: 14px !important;
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .produk-rel-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(0,0,0,0.1) !important;
        }
        .produk-rel-card:hover .produk-rel-img {
            transform: scale(1.06);
        }
    </style>
    @endsection

@endsection
