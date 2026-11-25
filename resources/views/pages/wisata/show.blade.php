@extends('layouts.app')

@section('title', $wisata->nama_wisata . ' - Wisata Desa Sebong Lagoi, Bintan')
@section('meta_description', Str::limit(strip_tags($wisata->deskripsi), 160))
@section('og_image', $wisata->foto_wisata ? asset('storage/' . $wisata->foto_wisata) : asset('images/logo-bintan.png'))
@section('og_type', 'place')
@section('minimal_footer', true)

@section('styles')
<style>
    .ws-hero {
        background: var(--white);
        padding: 40px 0 60px;
        border-bottom: 1px solid var(--border-hairline);
    }

    .ws-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--ink-muted);
        text-decoration: none;
        margin-bottom: 24px;
        transition: color 0.2s ease;
    }

    .ws-back:hover {
        color: var(--navy);
    }

    .ws-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--hot-pink);
        margin-bottom: 12px;
    }

    .ws-kicker .ws-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--hot-pink);
    }

    .ws-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: clamp(2rem, 3.8vw, 3rem);
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.03em;
        color: var(--navy);
        margin: 0 0 16px;
        text-transform: capitalize;
    }

    .ws-lead {
        font-size: 0.98rem;
        color: var(--ink-muted);
        line-height: 1.72;
        max-width: 560px;
        margin: 0 0 22px;
    }

    .ws-meta-strip {
        padding: 16px 0;
        margin-bottom: 24px;
        border-top: 1px solid var(--border-hairline);
        border-bottom: 1px solid var(--border-hairline);
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .ws-meta-row {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: 0.86rem;
        color: var(--ink-muted);
        line-height: 1.5;
    }

    .ws-meta-row i {
        color: var(--hot-pink);
        margin-top: 3px;
        flex-shrink: 0;
    }

    .ws-meta-row strong {
        color: var(--navy);
        font-weight: 700;
    }

    .ws-photo-frame {
        position: relative;
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        border-radius: 20px;
        padding: 10px;
        cursor: pointer;
    }

    .ws-photo-frame img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        border-radius: 14px;
        display: block;
        transition: transform 0.45s ease;
    }

    .ws-photo-frame:hover img {
        transform: scale(1.02);
    }

    .ws-zoom-pill {
        position: absolute;
        right: 22px;
        bottom: 22px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(15, 27, 61, 0.85);
        color: var(--white);
        font-size: 0.74rem;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 300px;
        backdrop-filter: blur(8px);
    }

    .ws-reading-card {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 18px;
        padding: clamp(24px, 3.5vw, 34px);
    }

    .ws-reading-body {
        font-size: 0.96rem;
        color: var(--ink-muted);
        line-height: 1.85;
    }

    .ws-tips-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-top: 18px;
    }

    .ws-tip-box {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 14px;
        padding: 16px;
    }

    .ws-tip-label {
        display: block;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--ink-muted);
        margin-bottom: 4px;
    }

    .ws-tip-val {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--navy);
    }

    .ws-side-card {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 18px;
        padding: 24px;
    }

    .ws-map-embed {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-hairline);
        aspect-ratio: 16 / 10;
        margin: 18px 0 16px;
    }

    .ws-map-embed iframe {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    .w-card-title {
        text-transform: capitalize;
    }

    @media (max-width: 767px) {
        .ws-tips-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    @php
        $fotoWisata = $wisata->foto_wisata ? asset('storage/' . $wisata->foto_wisata) : asset('images/tentang-desa.jpg');
    @endphp

    <!-- ====================================================
         1 / CLEAN 2-COLUMN EDITORIAL HERO
         ==================================================== -->
    <section class="ws-hero">
        <div class="container ed-container">
            <a href="{{ route('wisata.index') }}" class="ws-back">
                <i class="bi bi-arrow-left"></i> Semua Destinasi Wisata
            </a>

            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="ws-kicker">
                        <span class="ws-dot"></span>
                        Destinasi Wisata · Desa Sebong Lagoi
                    </div>

                    <h1 class="ws-title">{{ $wisata->nama_wisata }}</h1>
                    <p class="ws-lead">
                        {{ Str::limit(strip_tags($wisata->deskripsi), 160) ?: 'Destinasi wisata unggulan di kawasan Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan.' }}
                    </p>

                    <div class="ws-meta-strip">
                        <div class="ws-meta-row">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span><strong>Alamat:</strong> {{ $wisata->alamat ?: 'Desa Sebong Lagoi, Kec. Teluk Sebong, Kab. Bintan' }}</span>
                        </div>
                        @if($wisata->latitude && $wisata->longitude)
                            <div class="ws-meta-row">
                                <i class="bi bi-compass"></i>
                                <span><strong>Koordinat:</strong> {{ $wisata->latitude }}, {{ $wisata->longitude }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        @if($wisata->latitude && $wisata->longitude)
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $wisata->latitude }},{{ $wisata->longitude }}"
                               target="_blank"
                               class="ed-btn-primary">
                                <i class="bi bi-geo-alt-fill"></i> Buka di Google Maps <i class="bi bi-arrow-up-right"></i>
                            </a>
                        @endif
                        <button type="button" id="btnShareWisata" class="ed-btn-secondary">
                            <i class="bi bi-share"></i> Bagikan
                        </button>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ws-photo-frame" data-bs-toggle="modal" data-bs-target="#wisataPhotoModal" role="button" tabindex="0">
                        <img src="{{ $fotoWisata }}" alt="{{ $wisata->nama_wisata }}">
                        <span class="ws-zoom-pill"><i class="bi bi-arrows-fullscreen"></i> Perbesar Foto</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         2 / PENJELASAN LENGKAP & PETA LOKASI
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / Informasi Destinasi</span>
            </div>

            <div class="row g-4 align-items-start">
                <div class="col-lg-7">
                    <div class="ws-reading-card">
                        <span class="ed-kicker">Tentang Destinasi</span>
                        <h2 class="ed-heading mb-4" style="font-size: clamp(1.5rem, 2.5vw, 2rem); text-transform: capitalize;">
                            Mengenal <span class="serif-italic">{{ $wisata->nama_wisata }}.</span>
                        </h2>
                        <div class="ws-reading-body">
                            {!! nl2br(e($wisata->deskripsi ?: 'Destinasi wisata alam di Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan.')) !!}
                        </div>
                    </div>

                    <div class="ws-tips-grid">
                        <div class="ws-tip-box">
                            <span class="ws-tip-label">Kawasan</span>
                            <span class="ws-tip-val">Teluk Sebong, Bintan</span>
                        </div>
                        <div class="ws-tip-box">
                            <span class="ws-tip-label">Jenis Wisata</span>
                            <span class="ws-tip-val">Alam &amp; Rekreasi</span>
                        </div>
                        <div class="ws-tip-box">
                            <span class="ws-tip-label">Akses Lokasi</span>
                            <span class="ws-tip-val">Roda 2 &amp; Roda 4</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="ws-side-card">
                        <span class="ed-kicker">Peta &amp; Alamat</span>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="padding: 10px 0; border-bottom: 1px solid var(--border-hairline);">
                                <span style="display:block; font-size:0.68rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:var(--ink-muted); margin-bottom:4px;">Alamat Lengkap</span>
                                <span style="font-size:0.88rem; font-weight:700; color:var(--navy); line-height:1.5; display:block;">{{ $wisata->alamat ?: 'Desa Sebong Lagoi, Kec. Teluk Sebong' }}</span>
                            </li>
                            <li style="padding: 10px 0; border-bottom: 1px solid var(--border-hairline);">
                                <span style="display:block; font-size:0.68rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:var(--ink-muted); margin-bottom:4px;">Wilayah Administrasi</span>
                                <span style="font-size:0.88rem; font-weight:700; color:var(--navy);">Desa Sebong Lagoi, Kab. Bintan, Kepri</span>
                            </li>
                            @if($wisata->latitude && $wisata->longitude)
                                <li style="padding: 10px 0 0;">
                                    <span style="display:block; font-size:0.68rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:var(--ink-muted); margin-bottom:4px;">Koordinat</span>
                                    <span style="font-size:0.88rem; font-weight:700; color:var(--navy);">{{ $wisata->latitude }}, {{ $wisata->longitude }}</span>
                                </li>
                            @endif
                        </ul>

                        @if($wisata->latitude && $wisata->longitude)
                            <div class="ws-map-embed">
                                <iframe src="https://maps.google.com/maps?q={{ $wisata->latitude }},{{ $wisata->longitude }}&hl=id&z=14&output=embed"
                                        title="Peta {{ $wisata->nama_wisata }}"
                                        allowfullscreen=""
                                        loading="lazy"></iframe>
                            </div>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $wisata->latitude }},{{ $wisata->longitude }}"
                               target="_blank"
                               class="ed-btn-primary w-100 justify-content-center">
                                <i class="bi bi-geo-alt-fill"></i> Petunjuk Arah Google Maps <i class="bi bi-arrow-up-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         3 / DESTINASI MENARIK LAINNYA
         ==================================================== -->
    @if($related->isNotEmpty())
        <section class="ed-section">
            <div class="container ed-container">
                <div class="ed-section-divider" aria-hidden="true">
                    <span class="ed-divider-accent"></span>
                    <span class="ed-divider-line"></span>
                    <span class="ed-divider-index">02 / Wisata Lainnya</span>
                </div>

                <div class="ed-section-head reveal">
                    <div>
                        <span class="ed-kicker">Jelajahi Sekitar</span>
                        <h2 class="ed-heading" style="font-size: clamp(1.5rem, 2.6vw, 2rem);">
                            Destinasi Menarik <span class="serif-italic">Lainnya.</span>
                        </h2>
                    </div>
                    <a href="{{ route('wisata.index') }}" class="ed-link-arrow">
                        Semua Wisata <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>

                <div class="row g-3 g-md-4">
                    @foreach($related as $rel)
                        <div class="col-6 col-md-6 col-lg-4 reveal">
                            <div class="w-card">
                                <div class="w-card-thumb">
                                    <img src="{{ $rel->foto_wisata ? asset('storage/' . $rel->foto_wisata) : asset('images/tentang-desa.jpg') }}"
                                         alt="{{ $rel->nama_wisata }}">
                                    <span class="w-card-tag">Wisata Alam</span>
                                </div>
                                <div class="w-card-body">
                                    <h3 class="w-card-title">{{ $rel->nama_wisata }}</h3>
                                    <p class="w-card-desc">{{ Str::limit(strip_tags($rel->deskripsi), 100) }}</p>
                                    <div class="w-card-loc">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>{{ Str::limit($rel->alamat, 55) }}</span>
                                    </div>
                                </div>
                                <div class="w-card-foot">
                                    <a href="{{ route('wisata.show', $rel->slug) }}" class="w-card-link">
                                        Lihat Detail Wisata <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Modal Perbesar Foto Wisata -->
    <div class="modal fade" id="wisataPhotoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 bg-transparent">
                <div class="modal-header border-0 d-flex justify-content-end pb-2">
                    <button type="button" class="btn-close btn-close-white fs-4" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1); background-color: rgba(255,255,255,0.88); border-radius: 50%; padding: 10px; opacity: 1;"></button>
                </div>
                <div class="modal-body text-center pt-0">
                    <img src="{{ $fotoWisata }}"
                         alt="{{ $wisata->nama_wisata }}"
                         class="img-fluid rounded-4 shadow-lg"
                         style="max-height: 84vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    const shareWisataBtn = document.getElementById('btnShareWisata');
    if (shareWisataBtn) {
        shareWisataBtn.addEventListener('click', function () {
            const title = @json($wisata->nama_wisata);
            if (navigator.share) {
                navigator.share({ title: title, url: window.location.href });
            } else {
                navigator.clipboard.writeText(window.location.href).then(function () {
                    alert('Tautan wisata berhasil disalin!');
                });
            }
        });
    }
</script>
@endsection
