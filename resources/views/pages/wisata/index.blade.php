@extends('layouts.app')

@section('title', 'Destinasi Wisata - Desa Sebong Lagoi')
@section('minimal_footer', true)

@section('styles')
<style>
    .w-fact-strip {
        grid-template-columns: repeat(3, 1fr);
        max-width: 780px;
    }

    @media (max-width: 767px) {
        .w-fact-strip {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

    <!-- ====================================================
         NAVY HERO + FAKTA SINGKAT WISATA
         ==================================================== -->
    <section class="ed-page-hero">
        <div class="container ed-container">
            <div class="ed-breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <span class="is-current">Destinasi Wisata</span>
            </div>

            <h1 class="ed-page-title">
                Pesona Alam &amp; Wisata <span class="serif-italic">Sebong Lagoi.</span>
            </h1>
            <p class="ed-page-lead">
                Jelajahi keindahan pantai pesisir, jalur ekowisata hutan mangrove, dan destinasi alam terbuka yang dikelola bersama masyarakat Desa Sebong Lagoi, Kabupaten Bintan.
            </p>

            <div class="ed-fact-strip w-fact-strip">
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Total Destinasi</span>
                    <div class="ed-fact-value">{{ $wisatas->total() }} Lokasi Wisata</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Kawasan</span>
                    <div class="ed-fact-value">Teluk Sebong, Bintan</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Daya Tarik</span>
                    <div class="ed-fact-value">Wisata Alam &amp; Pesisir</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         01 / DAFTAR DESTINASI WISATA
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / Objek Wisata</span>
            </div>

            <div class="ed-section-head reveal">
                <div>
                    <span class="ed-kicker">Direktori Wisata</span>
                    <h2 class="ed-heading">
                        Pilihan Destinasi <span class="serif-italic">Wisata Desa.</span>
                    </h2>
                </div>
                <a href="{{ route('umkm.index') }}" class="ed-link-arrow">
                    Jelajahi UMKM Sekitar <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            @if($wisatas->isNotEmpty())
                <div class="row g-4">
                    @foreach($wisatas as $index => $wisata)
                        <div class="col-12 col-md-6 col-lg-4 reveal">
                            <div class="w-card">
                                <div class="w-card-thumb">
                                    <img src="{{ $wisata->foto_wisata ? asset('storage/' . $wisata->foto_wisata) : asset('images/tentang-desa.jpg') }}"
                                         alt="{{ $wisata->nama_wisata }}">
                                    <span class="w-card-tag">{{ str_pad(($wisatas->firstItem() ?? 1) + $index, 2, '0', STR_PAD_LEFT) }} · Wisata Alam</span>
                                </div>

                                <div class="w-card-body">
                                    <h3 class="w-card-title">{{ $wisata->nama_wisata }}</h3>
                                    <p class="w-card-desc">{{ Str::limit(strip_tags($wisata->deskripsi), 120) }}</p>
                                    <div class="w-card-loc">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>{{ Str::limit($wisata->alamat, 60) }}</span>
                                    </div>
                                </div>

                                <div class="w-card-foot">
                                    <a href="{{ route('wisata.show', $wisata->slug) }}" class="w-card-link">
                                        Lihat Detail Wisata <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($wisatas->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $wisatas->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @else
                <div class="ed-empty-card reveal">
                    <div class="ed-empty-icon">
                        <i class="bi bi-map"></i>
                    </div>
                    <h3 class="ed-empty-title">Belum Ada Data Wisata</h3>
                    <p class="ed-empty-desc mb-0">
                        Data destinasi wisata Desa Sebong Lagoi belum ditambahkan ke dalam sistem.
                    </p>
                </div>
            @endif
        </div>
    </section>

@endsection
