@extends('layouts.app')

@section('title', 'Dokumen & Administrasi - Pemerintah Desa Sebong Lagoi')
@section('minimal_footer', true)

@section('styles')
<style>
    .doc-fact-strip {
        grid-template-columns: repeat(3, 1fr);
        max-width: 780px;
    }

    /* Filter bar */
    .doc-filter-bar {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 14px;
        padding: 14px 18px;
        margin-bottom: 32px;
    }

    .doc-select {
        border: 1px solid var(--border-hairline);
        border-radius: 10px;
        font-size: 0.86rem;
        color: var(--navy);
        background-color: var(--bg-alt);
        padding: 8px 32px 8px 12px;
        min-width: 170px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .doc-select:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(15, 27, 61, 0.08);
        background-color: var(--white);
    }

    .doc-reset-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 999px;
        border: 1px solid var(--border-hairline);
        background: var(--white);
        color: var(--navy);
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: border-color 0.2s ease, color 0.2s ease;
    }

    .doc-reset-btn:hover {
        border-color: var(--hot-pink);
        color: var(--hot-pink);
    }

    /* Category heading */
    .doc-cat-block {
        margin-bottom: 44px;
    }

    .doc-cat-block:last-child {
        margin-bottom: 0;
    }

    .doc-cat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-hairline);
    }

    .doc-cat-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .doc-cat-badge {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: var(--navy);
        color: var(--white);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }

    .doc-cat-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--navy);
        margin: 0;
    }

    .doc-cat-count {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--ink-muted);
        background: var(--white);
        border: 1px solid var(--border-hairline);
        padding: 5px 12px;
        border-radius: 999px;
    }

    /* Document cards */
    .doc-card {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 16px;
        padding: 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        transition: border-color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    }

    .doc-card:hover {
        border-color: var(--navy);
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(15, 27, 61, 0.08);
    }

    .doc-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1.25rem;
    }

    .doc-icon-box.is-pdf {
        background: rgba(255, 61, 139, 0.09);
        color: var(--hot-pink);
    }

    .doc-icon-box.is-xlsx {
        background: rgba(16, 124, 65, 0.09);
        color: #107c41;
    }

    .doc-icon-box.is-docx {
        background: rgba(15, 27, 61, 0.08);
        color: var(--navy);
    }

    .doc-icon-box.is-other {
        background: var(--bg-alt);
        color: var(--ink-muted);
    }

    .doc-meta-pill {
        display: inline-block;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--ink-muted);
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        padding: 3px 9px;
        border-radius: 999px;
        margin-bottom: 8px;
    }

    .doc-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.98rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.38;
        margin: 0;
    }

    .doc-desc {
        font-size: 0.84rem;
        color: var(--ink-muted);
        line-height: 1.6;
        margin: 14px 0 0;
    }

    .doc-card-foot {
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid var(--border-hairline);
    }

    .doc-read-btn {
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 16px;
        border: none;
        border-radius: 999px;
        background: var(--navy);
        color: var(--white);
        font-size: 0.84rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .doc-read-btn:hover {
        background: var(--hot-pink);
        color: var(--white);
    }

    .doc-protect-note {
        display: block;
        text-align: center;
        margin-top: 9px;
        font-size: 0.72rem;
        color: var(--ink-muted);
    }

    /* Viewer modal */
    .doc-modal-header {
        background: var(--navy);
        color: var(--white);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .doc-modal-badge {
        display: inline-block;
        font-size: 0.68rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.72);
        background: rgba(255, 255, 255, 0.1);
        padding: 3px 9px;
        border-radius: 999px;
        margin-top: 3px;
    }

    .doc-page-indicator {
        font-size: 0.76rem;
        font-weight: 600;
        color: var(--white);
        background: rgba(255, 255, 255, 0.14);
        padding: 5px 10px;
        border-radius: 999px;
    }

    .viewer-modal-body {
        position: relative;
        height: 75vh;
        overflow-y: auto;
        background-color: #1E2433;
        padding: 24px 12px;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }

    .pdf-page-wrapper {
        position: relative;
        background-color: #ffffff;
        margin: 0 auto 20px auto;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
        border-radius: 4px;
        overflow: hidden;
        max-width: 100%;
    }

    .pdf-page-wrapper canvas {
        display: block;
        width: 100% !important;
        height: auto !important;
        pointer-events: none;
    }

    .pdf-watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-35deg);
        font-size: clamp(1.2rem, 3vw, 2.2rem);
        font-weight: 800;
        color: rgba(15, 27, 61, 0.07);
        pointer-events: none;
        white-space: nowrap;
        text-transform: uppercase;
        letter-spacing: 4px;
    }

    /* EXCEL STYLING */
    .excel-container {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
        overflow: hidden;
        margin: 0 auto;
        max-width: 100%;
    }

    .excel-tabs-bar {
        background: #172038;
        padding: 8px 12px 0;
        display: flex;
        gap: 4px;
        overflow-x: auto;
        border-bottom: 2px solid var(--hot-pink);
    }

    .excel-tab-btn {
        background: #28334e;
        color: #cbd5e1;
        border: none;
        padding: 6px 16px;
        border-radius: 6px 6px 0 0;
        font-size: 0.8rem;
        cursor: pointer;
        white-space: nowrap;
        transition: background 0.2s, color 0.2s;
    }

    .excel-tab-btn:hover {
        background: #364466;
        color: #ffffff;
    }

    .excel-tab-btn.active {
        background: var(--navy);
        color: #ffffff;
        font-weight: 700;
    }

    .excel-table-scroll {
        max-height: 65vh;
        overflow: auto;
        padding: 16px;
    }

    .excel-table-scroll table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
        background: #ffffff;
    }

    .excel-table-scroll th,
    .excel-table-scroll td {
        border: 1px solid #dee2e6;
        padding: 6px 10px;
        white-space: nowrap;
    }

    .excel-table-scroll tr:first-child td,
    .excel-table-scroll th {
        background: #f1f5f9;
        font-weight: 600;
        color: var(--navy);
    }

    /* WORD STYLING */
    .docx-wrapper {
        background: transparent !important;
        padding: 0 !important;
    }

    .docx-wrapper > section.docx {
        background: #ffffff !important;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35) !important;
        margin: 0 auto 20px auto !important;
        border-radius: 4px !important;
        padding: 40px !important;
        max-width: 850px !important;
    }

    @media (max-width: 767px) {
        .doc-fact-strip {
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
                <span>Informasi</span>
                <span>/</span>
                <span class="is-current">Dokumen &amp; Administrasi</span>
            </div>

            <h1 class="ed-page-title">
                Dokumen &amp; Administrasi <span class="serif-italic">Desa Sebong Lagoi.</span>
            </h1>
            <p class="ed-page-lead">
                Arsip dokumen resmi, peraturan, laporan, dan administrasi Pemerintah Desa Sebong Lagoi yang dapat dibaca secara daring oleh masyarakat.
            </p>

            <div class="ed-fact-strip doc-fact-strip">
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Total Dokumen</span>
                    <div class="ed-fact-value">{{ $dokumens->count() }} Berkas</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Kategori Arsip</span>
                    <div class="ed-fact-value">{{ $kategoris->count() }} Kategori</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Mode Akses</span>
                    <div class="ed-fact-value">Baca Daring · Terlindungi</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         01 / ARSIP DOKUMEN PUBLIK
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / ARSIP DOKUMEN PUBLIK</span>
            </div>

            <div class="ed-section-head reveal">
                <div>
                    <span class="ed-kicker">Transparansi Publik</span>
                    <h2 class="ed-heading">
                        Arsip <span class="serif-italic">Dokumen Resmi</span> ({{ $dokumens->count() }}).
                    </h2>
                </div>
                <a href="{{ route('about') }}" class="ed-link-arrow">
                    Profil Desa <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            {{-- FILTER BAR --}}
            <div class="doc-filter-bar reveal">
                <form method="GET" action="{{ route('dokumen.index') }}" class="row g-2 align-items-center">
                    <div class="col-12 col-sm-auto">
                        <select name="kategori" class="form-select form-select-sm doc-select" aria-label="Filter kategori dokumen" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat }}" {{ request('kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-sm-auto">
                        <select name="tahun" class="form-select form-select-sm doc-select" aria-label="Filter tahun dokumen" onchange="this.form.submit()">
                            <option value="">Semua Tahun</option>
                            @foreach($tahuns as $th)
                                <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(request('kategori') || request('tahun'))
                        <div class="col-auto">
                            <a href="{{ route('dokumen.index') }}" class="doc-reset-btn">
                                <i class="bi bi-x-lg"></i> Reset Filter
                            </a>
                        </div>
                    @endif
                    <div class="col-12 col-sm ms-sm-auto text-sm-end">
                        <span class="small" style="color: var(--ink-muted);">
                            Menampilkan <strong style="color: var(--navy);">{{ $dokumens->count() }}</strong> dokumen
                        </span>
                    </div>
                </form>
            </div>

            {{-- DAFTAR DOKUMEN --}}
            @if($dokumens->isEmpty())
                @if(request('kategori') || request('tahun'))
                    <div class="ed-empty-card reveal">
                        <div class="ed-empty-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h3 class="ed-empty-title">Dokumen Tidak Ditemukan</h3>
                        <p class="ed-empty-desc">
                            Tidak ada arsip dokumen yang sesuai dengan filter kategori atau tahun yang dipilih. Atur ulang filter untuk melihat seluruh daftar dokumen publik.
                        </p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="{{ route('dokumen.index') }}" class="ed-btn-primary">
                                Tampilkan Semua Dokumen <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="ed-empty-card reveal">
                        <div class="ed-empty-icon">
                            <i class="bi bi-folder2-open"></i>
                        </div>
                        <h3 class="ed-empty-title">Belum Ada Dokumen Tersedia</h3>
                        <p class="ed-empty-desc">
                            Dokumen resmi, peraturan desa, dan arsip administrasi akan ditampilkan di halaman ini setelah dipublikasikan oleh Pemerintah Desa Sebong Lagoi.
                        </p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="{{ route('about') }}" class="ed-btn-primary">
                                Lihat Profil Desa <i class="bi bi-arrow-up-right"></i>
                            </a>
                            <a href="{{ route('kontak') }}" class="ed-btn-secondary">
                                Hubungi Pemerintah Desa
                            </a>
                        </div>
                    </div>
                @endif
            @else
                @foreach($dokumens->groupBy('kategori') as $kategori => $items)
                    <div class="doc-cat-block">
                        <div class="doc-cat-header reveal">
                            <div class="doc-cat-left">
                                <span class="doc-cat-badge">
                                    <i class="bi bi-folder-fill"></i>
                                </span>
                                <h3 class="doc-cat-title">{{ $kategori }}</h3>
                            </div>
                            <span class="doc-cat-count">{{ $items->count() }} dokumen</span>
                        </div>

                        <div class="row g-4">
                            @foreach($items as $dokumen)
                                @php
                                    $ext = strtoupper(pathinfo($dokumen->file_dokumen, PATHINFO_EXTENSION));
                                    $isPdf = in_array($ext, ['PDF']);
                                    $isWord = in_array($ext, ['DOC', 'DOCX']);
                                    $isExcel = in_array($ext, ['XLS', 'XLSX', 'CSV']);
                                    $toneClass = $isPdf ? 'is-pdf' : ($isExcel ? 'is-xlsx' : ($isWord ? 'is-docx' : 'is-other'));
                                    $iconName = $isPdf ? 'filetype-pdf' : ($isExcel ? 'filetype-xlsx' : ($isWord ? 'filetype-docx' : 'file-earmark-text'));
                                @endphp
                                <div class="col-md-6 col-lg-4 reveal">
                                    <div class="doc-card">
                                        <div>
                                            <div class="d-flex align-items-start gap-3">
                                                <div class="doc-icon-box {{ $toneClass }}">
                                                    <i class="bi bi-{{ $iconName }}"></i>
                                                </div>
                                                <div>
                                                    <span class="doc-meta-pill">{{ $ext ?: 'FILE' }} &bull; {{ $dokumen->tahun }}</span>
                                                    <h4 class="doc-title">{{ $dokumen->judul }}</h4>
                                                </div>
                                            </div>

                                            @if($dokumen->deskripsi)
                                                <p class="doc-desc">{{ Str::limit($dokumen->deskripsi, 110) }}</p>
                                            @endif
                                        </div>

                                        <div class="doc-card-foot">
                                            <button type="button"
                                                    class="doc-read-btn"
                                                    data-url="{{ route('dokumen.lihat', $dokumen->id) }}"
                                                    data-title="{{ $dokumen->judul }}"
                                                    data-ext="{{ $ext }}">
                                                <i class="bi bi-eye"></i> Baca Dokumen
                                            </button>
                                            <span class="doc-protect-note">
                                                <i class="bi bi-shield-lock me-1"></i>Hanya baca &bull; Dilindungi dari unduhan
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    {{-- MODAL VIEWER DOKUMEN (UNIVERSAL READ-ONLY: PDF, EXCEL, WORD) --}}
    <div class="modal fade" id="docViewerModal" tabindex="-1" aria-labelledby="docViewerModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                {{-- HEADER TOOLBAR --}}
                <div class="modal-header doc-modal-header py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2 overflow-hidden" style="max-width: 55%;">
                        <i class="bi bi-file-earmark-text fs-5 flex-shrink-0" style="color: var(--hot-pink);"></i>
                        <div class="overflow-hidden">
                            <h6 class="modal-title fw-bold mb-0 text-truncate text-white" id="docViewerModalLabel" style="font-size: 0.95rem;">
                                Memuat Dokumen...
                            </h6>
                            <span class="doc-modal-badge">
                                <i class="bi bi-shield-lock me-1"></i>Penampil Dokumen Aman (Hanya Baca)
                            </span>
                        </div>
                    </div>

                    {{-- CONTROLS --}}
                    <div class="d-flex align-items-center gap-2">
                        <span id="pageIndicator" class="doc-page-indicator">
                            Memuat...
                        </span>
                        <div id="pdfControls" class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="zoomOut()" title="Perkecil">
                                <i class="bi bi-zoom-out"></i>
                            </button>
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="resetZoom()" title="Ukuran Normal">
                                100%
                            </button>
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="zoomIn()" title="Perbesar">
                                <i class="bi bi-zoom-in"></i>
                            </button>
                        </div>
                        <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>

                {{-- VIEWER CONTAINER BODY --}}
                <div class="viewer-modal-body" id="viewerContainer" oncontextmenu="return false;">
                    <div id="viewerLoading" class="d-flex flex-column align-items-center justify-content-center py-5 text-white">
                        <div class="spinner-border mb-3" style="color: var(--hot-pink);" role="status"></div>
                        <span class="fw-semibold">Sedang merender isi dokumen...</span>
                        <small class="text-white-50 mt-1">Harap tunggu sebentar</small>
                    </div>
                    <div id="viewerError" class="d-none p-4 text-center"></div>

                    {{-- Container for PDF canvas --}}
                    <div id="pdfPagesContainer" class="d-flex flex-column align-items-center"></div>

                    {{-- Container for Excel sheets --}}
                    <div id="excelContainer" class="d-none excel-container">
                        <div id="excelTabsBar" class="excel-tabs-bar"></div>
                        <div id="excelTableScroll" class="excel-table-scroll"></div>
                    </div>

                    {{-- Container for Word docx --}}
                    <div id="docxContainer" class="d-none"></div>
                </div>

                {{-- FOOTER --}}
                <div class="modal-footer bg-white py-2 px-4 d-flex justify-content-between align-items-center border-top">
                    <small style="font-size: 0.8rem; color: var(--ink-muted);">
                        <i class="bi bi-shield-check text-success me-1"></i>Dokumen resmi Desa Sebong Lagoi. Dilindungi hak cipta.
                    </small>
                    <button type="button" class="btn btn-sm px-4 text-white" data-bs-dismiss="modal" style="background: var(--navy); border-radius: 999px;">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
{{-- 1. PDF.js for Canvas PDF rendering --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

{{-- 2. SheetJS for Excel rendering to HTML tables --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

{{-- 3. docx-preview for Word docx rendering --}}
<script src="https://unpkg.com/docx-preview@0.3.3/dist/docx-preview.min.js"></script>

<script>
    if (typeof pdfjsLib !== 'undefined') {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    }

    let currentPdfDoc = null;
    let currentScale = 1.3;
    let currentWorkbook = null;

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.doc-read-btn');
        if (!btn) return;
        openViewer(btn.dataset.url, btn.dataset.title, btn.dataset.ext);
    });

    async function openViewer(url, title, ext) {
        const modalEl = document.getElementById('docViewerModal');
        const modalTitle = document.getElementById('docViewerModalLabel');
        const pdfContainer = document.getElementById('pdfPagesContainer');
        const excelContainer = document.getElementById('excelContainer');
        const docxContainer = document.getElementById('docxContainer');
        const loading = document.getElementById('viewerLoading');
        const errorBox = document.getElementById('viewerError');
        const pageIndicator = document.getElementById('pageIndicator');
        const pdfControls = document.getElementById('pdfControls');

        modalTitle.innerText = title;
        pdfContainer.innerHTML = '';
        docxContainer.innerHTML = '';
        document.getElementById('excelTabsBar').innerHTML = '';
        document.getElementById('excelTableScroll').innerHTML = '';

        pdfContainer.classList.add('d-none');
        excelContainer.classList.add('d-none');
        docxContainer.classList.add('d-none');
        pdfControls.classList.add('d-none');

        loading.classList.remove('d-none');
        errorBox.classList.add('d-none');
        pageIndicator.innerText = 'Memuat...';

        const modal = new bootstrap.Modal(modalEl);
        modal.show();

        const extLower = (ext || '').toLowerCase();

        try {
            // 1. PDF RENDERER
            if (extLower === 'pdf') {
                pdfControls.classList.remove('d-none');
                pdfContainer.classList.remove('d-none');

                const loadingTask = pdfjsLib.getDocument({
                    url: url,
                    cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/cmaps/',
                    cMapPacked: true,
                });

                currentPdfDoc = await loadingTask.promise;
                loading.classList.add('d-none');
                pageIndicator.innerText = `Total ${currentPdfDoc.numPages} Halaman`;
                await renderAllPages(currentPdfDoc, currentScale);

            // 2. EXCEL RENDERER (XLSX, XLS, CSV)
            } else if (['xlsx', 'xls', 'csv'].includes(extLower)) {
                excelContainer.classList.remove('d-none');

                const response = await fetch(url);
                const arrayBuffer = await response.arrayBuffer();
                currentWorkbook = XLSX.read(arrayBuffer, { type: 'array' });

                loading.classList.add('d-none');
                pageIndicator.innerText = `Excel: ${currentWorkbook.SheetNames.length} Lembar (Sheet)`;

                renderExcelSheets(currentWorkbook);

            // 3. WORD RENDERER (DOCX)
            } else if (extLower === 'docx') {
                docxContainer.classList.remove('d-none');

                const response = await fetch(url);
                const blob = await response.blob();

                loading.classList.add('d-none');
                pageIndicator.innerText = 'Dokumen Word';

                await docx.renderAsync(blob, docxContainer);

            // 4. LEGACY DOC OR OTHER FORMAT
            } else {
                loading.classList.add('d-none');
                errorBox.classList.remove('d-none');
                errorBox.innerHTML = `
                    <div class="alert alert-info text-dark border-0 shadow-sm text-start" style="border-radius: 12px; max-width: 600px; margin: 0 auto;">
                        <h6 class="fw-bold mb-2"><i class="bi bi-file-earmark-text text-primary me-2"></i>Dokumen Format .${ext}</h6>
                        <p class="small text-muted mb-0">Dokumen format <strong>.${ext}</strong> lama tidak dapat dipratinjau langsung di peramban web. Untuk kenyamanan, kami sarankan mengonversinya ke format <strong>.docx</strong> atau <strong>.pdf</strong> saat mengunggah.</p>
                    </div>
                `;
                pageIndicator.innerText = 'Format .' + ext;
            }
        } catch (err) {
            console.error('Document Viewer Error:', err);
            loading.classList.add('d-none');
            errorBox.classList.remove('d-none');
            errorBox.innerHTML = `
                <div class="alert alert-danger border-0 shadow-sm text-start" style="border-radius: 12px; max-width: 600px; margin: 0 auto;">
                    <h6 class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Gagal Memuat Dokumen</h6>
                    <p class="small mb-0">Terjadi kesalahan saat memproses berkas dokumen ini.</p>
                </div>
            `;
            pageIndicator.innerText = 'Gagal';
        }
    }

    // PDF RENDER
    async function renderAllPages(pdfDoc, scale) {
        const container = document.getElementById('pdfPagesContainer');
        container.innerHTML = '';

        for (let pageNum = 1; pageNum <= pdfDoc.numPages; pageNum++) {
            const page = await pdfDoc.getPage(pageNum);
            const viewport = page.getViewport({ scale: scale });

            const pageWrapper = document.createElement('div');
            pageWrapper.className = 'pdf-page-wrapper';
            pageWrapper.style.width = viewport.width + 'px';

            const canvas = document.createElement('canvas');
            canvas.width = viewport.width;
            canvas.height = viewport.height;

            const watermark = document.createElement('div');
            watermark.className = 'pdf-watermark';
            watermark.innerText = 'DESA SEBONG LAGOI';

            pageWrapper.appendChild(canvas);
            pageWrapper.appendChild(watermark);
            container.appendChild(pageWrapper);

            const ctx = canvas.getContext('2d');
            const renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            await page.render(renderContext).promise;
        }
    }

    // EXCEL RENDER
    function renderExcelSheets(workbook) {
        const tabsBar = document.getElementById('excelTabsBar');
        const tableScroll = document.getElementById('excelTableScroll');

        tabsBar.innerHTML = '';
        tableScroll.innerHTML = '';

        workbook.SheetNames.forEach((sheetName, index) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'excel-tab-btn' + (index === 0 ? ' active' : '');
            btn.innerText = sheetName;
            btn.onclick = () => {
                document.querySelectorAll('.excel-tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                displayExcelSheet(workbook.Sheets[sheetName]);
            };
            tabsBar.appendChild(btn);
        });

        if (workbook.SheetNames.length > 0) {
            displayExcelSheet(workbook.Sheets[workbook.SheetNames[0]]);
        }
    }

    function displayExcelSheet(worksheet) {
        const tableScroll = document.getElementById('excelTableScroll');
        const htmlTable = XLSX.utils.sheet_to_html(worksheet, { header: '', footer: '' });
        tableScroll.innerHTML = htmlTable;
    }

    async function zoomIn() {
        if (!currentPdfDoc) return;
        currentScale = Math.min(2.5, currentScale + 0.2);
        await renderAllPages(currentPdfDoc, currentScale);
    }

    async function zoomOut() {
        if (!currentPdfDoc) return;
        currentScale = Math.max(0.7, currentScale - 0.2);
        await renderAllPages(currentPdfDoc, currentScale);
    }

    async function resetZoom() {
        if (!currentPdfDoc) return;
        currentScale = 1.3;
        await renderAllPages(currentPdfDoc, currentScale);
    }

    // Blokir klik kanan di container viewer modal
    document.getElementById('viewerContainer').addEventListener('contextmenu', function (e) {
        e.preventDefault();
        return false;
    });

    // Blokir shortcut download/print (Ctrl+S, Ctrl+P, Ctrl+U) saat modal terbuka
    document.addEventListener('keydown', function (e) {
        const modal = document.getElementById('docViewerModal');
        if (modal && modal.classList.contains('show')) {
            if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'p' || e.key === 'u')) {
                e.preventDefault();
                return false;
            }
        }
    });
</script>
@endsection
