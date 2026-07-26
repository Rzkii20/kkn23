@extends('layouts.dashboard')

@section('title', 'Tambah UMKM - Dashboard Admin')
@section('page_title', 'Tambah Data UMKM Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <a href="{{ route('admin.umkm.index') }}" class="text-decoration-none text-muted me-2"><i class="bi bi-arrow-left"></i></a>
                        Tambah Profil Toko UMKM
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger" style="border-radius: 10px;">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Ada beberapa kesalahan input:</strong>
                            <ul class="mb-0 mt-1 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- SECTION: UMKM PROFILE -->
                        <h6 class="fw-bold text-primary-custom border-bottom pb-2 mb-3">
                            <i class="bi bi-shop-window me-2"></i> Informasi Profil Bisnis UMKM
                        </h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_usaha" class="form-label fw-medium text-dark">Nama Toko / Usaha <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha') }}" placeholder="Contoh: Otak-otak Sebong Jaya" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_whatsapp" class="form-label fw-medium text-dark">Nomor WhatsApp Usaha <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">+62</span>
                                    <input type="text" class="form-control" id="no_whatsapp" name="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="812XXXXXXXX" required>
                                </div>
                                <div class="form-text text-muted small">Masukkan tanpa angka 0 di depan (contoh: 8134567890)</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-medium text-dark">Alamat Lengkap Toko <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Masukkan alamat lengkap fisik toko" required>{{ old('alamat') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-medium text-dark">Deskripsi Jenis Usaha <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsikan produk utama dan sejarah singkat toko...">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="latitude" class="form-label fw-medium text-dark">Koordinat Latitude <span class="text-muted">(Opsional)</span></label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}" placeholder="Contoh: 1.15428">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="longitude" class="form-label fw-medium text-dark">Koordinat Longitude <span class="text-muted">(Opsional)</span></label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}" placeholder="Contoh: 104.3004">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="foto_toko" class="form-label fw-medium text-dark">Foto / Banner Toko <span class="text-muted">(Opsional)</span></label>
                            <input type="file" class="form-control" id="foto_toko" name="foto_toko" accept="image/*">
                            <div class="form-text text-muted small">Format disarankan: JPG, PNG, WEBP. Maksimal ukuran file: 2MB.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary-custom py-2">
                                <i class="bi bi-save me-2"></i> Simpan Data UMKM
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
