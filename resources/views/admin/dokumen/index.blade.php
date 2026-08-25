@extends('layouts.dashboard')

@section('title', 'Kelola Dokumen - Dashboard Admin')
@section('page_title', 'Dokumen & Administrasi')

@section('styles')
<style>
    .viewer-modal-body {
        position: relative;
        height: 75vh;
        overflow-y: auto;
        background-color: #383b3d;
        padding: 24px 12px;
        user-select: none;
        -webkit-user-select: none;
    }
    .pdf-page-wrapper {
        position: relative;
        background-color: #ffffff;
        margin: 0 auto 20px auto;
        box-shadow: 0 8px 24px rgba(0,0,0,0.35);
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
        color: rgba(0, 48, 73, 0.07);
        pointer-events: none;
        white-space: nowrap;
        text-transform: uppercase;
        letter-spacing: 4px;
    }
    .excel-container {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.35);
        overflow: hidden;
        margin: 0 auto;
        max-width: 100%;
    }
    .excel-tabs-bar {
        background: #25282a;
        padding: 8px 12px 0;
        display: flex;
        gap: 4px;
        overflow-x: auto;
        border-bottom: 2px solid #0077b6;
    }
    .excel-tab-btn {
        background: #424649;
        color: #ddd;
        border: none;
        padding: 6px 16px;
        border-radius: 6px 6px 0 0;
        font-size: 0.8rem;
        cursor: pointer;
        white-space: nowrap;
    }
    .excel-tab-btn.active {
        background: #0077b6;
        color: #fff;
        font-weight: bold;
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
        background: #fff;
    }
    .excel-table-scroll th, .excel-table-scroll td {
        border: 1px solid #dee2e6;
        padding: 6px 10px;
        white-space: nowrap;
    }
    .excel-table-scroll tr:first-child td, .excel-table-scroll th {
        background: #f1f5f9;
        font-weight: 600;
        color: #334155;
    }
    .docx-wrapper {
        background: transparent !important;
        padding: 0 !important;
    }
    .docx-wrapper > section.docx {
        background: #ffffff !important;
        box-shadow: 0 8px 24px rgba(0,0,0,0.35) !important;
        margin: 0 auto 20px auto !important;
        border-radius: 4px !important;
        padding: 40px !important;
        max-width: 850px !important;
    }
</style>
@endsection

