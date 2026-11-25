@extends('layouts.app')

@section('title', 'Agenda Event - Desa Sebong Lagoi')
@section('minimal_footer', true)

@section('styles')
<style>
    .ev-fact-strip {
        grid-template-columns: repeat(3, 1fr);
        max-width: 780px;
    }

    .ev-card {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 16px;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: border-color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    }

    .ev-card:hover {
        border-color: var(--navy);
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(15, 27, 61, 0.08);
    }

    .ev-thumb {
        position: relative;
        aspect-ratio: 16 / 10;
        overflow: hidden;
        background: var(--bg-alt);
        border-bottom: 1px solid var(--border-hairline);
    }

    .ev-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .ev-card:hover .ev-thumb img {
        transform: scale(1.05);
    }

    .ev-date-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        width: 56px;
        border-radius: 12px;
        overflow: hidden;
        background: var(--white);
        border: 1px solid var(--border-hairline);
        text-align: center;
        box-shadow: 0 8px 20px rgba(15, 27, 61, 0.16);
    }

    .ev-date-month {
        background: var(--hot-pink);
        color: var(--white);
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 3px 0;
    }

    .ev-date-day {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--navy);
        line-height: 1.2;
        padding: 4px 0 5px;
    }

    .ev-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .ev-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.08rem;
        font-weight: 700;
        line-height: 1.32;
        margin: 0 0 12px;
    }

    .ev-title a {
        color: var(--navy);
        text-decoration: none;
    }

    .ev-title a:hover {
        color: var(--hot-pink);
    }

    .ev-meta {
        display: flex;
        flex-direction: column;
        gap: 6px;
        font-size: 0.78rem;
        color: var(--ink-muted);
        margin-bottom: 12px;
    }

    .ev-meta-row {
        display: flex;
        align-items: flex-start;
        gap: 7px;
    }

    .ev-meta-row i {
        color: var(--hot-pink);
        margin-top: 2px;
        flex-shrink: 0;
    }

    .ev-desc {
        font-size: 0.84rem;
        color: var(--ink-muted);
        line-height: 1.6;
        margin: 0;
    }

    .ev-foot {
        padding: 13px 20px;
        border-top: 1px solid var(--border-hairline);
    }

    .ev-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--navy);
        text-decoration: none;
    }

    .ev-card:hover .ev-link,
    .ev-link:hover {
        color: var(--hot-pink);
    }

    .ev-past-card {
        display: flex;
        align-items: center;
        gap: 14px;
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        border-radius: 14px;
        padding: 12px;
        text-decoration: none;
        transition: border-color 0.2s ease, transform 0.2s ease;
    }

    .ev-past-card:hover {
        border-color: var(--navy);
        transform: translateY(-2px);
    }

    .ev-past-card img {
        width: 76px;
        height: 76px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .ev-past-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.92rem;
        font-weight: 700;
        color: var(--navy);
        margin: 0 0 4px;
        line-height: 1.3;
    }

    .ev-past-date {
        font-size: 0.76rem;
        color: var(--ink-muted);
    }

    @media (max-width: 767px) {
        .ev-fact-strip {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 575px) {
        .ev-card {
            border-radius: 12px;
        }

        .ev-date-badge {
            top: 8px;
            left: 8px;
            width: 44px;
            border-radius: 8px;
        }

        .ev-date-month {
            font-size: 0.58rem;
        }

        .ev-date-day {
            font-size: 1rem;
        }

        .ev-body {
            padding: 12px;
        }

        .ev-title {
            font-size: 0.88rem;
            margin-bottom: 8px;
        }

        .ev-meta {
            font-size: 0.72rem;
            margin-bottom: 8px;
        }

        .ev-desc {
            font-size: 0.76rem;
        }

        .ev-foot {
            padding: 10px 12px;
        }

        .ev-link {
            font-size: 0.76rem;
        }

        .ev-past-card {
            flex-direction: column;
            align-items: flex-start;
            padding: 10px;
        }

        .ev-past-card img {
            width: 100%;
            height: 96px;
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
                <span class="is-current">Event Desa</span>
            </div>

            <h1 class="ed-page-title">
                Agenda &amp; Event <span class="serif-italic">Desa Sebong Lagoi.</span>
            </h1>
            <p class="ed-page-lead">
                Kalender kegiatan masyarakat, festival budaya, pameran produk UMKM, dan agenda resmi Pemerintah Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan.
            </p>

            <div class="ed-fact-strip ev-fact-strip">
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Agenda Mendatang</span>
                    <div class="ed-fact-value">{{ $events->total() }} Acara</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Arsip Acara</span>
                    <div class="ed-fact-value">{{ $pastEvents->count() }} Kegiatan</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Lokasi</span>
                    <div class="ed-fact-value">Teluk Sebong, Bintan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         01 / ACARA AKAN DATANG
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / Agenda Mendatang</span>
            </div>

            <div class="ed-section-head reveal">
                <div>
                    <span class="ed-kicker">Kalender Kegiatan</span>
                    <h2 class="ed-heading">
                        Acara <span class="serif-italic">Akan Datang</span> ({{ $events->total() }}).
                    </h2>
                </div>
                <a href="/artikel" class="ed-link-arrow">
                    Berita &amp; Artikel <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            @if($events->isNotEmpty())
                <div class="row g-3 g-md-4">
                    @foreach($events as $event)
                        <div class="col-6 col-md-6 col-lg-4 reveal">
                            <div class="ev-card">
                                <div class="ev-thumb">
                                    <img src="{{ $event->foto_event ? asset('storage/' . $event->foto_event) : asset('images/tentang-desa.jpg') }}"
                                         alt="{{ $event->nama_event }}">
                                    <div class="ev-date-badge">
                                        <div class="ev-date-month">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('M') }}</div>
                                        <div class="ev-date-day">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d') }}</div>
                                    </div>
                                </div>

                                <div class="ev-body">
                                    <h3 class="ev-title">
                                        <a href="{{ route('event.show', $event->slug) }}">{{ $event->nama_event }}</a>
                                    </h3>

                                    <div class="ev-meta">
                                        <div class="ev-meta-row">
                                            <i class="bi bi-calendar3"></i>
                                            <span>
                                                {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}
                                                @if($event->tanggal_mulai != $event->tanggal_selesai)
                                                    – {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d F Y') }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="ev-meta-row">
                                            <i class="bi bi-geo-alt-fill"></i>
                                            <span>{{ Str::limit($event->lokasi, 50) }}</span>
                                        </div>
                                    </div>

                                    <p class="ev-desc">{{ Str::limit(strip_tags($event->deskripsi), 100) }}</p>
                                </div>

                                <div class="ev-foot">
                                    <a href="{{ route('event.show', $event->slug) }}" class="ev-link">
                                        Detail Acara <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($events->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $events->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @else
                <div class="ed-empty-card reveal">
                    <div class="ed-empty-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <h3 class="ed-empty-title">Belum Ada Agenda Acara Terjadwal</h3>
                    <p class="ed-empty-desc">
                        Saat ini belum ada acara mendatang yang dijadwalkan. Pantau berita desa, galeri kegiatan, atau hubungi kantor desa untuk informasi agenda terbaru.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="/galeri" class="ed-btn-secondary">
                            Lihat Galeri Kegiatan
                        </a>
                        <a href="/kontak" class="ed-btn-primary">
                            Hubungi Kantor Desa <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- ====================================================
         02 / ARSIP ACARA SEBELUMNYA
         ==================================================== -->
    @if($pastEvents->isNotEmpty())
        <section class="ed-section">
            <div class="container ed-container">
                <div class="ed-section-divider" aria-hidden="true">
                    <span class="ed-divider-accent"></span>
                    <span class="ed-divider-line"></span>
                    <span class="ed-divider-index">02 / Arsip Acara</span>
                </div>

                <div class="ed-section-head reveal">
                    <div>
                        <span class="ed-kicker">Dokumentasi Agenda</span>
                        <h2 class="ed-heading" style="font-size: clamp(1.5rem, 2.6vw, 2rem);">
                            Acara <span class="serif-italic">Sebelumnya.</span>
                        </h2>
                    </div>
                </div>

                <div class="row g-3 g-md-4">
                    @foreach($pastEvents as $past)
                        <div class="col-6 col-md-4 reveal">
                            <a href="{{ route('event.show', $past->slug) }}" class="ev-past-card">
                                <img src="{{ $past->foto_event ? asset('storage/' . $past->foto_event) : asset('images/tentang-desa.jpg') }}"
                                     alt="{{ $past->nama_event }}">
                                <div>
                                    <h3 class="ev-past-title">{{ Str::limit($past->nama_event, 48) }}</h3>
                                    <div class="ev-past-date">
                                        <i class="bi bi-calendar2 me-1"></i>
                                        {{ \Carbon\Carbon::parse($past->tanggal_mulai)->translatedFormat('d M Y') }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
