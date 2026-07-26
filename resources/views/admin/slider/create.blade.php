@extends('layouts.dashboard')

@section('title', 'Tambah Banner - Admin')
@section('page_title', 'Tambah Banner Slider Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-card-image me-2 text-primary-custom"></i>Form Tambah Banner Slider</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="foto_banner" class="form-label fw-medium">Gambar Banner <span class="text-danger">*</span></label>
                            <input type="file" name="foto_banner" id="foto_banner" accept="image/*"
                                   class="form-control @error('foto_banner') is-invalid @enderror"
                                   onchange="previewImage(this, 'preview')">
                            @error('foto_banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, PNG, WEBP. Maks: 3MB. Rekomendasi rasio 16:5 (landscape)</small>
                            <div class="mt-2" id="preview" style="display:none;">
                                <img id="previewImg" src="#" alt="Preview" class="img-fluid rounded" style="max-height: 200px; object-fit: cover; width: 100%;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="judul" class="form-label fw-medium">Judul Banner</label>
                                <input type="text" name="judul" id="judul"
                                       class="form-control @error('judul') is-invalid @enderror"
                                       value="{{ old('judul') }}" placeholder="Contoh: Selamat Datang di Sebong Lagoi">
                                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="urutan" class="form-label fw-medium">Urutan Tampil</label>
                                <input type="number" name="urutan" id="urutan"
                                       class="form-control @error('urutan') is-invalid @enderror"
                                       value="{{ old('urutan', 0) }}" min="0">
                                @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="subjudul" class="form-label fw-medium">Sub Judul</label>
                            <input type="text" name="subjudul" id="subjudul"
                                   class="form-control @error('subjudul') is-invalid @enderror"
                                   value="{{ old('subjudul') }}" placeholder="Contoh: Destinasi wisata dan UMKM terbaik di Bintan">
                            @error('subjudul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="bi bi-check-lg me-1"></i> Simpan Banner
                            </button>
                            <a href="{{ route('admin.slider.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const previewImg = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
