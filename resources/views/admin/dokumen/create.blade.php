@extends('layouts.dashboard')

@section('title', 'Tambah Dokumen - Dashboard Admin')
@section('page_title', 'Tambah Dokumen Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card card-custom border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-file-earmark-plus-fill text-warning me-2"></i> Upload Dokumen Baru
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-medium small text-dark">Judul Dokumen <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul') }}"
                               placeholder="Contoh: Peraturan Desa No. 1 Tahun 2025"
                               style="border-radius: 10px;">
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-medium small text-dark">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" id="kategori"
                                class="form-select @error('kategori') is-invalid @enderror"
                                style="border-radius: 10px;">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Tahun --}}
                    <div class="mb-3">
                        <label for="tahun" class="form-label fw-medium small text-dark">Tahun <span class="text-danger">*</span></label>
                        <input type="number" name="tahun" id="tahun"
                               class="form-control @error('tahun') is-invalid @enderror"
                               value="{{ old('tahun', date('Y')) }}"
                               min="2000" max="{{ date('Y') + 1 }}"
                               style="border-radius: 10px;">
                        @error('tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-medium small text-dark">Deskripsi Singkat <span class="text-muted">(opsional)</span></label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Keterangan singkat tentang dokumen ini..."
                                  style="border-radius: 10px;">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- File Upload --}}
                    <div class="mb-4">
                        <label for="file_dokumen" class="form-label fw-medium small text-dark">File Dokumen <span class="text-danger">*</span></label>
                        <input type="file" name="file_dokumen" id="file_dokumen"
                               class="form-control @error('file_dokumen') is-invalid @enderror"
                               accept=".pdf,.doc,.docx,.xls,.xlsx"
                               style="border-radius: 10px;">
                        <div class="text-muted mt-1" style="font-size: 0.75rem;">
                            Format: PDF, DOC, DOCX, XLS, XLSX. Maksimal 10 MB.
                        </div>
                        @error('file_dokumen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary-custom px-4" style="border-radius: 10px;">
                            <i class="bi bi-upload me-2"></i> Upload Dokumen
                        </button>
                        <a href="{{ route('admin.dokumen.index') }}" class="btn btn-outline-secondary px-4" style="border-radius: 10px;">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
