@extends('layouts.app')

@section('title', 'Kumpulan Artikel - Desa Sebong Lagoi')
@section('minimal_footer', true)

@section('styles')
<style>
    .art-fact-strip {
        grid-template-columns: repeat(3, 1fr);
        max-width: 780px;
    }

    .art-card {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 16px;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: border-color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    }

    .art-card:hover {
        border-color: var(--navy);
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(15, 27, 61, 0.08);
    }

    .art-card-thumb {
        position: relative;
        aspect-ratio: 16 / 10;
        overflow: hidden;
        background: var(--bg-alt);
        border-bottom: 1px solid var(--border-hairline);
        display: block;
    }

    .art-card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .art-card:hover .art-card-thumb img {
        transform: scale(1.05);
    }

    .art-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .art-card-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px 14px;
        font-size: 0.76rem;
        color: var(--ink-muted);
        margin-bottom: 10px;
    }

    .art-card-meta i {
        color: var(--hot-pink);
    }

    .art-card-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        line-height: 1.34;
        margin: 0 0 10px;
    }

    .art-card-title a {
        color: var(--navy);
        text-decoration: none;
    }

    .art-card-title a:hover {
        color: var(--hot-pink);
    }

    .art-card-excerpt {
        font-size: 0.84rem;
        color: var(--ink-muted);
        line-height: 1.6;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .art-card-foot {
        padding: 13px 20px;
        border-top: 1px solid var(--border-hairline);
    }

    .art-card-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--navy);
        text-decoration: none;
    }

    .art-card:hover .art-card-link,
    .art-card-link:hover {
        color: var(--hot-pink);
    }

    @media (max-width: 767px) {
        .art-fact-strip {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 575px) {
        .art-card {
            border-radius: 12px;
        }

        .art-card-body {
            padding: 12px;
        }

        .art-card-meta {
            font-size: 0.68rem;
            gap: 4px 8px;
            margin-bottom: 6px;
        }

        .art-card-title {
            font-size: 0.86rem;
            margin-bottom: 6px;
        }

        .art-card-excerpt {
            font-size: 0.74rem;
        }

        .art-card-foot {
            padding: 10px 12px;
        }

        .art-card-link {
            font-size: 0.74rem;
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
                <span>Informasi</span>
                <span>/</span>
                <span class="is-current">Berita &amp; Artikel</span>
            </div>

            <h1 class="ed-page-title">
                Berita &amp; Artikel <span class="serif-italic">Desa Sebong Lagoi.</span>
            </h1>
            <p class="ed-page-lead">
                Informasi terbaru seputar kegiatan masyarakat, pemberdayaan pelaku UMKM, pariwisata, dan perkembangan resmi Pemerintah Desa Sebong Lagoi.
            </p>

            <div class="ed-fact-strip art-fact-strip">
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Total Publikasi</span>
                    <div class="ed-fact-value">{{ $artikels->total() }} Artikel</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Sumber Resmi</span>
                    <div class="ed-fact-value">Pemerintah Desa</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Wilayah</span>
                    <div class="ed-fact-value">Teluk Sebong, Bintan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         01 / KABAR & LIPUTAN DESA
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / KABAR &amp; LIPUTAN DESA</span>
            </div>

            <div class="ed-section-head reveal">
                <div>
                    <span class="ed-kicker">Kabar Terkini</span>
                    <h2 class="ed-heading">
                        Liputan &amp; <span class="serif-italic">Berita Warga</span> ({{ $artikels->total() }}).
                    </h2>
                </div>
                <a href="{{ route('event.index') }}" class="ed-link-arrow">
                    Agenda Event Desa <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            @if($artikels->isNotEmpty())
                <div class="row g-3 g-md-4">
                    @foreach($artikels as $artikel)
                        <div class="col-6 col-md-6 col-lg-4 reveal">
                            <article class="art-card">
                                <a href="{{ route('artikel.show', $artikel->slug) }}" class="art-card-thumb">
                                    <img src="{{ $artikel->foto_artikel ? asset('storage/' . $artikel->foto_artikel) : asset('images/tentang-desa.jpg') }}"
                                         alt="{{ $artikel->judul }}"
                                         loading="lazy"
                                         decoding="async">
                                </a>

                                <div class="art-card-body">
                                    <div class="art-card-meta">
                                        <span>
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ \Carbon\Carbon::parse($artikel->created_at)->locale('id')->translatedFormat('d M Y') }}
                                        </span>
                                        <span>
                                            <i class="bi bi-eye me-1"></i>
                                            {{ $artikel->views }} dibaca
                                        </span>
                                    </div>

                                    <h3 class="art-card-title">
                                        <a href="{{ route('artikel.show', $artikel->slug) }}">{{ $artikel->judul }}</a>
                                    </h3>

                                    <p class="art-card-excerpt">{{ Str::limit(strip_tags($artikel->konten), 120) }}</p>
                                </div>

                                <div class="art-card-foot">
                                    <a href="{{ route('artikel.show', $artikel->slug) }}" class="art-card-link">
                                        Baca Selengkapnya <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if($artikels->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $artikels->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @else
                <div class="ed-empty-card reveal">
                    <div class="ed-empty-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <h3 class="ed-empty-title">Belum Ada Artikel Diterbitkan</h3>
                    <p class="ed-empty-desc">
                        Berita dan liputan kegiatan Desa Sebong Lagoi akan tampil di sini setelah dipublikasikan oleh admin desa.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('event.index') }}" class="ed-btn-secondary">
                            Lihat Agenda Event
                        </a>
                        <a href="{{ route('umkm.index') }}" class="ed-btn-primary">
                            Jelajahi UMKM <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection
