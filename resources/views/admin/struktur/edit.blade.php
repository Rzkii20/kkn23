@extends('layouts.dashboard')

@section('title', 'Edit Anggota Struktur Desa - Dashboard Admin')
@section('page_title', 'Edit Anggota Struktur Desa')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-pencil-square text-warning me-2"></i> Edit: {{ $strukturDesa->nama }}
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.struktur-desa.update', $strukturDesa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            {{-- Nama --}}
                            <div class="col-md-6">
                                <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                       value="{{ old('nama', $strukturDesa->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jabatan --}}
                            <div class="col-md-6">
                                <label for="jabatan" class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" id="jabatan" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror"
                                       value="{{ old('jabatan', $strukturDesa->jabatan) }}" required>
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Periode --}}
                            <div class="col-md-6">
                                <label for="periode" class="form-label fw-semibold">Periode Jabatan</label>
                                <input type="text" id="periode" name="periode" class="form-control @error('periode') is-invalid @enderror"
                                       value="{{ old('periode', $strukturDesa->periode) }}" placeholder="Contoh: 2022 - 2025">
                                @error('periode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nomor HP --}}
                            <div class="col-md-6">
                                <label for="nomor_hp" class="form-label fw-semibold">Nomor HP / WA</label>
                                <input type="text" id="nomor_hp" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror"
                                       value="{{ old('nomor_hp', $strukturDesa->nomor_hp) }}" placeholder="Contoh: 08123456789">
                                @error('nomor_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Urutan --}}
                            <div class="col-md-4">
                                <label for="urutan" class="form-label fw-semibold">Urutan Tampil <span class="text-danger">*</span></label>
                                <input type="number" id="urutan" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                                       value="{{ old('urutan', $strukturDesa->urutan) }}" min="0" required>
                                <div class="form-text">Angka lebih kecil = posisi lebih atas</div>
                                @error('urutan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-4 d-flex align-items-center pt-4">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $strukturDesa->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_active">Tampil di Halaman Publik</label>
                                </div>
                            </div>

                            {{-- Foto --}}
                            <div class="col-12">
                                <label for="foto" class="form-label fw-semibold">Foto</label>

                                {{-- Foto saat ini --}}
                                @if($strukturDesa->foto)
                                    <div class="mb-3">
                                        <p class="small text-muted mb-2">Foto saat ini:</p>
                                        <img id="fotoPreview"
                                             src="{{ asset('storage/' . $strukturDesa->foto) }}"
                                             class="rounded shadow-sm"
                                             style="width: 120px; height: 120px; object-fit: cover;"
                                             alt="Foto {{ $strukturDesa->nama }}">
                                    </div>
                                @else
                                    <div class="mb-3 d-none" id="fotoPreviewWrapper">
                                        <img id="fotoPreview" src="#"
                                             class="rounded shadow-sm"
                                             style="width: 120px; height: 120px; object-fit: cover;" alt="Preview Foto">
                                    </div>
                                @endif

                                <input type="file" id="foto" name="foto"
                                       class="form-control @error('foto') is-invalid @enderror"
                                       accept="image/jpg,image/jpeg,image/png,image/webp">
                                <div class="form-text">Biarkan kosong jika tidak ingin mengganti foto. Format: JPG, PNG, WEBP. Maks 2MB.</div>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.struktur-desa.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-warning text-white">
                                <i class="bi bi-check-lg me-1"></i> Perbarui
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
    document.getElementById('foto').addEventListener('change', function(e) {
        const preview = document.getElementById('fotoPreview');
        if (preview && this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                if (document.getElementById('fotoPreviewWrapper')) {
                    document.getElementById('fotoPreviewWrapper').classList.remove('d-none');
                }
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection
