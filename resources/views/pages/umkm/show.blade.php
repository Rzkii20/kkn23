@extends('layouts.app')

@section('title', $umkm->nama_usaha . ' - Profil UMKM Desa Sebong Lagoi')
@section('meta_description', Str::limit(strip_tags($umkm->deskripsi ?? 'Profil usaha ' . $umkm->nama_usaha . ' di Desa Sebong Lagoi, Teluk Sebong, Bintan.'), 160))
@section('og_image', $umkm->foto_toko ? asset('storage/' . $umkm->foto_toko) : asset('images/logo-bintan.png'))
@section('og_type', 'business.business')
@section('minimal_footer', true)

@section('styles')
    <!-- Leaflet Map CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        .u-intro {
            background: var(--white);
            padding: 44px 0 64px;
            border-bottom: 1px solid var(--border-hairline);
        }

        .u-back-link {
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

        .u-back-link:hover {
            color: var(--navy);
        }

        .u-kicker {
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

        .u-kicker .u-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--hot-pink);
        }

        .u-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(2.1rem, 4.2vw, 3.25rem);
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -0.03em;
            color: var(--navy);
            margin: 0 0 16px;
        }

        .u-lead {
            font-size: 1rem;
            color: var(--ink-muted);
            line-height: 1.7;
            max-width: 560px;
            margin: 0 0 24px;
        }

        .u-meta-inline {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px 18px;
            padding: 16px 0;
            margin-bottom: 26px;
            border-top: 1px solid var(--border-hairline);
            border-bottom: 1px solid var(--border-hairline);
            font-size: 0.84rem;
            color: var(--ink-muted);
        }

        .u-meta-inline strong {
            color: var(--navy);
            font-weight: 700;
        }

        .u-meta-sep {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--border-hairline);
        }

        .u-hero-frame {
            background: var(--bg-alt);
            border: 1px solid var(--border-hairline);
            border-radius: 20px;
            padding: 10px;
        }

        .u-hero-frame img {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            border-radius: 14px;
            display: block;
        }

        .u-about-prose p {
            font-size: 0.96rem;
            color: var(--ink-muted);
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .u-about-prose p:last-child {
            margin-bottom: 0;
        }

        .u-spec-card {
            background: var(--white);
            border: 1px solid var(--border-hairline);
            border-radius: 18px;
            padding: 26px;
        }

        .u-spec-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .u-spec-list li {
            padding: 13px 0;
            border-bottom: 1px solid var(--border-hairline);
        }

        .u-spec-list li:first-child {
            padding-top: 0;
        }

        .u-spec-list li:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .u-spec-key {
            display: block;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--ink-muted);
            margin-bottom: 4px;
        }

        .u-spec-val {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--navy);
            line-height: 1.45;
        }

        .u-spec-val a {
            color: var(--navy);
            text-decoration: none;
        }

        .u-spec-val a:hover {
            color: var(--hot-pink);
        }

        .u-produk-card {
            background: var(--white);
            border: 1px solid var(--border-hairline);
            border-radius: 18px;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: border-color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
        }

        .u-produk-card:hover {
            border-color: var(--navy);
            transform: translateY(-4px);
            box-shadow: 0 18px 44px rgba(15, 27, 61, 0.08);
        }

        .u-produk-img {
            position: relative;
            height: 190px;
            overflow: hidden;
            background: var(--bg-alt);
            border-bottom: 1px solid var(--border-hairline);
        }

        .u-produk-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .u-produk-card:hover .u-produk-img img {
            transform: scale(1.04);
        }

        .u-produk-cat {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--white);
            border: 1px solid var(--border-hairline);
            color: var(--navy);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 300px;
        }

        .u-produk-body {
            padding: 16px 18px 14px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .u-produk-head {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 8px;
        }

        .u-produk-name {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--navy);
            margin: 0;
            line-height: 1.3;
        }

        .u-produk-price {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.02rem;
            font-weight: 800;
            color: var(--navy);
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        .u-produk-pack {
            display: inline-block;
            font-size: 0.74rem;
            font-weight: 600;
            color: var(--ink-muted);
            margin-bottom: 8px;
        }

        .u-produk-desc {
            font-size: 0.82rem;
            color: var(--ink-muted);
            line-height: 1.55;
            margin: 0;
        }

        .u-produk-foot {
            padding: 12px 18px;
            border-top: 1px solid var(--border-hairline);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .u-produk-link {
            font-size: 0.84rem;
            font-weight: 700;
            color: var(--navy);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .u-produk-card:hover .u-produk-link,
        .u-produk-link:hover {
            color: var(--hot-pink);
        }

        .u-map-card {
            background: var(--white);
            border: 1px solid var(--border-hairline);
            border-radius: 18px;
            padding: 14px;
        }

        #map {
            height: 360px;
            border-radius: 12px;
            z-index: 1;
        }

        .u-map-empty {
            padding: 64px 24px;
            text-align: center;
            color: var(--ink-muted);
            background: var(--bg-alt);
            border-radius: 12px;
        }

        @media (max-width: 575px) {
            .u-produk-card {
                border-radius: 12px;
            }

            .u-produk-img {
                height: 135px;
            }

            .u-produk-body {
                padding: 12px;
            }

            .u-produk-name {
                font-size: 0.88rem;
            }

            .u-produk-price {
                font-size: 0.9rem;
            }

            .u-produk-desc {
                font-size: 0.76rem;
            }

            .u-produk-foot {
                padding: 10px 12px;
            }

            .u-produk-link {
                font-size: 0.76rem;
            }
        }

        /* Clean Minimal Share & QR Modal */
        .u-qr-modal-content {
            background: var(--white);
            border: 1px solid var(--border-hairline);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(15, 27, 61, 0.14);
        }

        .u-qr-modal-head {
            background: var(--white);
            color: var(--navy);
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-hairline);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .u-qr-modal-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1rem;
            font-weight: 800;
            color: var(--navy);
            margin: 0;
            line-height: 1.25;
        }

        .u-qr-modal-sub {
            display: block;
            font-size: 0.76rem;
            color: var(--ink-muted);
            margin-top: 2px;
        }

        .u-qr-modal-close {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1px solid var(--border-hairline);
            background: var(--white);
            color: var(--navy);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.88rem;
            flex-shrink: 0;
            cursor: pointer;
            transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }

        .u-qr-modal-close:hover {
            background: var(--navy);
            border-color: var(--navy);
            color: var(--white);
        }

        .u-qr-modal-body {
            padding: 18px 20px 20px;
        }

        .u-share-tabs {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            border-bottom: 1px solid var(--border-hairline);
            margin-bottom: 18px;
        }

        .u-share-tab {
            border: none;
            border-bottom: 2px solid transparent;
            background: transparent;
            color: var(--ink-muted);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            padding: 8px 10px 10px;
            margin-bottom: -1px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            cursor: pointer;
            transition: color 0.2s ease, border-color 0.2s ease;
        }

        .u-share-tab.is-active {
            color: var(--navy);
            border-bottom-color: var(--hot-pink);
        }

        .u-share-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px 8px;
            margin-bottom: 18px;
        }

        .u-share-tile {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 4px;
            border: none;
            background: transparent;
            color: var(--navy);
            font-size: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .u-share-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid var(--border-hairline);
            background: var(--white);
            color: var(--navy);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.08rem;
            transition: transform 0.2s ease, background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }

        .u-share-tile:hover .u-share-circle {
            transform: translateY(-2px);
            background: var(--navy);
            border-color: var(--navy);
            color: var(--white);
        }

        .u-share-tile.is-wa:hover .u-share-circle {
            background: #16a34a;
            border-color: #16a34a;
        }

        .u-share-tile.is-fb:hover .u-share-circle {
            background: #1877f2;
            border-color: #1877f2;
        }

        .u-share-tile.is-tg:hover .u-share-circle {
            background: #0088cc;
            border-color: #0088cc;
        }

        .u-share-tile.is-more:hover .u-share-circle {
            background: var(--hot-pink);
            border-color: var(--hot-pink);
        }

        .u-copy-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--white);
            border: 1px solid var(--border-hairline);
            border-radius: 10px;
            padding: 5px 5px 5px 12px;
        }

        .u-copy-input {
            flex: 1;
            min-width: 0;
            border: none;
            background: transparent;
            font-size: 0.75rem;
            color: var(--ink-muted);
            outline: none;
        }

        .u-copy-btn {
            border: none;
            background: var(--navy);
            color: var(--white);
            font-size: 0.74rem;
            font-weight: 700;
            padding: 7px 12px;
            border-radius: 7px;
            flex-shrink: 0;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .u-copy-btn:hover {
            background: var(--hot-pink);
        }

        .u-copy-toast {
            display: none;
            font-size: 0.76rem;
            font-weight: 600;
            color: var(--hot-pink);
            text-align: center;
            margin-top: 8px;
        }

        .u-qr-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            background: var(--white);
            border: 1px solid var(--border-hairline);
            border-radius: 14px;
            margin-bottom: 12px;
        }

        #umkmQrCodeCanvas img,
        #umkmQrCodeCanvas canvas {
            display: block;
        }

        .u-qr-hint {
            font-size: 0.8rem;
            color: var(--ink-muted);
            margin: 0 0 14px;
        }

        .u-cta-bar {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .u-share-modal-dialog {
            max-width: 390px;
        }

        @media (max-width: 575px) {
            .u-cta-bar {
                flex-wrap: nowrap;
                gap: 8px;
            }

            .u-cta-bar .u-cta-wa {
                flex: 1;
                width: auto !important;
                justify-content: center;
                padding: 11px 16px;
                white-space: nowrap;
            }

            .u-cta-bar .u-cta-icon-btn {
                width: 46px !important;
                height: 46px;
                padding: 0;
                border-radius: 50%;
                flex-shrink: 0;
                justify-content: center;
                font-size: 1.05rem;
            }

            .u-share-modal-dialog {
                max-width: 300px;
                margin: 12px auto;
            }

            .u-qr-modal-content {
                border-radius: 16px;
            }

            .u-qr-modal-head {
                padding: 14px 16px;
            }

            .u-qr-modal-title {
                font-size: 0.92rem;
            }

            .u-qr-modal-body {
                padding: 14px 16px 16px;
            }

            .u-share-tabs {
                margin-bottom: 14px;
            }

            .u-share-tab {
                padding: 6px 8px 8px;
                font-size: 0.76rem;
            }

            .u-share-grid {
                gap: 10px 6px;
                margin-bottom: 14px;
            }

            .u-share-circle {
                width: 38px;
                height: 38px;
                font-size: 0.98rem;
            }

            .u-share-tile {
                font-size: 0.68rem;
                gap: 5px;
            }

            .u-copy-bar {
                padding: 4px 4px 4px 10px;
            }

            .u-copy-btn {
                padding: 6px 10px;
                font-size: 0.7rem;
            }

            .u-qr-box {
                padding: 10px;
                margin-bottom: 10px;
            }

            #umkmQrCodeCanvas img,
            #umkmQrCodeCanvas canvas {
                width: 160px !important;
                height: 160px !important;
            }
        }
    </style>