@section('content')
    <div class="card card-custom border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-folder-fill text-warning me-2"></i> Daftar Dokumen</h5>
            <a href="{{ route('admin.dokumen.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Dokumen
            </a>
        </div>
        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3 border-0 shadow-sm" role="alert" style="border-radius: 10px;">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="ps-4" style="width: 40px;">#</th>
                            <th>Judul Dokumen</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>File</th>
                            <th>Tanggal Upload</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dokumens as $i => $dokumen)
                            @php 
                                $ext = strtolower(pathinfo($dokumen->file_dokumen, PATHINFO_EXTENSION));
                                $isPdf = $ext === 'pdf';
                                $isExcel = in_array($ext, ['xls', 'xlsx', 'csv']);
                                $isWord = in_array($ext, ['doc', 'docx']);
                                $badgeColor = $isPdf ? 'danger' : ($isExcel ? 'success' : ($isWord ? 'primary' : 'warning'));
                                $icon = $isPdf ? 'filetype-pdf' : ($isExcel ? 'filetype-xlsx' : ($isWord ? 'filetype-docx' : 'file-earmark'));
                            @endphp
                            <tr>
                                <td class="ps-4 text-muted small">{{ $i + 1 }}</td>
                                <td>
                                    <span class="fw-semibold text-dark d-block" style="max-width: 280px;">{{ $dokumen->judul }}</span>
                                    @if($dokumen->deskripsi)
                                        <small class="text-muted">{{ Str::limit($dokumen->deskripsi, 60) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 small">{{ $dokumen->kategori }}</span>
                                </td>
                                <td><span class="text-muted small">{{ $dokumen->tahun }}</span></td>
                                <td>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-{{ $badgeColor }} px-2 py-1" 
                                            style="border-radius: 6px; font-size: 0.8rem;" 
                                            title="Lihat Pratinjau Dokumen"
                                            onclick="openViewer('{{ route('dokumen.lihat', $dokumen->id) }}', '{{ addslashes($dokumen->judul) }}', '{{ $ext }}')">
                                        <i class="bi bi-{{ $icon }} me-1"></i> {{ strtoupper($ext) }}
                                    </button>
                                </td>
                                <td><span class="text-muted small">{{ $dokumen->created_at->format('d M Y') }}</span></td>
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-2">
                                        {{-- Tombol Lihat --}}
                                        <button type="button" 
                                                class="btn btn-outline-info btn-sm px-2" 
                                                style="border-radius: 6px;" 
                                                title="Lihat Dokumen"
                                                onclick="openViewer('{{ route('dokumen.lihat', $dokumen->id) }}', '{{ addslashes($dokumen->judul) }}', '{{ $ext }}')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}"
                                           class="btn btn-outline-warning btn-sm px-2" style="border-radius: 6px;" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus dokumen ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-2"
                                                    style="border-radius: 6px;" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder2-open fs-1 d-block mb-3"></i>
                                    Belum ada dokumen yang diunggah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL VIEWER DOKUMEN (ADMIN) --}}
    <div class="modal fade" id="docViewerModal" tabindex="-1" aria-labelledby="docViewerModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                {{-- HEADER TOOLBAR --}}
                <div class="modal-header bg-dark text-white py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2 overflow-hidden" style="max-width: 50%;">
                        <i class="bi bi-file-earmark-text text-warning fs-5 flex-shrink-0"></i>
                        <div class="overflow-hidden">
                            <h6 class="modal-title fw-bold mb-0 text-truncate text-white" id="docViewerModalLabel" style="font-size: 0.95rem;">
                                Memuat Dokumen...
                            </h6>
                            <span class="badge bg-secondary bg-opacity-50 text-white-50" style="font-size: 0.68rem;">
                                <i class="bi bi-shield-lock me-1"></i>Penampil Dokumen (Hanya Baca)
                            </span>
                        </div>
                    </div>

                    {{-- CONTROLS --}}
                    <div class="d-flex align-items-center gap-2">
                        <span id="pageIndicator" class="badge bg-secondary text-white fw-normal px-2 py-1 small">
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
                        <div class="spinner-border text-warning mb-3" role="status"></div>
                        <span class="fw-semibold">Sedang merender isi dokumen...</span>
                        <small class="text-white-50 mt-1">Harap tunggu sebentar</small>
                    </div>
                    <div id="viewerError" class="d-none p-4 text-center"></div>
                    
                    {{-- PDF canvas --}}
                    <div id="pdfPagesContainer" class="d-flex flex-column align-items-center"></div>

                    {{-- Excel sheets --}}
                    <div id="excelContainer" class="d-none excel-container">
                        <div id="excelTabsBar" class="excel-tabs-bar"></div>
                        <div id="excelTableScroll" class="excel-table-scroll"></div>
                    </div>

                    {{-- Word docx --}}
                    <div id="docxContainer" class="d-none"></div>
                </div>

                {{-- FOOTER --}}
                <div class="modal-footer bg-light py-2 px-4 d-flex justify-content-between align-items-center">
                    <small class="text-muted" style="font-size: 0.8rem;">
                        <i class="bi bi-shield-check text-success me-1"></i>Pratinjau Dokumen Desa Sebong Lagoi.
                    </small>
                    <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal" style="border-radius: 8px;">
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

        const extLower = ext.toLowerCase();

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
                        <p class="small text-muted mb-0">Dokumen format <strong>.${ext}</strong> lama tidak dapat dipratinjau langsung di peramban web. Kami sarankan mengonversinya ke format <strong>.docx</strong> atau <strong>.pdf</strong>.</p>
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

    document.getElementById('viewerContainer').addEventListener('contextmenu', function(e) {
        e.preventDefault();
        return false;
    });

    document.addEventListener('keydown', function(e) {
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
