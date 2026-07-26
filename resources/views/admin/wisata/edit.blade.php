@extends('layouts.dashboard')

@section('title', 'Edit Wisata - Dashboard Admin')
@section('page_title', 'Edit Destinasi Wisata')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <a href="{{ route('admin.wisata.index') }}" class="text-decoration-none text-muted me-2"><i class="bi bi-arrow-left"></i></a>
                        Edit: <span class="text-primary-custom">{{ $wisata->nama_wisata }}</span>
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

                    <form action="{{ route('admin.wisata.update', $wisata->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_wisata" class="form-label fw-medium text-dark">Nama Objek Wisata <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" value="{{ old('nama_wisata', $wisata->nama_wisata) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-medium text-dark">Deskripsi Wisata <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-medium text-dark">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ old('alamat', $wisata->alamat) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="latitude" class="form-label fw-medium text-dark">Latitude Google Maps</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $wisata->latitude) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="longitude" class="form-label fw-medium text-dark">Longitude Google Maps</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $wisata->longitude) }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="foto_wisata" class="form-label fw-medium text-dark">Ganti Foto Wisata</label>
                            @if($wisata->foto_wisata)
                                <div class="mb-2">
                                    <img id="imgPreview" src="{{ asset('storage/' . $wisata->foto_wisata) }}" class="rounded shadow-sm" style="height: 150px; object-fit: cover;" alt="Foto Saat Ini">
                                    <span class="d-block text-muted small mt-1">Foto wisata saat ini.</span>
                                </div>
                            @else
                                <img id="imgPreview" src="" class="rounded shadow-sm d-none mb-2" style="height: 150px; object-fit: cover;" alt="Preview">
                            @endif
                            <input type="file" class="form-control" id="foto_wisata" name="foto_wisata" accept="image/*" onchange="document.getElementById('imgPreview').src=URL.createObjectURL(this.files[0]); document.getElementById('imgPreview').classList.remove('d-none');">
                            <div class="form-text text-muted small">Format: JPG, PNG, WEBP. Maks: 2MB.</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-custom py-2">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan Wisata
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
