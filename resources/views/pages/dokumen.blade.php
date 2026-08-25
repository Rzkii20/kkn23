@extends('layouts.app')

@section('title', 'Dokumen & Administrasi - Pemerintah Desa Sebong Lagoi')

@section('styles')
<style>
    .doc-card {
        border-radius: 14px;
        transition: transform .2s ease, box-shadow .2s ease;
        border: 1px solid rgba(0,0,0,0.06);
    }
    .doc-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    .viewer-modal-body {
        position: relative;
        height: 78vh;
        padding: 0;
        background-color: #525659;
    }
    .viewer-iframe {
        width: 100%;
        height: 100%;
        border: none;
    }
</style>
@endsection

@section('content')
    {{-- HEADER --}}
    <div class="py-4 py-md-5 text-white position-relative"
         style="background: linear-gradient(rgba(0, 48, 73, 0.85), rgba(0, 48, 73, 0.85)), url('https://images.unsplash.com/photo-1568027762272-e4da8b386fe9?q=80&w=1920&auto=format&fit=crop') no-repeat center center; background-size: cover;">
        <div class="container text-center py-2 py-md-3">
            <div class="mb-2">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-semibold">
                    <i class="bi bi-folder-fill me-1"></i> Dokumen Resmi
                </span>
            </div>
            <h1 class="fs-2 fw-bold mb-2">Dokumen & Administrasi</h1>
            <p class="text-white-50 mb-0 fs-6">Dokumen resmi Pemerintah Desa Sebong Lagoi yang dapat dilihat dan dibaca oleh masyarakat.</p>
        </div>
    </div>

    {{-- FILTER BAR --}}
    <section class="py-3 bg-white border-bottom shadow-sm sticky-top" style="top: 72px; z-index: 100;">
        <div class="container">
            <form method="GET" action="{{ route('dokumen.index') }}" class="row g-2 align-items-center">
                <div class="col-sm-auto">
                    <select name="kategori" class="form-select form-select-sm" style="border-radius: 8px; min-width: 180px;" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-auto">
                    <select name="tahun" class="form-select form-select-sm" style="border-radius: 8px; min-width: 120px;" onchange="this.form.submit()">
                        <option value="">Semua Tahun</option>
                        @foreach($tahuns as $th)
                            <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                        @endforeach
                    </select>
                </div>
                @if(request('kategori') || request('tahun'))
                    <div class="col-sm-auto">
                        <a href="{{ route('dokumen.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                            <i class="bi bi-x-lg me-1"></i> Reset
                        </a>
                    </div>
                @endif
                <div class="col ms-auto text-muted small text-end">
                    Menampilkan <strong>{{ $dokumens->count() }}</strong> dokumen
                </div>
            </form>
        </div>
    </section>

    {{-- DAFTAR DOKUMEN --}}
    <section class="py-5" style="background: var(--sea-blue-light, #f0f7ff);">
        <div class="container">
            @if($dokumens->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-folder2-open text-muted" style="font-size: 4rem;"></i>
                    <h5 class="fw-bold text-dark mt-3">Belum Ada Dokumen</h5>
                    <p class="text-muted">Dokumen akan ditampilkan di sini setelah diunggah oleh admin.</p>
                </div>
            @else
                {{-- Group by kategori --}}
                @foreach($dokumens->groupBy('kategori') as $kategori => $items)
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-folder-fill text-warning fs-5"></i>
                            <h5 class="fw-bold text-dark mb-0">{{ $kategori }}</h5>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary ms-1">{{ $items->count() }} dokumen</span>
                        </div>

                        <div class="row g-3">
                            @foreach($items as $dokumen)
                                @php $ext = strtoupper(pathinfo($dokumen->file_dokumen, PATHINFO_EXTENSION)); @endphp
                                <div class="col-md-6 col-lg-4">
                                    <div class="card doc-card border-0 shadow-sm h-100 bg-white">
                                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="d-flex align-items-start gap-3 mb-3">
                                                    <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                                         style="width: 48px; height: 48px; background: {{ $ext === 'PDF' ? '#fff0f0' : '#f0f4ff' }};">
                                                        <i class="bi bi-{{ $ext === 'PDF' ? 'filetype-pdf text-danger' : 'file-earmark-text text-primary' }} fs-4"></i>
                                                    </div>
                                                    <div>
                                                        <span class="badge bg-light text-secondary border small mb-1">{{ $ext }} &bull; {{ $dokumen->tahun }}</span>
                                                        <h6 class="fw-bold text-dark mb-0 lh-sm" style="font-size: 0.95rem;">{{ $dokumen->judul }}</h6>
                                                    </div>
                                                </div>

                                                @if($dokumen->deskripsi)
                                                    <p class="text-muted small mb-3 lh-sm">{{ Str::limit($dokumen->deskripsi, 100) }}</p>
                                                @endif
                                            </div>

                                            <div class="mt-3 pt-3 border-top">
                                                <button type="button" 
                                                        class="btn btn-sm btn-primary-custom w-100 py-2 d-flex align-items-center justify-content-center gap-2"
                                                        style="border-radius: 8px; font-weight: 600;"
                                                        onclick="openViewer('{{ route('dokumen.lihat', $dokumen->id) }}', '{{ addslashes($dokumen->judul) }}', '{{ $ext }}')">
                                                    <i class="bi bi-eye"></i> Baca Dokumen
                                                </button>
                                                <div class="text-center mt-2">
                                                    <small class="text-muted" style="font-size: 0.72rem;">
                                                        <i class="bi bi-shield-lock me-1"></i>Hanya baca / tidak untuk diunduh
                                                    </small>
                                                </div>
                                            </div>
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

    {{-- MODAL VIEWER DOKUMEN (READ ONLY) --}}
    <div class="modal fade" id="docViewerModal" tabindex="-1" aria-labelledby="docViewerModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header bg-dark text-white py-3 px-4">
                    <div class="d-flex align-items-center gap-2 overflow-hidden">
                        <i class="bi bi-file-earmark-text text-warning fs-5 flex-shrink-0"></i>
                        <div>
                            <h6 class="modal-title fw-bold mb-0 text-truncate text-white" id="docViewerModalLabel" style="font-size: 1rem;">
                                Memuat Dokumen...
                            </h6>
                            <span class="badge bg-secondary bg-opacity-50 text-white-50" style="font-size: 0.68rem;">
                                <i class="bi bi-shield-lock me-1"></i>Pratinjau Dokumen (Hanya Baca)
                            </span>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="closeViewer()"></button>
                </div>
                <div class="viewer-modal-body" id="viewerContainer" oncontextmenu="return false;">
                    <div id="viewerLoading" class="d-flex flex-column align-items-center justify-content-center h-100 text-white">
                        <div class="spinner-border text-warning mb-2" role="status"></div>
                        <span>Memuat isi dokumen...</span>
                    </div>
                    <iframe id="docViewerIframe" class="viewer-iframe d-none" src="" allow="autoplay" oncontextmenu="return false;"></iframe>
                </div>
                <div class="modal-footer bg-light py-2 px-4 d-flex justify-content-between">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>Dokumen resmi Pemerintah Desa Sebong Lagoi.
                    </small>
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal" onclick="closeViewer()">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function openViewer(url, title, ext) {
        const modalEl = document.getElementById('docViewerModal');
        const modalTitle = document.getElementById('docViewerModalLabel');
        const iframe = document.getElementById('docViewerIframe');
        const loading = document.getElementById('viewerLoading');

        modalTitle.innerText = title;
        loading.classList.remove('d-none');
        iframe.classList.add('d-none');

        // Tambahkan parameter toolbar=0 agar browser tidak memunculkan bar download bawaan PDF
        const targetUrl = url + (ext.toLowerCase() === 'pdf' ? '#toolbar=0&navpanes=0&scrollbar=0' : '');
        iframe.src = targetUrl;

        iframe.onload = function() {
            loading.classList.add('d-none');
            iframe.classList.remove('d-none');
        };

        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }

    function closeViewer() {
        const iframe = document.getElementById('docViewerIframe');
        iframe.src = '';
    }

    // Blokir klik kanan di container viewer modal
    document.getElementById('viewerContainer').addEventListener('contextmenu', function(e) {
        e.preventDefault();
        return false;
    });
</script>
@endsection
