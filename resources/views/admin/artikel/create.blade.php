@extends('layouts.dashboard')

@section('title', 'Tulis Artikel - Dashboard Admin')
@section('page_title', 'Tulis Artikel Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <a href="{{ route('admin.artikel.index') }}" class="text-decoration-none text-muted me-2"><i class="bi bi-arrow-left"></i></a>
                        Formulir Publikasi Artikel
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

                    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="judul" class="form-label fw-medium text-dark fs-5">Judul Artikel <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul yang menarik..." required>
                        </div>

                        <div class="mb-4">
                            <label for="konten" class="form-label fw-medium text-dark">Isi Konten <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="konten" name="konten" rows="12" placeholder="Tuliskan isi berita atau artikel di sini..." required>{{ old('konten') }}</textarea>
                            <div class="form-text small mt-2">Untuk membuat paragraf baru, tekan Enter.</div>
                        </div>

                        <div class="mb-4">
                            <label for="foto_artikel" class="form-label fw-medium text-dark">Gambar Sampul (Thumbnail) <span class="text-muted small">(Opsional)</span></label>
                            <input type="file" class="form-control" id="foto_artikel" name="foto_artikel" accept="image/*" onchange="document.getElementById('imgPreview').src=URL.createObjectURL(this.files[0]); document.getElementById('imgPreview').classList.remove('d-none');">
                            <img id="imgPreview" class="mt-3 rounded shadow-sm d-none" style="height: 200px; object-fit: cover; width: 100%; max-width: 400px;" alt="Preview Sampul">
                            <div class="form-text text-muted small mt-2">Format disarankan: Lanskap (16:9), JPG/PNG/WEBP. Maks: 2MB.</div>
                        </div>

                        <hr class="my-4 text-muted">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.artikel.index') }}" class="btn btn-light px-4 py-2">Batal</a>
                            <button type="submit" class="btn btn-primary-custom px-4 py-2">
                                <i class="bi bi-send me-2"></i> Terbitkan Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
