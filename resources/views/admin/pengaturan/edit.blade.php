@extends('layouts.dashboard')

@section('title', 'Pengaturan Akun - Admin')
@section('page_title', 'Pengaturan Akun Admin')

@section('content')

<div class="row g-4">

    {{-- ===== KARTU PROFIL KIRI ===== --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm text-center p-4" style="border-radius: 16px;">
            {{-- Foto Profil --}}
            <div class="position-relative d-inline-block mx-auto mb-3" style="width: 110px; height: 110px;">
                @if($user->foto_profil)
                    <img src="{{ asset('storage/' . $user->foto_profil) }}"
                         alt="Foto Profil"
                         class="rounded-circle w-100 h-100 object-fit-cover border border-3 border-primary"
                         id="preview-foto"
                         style="object-fit:cover;">
                @else
                    <div class="rounded-circle w-100 h-100 d-flex align-items-center justify-content-center text-white fw-bold"
                         id="preview-placeholder"
                         style="font-size: 2.5rem; background: linear-gradient(135deg, #1e3a5f, #2ecc71);">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <img src="" alt="" class="rounded-circle w-100 h-100 object-fit-cover border border-3 border-primary d-none"
                         id="preview-foto" style="object-fit:cover;">
                @endif
            </div>

            <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
            <span class="badge bg-danger mb-1">Administrator</span>
            <p class="text-muted small mb-0">{{ $user->email }}</p>

            <hr>
            <p class="text-muted small mb-0"><i class="bi bi-calendar3 me-1"></i>Bergabung {{ $user->created_at->format('d M Y') }}</p>
        </div>
    </div>

    {{-- ===== FORM KANAN ===== --}}
    <div class="col-lg-8">

        {{-- FORM PROFIL --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-header bg-white border-0 p-4 pb-0">
                <h6 class="fw-bold text-dark mb-0">
                    <i class="bi bi-person-circle me-2 text-primary"></i>Informasi Profil
                </h6>
                <p class="text-muted small mb-0 mt-1">Ubah nama, email, dan foto profil Anda.</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.pengaturan.profil') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Foto Profil Upload --}}
                    <div class="mb-4">
                        <label class="form-label fw-medium small text-dark">Foto Profil</label>
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <input type="file" name="foto" id="foto-input" class="form-control form-control-sm @error('foto') is-invalid @enderror"
                                    accept="image/jpeg,image/png,image/jpg,image/webp"
                                    onchange="previewFoto(this)">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="text-muted" style="font-size: 0.75rem; margin-top: 4px;">
                                    Format: JPG, PNG, WEBP. Maks 2 MB.
                                </div>
                            </div>
                            @if($user->foto_profil)
                                <form action="{{ route('admin.pengaturan.hapus-foto') }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Hapus foto profil?')"
                                        title="Hapus foto">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-medium small text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}"
                            placeholder="Nama lengkap admin"
                            style="border-radius: 10px;">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="form-label fw-medium small text-dark">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}"
                            placeholder="email@domain.com"
                            style="border-radius: 10px;">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; background: var(--sea-blue); border-color: var(--sea-blue);">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        {{-- FORM PASSWORD --}}
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-0 p-4 pb-0">
                <h6 class="fw-bold text-dark mb-0">
                    <i class="bi bi-shield-lock me-2 text-warning"></i>Ubah Password
                </h6>
                <p class="text-muted small mb-0 mt-1">Pastikan password baru minimal 8 karakter.</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.pengaturan.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Password Lama --}}
                    <div class="mb-3">
                        <label for="password_lama" class="form-label fw-medium small text-dark">Password Saat Ini <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" name="password_lama" id="password_lama"
                                class="form-control @error('password_lama') is-invalid @enderror"
                                placeholder="Masukkan password saat ini"
                                style="border-radius: 10px 0 0 10px;">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePass('password_lama')" style="border-radius: 0 10px 10px 0;">
                                <i class="bi bi-eye" id="icon-password_lama"></i>
                            </button>
                            @error('password_lama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-3">
                        <label for="password_baru" class="form-label fw-medium small text-dark">Password Baru <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" name="password_baru" id="password_baru"
                                class="form-control @error('password_baru') is-invalid @enderror"
                                placeholder="Minimal 8 karakter"
                                style="border-radius: 10px 0 0 10px;">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePass('password_baru')" style="border-radius: 0 10px 10px 0;">
                                <i class="bi bi-eye" id="icon-password_baru"></i>
                            </button>
                            @error('password_baru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-4">
                        <label for="password_baru_confirmation" class="form-label fw-medium small text-dark">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" name="password_baru_confirmation" id="password_baru_confirmation"
                                class="form-control"
                                placeholder="Ulangi password baru"
                                style="border-radius: 10px 0 0 10px;">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePass('password_baru_confirmation')" style="border-radius: 0 10px 10px 0;">
                                <i class="bi bi-eye" id="icon-password_baru_confirmation"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning px-4 fw-semibold" style="border-radius: 10px;">
                        <i class="bi bi-key me-2"></i>Ganti Password
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@section('scripts')
<script>
    function previewFoto(input) {
        const preview = document.getElementById('preview-foto');
        const placeholder = document.getElementById('preview-placeholder');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                if (placeholder) placeholder.classList.add('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function togglePass(fieldId) {
        const input = document.getElementById(fieldId);
        const icon  = document.getElementById('icon-' + fieldId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }
</script>
@endsection

@endsection
