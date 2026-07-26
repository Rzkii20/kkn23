@extends('layouts.dashboard')

@section('title', 'Edit UMKM - Dashboard Admin')
@section('page_title', 'Edit Profil UMKM')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <a href="{{ route('admin.umkm.index') }}" class="text-decoration-none text-muted me-2"><i class="bi bi-arrow-left"></i></a>
                        Edit Profil Toko: <span class="text-primary-custom">{{ $umkm->nama_usaha }}</span>
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

                    <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- SECTION: UMKM PROFILE -->
                        <h6 class="fw-bold text-primary-custom border-bottom pb-2 mb-3">
                            <i class="bi bi-shop-window me-2"></i> Informasi Profil Bisnis UMKM
                        </h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_usaha" class="form-label fw-medium text-dark">Nama Toko / Usaha <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha', $umkm->nama_usaha) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_whatsapp" class="form-label fw-medium text-dark">Nomor WhatsApp Usaha <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">+62</span>
                                    <input type="text" class="form-control" id="no_whatsapp" name="no_whatsapp" value="{{ old('no_whatsapp', $umkm->no_whatsapp) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-medium text-dark">Alamat Lengkap Toko <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ old('alamat', $umkm->alamat) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-medium text-dark">Deskripsi Jenis Usaha <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="latitude" class="form-label fw-medium text-dark">Koordinat Latitude <span class="text-muted">(Opsional)</span></label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $umkm->latitude) }}" placeholder="Contoh: 1.15428">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="longitude" class="form-label fw-medium text-dark">Koordinat Longitude <span class="text-muted">(Opsional)</span></label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $umkm->longitude) }}" placeholder="Contoh: 104.3004">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="foto_toko" class="form-label fw-medium text-dark">Ganti Foto / Banner Toko</label>
                            @if($umkm->foto_toko)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $umkm->foto_toko) }}" class="img-thumbnail rounded shadow-sm" style="height: 100px; object-fit: cover;" alt="Foto Toko Saat Ini">
                                    <span class="d-block text-muted small mt-1">Foto toko saat ini. Unggah gambar baru untuk menggantinya.</span>
                                </div>
                            @endif
                            <input type="file" class="form-control" id="foto_toko" name="foto_toko" accept="image/*">
                            <div class="form-text text-muted small">Format: JPG, PNG, WEBP. Maks: 2MB.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium text-dark">Status Keaktifan Toko</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_aktif" id="statusAktif" value="1" {{ old('status_aktif', $umkm->status_aktif) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label text-success fw-medium" for="statusAktif">Aktif</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_aktif" id="statusNonAktif" value="0" {{ old('status_aktif', $umkm->status_aktif) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label text-danger fw-medium" for="statusNonAktif">Non-Aktif</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary-custom py-2">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
