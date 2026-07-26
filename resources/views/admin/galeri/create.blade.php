@extends('layouts.dashboard')

@section('title', 'Tambah Media - Dashboard Admin')
@section('page_title', 'Tambah Media Galeri')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <a href="{{ route('admin.galeri.index') }}" class="text-decoration-none text-muted me-2"><i class="bi bi-arrow-left"></i></a>
                        Form Tambah Media
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

                    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="judul" class="form-label fw-medium text-dark">Judul Media <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Penyerahan Bantuan Sosial" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium text-dark">Tipe Media <span class="text-danger">*</span></label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipe" id="tipeFoto" value="foto" {{ old('tipe', 'foto') == 'foto' ? 'checked' : '' }} onchange="toggleMediaInput()">
                                    <label class="form-check-label" for="tipeFoto"><i class="bi bi-camera me-1"></i> Foto (Upload)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipe" id="tipeVideo" value="video" {{ old('tipe') == 'video' ? 'checked' : '' }} onchange="toggleMediaInput()">
                                    <label class="form-check-label" for="tipeVideo"><i class="bi bi-play-circle me-1"></i> Video (YouTube)</label>
                                </div>
                            </div>
                        </div>

                        <div id="inputFoto" class="mb-4 {{ old('tipe', 'foto') == 'foto' ? '' : 'd-none' }}">
                            <label for="file_foto" class="form-label fw-medium text-dark">Upload File Foto <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="file_foto" name="file_foto" accept="image/*" onchange="document.getElementById('imgPreview').src=URL.createObjectURL(this.files[0]); document.getElementById('imgPreview').classList.remove('d-none');">
                            <img id="imgPreview" class="mt-2 rounded shadow-sm d-none" style="height: 150px; object-fit: cover;" alt="Preview Foto">
                            <div class="form-text text-muted small">Format: JPG, PNG, WEBP. Maks: 2MB.</div>
                        </div>

                        <div id="inputVideo" class="mb-4 {{ old('tipe') == 'video' ? '' : 'd-none' }}">
                            <label for="file_video" class="form-label fw-medium text-dark">URL Video YouTube <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" id="file_video" name="file_video" value="{{ old('file_video') }}" placeholder="https://www.youtube.com/watch?v=XXXXXX">
                            <div class="form-text text-muted small">Masukkan URL lengkap video dari YouTube.</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-custom py-2">
                                <i class="bi bi-save me-2"></i> Tambahkan ke Galeri
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function toggleMediaInput() {
        const tipe = document.querySelector('input[name="tipe"]:checked').value;
        if (tipe === 'foto') {
            document.getElementById('inputFoto').classList.remove('d-none');
            document.getElementById('inputVideo').classList.add('d-none');
        } else {
            document.getElementById('inputVideo').classList.remove('d-none');
            document.getElementById('inputFoto').classList.add('d-none');
        }
    }
</script>
@endsection