@endsection

@section('content')
    @php
        $waRaw = preg_replace('/[^0-9]/', '', (string) $umkm->no_whatsapp);
        if (str_starts_with($waRaw, '0')) {
            $waDigits = '62' . substr($waRaw, 1);
        } elseif (str_starts_with($waRaw, '8')) {
            $waDigits = '62' . $waRaw;
        } else {
            $waDigits = $waRaw;
        }

        $waLink = $waDigits
            ? 'https://wa.me/' . $waDigits . '?text=' . urlencode('Halo ' . $umkm->nama_usaha . ', saya ingin bertanya mengenai produk Anda.')
            : null;

        $kategoriList = $produks->pluck('kategori.nama_kategori')->filter()->unique()->values();
        $minHarga = $produks->isNotEmpty() ? $produks->min('harga') : null;
        $maxHarga = $produks->isNotEmpty() ? $produks->max('harga') : null;
    @endphp

    <!-- ====================================================
         1 / CLEAN BRAND INTRO (FOKUS KE UMKM INI)
         ==================================================== -->
    <section class="u-intro">
        <div class="container ed-container">
            <a href="{{ route('umkm.index') }}" class="u-back-link">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar UMKM
            </a>

            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="u-kicker">
                        <span class="u-dot"></span>
                        Profil UMKM · Desa Sebong Lagoi
                    </div>

                    <h1 class="u-title">{{ $umkm->nama_usaha }}</h1>
                    <p class="u-lead">
                        {{ $umkm->deskripsi ?: 'Usaha mikro, kecil, dan menengah binaan Desa Sebong Lagoi yang menghadirkan produk pilihan asli masyarakat setempat.' }}
                    </p>

                    <div class="u-meta-inline">
                        <span><strong>{{ $produks->count() }}</strong> Produk Tersedia</span>
                        @if($kategoriList->isNotEmpty())
                            <span class="u-meta-sep"></span>
                            <span>Kategori: <strong>{{ $kategoriList->implode(', ') }}</strong></span>
                        @endif
                        @if($minHarga !== null)
                            <span class="u-meta-sep"></span>
                            <span>
                                Harga:
                                <strong>
                                    Rp {{ number_format($minHarga, 0, ',', '.') }}
                                    @if($maxHarga && $maxHarga !== $minHarga)
                                        – Rp {{ number_format($maxHarga, 0, ',', '.') }}
                                    @endif
                                </strong>
                            </span>
                        @endif
                    </div>

                    <div class="u-cta-bar">
                        @if($waLink)
                            <a href="{{ $waLink }}" target="_blank" class="ed-btn-primary u-cta-wa">
                                <i class="bi bi-whatsapp"></i> Hubungi WhatsApp
                            </a>
                        @endif
                        <a href="#lokasi-umkm"
                           class="ed-btn-secondary u-cta-icon-btn"
                           title="Lihat Lokasi"
                           aria-label="Lihat Lokasi">
                            <i class="bi bi-geo-alt"></i> <span class="d-none d-sm-inline">Lihat Lokasi</span>
                        </a>
                        <button type="button"
                                id="uOpenShareBtn"
                                class="ed-btn-secondary u-cta-icon-btn"
                                title="Bagikan UMKM"
                                aria-label="Bagikan UMKM"
                                data-bs-toggle="modal"
                                data-bs-target="#umkmShareModal">
                            <i class="bi bi-share"></i> <span class="d-none d-sm-inline">Bagikan</span>
                        </button>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="u-hero-frame">
                        <img src="{{ $umkm->foto_toko ? asset('storage/' . $umkm->foto_toko) : asset('images/tentang-desa.jpg') }}"
                             alt="{{ $umkm->nama_usaha }}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         2 / TENTANG USAHA INI
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / Tentang Usaha</span>
            </div>

            <div class="row g-5 align-items-start">
                <div class="col-lg-7">
                    <span class="ed-kicker">Cerita &amp; Penjelasan</span>
                    <h2 class="ed-heading mb-4">
                        Mengenal <span class="serif-italic">{{ $umkm->nama_usaha }}.</span>
                    </h2>

                    <div class="u-about-prose">
                        <p>
                            {!! nl2br(e($umkm->deskripsi ?: $umkm->nama_usaha . ' merupakan pelaku UMKM aktif yang beroperasi di Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan.')) !!}
                        </p>
                        <p>
                            Berlokasi di {{ $umkm->alamat ?: 'Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan' }},
                            <strong>{{ $umkm->nama_usaha }}</strong> menghadirkan {{ $produks->count() }} pilihan produk lokal
                            @if($kategoriList->isNotEmpty())
                                dalam kategori <strong>{{ $kategoriList->implode(' dan ') }}</strong>
                            @endif
                            yang dikemas rapi dan cocok dinikmati sehari-hari maupun sebagai oleh-oleh khas daerah.
                        </p>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="u-spec-card">
                        <ul class="u-spec-list">
                            <li>
                                <span class="u-spec-key">Pemilik / Pengelola</span>
                                <div class="u-spec-val">{{ $umkm->user?->name ?? 'Pengelola ' . $umkm->nama_usaha }}</div>
                            </li>
                            <li>
                                <span class="u-spec-key">Kategori Produk</span>
                                <div class="u-spec-val">{{ $kategoriList->isNotEmpty() ? $kategoriList->implode(', ') : 'Produk UMKM Desa' }}</div>
                            </li>
                            <li>
                                <span class="u-spec-key">Rentang Harga</span>
                                <div class="u-spec-val">
                                    @if($minHarga !== null)
                                        Rp {{ number_format($minHarga, 0, ',', '.') }}
                                        @if($maxHarga && $maxHarga !== $minHarga)
                                            – Rp {{ number_format($maxHarga, 0, ',', '.') }}
                                        @endif
                                    @else
                                        Hubungi pelaku usaha
                                    @endif
                                </div>
                            </li>
                            <li>
                                <span class="u-spec-key">Alamat</span>
                                <div class="u-spec-val">{{ $umkm->alamat ?: 'Desa Sebong Lagoi, Teluk Sebong' }}</div>
                            </li>
                            <li>
                                <span class="u-spec-key">Kontak WhatsApp</span>
                                <div class="u-spec-val">
                                    @if($waDigits)
                                        <a href="{{ $waLink }}" target="_blank">+{{ $waDigits }}</a>
                                    @else
                                        -
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         3 / PRODUK DARI UMKM INI
         ==================================================== -->
    <section class="ed-section">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">02 / Daftar Produk</span>
            </div>

            <div class="ed-section-head">
                <div>
                    <span class="ed-kicker">Etalase Resmi</span>
                    <h2 class="ed-heading">
                        Produk <span class="serif-italic">{{ $umkm->nama_usaha }}.</span>
                    </h2>
                    <p class="ed-subtext">
                        Daftar produk yang diproduksi dan ditawarkan langsung oleh {{ $umkm->nama_usaha }}.
                    </p>
                </div>
            </div>

            @if($produks->isNotEmpty())
                <div class="row g-3 g-md-4">
                    @foreach($produks as $produk)
                        <div class="col-6 col-sm-6 col-lg-3">
                            <div class="u-produk-card">
                                <div class="u-produk-img">
                                    <img src="{{ $produk->foto_produk ? asset('storage/' . $produk->foto_produk) : asset('images/tentang-desa.jpg') }}"
                                         alt="{{ $produk->nama_produk }}">
                                    <span class="u-produk-cat">{{ optional($produk->kategori)->nama_kategori ?? 'Umum' }}</span>
                                </div>

                                <div class="u-produk-body">
                                    <div class="u-produk-head">
                                        <h3 class="u-produk-name">{{ $produk->nama_produk }}</h3>
                                        <span class="u-produk-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                    </div>

                                    @if($produk->ukuran_kemasan)
                                        <span class="u-produk-pack">
                                            <i class="bi bi-box-seam me-1"></i>Kemasan {{ $produk->ukuran_kemasan }}
                                        </span>
                                    @endif

                                    <p class="u-produk-desc">
                                        {{ Str::limit(strip_tags($produk->deskripsi), 105) }}
                                    </p>
                                </div>

                                <div class="u-produk-foot">
                                    <span class="small" style="color: var(--ink-muted);">
                                        <i class="bi bi-eye me-1"></i>{{ $produk->views }} kali dilihat
                                    </span>
                                    <a href="{{ route('produk.show', $produk->slug) }}" class="u-produk-link">
                                        Lihat Detail <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="ed-empty-card">
                    <div class="ed-empty-icon">
                        <i class="bi bi-box"></i>
                    </div>
                    <h3 class="ed-empty-title">Belum Ada Produk Terdaftar</h3>
                    <p class="ed-empty-desc mb-0">
                        {{ $umkm->nama_usaha }} belum menambahkan produk ke dalam etalase ini.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- ====================================================
         4 / LOKASI USAHA
         ==================================================== -->
    <section class="ed-section-alt" id="lokasi-umkm">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">03 / Lokasi Usaha</span>
            </div>

            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <span class="ed-kicker">Kunjungi Langsung</span>
                    <h2 class="ed-heading mb-3">
                        Lokasi <span class="serif-italic">{{ $umkm->nama_usaha }}.</span>
                    </h2>
                    <p class="ed-subtext mb-4">
                        {{ $umkm->alamat ?: 'Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan, Kepulauan Riau.' }}
                    </p>

                    @if($umkm->latitude && $umkm->longitude)
                        <p class="small mb-4" style="color: var(--ink-muted);">
                            <i class="bi bi-check-circle-fill me-1" style="color: var(--hot-pink);"></i>
                            Koordinat terverifikasi: <strong style="color: var(--navy);">{{ $umkm->latitude }}, {{ $umkm->longitude }}</strong>
                        </p>
                    @endif

                    <div class="d-flex flex-wrap gap-3">
                        @if($umkm->latitude && $umkm->longitude)
                            <a href="https://www.google.com/maps?q={{ $umkm->latitude }},{{ $umkm->longitude }}"
                               target="_blank"
                               class="ed-btn-secondary">
                                <i class="bi bi-map"></i> Buka di Google Maps <i class="bi bi-arrow-up-right"></i>
                            </a>
                        @endif
                        @if($waLink)
                            <a href="{{ $waLink }}" target="_blank" class="ed-btn-primary">
                                <i class="bi bi-whatsapp"></i> Chat Pemilik Usaha
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="u-map-card">
                        @if($umkm->latitude && $umkm->longitude)
                            <div id="map"></div>
                        @else
                            <div class="u-map-empty">
                                <i class="bi bi-map fs-1"></i>
                                <h6 class="fw-bold mt-3" style="color: var(--navy);">Lokasi Belum Dipetakan</h6>
                                <p class="small mb-0">Pemilik usaha belum mengatur koordinat peta lokasi.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- UNIFIED SHARE & QR CODE MODAL --}}
    @php
        $shareText = 'Lihat profil dan katalog produk ' . $umkm->nama_usaha . ' di Desa Sebong Lagoi: ' . url()->current();
        $shareUrl = url()->current();
    @endphp
    <div class="modal fade" id="umkmShareModal" tabindex="-1" aria-labelledby="umkmShareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered u-share-modal-dialog">
            <div class="modal-content u-qr-modal-content">
                <div class="u-qr-modal-head">
                    <div>
                        <h5 class="u-qr-modal-title" id="umkmShareModalLabel">Bagikan UMKM</h5>
                        <span class="u-qr-modal-sub">{{ $umkm->nama_usaha }}</span>
                    </div>
                    <button type="button" class="u-qr-modal-close" data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="u-qr-modal-body">
                    <div class="u-share-tabs" role="tablist">
                        <button type="button" class="u-share-tab is-active" data-tab-target="uTabShare" aria-selected="true">
                            Bagikan
                        </button>
                        <button type="button" class="u-share-tab" data-tab-target="uTabQr" aria-selected="false">
                            QR Code
                        </button>
                    </div>

                    {{-- Tab 1: Share Channels + Copy Link --}}
                    <div id="uTabShare">
                        <div class="u-share-grid">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($shareText) }}"
                               target="_blank"
                               rel="noopener"
                               class="u-share-tile is-wa">
                                <span class="u-share-circle"><i class="bi bi-whatsapp"></i></span>
                                <span>WhatsApp</span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}"
                               target="_blank"
                               rel="noopener"
                               class="u-share-tile is-fb">
                                <span class="u-share-circle"><i class="bi bi-facebook"></i></span>
                                <span>Facebook</span>
                            </a>
                            <a href="https://t.me/share/url?url={{ urlencode($shareUrl) }}&text={{ urlencode('Profil UMKM ' . $umkm->nama_usaha . ' — Desa Sebong Lagoi') }}"
                               target="_blank"
                               rel="noopener"
                               class="u-share-tile is-tg">
                                <span class="u-share-circle"><i class="bi bi-telegram"></i></span>
                                <span>Telegram</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode('Profil UMKM ' . $umkm->nama_usaha . ' — Desa Sebong Lagoi') }}&url={{ urlencode($shareUrl) }}"
                               target="_blank"
                               rel="noopener"
                               class="u-share-tile">
                                <span class="u-share-circle"><i class="bi bi-twitter-x"></i></span>
                                <span>X</span>
                            </a>
                            <a href="mailto:?subject={{ rawurlencode('Profil UMKM ' . $umkm->nama_usaha . ' — Desa Sebong Lagoi') }}&body={{ rawurlencode($shareText) }}"
                               class="u-share-tile">
                                <span class="u-share-circle"><i class="bi bi-envelope"></i></span>
                                <span>Email</span>
                            </a>
                            <button type="button" id="uNativeShareBtn" class="u-share-tile is-more">
                                <span class="u-share-circle"><i class="bi bi-box-arrow-up"></i></span>
                                <span>Lainnya</span>
                            </button>
                        </div>

                        <div class="u-copy-bar">
                            <input type="text" class="u-copy-input" value="{{ $shareUrl }}" readonly aria-label="Tautan profil UMKM">
                            <button type="button" id="uModalCopyBtn" class="u-copy-btn">
                                Salin
                            </button>
                        </div>
                        <div id="uModalCopyToast" class="u-copy-toast">Tautan disalin!</div>
                    </div>

                    {{-- Tab 2: QR / Barcode --}}
                    <div id="uTabQr" class="d-none text-center">
                        <div class="u-qr-box">
                            <div id="umkmQrCodeCanvas"></div>
                        </div>
                        <p class="u-qr-hint">Pindai QR untuk membuka profil {{ $umkm->nama_usaha }}.</p>
                        <button type="button" id="uDownloadQrBtn" class="ed-btn-primary w-100 justify-content-center">
                            <i class="bi bi-download"></i> Unduh QR PNG
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        (function () {
            var shareUrl = @json(url()->current());
            var umkmName = @json($umkm->nama_usaha);
            var umkmSlug = @json($umkm->slug);

            function copyLink(toastEl, customMsg) {
                function showToast() {
                    if (!toastEl) return;
                    if (customMsg) toastEl.textContent = customMsg;
                    toastEl.style.display = 'block';
                    setTimeout(function () {
                        toastEl.style.display = 'none';
                    }, 2500);
                }

                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(shareUrl).then(showToast);
                } else {
                    var ta = document.createElement('textarea');
                    ta.value = shareUrl;
                    ta.setAttribute('readonly', '');
                    ta.style.position = 'fixed';
                    ta.style.opacity = '0';
                    document.body.appendChild(ta);
                    ta.select();
                    try {
                        document.execCommand('copy');
                        showToast();
                    } finally {
                        document.body.removeChild(ta);
                    }
                }
            }

            var modalCopyBtn = document.getElementById('uModalCopyBtn');
            var modalCopyToast = document.getElementById('uModalCopyToast');
            if (modalCopyBtn) {
                modalCopyBtn.addEventListener('click', function () {
                    copyLink(modalCopyToast, 'Tautan disalin ke clipboard!');
                });
            }

            var nativeShareBtn = document.getElementById('uNativeShareBtn');
            if (nativeShareBtn) {
                nativeShareBtn.addEventListener('click', function () {
                    if (navigator.share) {
                        navigator.share({
                            title: umkmName + ' — Desa Sebong Lagoi',
                            text: 'Lihat profil dan katalog produk ' + umkmName + ' di Desa Sebong Lagoi',
                            url: shareUrl,
                        }).catch(function () {});
                    } else {
                        copyLink(modalCopyToast, 'Peramban tidak mendukung Share langsung — tautan disalin!');
                    }
                });
            }

            var qrGenerated = false;
            var qrContainer = document.getElementById('umkmQrCodeCanvas');

            function ensureQrGenerated() {
                if (qrGenerated || !qrContainer || typeof QRCode === 'undefined') return;
                qrContainer.innerHTML = '';
                new QRCode(qrContainer, {
                    text: shareUrl,
                    width: 240,
                    height: 240,
                    colorDark: '#0f1b3d',
                    colorLight: '#ffffff',
                    correctLevel: QRCode.CorrectLevel.H,
                });
                qrGenerated = true;
            }

            var tabBtns = Array.from(document.querySelectorAll('.u-share-tab'));
            var tabShare = document.getElementById('uTabShare');
            var tabQr = document.getElementById('uTabQr');

            function switchTab(targetId) {
                tabBtns.forEach(function (b) {
                    var active = b.dataset.tabTarget === targetId;
                    b.classList.toggle('is-active', active);
                    b.setAttribute('aria-selected', active ? 'true' : 'false');
                });
                if (tabShare) tabShare.classList.toggle('d-none', targetId !== 'uTabShare');
                if (tabQr) tabQr.classList.toggle('d-none', targetId !== 'uTabQr');
                if (targetId === 'uTabQr') {
                    ensureQrGenerated();
                }
            }

            tabBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    switchTab(btn.dataset.tabTarget);
                });
            });

            var shareModalEl = document.getElementById('umkmShareModal');
            if (shareModalEl) {
                shareModalEl.addEventListener('show.bs.modal', function () {
                    switchTab('uTabShare');
                });
            }

            var downloadBtn = document.getElementById('uDownloadQrBtn');
            if (downloadBtn) {
                downloadBtn.addEventListener('click', function () {
                    ensureQrGenerated();
                    if (!qrContainer) return;

                    var qrCanvas = qrContainer.querySelector('canvas');
                    var qrImg = qrContainer.querySelector('img');
                    var qrSource = qrCanvas || qrImg;
                    if (!qrSource) return;

                    var cardW = 640;
                    var cardH = 820;
                    var out = document.createElement('canvas');
                    out.width = cardW;
                    out.height = cardH;
                    var ctx = out.getContext('2d');

                    ctx.fillStyle = '#ffffff';
                    ctx.fillRect(0, 0, cardW, cardH);
                    ctx.strokeStyle = '#e5e9f2';
                    ctx.lineWidth = 4;
                    ctx.strokeRect(2, 2, cardW - 4, cardH - 4);

                    ctx.fillStyle = '#0f1b3d';
                    ctx.fillRect(0, 0, cardW, 112);

                    ctx.fillStyle = '#ff3d8b';
                    ctx.font = 'bold 18px sans-serif';
                    ctx.textAlign = 'center';
                    ctx.fillText('DESA SEBONG LAGOI · PROFIL UMKM RESMI', cardW / 2, 50);

                    ctx.fillStyle = '#ffffff';
                    ctx.font = 'bold 28px sans-serif';
                    ctx.fillText(umkmName.slice(0, 34), cardW / 2, 88);

                    var qrSize = 380;
                    var qrX = (cardW - qrSize) / 2;
                    var qrY = 160;
                    ctx.fillStyle = '#ffffff';
                    ctx.fillRect(qrX - 24, qrY - 24, qrSize + 48, qrSize + 48);
                    ctx.strokeStyle = '#e5e9f2';
                    ctx.lineWidth = 2;
                    ctx.strokeRect(qrX - 24, qrY - 24, qrSize + 48, qrSize + 48);
                    ctx.drawImage(qrSource, qrX, qrY, qrSize, qrSize);

                    ctx.fillStyle = '#0f1b3d';
                    ctx.font = 'bold 26px sans-serif';
                    ctx.fillText(umkmName.slice(0, 36), cardW / 2, 646);

                    ctx.fillStyle = '#5b647a';
                    ctx.font = '20px sans-serif';
                    ctx.fillText('Scan QR untuk lihat profil & katalog produk', cardW / 2, 686);

                    ctx.fillStyle = '#0f1b3d';
                    ctx.font = '15px sans-serif';
                    ctx.fillText(shareUrl.length > 62 ? shareUrl.slice(0, 59) + '...' : shareUrl, cardW / 2, 748);

                    var link = document.createElement('a');
                    link.download = 'qr-umkm-' + umkmSlug + '.png';
                    link.href = out.toDataURL('image/png');
                    link.click();
                });
            }
        })();
    </script>

    @if($umkm->latitude && $umkm->longitude)
        <!-- Leaflet Map JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var lat = {{ (float) $umkm->latitude }};
                var lng = {{ (float) $umkm->longitude }};

                var map = L.map('map').setView([lat, lng], 15);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                var namaUsaha = @json($umkm->nama_usaha);
                var alamatUsaha = @json($umkm->alamat ?? '');
                var marker = L.marker([lat, lng]).addTo(map);
                marker.bindPopup('<b>' + namaUsaha + '</b><br>' + alamatUsaha).openPopup();
            });
        </script>
    @endif
@endsection
