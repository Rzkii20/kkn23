@extends('layouts.app')

@section('title', $event->nama_event . ' - Agenda Event Desa Sebong Lagoi')
@section('meta_description', Str::limit(strip_tags($event->deskripsi), 160))
@section('og_image', $event->foto_event ? asset('storage/' . $event->foto_event) : asset('images/logo-bintan.png'))
@section('og_type', 'event')
@section('minimal_footer', true)

@section('styles')
<style>
    .ev-detail-hero {
        background: var(--white);
        padding: 40px 0 56px;
        border-bottom: 1px solid var(--border-hairline);
    }

    .ev-detail-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--ink-muted);
        text-decoration: none;
        margin-bottom: 22px;
    }

    .ev-detail-back:hover {
        color: var(--navy);
    }

    .ev-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 300px;
        margin-bottom: 14px;
    }

    .ev-status-pill.is-upcoming {
        background: var(--hot-pink);
        color: var(--white);
    }

    .ev-status-pill.is-live {
        background: var(--navy);
        color: var(--white);
    }

    .ev-status-pill.is-done {
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        color: var(--ink-muted);
    }

    .ev-detail-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: clamp(2rem, 3.8vw, 3rem);
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.03em;
        color: var(--navy);
        margin: 0 0 16px;
        max-width: 820px;
    }

    .ev-detail-sub {
        display: flex;
        flex-wrap: wrap;
        gap: 12px 24px;
        font-size: 0.9rem;
        color: var(--ink-muted);
        margin-bottom: 28px;
    }

    .ev-detail-sub i {
        color: var(--hot-pink);
        margin-right: 6px;
    }

    .ev-detail-photo {
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        border-radius: 20px;
        padding: 10px;
    }

    .ev-detail-photo img {
        width: 100%;
        aspect-ratio: 21 / 9;
        object-fit: cover;
        border-radius: 14px;
        display: block;
    }

    .ev-reading-card {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 18px;
        padding: clamp(24px, 3.5vw, 36px);
    }

    .ev-reading-body {
        font-size: 0.96rem;
        color: var(--ink-muted);
        line-height: 1.85;
    }

    .ev-info-card {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 18px;
        padding: 24px;
    }

    .ev-info-row {
        padding: 14px 0;
        border-bottom: 1px solid var(--border-hairline);
    }

    .ev-info-row:first-of-type {
        padding-top: 6px;
    }

    .ev-info-row:last-of-type {
        border-bottom: none;
    }

    .ev-info-key {
        display: block;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--ink-muted);
        margin-bottom: 4px;
    }

    .ev-info-val {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.5;
    }

    @media (max-width: 767px) {
        .ev-detail-photo img {
            aspect-ratio: 16 / 10;
        }
    }
</style>
@endsection

