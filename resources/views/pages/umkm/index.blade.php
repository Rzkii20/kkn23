@extends('layouts.app')

@section('title', 'Daftar UMKM - Desa Sebong Lagoi')

@section('minimal_footer', true)

@section('content')

    <!-- ====================================================
         NAVY HERO HEADER + SEARCH
         ==================================================== -->
    <section class="ed-page-hero">
        <div class="container ed-container">
            <div class="ed-breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <span>UMKM</span>
                <span>/</span>
                <span class="is-current">Daftar UMKM</span>
            </div>

            <h1 class="ed-page-title">
                Daftar Mitra <span class="serif-italic">UMKM</span> Desa Sebong Lagoi.
            </h1>
            <p class="ed-page-lead">
                Dukung perekonomian warga Desa Sebong Lagoi dengan mengenal pelaku usaha lokal dan berbelanja produk unggulan langsung dari pembuatnya.
            </p>

            <form action="{{ route('umkm.index') }}" method="GET" class="ed-hero-search">
                <i class="bi bi-search"></i>
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Cari nama usaha atau produk unggulan..."
                       aria-label="Cari UMKM">
                <button type="submit">Cari</button>
            </form>

            @if($search)
                <div class="ed-search-status">
                    <span>Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong></span>
                    <a href="{{ route('umkm.index') }}"><i class="bi bi-x-circle me-1"></i>Bersihkan</a>
                </div>
            @endif
        </div>
    </section>

    <!-- ====================================================
         01 / DIREKTORI MITRA UMKM
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / Mitra Terdaftar</span>
            </div>

            <div class="ed-section-head reveal">
                <div>
                    <span class="ed-kicker">Direktori Usaha</span>
                    <h2 class="ed-heading">
                        Pelaku <span class="serif-italic">UMKM Aktif</span> ({{ $umkms->total() }}).
                    </h2>
                </div>
                <a href="/produk" class="ed-link-arrow">
                    Katalog Produk <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            @if($umkms->isNotEmpty())
                <div class="row g-3 g-md-4">
                    @foreach($umkms as $umkm)
                        <div class="col-6 col-sm-6 col-lg-3 reveal">
                            <div class="ed-umkm-card">
                                <div class="ed-umkm-thumb">
                                    <img src="{{ $umkm->foto_toko ? asset('storage/' . $umkm->foto_toko) : asset('images/tentang-desa.jpg') }}"
                                         alt="{{ $umkm->nama_usaha }}">
                                    @if($umkm->status_aktif)
                                        <span class="ed-umkm-status">Mitra Aktif</span>
                                    @endif
                                </div>

                                <div class="ed-umkm-body">
                                    <h3 class="ed-umkm-name">{{ $umkm->nama_usaha }}</h3>
                                    <div class="ed-umkm-loc">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>{{ Str::limit($umkm->alamat, 55) }}</span>
                                    </div>
                                    <p class="ed-umkm-desc">{{ Str::limit($umkm->deskripsi, 95) }}</p>
                                </div>

                                <div class="ed-umkm-foot">
                                    <span class="ed-umkm-count">
                                        <i class="bi bi-box-seam"></i> {{ $umkm->produk->count() }} Produk
                                    </span>
                                    <a href="{{ route('umkm.show', $umkm->slug) }}" class="ed-umkm-btn">
                                        Kunjungi Toko <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($umkms->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $umkms->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @else
                <div class="ed-empty-card reveal">
                    <div class="ed-empty-icon">
                        <i class="bi bi-shop-window"></i>
                    </div>
                    <h3 class="ed-empty-title">Mitra UMKM Tidak Ditemukan</h3>
                    <p class="ed-empty-desc">
                        Coba bersihkan kata kunci pencarian atau tampilkan seluruh daftar mitra UMKM Desa Sebong Lagoi.
                    </p>
                    <a href="{{ route('umkm.index') }}" class="ed-btn-primary">
                        Muat Ulang Halaman
                    </a>
                </div>
            @endif
        </div>
    </section>

@endsection
