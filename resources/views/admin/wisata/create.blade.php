@extends('layouts.dashboard')

@section('title', 'Tambah Wisata - Dashboard Admin')
@section('page_title', 'Tambah Destinasi Wisata Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <a href="{{ route('admin.wisata.index') }}" class="text-decoration-none text-muted me-2"><i class="bi bi-arrow-left"></i></a>
                        Form Tambah Objek Wisata
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

                    <form action="{{ route('admin.wisata.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_wisata" class="form-label fw-medium text-dark">Nama Objek Wisata <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" value="{{ old('nama_wisata') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-medium text-dark">Deskripsi Wisata <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi') }}</textarea>
                            <div class="form-text small">Jelaskan daya tarik, fasilitas, dan keunikan tempat ini.</div>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-medium text-dark">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="latitude" class="form-label fw-medium text-dark">Latitude Google Maps</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}" placeholder="-0.123456">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="longitude" class="form-label fw-medium text-dark">Longitude Google Maps</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}" placeholder="104.123456">
                            </div>
                            <div class="col-12 mt-1 mb-3">
                                <div class="form-text small"><i class="bi bi-info-circle me-1"></i> Buka <a href="https://maps.google.com" target="_blank">Google Maps</a>, klik pada lokasi, dan salin koordinat latitude/longitude (opsional).</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="foto_wisata" class="form-label fw-medium text-dark">Foto Wisata <span class="text-muted small">(Opsional)</span></label>
                            <input type="file" class="form-control" id="foto_wisata" name="foto_wisata" accept="image/*" onchange="document.getElementById('imgPreview').src=URL.createObjectURL(this.files[0]); document.getElementById('imgPreview').classList.remove('d-none');">
                            <img id="imgPreview" class="mt-2 rounded shadow-sm d-none" style="height: 150px; object-fit: cover;" alt="Preview Foto">
                            <div class="form-text text-muted small">Format disarankan: Lanskap (16:9), JPG/PNG/WEBP. Maks: 2MB.</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-custom py-2">
                                <i class="bi bi-save me-2"></i> Simpan & Publikasikan Wisata
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
