@extends('layouts.app')

@section('title', 'Dokumen & Administrasi - Pemerintah Desa Sebong Lagoi')

@section('content')
    {{-- HEADER --}}
    <div class="py-4 py-md-5 text-white position-relative"
         style="background: linear-gradient(rgba(0, 48, 73, 0.82), rgba(0, 48, 73, 0.82)), url('https://images.unsplash.com/photo-1568027762272-e4da8b386fe9?q=80&w=1920&auto=format&fit=crop') no-repeat center center; background-size: cover;">
        <div class="container text-center py-2 py-md-3">
            <div class="mb-2">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-semibold">
                    <i class="bi bi-folder-fill me-1"></i> Dokumen Resmi
                </span>
            </div>
            <h1 class="fs-2 fw-bold mb-2">Dokumen & Administrasi</h1>
            <p class="text-white-50 mb-0 fs-6">Dokumen resmi Pemerintah Desa Sebong Lagoi. Untuk salinan dokumen, silakan kunjungi Kantor Desa.</p>
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
                                    <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; transition: transform .2s, box-shadow .2s;"
                                         onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.12)';"
                                         onmouseout="this.style.transform=''; this.style.boxShadow='';">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-start gap-3 mb-3">
                                                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                                     style="width: 48px; height: 48px; background: {{ $ext === 'PDF' ? '#fff0f0' : '#f0f4ff' }};">
                                                    <i class="bi bi-{{ $ext === 'PDF' ? 'filetype-pdf text-danger' : 'file-earmark-text text-primary' }} fs-4"></i>
                                                </div>
                                                <div>
                                                    <span class="badge bg-light text-secondary border small mb-1">{{ $ext }} &bull; {{ $dokumen->tahun }}</span>
                                                    <h6 class="fw-bold text-dark mb-0 lh-sm" style="font-size: 0.9rem;">{{ $dokumen->judul }}</h6>
                                                </div>
                                            </div>

                                            @if($dokumen->deskripsi)
                                                <p class="text-muted small mb-3 lh-sm">{{ Str::limit($dokumen->deskripsi, 100) }}</p>
                                            @endif

                                            <div class="d-flex align-items-center gap-2 mt-2">
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary border small">
                                                    <i class="bi bi-lock-fill me-1"></i> Dokumen Resmi
                                                </span>
                                                <span class="text-muted small">Tersedia di Kantor Desa</span>
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
@endsection
