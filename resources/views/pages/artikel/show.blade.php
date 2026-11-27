@extends('layouts.app')

@section('title', $artikel->judul . ' - Berita Desa Sebong Lagoi')
@section('meta_description', Str::limit(strip_tags($artikel->konten), 155))
@section('og_image', $artikel->foto_artikel ? asset('storage/' . $artikel->foto_artikel) : asset('images/logo-bintan.png'))
@section('og_type', 'article')
@section('minimal_footer', true)

@section('styles')
<style>
    .art-hero {
        background: var(--white);
        padding: 112px 0 36px;
        border-bottom: 1px solid var(--border-hairline);
    }

    .art-back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.84rem;
        font-weight: 600;
        color: var(--ink-muted);
        text-decoration: none;
        margin-bottom: 18px;
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .art-back-link:hover {
        color: var(--hot-pink);
        transform: translateX(-2px);
    }

    .art-crumb {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
        font-size: 0.78rem;
        color: var(--ink-muted);
        margin-bottom: 18px;
    }

    .art-crumb a {
        color: var(--ink-muted);
        text-decoration: none;
    }

    .art-crumb a:hover {
        color: var(--hot-pink);
    }

    .art-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.74rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--hot-pink);
        margin-bottom: 12px;
    }

    .art-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: clamp(1.75rem, 3.4vw, 2.65rem);
        font-weight: 800;
        line-height: 1.18;
        letter-spacing: -0.025em;
        color: var(--navy);
        margin: 0 0 18px;
        max-width: 900px;
    }

    .art-meta-strip {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px 20px;
        font-size: 0.84rem;
        color: var(--ink-muted);
    }

    .art-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .art-meta-item i {
        color: var(--hot-pink);
    }

    /* Main Reading Card & Static Sidebar */
    .art-reading-card {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 16px 40px rgba(15, 27, 61, 0.05);
    }

    .art-cover-frame {
        border-radius: 14px;
        overflow: hidden;
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        margin-bottom: 28px;
    }

    .art-cover-frame img {
        width: 100%;
        max-height: 480px;
        object-fit: cover;
        display: block;
    }

    .art-content {
        font-size: 1.02rem;
        line-height: 1.85;
        color: var(--ink-soft);
    }

    .art-content p {
        margin-bottom: 1.35rem;
    }

    .art-share-bar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-top: 32px;
        padding-top: 22px;
        border-top: 1px solid var(--border-hairline);
    }

    .art-share-label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.84rem;
        font-weight: 700;
        color: var(--navy);
    }

    .art-share-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
    }

    .art-share-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 999px;
        border: 1px solid var(--border-hairline);
        background: var(--bg-alt);
        color: var(--navy);
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
    }

    .art-share-btn:hover {
        background: var(--navy);
        border-color: var(--navy);
        color: var(--white);
    }

    .art-share-btn.is-wa:hover {
        background: #16a34a;
        border-color: #16a34a;
    }

    .art-share-status {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--hot-pink);
        display: none;
    }

    /* Strictly static sidebar so it never overlaps navbar or other sections */
    .art-sidebar-card {
        position: static;
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 20px;
        padding: 24px;
        height: auto;
    }

    .art-sidebar-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 14px;
        margin-bottom: 18px;
        border-bottom: 1px solid var(--border-hairline);
    }

    .art-sidebar-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--navy);
        margin: 0;
    }

    .art-latest-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .art-latest-item {
        padding-bottom: 14px;
        border-bottom: 1px solid var(--border-hairline);
    }

    .art-latest-item:last-child {
        padding-bottom: 0;
        border-bottom: none;
    }

    .art-latest-link {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        text-decoration: none;
    }

    .art-latest-thumb {
        width: 72px;
        height: 58px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
    }

    .art-latest-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem;
        font-weight: 700;
        line-height: 1.38;
        color: var(--navy);
        margin: 0 0 5px;
        transition: color 0.2s ease;
    }

    .art-latest-link:hover .art-latest-name {
        color: var(--hot-pink);
    }

    .art-latest-time {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.74rem;
        color: var(--ink-muted);
    }

    .art-sidebar-empty {
        font-size: 0.86rem;
        line-height: 1.6;
        color: var(--ink-muted);
        margin: 0 0 16px;
    }

    @media (max-width: 767px) {
        .art-hero {
            padding: 96px 0 28px;
        }

        .art-reading-card,
        .art-sidebar-card {
            padding: 20px;
            border-radius: 16px;
        }
    }
</style>
@endsection

