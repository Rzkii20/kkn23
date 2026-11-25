@extends('layouts.app')

@section('title', 'Galeri Desa - Sebong Lagoi')
@section('minimal_footer', true)

@section('styles')
<style>
    .gal-page {
        padding: 112px 0 80px;
        background: var(--white);
        min-height: 75vh;
    }

    /* Archive Header */
    .gal-header {
        margin-bottom: 36px;
    }

    .gal-kicker {
        display: block;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--ink-muted);
        margin-bottom: 10px;
    }

    .gal-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: clamp(2.8rem, 6vw, 4.6rem);
        font-weight: 800;
        line-height: 0.96;
        letter-spacing: -0.03em;
        text-transform: uppercase;
        color: var(--navy);
        margin: 0 0 18px;
    }

    .gal-dot {
        color: var(--hot-pink);
    }

    .gal-desc {
        font-size: 0.94rem;
        color: var(--ink-muted);
        line-height: 1.65;
        max-width: 560px;
        margin: 0;
    }

    /* Minimalist Sort & Count Toolbar */
    .gal-toolbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px 20px;
        padding-bottom: 22px;
        margin-bottom: 28px;
        border-bottom: 1px solid var(--border-hairline);
    }

    .gal-sort-form {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }

    .gal-sort-label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--ink-muted);
        margin: 0;
    }

    .gal-sort-select {
        border: none;
        background: transparent;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--navy);
        padding: 4px 22px 4px 2px;
        cursor: pointer;
        outline: none;
    }

    .gal-sort-select:focus {
        color: var(--hot-pink);
    }

    .gal-count {
        font-size: 0.82rem;
        font-weight: 500;
        color: var(--ink-muted);
    }

    /* Pinterest-Style CSS Column Masonry */
    .gal-masonry {
        column-count: 4;
        column-gap: 20px;
    }

    @media (max-width: 1199px) {
        .gal-masonry {
            column-count: 3;
        }
    }

    @media (max-width: 767px) {
        .gal-masonry {
            column-count: 2;
            column-gap: 12px;
        }
    }

    @media (max-width: 575px) {
        .gal-pin {
            margin-bottom: 12px;
            border-radius: 12px;
        }

        .gal-pin-rest {
            padding: 12px;
        }

        .gal-pin-rest-title {
            font-size: 0.74rem;
        }
    }

    .gal-pin {
        break-inside: avoid;
        -webkit-column-break-inside: avoid;
        margin-bottom: 20px;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        box-shadow: 0 8px 24px rgba(15, 27, 61, 0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .gal-pin:hover {
        transform: translateY(-4px);
        border-color: var(--navy);
        box-shadow: 0 18px 40px rgba(15, 27, 61, 0.14);
    }

    .gal-pin-trigger {
        display: block;
        width: 100%;
        border: none;
        padding: 0;
        margin: 0;
        background: transparent;
        text-align: left;
        cursor: zoom-in;
        position: relative;
    }

    .gal-pin-img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.55s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .gal-pin:hover .gal-pin-img {
        transform: scale(1.04);
    }

    /* Resting subtle bottom caption */
    .gal-pin-rest {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(15, 27, 61, 0) 56%, rgba(15, 27, 61, 0.78) 100%);
        display: flex;
        align-items: flex-end;
        padding: 18px;
        transition: opacity 0.28s ease;
        pointer-events: none;
    }

    .gal-pin-rest-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.84rem;
        font-weight: 800;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        color: var(--white);
        line-height: 1.3;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .gal-pin:hover .gal-pin-rest {
        opacity: 0;
    }

    /* Hover Editorial Overlay */
    .gal-pin-hover {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(15, 27, 61, 0.16) 0%, rgba(15, 27, 61, 0.92) 78%, rgba(9, 18, 43, 0.96) 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.28s ease;
        pointer-events: none;
    }

    .gal-pin:hover .gal-pin-hover,
    .gal-pin-trigger:focus-visible .gal-pin-hover {
        opacity: 1;
    }

    .gal-pin-badge {
        display: inline-block;
        align-self: flex-start;
        background: var(--hot-pink);
        color: var(--white);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 999px;
        margin-bottom: 10px;
    }

    .gal-pin-hover-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.96rem;
        font-weight: 800;
        letter-spacing: 0.01em;
        text-transform: uppercase;
        color: var(--white);
        line-height: 1.3;
        margin: 0 0 14px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .gal-pin-hover-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 10px;
        border-top: 1px solid rgba(255, 255, 255, 0.22);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        color: rgba(255, 255, 255, 0.85);
    }

    .gal-pin-view {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: var(--hot-pink);
        text-transform: uppercase;
    }

    /* Video Pin */
    .gal-video-caption {
        padding: 14px 16px;
        background: var(--white);
        border-top: 1px solid var(--border-hairline);
    }

    .gal-video-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--navy);
        margin: 0 0 6px;
        line-height: 1.35;
    }

    .gal-video-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.74rem;
        color: var(--ink-muted);
    }

    /* Split-Card Lightbox Modal */
    #galeriLightboxModal.show {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        background: rgba(15, 27, 61, 0.28);
    }

    .gal-lb-dialog {
        max-width: min(92vw, 940px);
    }

    .gal-lb-content {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 22px;
        overflow: hidden;
        color: var(--ink);
        box-shadow: 0 28px 80px rgba(15, 27, 61, 0.18);
    }

    .gal-lb-grid {
        display: grid;
        grid-template-columns: 1.35fr 1fr;
        min-height: 480px;
    }

    .gal-lb-media {
        position: relative;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 26px;
    }

    .gal-lb-img {
        max-width: 100%;
        max-height: 70vh;
        width: auto;
        height: auto;
        border-radius: 14px;
        object-fit: contain;
        box-shadow: 0 16px 40px rgba(15, 27, 61, 0.14);
    }

    .gal-lb-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 38px;
        height: 38px;
        border-radius: 50%;
        border: 1px solid var(--border-hairline);
        background: rgba(255, 255, 255, 0.94);
        color: var(--navy);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(15, 27, 61, 0.12);
        transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
    }

    .gal-lb-nav:hover {
        background: var(--hot-pink);
        border-color: var(--hot-pink);
        color: var(--white);
    }

    .gal-lb-nav.prev {
        left: 14px;
    }

    .gal-lb-nav.next {
        right: 14px;
    }

    .gal-lb-info {
        background: var(--white);
        border-left: 1px solid var(--border-hairline);
        padding: 26px 28px 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 24px;
    }

    .gal-lb-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
    }

    .gal-lb-close {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1px solid var(--border-hairline);
        background: var(--white);
        color: var(--navy);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        cursor: pointer;
        flex-shrink: 0;
        transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
    }

    .gal-lb-close:hover {
        background: var(--navy);
        border-color: var(--navy);
        color: var(--white);
    }

    .gal-lb-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.38rem;
        font-weight: 800;
        line-height: 1.24;
        letter-spacing: -0.02em;
        text-transform: uppercase;
        color: var(--navy);
        margin: 0 0 10px;
    }

    .gal-lb-date {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--ink-muted);
    }

    .gal-lb-divider {
        border: 0;
        border-top: 1px solid var(--border-hairline);
        margin: 18px 0;
    }

    .gal-lb-desc-label {
        display: block;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--ink-muted);
        margin-bottom: 8px;
    }

    .gal-lb-desc {
        font-size: 0.86rem;
        line-height: 1.68;
        color: var(--ink-soft);
        margin: 0;
    }

    .gal-lb-foot {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 16px;
        border-top: 1px solid var(--border-hairline);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.72rem;
    }

    .gal-lb-archive {
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--ink-muted);
    }

    .gal-lb-counter {
        font-weight: 800;
        color: var(--navy);
    }

    @media (max-width: 767px) {
        .gal-lb-grid {
            grid-template-columns: 1fr;
            min-height: auto;
        }

        .gal-lb-media {
            padding: 18px;
        }

        .gal-lb-img {
            max-height: 46vh;
        }

        .gal-lb-info {
            border-left: none;
            border-top: 1px solid var(--border-hairline);
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
    <section class="gal-page">
        <div class="container ed-container">

            {{-- SWISS ARCHIVE HEADER --}}
            <div class="gal-header reveal">
                <span class="gal-kicker">THE ARCHIVE</span>
                <h1 class="gal-title">GALLERY<span class="gal-dot">.</span></h1>
                <p class="gal-desc">
                    Jelajahi galeri arsip dokumentasi Desa Sebong Lagoi. Temukan momen kegiatan masyarakat, keindahan pesisir, geliat UMKM, serta kebersamaan warga.
                </p>
            </div>

            {{-- SORT & COUNT TOOLBAR --}}
            <div class="gal-toolbar reveal">
                <form method="GET" action="{{ route('galeri.index') }}" class="gal-sort-form">
                    <label for="galSortSelect" class="gal-sort-label">Urutkan:</label>
                    <select id="galSortSelect" name="sort" class="gal-sort-select" onchange="this.form.submit()">
                        <option value="terbaru" {{ $sort === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ $sort === 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </form>

                <div class="gal-count">
                    {{ $galeris->total() }} dokumentasi
                </div>
            </div>

            {{-- PINTEREST MASONRY GRID --}}
            @if($galeris->isNotEmpty())
                @php $photoIndex = 0; @endphp
                <div class="gal-masonry">
                    @foreach($galeris as $item)
                        @if($item->tipe === 'foto')
                            @php
                                $imgSrc = asset('storage/' . $item->file_path);
                                $dateLabel = $item->created_at ? $item->created_at->format('d/m/Y') : '-';
                                $dateLong = $item->created_at ? \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d F Y') : '-';
                                $descText = !empty($item->deskripsi)
                                    ? $item->deskripsi
                                    : 'Arsip dokumentasi visual kegiatan masyarakat dan potensi di Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan: ' . $item->judul . '.';
                            @endphp
                            <article class="gal-pin reveal">
                                <button type="button"
                                        class="gal-pin-trigger"
                                        data-gal-index="{{ $photoIndex }}"
                                        data-gal-src="{{ $imgSrc }}"
                                        data-gal-title="{{ $item->judul }}"
                                        data-gal-date="{{ $dateLabel }}"
                                        data-gal-date-long="{{ $dateLong }}"
                                        data-gal-desc="{{ $descText }}"
                                        aria-label="Lihat foto {{ $item->judul }}">
                                    <img src="{{ $imgSrc }}"
                                         class="gal-pin-img"
                                         alt="{{ $item->judul }}"
                                         loading="lazy">

                                    <div class="gal-pin-rest">
                                        <h2 class="gal-pin-rest-title">{{ $item->judul }}</h2>
                                    </div>

                                    <div class="gal-pin-hover">
                                        <span class="gal-pin-badge">Dokumentasi Foto</span>
                                        <h2 class="gal-pin-hover-title">{{ $item->judul }}</h2>
                                        <div class="gal-pin-hover-meta">
                                            <span>{{ $dateLabel }}</span>
                                            <span class="gal-pin-view">VIEW <i class="bi bi-arrows-angle-expand"></i></span>
                                        </div>
                                    </div>
                                </button>
                            </article>
                            @php $photoIndex++; @endphp
                        @else
                            <article class="gal-pin reveal">
                                <div class="ratio ratio-16x9 bg-dark">
                                    <iframe src="{{ str_replace('watch?v=', 'embed/', $item->file_path) }}"
                                            title="{{ $item->judul }}"
                                            allowfullscreen></iframe>
                                </div>
                                <div class="gal-video-caption">
                                    <h2 class="gal-video-title">{{ $item->judul }}</h2>
                                    <div class="gal-video-meta">
                                        <span class="gal-pin-badge mb-0">Video</span>
                                        <span>{{ $item->created_at ? $item->created_at->format('d/m/Y') : '-' }}</span>
                                    </div>
                                </div>
                            </article>
                        @endif
                    @endforeach
                </div>

                @if($galeris->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $galeris->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @else
                <div class="ed-empty-card reveal">
                    <div class="ed-empty-icon">
                        <i class="bi bi-images"></i>
                    </div>
                    <h3 class="ed-empty-title">Belum Ada Media Galeri</h3>
                    <p class="ed-empty-desc">
                        Dokumentasi foto dan video kegiatan Desa Sebong Lagoi akan tampil di arsip ini setelah diunggah oleh admin desa.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('home') }}" class="ed-btn-primary">
                            Kembali ke Beranda <i class="bi bi-arrow-up-right"></i>
                        </a>
                        <a href="{{ route('wisata.index') }}" class="ed-btn-secondary">
                            Jelajahi Wisata
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </section>

    {{-- LIGHTBOX MODAL --}}
    <div class="modal fade" id="galeriLightboxModal" tabindex="-1" aria-labelledby="galeriLightboxTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered gal-lb-dialog">
            <div class="modal-content gal-lb-content">
                <div class="gal-lb-grid">
                    {{-- Left Pane: Foto --}}
                    <div class="gal-lb-media">
                        <button type="button" class="gal-lb-nav prev" id="galLbPrev" aria-label="Foto sebelumnya">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <img id="galeriLightboxImg" src="" alt="" class="gal-lb-img">
                        <button type="button" class="gal-lb-nav next" id="galLbNext" aria-label="Foto berikutnya">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>

                    {{-- Right Pane: Detail Keterangan --}}
                    <div class="gal-lb-info">
                        <div>
                            <div class="gal-lb-top">
                                <span class="gal-pin-badge mb-0">Dokumentasi Foto</span>
                                <button type="button" class="gal-lb-close" data-bs-dismiss="modal" aria-label="Tutup">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>

                            <h2 class="gal-lb-title" id="galeriLightboxTitle"></h2>

                            <div class="gal-lb-date">
                                <i class="bi bi-calendar3"></i>
                                <span id="galeriLightboxDate"></span>
                            </div>

                            <hr class="gal-lb-divider">

                            <span class="gal-lb-desc-label">Keterangan</span>
                            <p class="gal-lb-desc" id="galeriLightboxDesc"></p>
                        </div>

                        <div class="gal-lb-foot">
                            <span class="gal-lb-archive">SEBONG LAGOI ARCHIVE</span>
                            <span class="gal-lb-counter" id="galeriLightboxCounter"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    (function () {
        const triggers = Array.from(document.querySelectorAll('.gal-pin-trigger'));
        const modalEl = document.getElementById('galeriLightboxModal');
        if (!triggers.length || !modalEl) return;

        const imgEl = document.getElementById('galeriLightboxImg');
        const titleEl = document.getElementById('galeriLightboxTitle');
        const dateEl = document.getElementById('galeriLightboxDate');
        const descEl = document.getElementById('galeriLightboxDesc');
        const counterEl = document.getElementById('galeriLightboxCounter');
        const prevBtn = document.getElementById('galLbPrev');
        const nextBtn = document.getElementById('galLbNext');

        const items = triggers.map((btn) => ({
            src: btn.dataset.galSrc,
            title: btn.dataset.galTitle,
            dateLong: btn.dataset.galDateLong || btn.dataset.galDate,
            desc: btn.dataset.galDesc || '',
        }));

        let currentIndex = 0;
        let bsModal = null;

        function renderSlide(idx) {
            currentIndex = (idx + items.length) % items.length;
            const item = items[currentIndex];
            imgEl.src = item.src;
            imgEl.alt = item.title;
            titleEl.textContent = item.title;
            dateEl.textContent = item.dateLong;
            descEl.textContent = item.desc;
            counterEl.textContent = (currentIndex + 1) + ' / ' + items.length;

            const showNav = items.length > 1;
            prevBtn.style.display = showNav ? 'inline-flex' : 'none';
            nextBtn.style.display = showNav ? 'inline-flex' : 'none';
        }

        triggers.forEach((btn, idx) => {
            btn.addEventListener('click', function () {
                renderSlide(idx);
                if (!bsModal) {
                    bsModal = new bootstrap.Modal(modalEl);
                }
                bsModal.show();
            });
        });

        prevBtn.addEventListener('click', function () {
            renderSlide(currentIndex - 1);
        });

        nextBtn.addEventListener('click', function () {
            renderSlide(currentIndex + 1);
        });

        document.addEventListener('keydown', function (e) {
            if (!modalEl.classList.contains('show')) return;
            if (e.key === 'ArrowLeft') renderSlide(currentIndex - 1);
            if (e.key === 'ArrowRight') renderSlide(currentIndex + 1);
        });
    })();
</script>
@endsection
