@extends('layouts.dashboard')

@section('title', 'Edit Event - Dashboard Admin')
@section('page_title', 'Edit Agenda Event')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <a href="{{ route('admin.event.index') }}" class="text-decoration-none text-muted me-2"><i class="bi bi-arrow-left"></i></a>
                        Edit: <span class="text-primary-custom">{{ Str::limit($event->nama_event, 40) }}</span>
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

                    <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_event" class="form-label fw-medium text-dark">Nama Acara / Event <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_event" name="nama_event" value="{{ old('nama_event', $event->nama_event) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-medium text-dark">Deskripsi Event <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_mulai" class="form-label fw-medium text-dark">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $event->tanggal_mulai) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_selesai" class="form-label fw-medium text-dark">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $event->tanggal_selesai) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label fw-medium text-dark">Lokasi Acara <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi', $event->lokasi) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="foto_event" class="form-label fw-medium text-dark">Ganti Poster / Banner</label>
                            @if($event->foto_event)
                                <div class="mb-2">
                                    <img id="imgPreview" src="{{ asset('storage/' . $event->foto_event) }}" class="rounded shadow-sm" style="height: 150px; object-fit: cover;" alt="Poster Saat Ini">
                                    <span class="d-block text-muted small mt-1">Poster event saat ini.</span>
                                </div>
                            @else
                                <img id="imgPreview" src="" class="rounded shadow-sm d-none mb-2" style="height: 150px; object-fit: cover;" alt="Preview Poster">
                            @endif
                            <input type="file" class="form-control" id="foto_event" name="foto_event" accept="image/*" onchange="document.getElementById('imgPreview').src=URL.createObjectURL(this.files[0]); document.getElementById('imgPreview').classList.remove('d-none');">
                            <div class="form-text text-muted small">Format disarankan: Lanskap (16:9), JPG/PNG/WEBP. Maks: 2MB.</div>
                        </div>

                        <div class="d-grid">
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
