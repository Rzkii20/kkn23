@extends('layouts.app')

@section('title', 'Potensi Desa - Pemerintah Desa Sebong Lagoi')
@section('minimal_footer', true)

@section('styles')
<style>
    .pt-fact-strip {
        grid-template-columns: repeat(3, 1fr);
        max-width: 780px;
    }

    .pt-media-frame {
        position: relative;
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 20px;
        overflow: hidden;
        padding: 12px;
        box-shadow: 0 18px 46px rgba(15, 27, 61, 0.08);
    }

    .pt-media-inner {
        position: relative;
        border-radius: 14px;
        overflow: hidden;
        aspect-ratio: 16 / 10;
        background: var(--bg-alt);
    }

    .pt-media-inner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.55s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .pt-media-frame:hover .pt-media-inner img {
        transform: scale(1.04);
    }

    .pt-media-caption {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 6px 4px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--navy);
    }

    .pt-media-tag {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--hot-pink);
        flex-shrink: 0;
    }

    .pt-sector-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: clamp(1.65rem, 2.8vw, 2.25rem);
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.025em;
        color: var(--navy);
        margin: 0 0 16px;
    }

    .pt-sector-copy {
        font-size: 0.94rem;
        line-height: 1.72;
        color: var(--ink-muted);
        margin: 0 0 14px;
    }

    .pt-highlights {
        list-style: none;
        padding: 0;
        margin: 20px 0 26px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .pt-highlights li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.88rem;
        font-weight: 500;
        color: var(--navy);
    }

    .pt-highlights li i {
        color: var(--hot-pink);
        font-size: 0.95rem;
        margin-top: 2px;
        flex-shrink: 0;
    }

    @media (max-width: 767px) {
        .pt-fact-strip {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

    <!-- ====================================================
         NAVY EDITORIAL HERO
         ==================================================== -->
    <section class="ed-page-hero">
        <div class="container ed-container">
            <div class="ed-breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <span>Profil Desa</span>
                <span>/</span>
                <span class="is-current">Potensi Desa</span>
            </div>

            <h1 class="ed-page-title">
                Potensi Unggulan <span class="serif-italic">Desa Sebong Lagoi.</span>
            </h1>
            <p class="ed-page-lead">
                Menyatukan kekayaan alam pesisir, daya tarik ekowisata kelas dunia, hasil kelautan, serta kreativitas pelaku UMKM lokal di Kecamatan Teluk Sebong, Kabupaten Bintan.
            </p>

            <div class="ed-fact-strip pt-fact-strip">
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Destinasi Wisata</span>
                    <div class="ed-fact-value">{{ $stats['wisata'] }} Lokasi</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Pelaku UMKM</span>
                    <div class="ed-fact-value">{{ $stats['umkm'] }} Unit Usaha</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Produk Unggulan</span>
                    <div class="ed-fact-value">{{ $stats['produk'] }} Produk</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         01 / SEKTOR PARIWISATA
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / SEKTOR PARIWISATA</span>
            </div>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6 reveal">
                    <div class="pt-media-frame">
                        <div class="pt-media-inner">
                            <img src="{{ isset($mangrove) && $mangrove->foto_wisata ? asset('storage/' . $mangrove->foto_wisata) : asset('images/tentang-desa.jpg') }}"
                                 alt="{{ $mangrove->nama_wisata ?? 'Ekowisata Hutan Mangrove & Pantai Desa Sebong Lagoi' }}">
                        </div>
                        <div class="pt-media-caption">
                            <span class="text-truncate">{{ ucwords($mangrove->nama_wisata ?? 'Kawasan Ekowisata Mangrove Sebong Lagoi') }}</span>
                            <span class="pt-media-tag">Sektor Utama</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 reveal">
                    <span class="ed-kicker">Ekowisata &amp; Pesisir</span>
                    <h2 class="pt-sector-title">
                        Ekowisata Hutan Mangrove <span class="serif-italic">&amp; Pantai.</span>
                    </h2>
                    <p class="pt-sector-copy">
                        Desa Sebong Lagoi memiliki aset ekosistem pesisir alami berupa sungai dan hutan mangrove seluas puluhan hektar yang terjaga dengan baik. Kawasan ini telah dikembangkan secara kolaboratif menjadi salah satu ikon wisata susur sungai (<em>Mangrove Tour</em>) terpopuler di Pulau Bintan.
                    </p>
                    <p class="pt-sector-copy">
                        Selain hutan mangrove, desa kami dikaruniai gugusan pantai berpasir putih menghadap Laut Natuna Utara dengan ombak yang bersahabat serta rindangnya pohon kelapa pesisir sebagai destinasi rekreasi keluarga.
                    </p>

                    <ul class="pt-highlights">
                        <li><i class="bi bi-check-circle-fill"></i><span>Wisata susur sungai mangrove alami dan pengamatan kunang-kunang malam</span></li>
                        <li><i class="bi bi-check-circle-fill"></i><span>Garis pantai landai berpasir putih dengan akses mudah dari kawasan Lagoi</span></li>
                        <li><i class="bi bi-check-circle-fill"></i><span>Wahana petualangan darat dan panorama perbukitan danau desa</span></li>
                    </ul>

                    <a href="{{ route('wisata.index') }}" class="ed-btn-primary">
                        Jelajahi Destinasi Wisata <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         02 / SEKTOR KELAUTAN
         ==================================================== -->
    <section class="ed-section">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">02 / SEKTOR KELAUTAN</span>
            </div>

            <div class="row align-items-center g-4 g-lg-5 flex-lg-row-reverse">
                <div class="col-lg-6 reveal">
                    <div class="pt-media-frame">
                        <div class="pt-media-inner">
                            <img src="{{ isset($hasilLaut) && $hasilLaut->foto_produk ? asset('storage/' . $hasilLaut->foto_produk) : asset('images/tentang-desa.jpg') }}"
                                 alt="{{ $hasilLaut->nama_produk ?? 'Potensi Kelautan dan Olahan Hasil Laut Sebong Lagoi' }}">
                        </div>
                        <div class="pt-media-caption">
                            <span class="text-truncate">{{ ucwords($hasilLaut->nama_produk ?? 'Olahan Hasil Laut Masyarakat Desa') }}</span>
                            <span class="pt-media-tag">Sektor Kelautan</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 reveal">
                    <span class="ed-kicker">Maritim &amp; Perikanan</span>
                    <h2 class="pt-sector-title">
                        Kelautan &amp; Hasil Perikanan <span class="serif-italic">Melimpah.</span>
                    </h2>
                    <p class="pt-sector-copy">
                        Sebagai wilayah pesisir kepulauan, sektor maritim dan perikanan menjadi penopang utama perekonomian warga desa. Tangkapan ikan bilis, udang, kepiting, serta biota laut khas Kepulauan Riau seperti <em>Gonggong</em> tersedia melimpah sepanjang tahun.
                    </p>
                    <p class="pt-sector-copy">
                        Hasil laut tersebut dipasok ke sentra kuliner sekitar Lagoi sekaligus diolah oleh unit UMKM rumah tangga menjadi produk camilan kemasan siap santap seperti peyek bilis, kerupuk ikan, otak-otak panggang, hingga abon laut.
                    </p>

                    <ul class="pt-highlights">
                        <li><i class="bi bi-check-circle-fill"></i><span>Pasokan tangkapan ikan segar harian langsung dari nelayan tradisional</span></li>
                        <li><i class="bi bi-check-circle-fill"></i><span>Hilirisasi hasil laut oleh pelaku UMKM menjadi camilan kemasan berdaya saing</span></li>
                        <li><i class="bi bi-check-circle-fill"></i><span>Pengolahan higienis dengan cita rasa autentik khas pesisir Bintan</span></li>
                    </ul>

                    <a href="{{ route('produk.index') }}" class="ed-btn-primary">
                        Lihat Katalog Produk Lokal <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         03 / EKONOMI KREATIF & UMKM
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">03 / EKONOMI KREATIF</span>
            </div>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6 reveal">
                    <div class="pt-media-frame">
                        <div class="pt-media-inner">
                            <img src="{{ isset($kerajinan) && $kerajinan->foto_produk ? asset('storage/' . $kerajinan->foto_produk) : asset('images/tentang-desa.jpg') }}"
                                 alt="{{ $kerajinan->nama_produk ?? 'Produk Ekonomi Kreatif dan UMKM Sebong Lagoi' }}">
                        </div>
                        <div class="pt-media-caption">
                            <span class="text-truncate">{{ ucwords($kerajinan->nama_produk ?? 'Produk Unggulan UMKM Desa Sebong Lagoi') }}</span>
                            <span class="pt-media-tag">Ekonomi Kreatif</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 reveal">
                    <span class="ed-kicker">Industri Rumah Tangga</span>
                    <h2 class="pt-sector-title">
                        Kerajinan Kreatif <span class="serif-italic">&amp; UMKM Lokal.</span>
                    </h2>
                    <p class="pt-sector-copy">
                        Pertumbuhan kunjungan wisata mendorong masyarakat mengembangkan produk ekonomi kreatif bernilai tambah, mulai dari pengolahan kuliner khas pisang salai dan keripik lokal hingga pemanfaatan serat kelapa serta cangkang kerang menjadi cenderamata khas Bintan.
                    </p>
                    <p class="pt-sector-copy">
                        Dukungan pemasaran digital dan katalog desa terus diperluas agar produk karya warga Sebong Lagoi dapat dikenal lebih luas oleh wisatawan domestik maupun mancanegara.
                    </p>

                    <ul class="pt-highlights">
                        <li><i class="bi bi-check-circle-fill"></i><span>Produk oleh-oleh kemasan modern siap bawa untuk wisatawan</span></li>
                        <li><i class="bi bi-check-circle-fill"></i><span>Pemberdayaan pelaku usaha rumah tangga dan perajin kreatif desa</span></li>
                        <li><i class="bi bi-check-circle-fill"></i><span>Terhubung langsung dengan kanal pemesanan WhatsApp pemilik UMKM</span></li>
                    </ul>

                    <div class="ed-btn-group">
                        <a href="{{ route('umkm.index') }}" class="ed-btn-primary">
                            Kunjungi Direktori UMKM <i class="bi bi-arrow-up-right"></i>
                        </a>
                        <a href="{{ route('kontak') }}" class="ed-btn-secondary">
                            Ajukan Kerja Sama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
