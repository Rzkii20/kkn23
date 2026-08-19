@extends('layouts.dashboard')

@section('title', 'Tambah Produk - Dashboard Admin')
@section('page_title', 'Tambah Produk Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <a href="{{ route('admin.produk.index') }}" class="text-decoration-none text-muted me-2"><i class="bi bi-arrow-left"></i></a>
                        Tambah Produk UMKM
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger" style="border-radius: 10px;">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <ul class="mb-0 mt-1 small">
                                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="umkm_id" class="form-label fw-medium text-dark">Pemilik UMKM <span class="text-danger">*</span></label>
                            <select class="form-select" id="umkm_id" name="umkm_id" required>
                                <option value="">-- Pilih UMKM --</option>
                                @foreach($umkms as $umkm)
                                    <option value="{{ $umkm->id }}" {{ old('umkm_id') == $umkm->id ? 'selected' : '' }}>{{ $umkm->nama_usaha }} ({{ $umkm->user?->name ?? 'Admin' }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="nama_produk" class="form-label fw-medium text-dark">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" placeholder="Masukkan nama produk" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="kategori_id" class="form-label fw-medium text-dark">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select" id="kategori_id" name="kategori_id" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-medium text-dark">Deskripsi Produk <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsikan produk" required>{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="harga" class="form-label fw-medium text-dark">Harga (Rp) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">Rp</span>
                                    <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" placeholder="15000" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ukuran_kemasan" class="form-label fw-medium text-dark">Ukuran / Kemasan <span class="text-muted fw-normal small">(Opsional)</span></label>
                                <input type="text" class="form-control" id="ukuran_kemasan" name="ukuran_kemasan" value="{{ old('ukuran_kemasan') }}" placeholder="Contoh: 500 gram, 1 Liter, Botol Kecil">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="foto_produk" class="form-label fw-medium text-dark">Foto Produk <span class="text-muted fw-normal small">(Opsional)</span></label>
                            <input type="file" class="form-control" id="foto_produk" name="foto_produk" accept="image/*" onchange="document.getElementById('imgPreview').src=URL.createObjectURL(this.files[0]); document.getElementById('imgPreview').classList.remove('d-none');">
                            <img id="imgPreview" class="mt-2 rounded shadow-sm d-none" style="height: 120px; object-fit: cover;" alt="Preview Foto">
                            <div class="form-text text-muted small">Format: JPG, PNG, WEBP. Maks: 2MB.</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-custom py-2">
                                <i class="bi bi-save me-2"></i> Simpan & Publikasikan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
