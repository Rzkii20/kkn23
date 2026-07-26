@extends('layouts.dashboard')

@section('title', 'Edit Banner - Admin')
@section('page_title', 'Edit Banner Slider')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-pencil-fill me-2 text-warning"></i>Edit Banner Slider</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.slider.update', $slider) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        <div class="mb-3">
                            <label for="foto_banner" class="form-label fw-medium">Ganti Gambar Banner</label>
                            <input type="file" name="foto_banner" id="foto_banner" accept="image/*"
                                   class="form-control @error('foto_banner') is-invalid @enderror"
                                   onchange="previewImage(this, 'preview')">
                            @error('foto_banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                        </div>
                        <!-- Current image -->
                        <div class="mb-3" id="preview">
                            <label class="form-label fw-medium text-muted">Gambar Banner Saat Ini</label>
                            <div>
                                <img id="previewImg" src="{{ asset('storage/' . $slider->foto_banner) }}"
                                     alt="{{ $slider->judul }}"
                                     class="img-fluid rounded" style="max-height: 200px; object-fit: cover; width: 100%;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="judul" class="form-label fw-medium">Judul Banner</label>
                                <input type="text" name="judul" id="judul"
                                       class="form-control @error('judul') is-invalid @enderror"
                                       value="{{ old('judul', $slider->judul) }}" placeholder="Contoh: Selamat Datang di Sebong Lagoi">
                                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="urutan" class="form-label fw-medium">Urutan Tampil</label>
                                <input type="number" name="urutan" id="urutan"
                                       class="form-control @error('urutan') is-invalid @enderror"
                                       value="{{ old('urutan', $slider->urutan) }}" min="0">
                                @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="subjudul" class="form-label fw-medium">Sub Judul</label>
                            <input type="text" name="subjudul" id="subjudul"
                                   class="form-control @error('subjudul') is-invalid @enderror"
                                   value="{{ old('subjudul', $slider->subjudul) }}" placeholder="Contoh: Destinasi wisata dan UMKM terbaik di Bintan">
                            @error('subjudul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="bi bi-check-lg me-1"></i> Perbarui Banner
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
    const previewImg = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
