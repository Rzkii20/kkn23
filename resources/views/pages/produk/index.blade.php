@extends('layouts.app')

@section('title', 'Katalog Produk UMKM - Desa Sebong Lagoi')
@section('meta_description', 'Temukan berbagai produk lokal asli UMKM Desa Sebong Lagoi. Kerajinan tangan, kuliner, dan produk unggulan masyarakat Kepulauan Riau.')
@section('minimal_footer', true)

@section('styles')
<style>
    .produk-filter-bar {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 32px;
    }

    .produk-cat-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .produk-cat-pill {
        display: inline-flex;
        align-items: center;
        padding: 7px 16px;
        border-radius: 300px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid var(--border-hairline);
        background: var(--white);
        color: var(--navy);
        transition: all 0.2s ease;
    }

    .produk-cat-pill:hover {
        border-color: var(--navy);
        color: var(--navy);
    }

    .produk-cat-pill.is-active {
        background: var(--navy);
        border-color: var(--navy);
        color: var(--white);
    }

    .produk-card-desc {
        font-size: 0.82rem;
        color: var(--ink-muted);
        line-height: 1.55;
        margin: 0 0 12px;
    }

    .produk-card-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 0.74rem;
        color: var(--ink-muted);
        margin-bottom: 12px;
    }

    .produk-info-note {
        margin-top: 36px;
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-left: 4px solid var(--navy);
        border-radius: 12px;
        padding: 16px 22px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        font-size: 0.84rem;
        color: var(--ink-muted);
    }

    .produk-info-note strong {
        color: var(--navy);
    }
</style>
@endsection

@section('content')

    <!-- ====================================================
         NAVY HERO + PENCARIAN
         ==================================================== -->
    <section class="ed-page-hero">
        <div class="container ed-container">
            <div class="ed-breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <a href="{{ route('umkm.index') }}">UMKM</a>
                <span>/</span>
                <span class="is-current">Katalog Produk</span>
            </div>

            <h1 class="ed-page-title">
                Katalog Produk <span class="serif-italic">UMKM Desa.</span>
            </h1>
            <p class="ed-page-lead">
                Etalase produk asli buatan masyarakat Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan — lengkap dengan informasi harga, ukuran kemasan, deskripsi produk, dan profil pelaku usaha.
            </p>

            <form action="{{ route('produk.index') }}" method="GET" class="ed-hero-search">
                <input type="hidden" name="kategori" value="{{ $kategoriSlug }}">
                <i class="bi bi-search"></i>
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Cari nama produk, kuliner, atau kerajinan..."
                       aria-label="Cari produk">
                <button type="submit">Cari</button>
            </form>

            @if($search || $kategoriSlug)
                <div class="ed-search-status">
                    <span>
                        Filter aktif:
                        @if($kategoriSlug)
                            <strong>{{ optional($kategoris->firstWhere('slug', $kategoriSlug))->nama_kategori ?? $kategoriSlug }}</strong>
                        @endif
                        @if($search)
                            <span>"{{ $search }}"</span>
                        @endif
                    </span>
                    <a href="{{ route('produk.index') }}"><i class="bi bi-x-circle me-1"></i>Tampilkan Semua</a>
                </div>
            @endif
        </div>
    </section>

    <!-- ====================================================
         01 / DAFTAR PRODUK UMKM
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / Etalase Produk</span>
            </div>

            <div class="produk-filter-bar reveal">
                <div>
                    <span class="ed-kicker mb-1">Produk Lokal</span>
                    <h2 class="ed-heading" style="font-size: clamp(1.5rem, 2.6vw, 2.1rem);">
                        Menampilkan <span class="serif-italic">{{ $produks->total() }} Produk</span> Mitra.
                    </h2>
                </div>

                <div class="produk-cat-pills">
                    <a href="{{ route('produk.index', ['search' => $search]) }}"
                       class="produk-cat-pill {{ !$kategoriSlug ? 'is-active' : '' }}">
                        Semua
                    </a>
                    @foreach($kategoris as $kat)
                        <a href="{{ route('produk.index', ['kategori' => $kat->slug, 'search' => $search]) }}"
                           class="produk-cat-pill {{ $kategoriSlug == $kat->slug ? 'is-active' : '' }}">
                            {{ $kat->nama_kategori }}
                        </a>
                    @endforeach
                </div>
            </div>

            @if($produks->isNotEmpty())
                <div class="row g-4">
                    @foreach($produks as $produk)
                        <div class="col-12 col-sm-6 col-lg-3 reveal">
                            <div class="ed-product-card">
                                <div class="ed-product-img">
                                    <img src="{{ $produk->foto_produk ? asset('storage/' . $produk->foto_produk) : asset('images/tentang-desa.jpg') }}"
                                         alt="{{ $produk->nama_produk }}">
                                    <span class="ed-product-cat">{{ optional($produk->kategori)->nama_kategori ?? 'Umum' }}</span>
                                </div>

                                <div class="ed-product-body">
                                    <div class="ed-product-seller">{{ optional($produk->umkm)->nama_usaha ?? 'UMKM Sebong Lagoi' }}</div>
                                    <h3 class="ed-product-title">{{ $produk->nama_produk }}</h3>
                                    <p class="produk-card-desc">{{ Str::limit(strip_tags($produk->deskripsi), 78) }}</p>

                                    <div class="produk-card-meta">
                                        <span><i class="bi bi-eye me-1"></i>{{ $produk->views }} dilihat</span>
                                        @if($produk->ukuran_kemasan)
                                            <span><i class="bi bi-box-seam me-1"></i>{{ $produk->ukuran_kemasan }}</span>
                                        @endif
                                    </div>

                                    <div class="ed-product-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                </div>

                                <div class="ed-product-foot">
                                    <a href="{{ route('produk.show', $produk->slug) }}" class="ed-product-link">
                                        Lihat Detail <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($produks->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $produks->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @else
                <div class="ed-empty-card reveal">
                    <div class="ed-empty-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h3 class="ed-empty-title">Produk Tidak Ditemukan</h3>
                    <p class="ed-empty-desc">
                        Coba ubah kata kunci pencarian atau pilih kategori lain untuk melihat produk UMKM Desa Sebong Lagoi.
                    </p>
                    <a href="{{ route('produk.index') }}" class="ed-btn-primary">
                        Tampilkan Semua Produk
                    </a>
                </div>
            @endif

            <div class="produk-info-note reveal">
                <div>
                    <i class="bi bi-info-circle-fill me-2" style="color: var(--hot-pink);"></i>
                    <strong>Informasi Katalog:</strong> Halaman ini menampilkan informasi resmi produk UMKM Desa Sebong Lagoi. Untuk info lokasi dan kunjungan toko, buka detail produk atau profil UMKM terkait.
                </div>
                <a href="{{ route('umkm.index') }}" class="ed-link-arrow">
                    Daftar Mitra UMKM <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>
        </div>
    </section>

@endsection
