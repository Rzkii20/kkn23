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

                    <div class="d-flex flex-wrap gap-3">
                        @if($waLink)
                            <a href="{{ $waLink }}" target="_blank" class="ed-btn-primary">
                                <i class="bi bi-whatsapp"></i> Hubungi WhatsApp
                            </a>
                        @endif
                        <a href="#lokasi-umkm" class="ed-btn-secondary">
                            <i class="bi bi-geo-alt"></i> Lihat Lokasi
                        </a>
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

@endsection

@section('scripts')
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
