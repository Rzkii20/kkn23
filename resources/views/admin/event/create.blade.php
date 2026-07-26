@extends('layouts.dashboard')

@section('title', 'Tambah Event - Dashboard Admin')
@section('page_title', 'Tambah Event Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <a href="{{ route('admin.event.index') }}" class="text-decoration-none text-muted me-2"><i class="bi bi-arrow-left"></i></a>
                        Form Tambah Agenda Acara
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

                    <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_event" class="form-label fw-medium text-dark">Nama Acara / Event <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_event" name="nama_event" value="{{ old('nama_event') }}" placeholder="Contoh: Festival Kuliner Desa 2026" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-medium text-dark">Deskripsi Event <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi') }}</textarea>
                            <div class="form-text small">Jelaskan mengenai detail kegiatan, jadwal susunan acara, HTM, dll.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_mulai" class="form-label fw-medium text-dark">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_selesai" class="form-label fw-medium text-dark">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                                <div class="form-text small">Sama dengan tanggal mulai jika acara 1 hari.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label fw-medium text-dark">Lokasi Acara <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Lapangan Serbaguna Desa Sebong Lagoi" required>
                        </div>

                        <div class="mb-4">
                            <label for="foto_event" class="form-label fw-medium text-dark">Poster / Banner Event <span class="text-muted small">(Opsional)</span></label>
                            <input type="file" class="form-control" id="foto_event" name="foto_event" accept="image/*" onchange="document.getElementById('imgPreview').src=URL.createObjectURL(this.files[0]); document.getElementById('imgPreview').classList.remove('d-none');">
                            <img id="imgPreview" class="mt-2 rounded shadow-sm d-none" style="height: 200px; object-fit: cover;" alt="Preview Foto">
                            <div class="form-text text-muted small">Format disarankan: Lanskap (16:9), JPG/PNG/WEBP. Maks: 2MB.</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-custom py-2">
                                <i class="bi bi-save me-2"></i> Publikasikan Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