@section('content')

    <!-- ====================================================
         HEADER & FOTO ACARA
         ==================================================== -->
    <section class="ev-detail-hero">
        <div class="container ed-container">
            <a href="{{ route('event.index') }}" class="ev-detail-back">
                <i class="bi bi-arrow-left"></i> Semua Agenda Acara
            </a>

            <div>
                @if($event->tanggal_selesai < now()->toDateString())
                    <span class="ev-status-pill is-done">Acara Selesai</span>
                @elseif($event->tanggal_mulai > now()->toDateString())
                    <span class="ev-status-pill is-upcoming">Akan Datang</span>
                @else
                    <span class="ev-status-pill is-live">Sedang Berlangsung</span>
                @endif
            </div>

            <h1 class="ev-detail-title">{{ $event->nama_event }}</h1>

            <div class="ev-detail-sub">
                <span>
                    <i class="bi bi-calendar-event"></i>
                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}
                    @if($event->tanggal_mulai != $event->tanggal_selesai)
                        – {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d F Y') }}
                    @endif
                </span>
                <span>
                    <i class="bi bi-geo-alt-fill"></i>
                    {{ $event->lokasi }}
                </span>
            </div>

            <div class="ev-detail-photo">
                <img src="{{ $event->foto_event ? asset('storage/' . $event->foto_event) : asset('images/tentang-desa.jpg') }}"
                     alt="{{ $event->nama_event }}">
            </div>
        </div>
    </section>

    <!-- ====================================================
         01 / PENJELASAN & INFORMASI ACARA
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / Rincian Acara</span>
            </div>

            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <div class="ev-reading-card">
                        <span class="ed-kicker">Deskripsi Kegiatan</span>
                        <h2 class="ed-heading mb-4" style="font-size: clamp(1.45rem, 2.4vw, 1.95rem);">
                            Tentang <span class="serif-italic">{{ $event->nama_event }}.</span>
                        </h2>
                        <div class="ev-reading-body">
                            {!! nl2br(e($event->deskripsi ?: 'Kegiatan resmi yang diselenggarakan di Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan.')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="ev-info-card">
                        <span class="ed-kicker">Informasi Acara</span>

                        <div class="ev-info-row">
                            <span class="ev-info-key">Tanggal Pelaksanaan</span>
                            <div class="ev-info-val">
                                {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('l, d F Y') }}
                                @if($event->tanggal_mulai != $event->tanggal_selesai)
                                    <br>s/d {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('l, d F Y') }}
                                @endif
                            </div>
                        </div>

                        <div class="ev-info-row">
                            <span class="ev-info-key">Lokasi Acara</span>
                            <div class="ev-info-val">{{ $event->lokasi }}</div>
                        </div>

                        <div class="ev-info-row">
                            <span class="ev-info-key">Status</span>
                            <div class="ev-info-val">
                                @if($event->tanggal_selesai < now()->toDateString())
                                    Acara Telah Selesai
                                @elseif($event->tanggal_mulai > now()->toDateString())
                                    Terjadwal / Akan Datang
                                @else
                                    Sedang Berlangsung
                                @endif
                            </div>
                        </div>

                        <div class="pt-3 d-flex flex-column gap-2">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($event->nama_event . ' - ' . url()->current()) }}"
                               target="_blank"
                               class="ed-btn-primary w-100 justify-content-center">
                                <i class="bi bi-whatsapp"></i> Bagikan ke WhatsApp
                            </a>
                            <button type="button"
                                    id="btnCopyEventLink"
                                    class="ed-btn-secondary w-100 justify-content-center">
                                <i class="bi bi-link-45deg"></i> Salin Tautan Acara
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         02 / ACARA MENARIK LAINNYA
         ==================================================== -->
    @if($otherEvents->isNotEmpty())
        <section class="ed-section">
            <div class="container ed-container">
                <div class="ed-section-divider" aria-hidden="true">
                    <span class="ed-divider-accent"></span>
                    <span class="ed-divider-line"></span>
                    <span class="ed-divider-index">02 / Agenda Lainnya</span>
                </div>

                <div class="ed-section-head">
                    <div>
                        <span class="ed-kicker">Agenda Lainnya</span>
                        <h2 class="ed-heading" style="font-size: clamp(1.45rem, 2.5vw, 2rem);">
                            Acara Menarik <span class="serif-italic">Lainnya.</span>
                        </h2>
                    </div>
                    <a href="{{ route('event.index') }}" class="ed-link-arrow">
                        Semua Event <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @foreach($otherEvents as $other)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('event.show', $other->slug) }}" class="text-decoration-none">
                                <div class="ed-event-card h-100">
                                    <span class="ed-event-date">{{ \Carbon\Carbon::parse($other->tanggal_mulai)->translatedFormat('d M Y') }}</span>
                                    <h3 class="ed-event-title">{{ Str::limit($other->nama_event, 48) }}</h3>
                                    <p class="ed-event-loc"><i class="bi bi-geo-alt me-1"></i>{{ $other->lokasi }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection

@section('scripts')
<script>
    const copyEventBtn = document.getElementById('btnCopyEventLink');
    if (copyEventBtn) {
        copyEventBtn.addEventListener('click', function () {
            navigator.clipboard.writeText(window.location.href).then(function () {
                alert('Tautan acara berhasil disalin!');
            });
        });
    }
</script>
@endsection