@section('content')

    <!-- ====================================================
         EDITORIAL ARTICLE HEADER
         ==================================================== -->
    <section class="art-hero">
        <div class="container ed-container">
            <a href="{{ route('artikel.index') }}" class="art-back-link">
                <i class="bi bi-arrow-left"></i> Kembali ke Berita &amp; Artikel
            </a>

            <div class="art-crumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <a href="{{ route('artikel.index') }}">Berita &amp; Artikel</a>
                <span>/</span>
                <span class="text-truncate" style="max-width: 260px;">{{ $artikel->judul }}</span>
            </div>

            <span class="art-kicker">Berita &amp; Artikel Desa</span>
            <h1 class="art-title">{{ $artikel->judul }}</h1>

            <div class="art-meta-strip">
                <span class="art-meta-item">
                    <i class="bi bi-calendar3"></i>
                    <span>{{ \Carbon\Carbon::parse($artikel->created_at)->locale('id')->translatedFormat('l, d F Y') }}</span>
                </span>
                <span class="art-meta-item">
                    <i class="bi bi-eye"></i>
                    <span>{{ $artikel->views }} kali dibaca</span>
                </span>
                <span class="art-meta-item">
                    <i class="bi bi-geo-alt"></i>
                    <span>Desa Sebong Lagoi</span>
                </span>
            </div>
        </div>
    </section>

    <!-- ====================================================
         01 / ISI ARTIKEL & BERITA TERBARU (STATIC SIDEBAR)
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="row g-4 g-lg-5 align-items-start">
                {{-- Left: Article Body --}}
                <div class="col-lg-8">
                    <article class="art-reading-card">
                        <div class="art-cover-frame">
                            <img src="{{ $artikel->foto_artikel ? asset('storage/' . $artikel->foto_artikel) : asset('images/tentang-desa.jpg') }}"
                                 alt="{{ $artikel->judul }}">
                        </div>

                        <div class="art-content">
                            {!! nl2br(e($artikel->konten)) !!}
                        </div>

                        <div class="art-share-bar">
                            <span class="art-share-label">Bagikan Artikel:</span>
                            <div class="art-share-actions">
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($artikel->judul . ' - ' . url()->current()) }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="art-share-btn is-wa">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="art-share-btn">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                                <button type="button" id="artCopyLinkBtn" class="art-share-btn">
                                    <i class="bi bi-link-45deg"></i> Salin Tautan
                                </button>
                                <span id="artCopyStatus" class="art-share-status">Tautan disalin!</span>
                            </div>
                        </div>
                    </article>
                </div>

                {{-- Right: Static Sidebar (No sticky-top overlap) --}}
                <div class="col-lg-4">
                    <aside class="art-sidebar-card">
                        <div class="art-sidebar-head">
                            <h2 class="art-sidebar-title">Berita Terbaru</h2>
                            <a href="{{ route('artikel.index') }}" class="small fw-semibold text-decoration-none" style="color: var(--hot-pink);">
                                Semua <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>

                        @if($latest_artikels->isNotEmpty())
                            <ul class="art-latest-list">
                                @foreach($latest_artikels as $latest)
                                    <li class="art-latest-item">
                                        <a href="{{ route('artikel.show', $latest->slug) }}" class="art-latest-link">
                                            <img src="{{ $latest->foto_artikel ? asset('storage/' . $latest->foto_artikel) : asset('images/tentang-desa.jpg') }}"
                                                 class="art-latest-thumb"
                                                 alt="{{ $latest->judul }}">
                                            <div>
                                                <h3 class="art-latest-name">{{ Str::limit($latest->judul, 58) }}</h3>
                                                <span class="art-latest-time">
                                                    <i class="bi bi-clock"></i>
                                                    {{ \Carbon\Carbon::parse($latest->created_at)->locale('id')->diffForHumans() }}
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="art-sidebar-empty">
                                Belum ada berita terbaru lainnya. Jelajahi agenda desa dan direktori UMKM sembari menunggu liputan berikutnya.
                            </p>
                            <div class="d-grid gap-2">
                                <a href="{{ route('artikel.index') }}" class="ed-btn-secondary justify-content-center">
                                    Kembali ke Daftar Artikel
                                </a>
                                <a href="{{ route('event.index') }}" class="ed-btn-primary justify-content-center">
                                    Lihat Agenda Event <i class="bi bi-arrow-up-right"></i>
                                </a>
                            </div>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    (function () {
        const copyBtn = document.getElementById('artCopyLinkBtn');
        const statusEl = document.getElementById('artCopyStatus');
        if (!copyBtn || !statusEl) return;

        copyBtn.addEventListener('click', function () {
            navigator.clipboard.writeText(window.location.href).then(function () {
                statusEl.style.display = 'inline';
                setTimeout(function () {
                    statusEl.style.display = 'none';
                }, 2500);
            });
        });
    })();
</script>
@endsection
