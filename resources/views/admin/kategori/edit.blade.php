@extends('layouts.dashboard')

@section('title', 'Edit Kategori - Admin')
@section('page_title', 'Edit Kategori Produk')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-pencil-fill me-2 text-warning"></i>Edit Kategori</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label fw-medium">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kategori" id="nama_kategori"
                                   class="form-control @error('nama_kategori') is-invalid @enderror"
                                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                   placeholder="Contoh: Makanan & Minuman">
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-medium text-muted">Slug Saat Ini</label>
                            <input type="text" class="form-control bg-light" value="{{ $kategori->slug }}" disabled>
                            <small class="text-muted">Slug tidak berubah saat update untuk menjaga konsistensi URL.</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium">Tautkan dengan UMKM (Opsional)</label>
                            <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                @if($umkms->count() > 0)
                                    @foreach($umkms as $umkm)
                                        @php
                                            $isChecked = false;
                                            if (is_array(old('umkm_ids'))) {
                                                $isChecked = in_array($umkm->id, old('umkm_ids'));
                                            } else {
                                                $isChecked = in_array($umkm->id, $selectedUmkms ?? []);
                                            }
                                        @endphp
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="umkm_ids[]" value="{{ $umkm->id }}" id="umkm_{{ $umkm->id }}" {{ $isChecked ? 'checked' : '' }}>
                                            <label class="form-check-label" for="umkm_{{ $umkm->id }}">
                                                {{ $umkm->nama_usaha }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted mb-0 small">Belum ada UMKM yang terdaftar.</p>
                                @endif
                            </div>
                            <small class="text-muted">Pilih UMKM yang menjual produk dalam kategori ini.</small>
                            @error('umkm_ids')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="bi bi-check-lg me-1"></i> Perbarui Kategori
                            </button>
                            <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
