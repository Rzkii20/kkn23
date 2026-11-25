@extends('layouts.app')

@section('title', $produk->nama_produk . ' - Produk UMKM Desa Sebong Lagoi')
@section('meta_description', Str::limit(strip_tags($produk->deskripsi), 160))
@section('og_image', $produk->foto_produk ? asset('storage/' . $produk->foto_produk) : asset('images/logo-bintan.png'))
@section('og_type', 'product')
@section('minimal_footer', true)

@section('styles')
<style>
    .pd-breadcrumb-bar {
        background: var(--bg-alt);
        border-bottom: 1px solid var(--border-hairline);
        padding: 14px 0;
    }

    .pd-breadcrumb {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--ink-muted);
    }

    .pd-breadcrumb a {
        color: var(--navy);
        text-decoration: none;
    }

    .pd-breadcrumb a:hover {
        color: var(--hot-pink);
    }

    .pd-photo-card {
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        border-radius: 20px;
        padding: 12px;
    }

    .pd-photo-card img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        border-radius: 14px;
        display: block;
    }

    .pd-photo-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 8px 4px;
        font-size: 0.78rem;
        color: var(--ink-muted);
    }

    .pd-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 14px;
    }

    .pd-badge-cat {
        background: var(--navy);
        color: var(--white);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        padding: 5px 14px;
        border-radius: 300px;
    }

    .pd-badge-pack {
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        color: var(--navy);
        font-size: 0.72rem;
        font-weight: 600;
        padding: 5px 14px;
        border-radius: 300px;
    }

    .pd-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: clamp(1.75rem, 3vw, 2.4rem);
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.025em;
        color: var(--navy);
        margin: 0 0 10px;
    }

    .pd-price {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: clamp(1.5rem, 2.5vw, 2rem);
        font-weight: 800;
        color: var(--navy);
        font-variant-numeric: tabular-nums;
        margin-bottom: 24px;
    }

    .pd-desc-box {
        border-top: 1px solid var(--border-hairline);
        border-bottom: 1px solid var(--border-hairline);
        padding: 20px 0;
        margin-bottom: 22px;
    }

    .pd-section-label {
        display: block;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--hot-pink);
        margin-bottom: 8px;
    }

    .pd-desc-text {
        font-size: 0.94rem;
        color: var(--ink-muted);
        line-height: 1.75;
        margin: 0;
    }

    .pd-spec-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px 20px;
        margin-bottom: 22px;
    }

    .pd-spec-item {
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        border-radius: 12px;
        padding: 12px 16px;
    }

    .pd-spec-key {
        display: block;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--ink-muted);
        margin-bottom: 3px;
    }

    .pd-spec-val {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--navy);
    }

    .pd-seller-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        border-radius: 14px;
        padding: 16px 20px;
        text-decoration: none;
        margin-bottom: 18px;
        transition: border-color 0.2s ease, transform 0.2s ease;
    }

    .pd-seller-card:hover {
        border-color: var(--navy);
        transform: translateY(-2px);
    }

    .pd-seller-left {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .pd-seller-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--navy);
        color: var(--white);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .pd-seller-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.96rem;
        font-weight: 700;
        color: var(--navy);
        display: block;
    }

    .pd-seller-sub {
        font-size: 0.78rem;
        color: var(--ink-muted);
    }

    .pd-notice {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-left: 4px solid var(--navy);
        border-radius: 12px;
        padding: 16px 18px;
        margin-bottom: 24px;
        font-size: 0.84rem;
        color: var(--ink-muted);
        line-height: 1.6;
    }

    .pd-notice strong {
        color: var(--navy);
    }

    @media (max-width: 575px) {
        .pd-spec-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

    <!-- ====================================================
         BREADCRUMB
         ==================================================== -->
    <div class="pd-breadcrumb-bar">
        <div class="container ed-container">
            <nav class="pd-breadcrumb" aria-label="breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <a href="{{ route('produk.index') }}">Katalog Produk</a>
                @if($produk->kategori)
                    <span>/</span>
                    <a href="{{ route('produk.index', ['kategori' => $produk->kategori->slug]) }}">{{ $produk->kategori->nama_kategori }}</a>
                @endif
                <span>/</span>
                <span>{{ $produk->nama_produk }}</span>
            </nav>
        </div>
    </div>

    <!-- ====================================================
         DETAIL PRODUK
         ==================================================== -->
    <section class="ed-section">
        <div class="container ed-container">
            <div class="row g-5 align-items-start">
                <!-- Foto Produk -->
                <div class="col-lg-6">
                    <div class="pd-photo-card">
                        <img src="{{ $produk->foto_produk ? asset('storage/' . $produk->foto_produk) : asset('images/tentang-desa.jpg') }}"
                             alt="{{ $produk->nama_produk }}">
                        <div class="pd-photo-meta">
                            <span><i class="bi bi-eye me-1"></i>{{ $produk->views }} kali dilihat</span>
                            <span>{{ optional($produk->kategori)->nama_kategori ?? 'Produk UMKM' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Informasi & Penjelasan Produk -->
                <div class="col-lg-6">
                    <div class="pd-badges">
                        <span class="pd-badge-cat">{{ optional($produk->kategori)->nama_kategori ?? 'Umum' }}</span>
                        @if($produk->ukuran_kemasan)
                            <span class="pd-badge-pack"><i class="bi bi-box-seam me-1"></i>{{ $produk->ukuran_kemasan }}</span>
                        @endif
                    </div>

                    <h1 class="pd-title">{{ $produk->nama_produk }}</h1>
                    <div class="pd-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>

                    <div class="pd-desc-box">
                        <span class="pd-section-label">Penjelasan Produk</span>
                        <p class="pd-desc-text">
                            {!! nl2br(e($produk->deskripsi ?: 'Produk unggulan buatan pelaku UMKM Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan.')) !!}
                        </p>
                    </div>

                    <div class="pd-spec-grid">
                        <div class="pd-spec-item">
                            <span class="pd-spec-key">Kategori</span>
                            <span class="pd-spec-val">{{ optional($produk->kategori)->nama_kategori ?? 'Umum' }}</span>
                        </div>
                        <div class="pd-spec-item">
                            <span class="pd-spec-key">Ukuran / Kemasan</span>
                            <span class="pd-spec-val">{{ $produk->ukuran_kemasan ?: 'Kemasan Standar UMKM' }}</span>
                        </div>
                        <div class="pd-spec-item">
                            <span class="pd-spec-key">Pelaku UMKM</span>
                            <span class="pd-spec-val">{{ optional($produk->umkm)->nama_usaha ?? 'UMKM Sebong Lagoi' }}</span>
                        </div>
                        <div class="pd-spec-item">
                            <span class="pd-spec-key">Asal Wilayah</span>
                            <span class="pd-spec-val">Desa Sebong Lagoi, Bintan</span>
                        </div>
                    </div>

                    @if($produk->umkm)
                        <a href="{{ route('umkm.show', $produk->umkm->slug) }}" class="pd-seller-card">
                            <div class="pd-seller-left">
                                <span class="pd-seller-icon"><i class="bi bi-shop"></i></span>
                                <div>
                                    <span class="pd-seller-name">{{ $produk->umkm->nama_usaha }}</span>
                                    <span class="pd-seller-sub">
                                        {{ Str::limit($produk->umkm->alamat ?: 'Desa Sebong Lagoi, Teluk Sebong', 55) }}
                                    </span>
                                </div>
                            </div>
                            <span class="ed-umkm-btn">Profil Toko <i class="bi bi-arrow-up-right"></i></span>
                        </a>
                    @endif

                    <div class="pd-notice">
                        <i class="bi bi-info-circle-fill me-2" style="color: var(--hot-pink);"></i>
                        <strong>Informasi Produk:</strong> Katalog ini hanya untuk <strong>melihat informasi produk</strong>. Tidak tersedia pemesanan online melalui website ini. Untuk informasi lebih lanjut, silakan kunjungi profil atau lokasi toko UMKM secara langsung.
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <button type="button"
                                id="btnShareProduk"
                                class="ed-btn-primary">
                            <i class="bi bi-share"></i> Bagikan Produk
                        </button>
                        @if($produk->umkm)
                            <a href="{{ route('umkm.show', $produk->umkm->slug) }}" class="ed-btn-secondary">
                                <i class="bi bi-shop-window"></i> Kunjungi Toko
                            </a>
                        @endif
                        <a href="{{ route('produk.index') }}" class="ed-btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Katalog
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         PRODUK SERUPA LAINNYA
         ==================================================== -->
    @if($related->isNotEmpty())
        <section class="ed-section-alt">
            <div class="container ed-container">
                <div class="ed-section-divider" aria-hidden="true">
                    <span class="ed-divider-accent"></span>
                    <span class="ed-divider-line"></span>
                    <span class="ed-divider-index">Produk Terkait</span>
                </div>

                <div class="ed-section-head reveal">
                    <div>
                        <span class="ed-kicker">Kategori Serupa</span>
                        <h2 class="ed-heading" style="font-size: clamp(1.5rem, 2.6vw, 2rem);">
                            Produk Serupa <span class="serif-italic">Lainnya.</span>
                        </h2>
                    </div>
                    <a href="{{ route('produk.index') }}" class="ed-link-arrow">
                        Semua Produk <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @foreach($related as $rel)
                        <div class="col-12 col-sm-6 col-lg-3 reveal">
                            <div class="ed-product-card">
                                <div class="ed-product-img">
                                    <img src="{{ $rel->foto_produk ? asset('storage/' . $rel->foto_produk) : asset('images/tentang-desa.jpg') }}"
                                         alt="{{ $rel->nama_produk }}">
                                    <span class="ed-product-cat">{{ optional($rel->kategori)->nama_kategori ?? 'Umum' }}</span>
                                </div>
                                <div class="ed-product-body">
                                    <div class="ed-product-seller">{{ optional($rel->umkm)->nama_usaha ?? 'UMKM Sebong Lagoi' }}</div>
                                    <h3 class="ed-product-title">{{ $rel->nama_produk }}</h3>
                                    <div class="ed-product-price">Rp {{ number_format($rel->harga, 0, ',', '.') }}</div>
                                </div>
                                <div class="ed-product-foot">
                                    <a href="{{ route('produk.show', $rel->slug) }}" class="ed-product-link">
                                        Lihat Detail <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection

@section('scripts')
<script>
    const shareBtn = document.getElementById('btnShareProduk');
    if (shareBtn) {
        shareBtn.addEventListener('click', function () {
            const title = @json($produk->nama_produk);
            if (navigator.share) {
                navigator.share({ title: title, url: window.location.href });
            } else {
                navigator.clipboard.writeText(window.location.href).then(function () {
                    alert('Tautan produk berhasil disalin!');
                });
            }
        });
    }
</script>
@endsection
