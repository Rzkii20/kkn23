<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mitra UMKM - Desa Sebong Lagoi</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts (Outfit) -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sea-blue: #0F4C81;
            --sea-blue-dark: #072e52;
            --mangrove-green: #1B4332;
            --accent-yellow: #F59E0B;
            --neutral-light: #F8FAFC;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, var(--sea-blue) 0%, var(--mangrove-green) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 650px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .auth-header {
            background: linear-gradient(135deg, var(--sea-blue-dark) 0%, var(--sea-blue) 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .auth-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: var(--accent-yellow);
        }

        .brand-logo {
            font-size: 2.2rem;
            color: var(--accent-yellow);
            margin-bottom: 5px;
        }

        .auth-body {
            padding: 35px;
        }

        .form-label {
            font-weight: 500;
            color: #334155;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 14px;
            border: 1px solid #CBD5E1;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--sea-blue);
            box-shadow: 0 0 0 4px rgba(15, 76, 129, 0.15);
        }

        .section-title {
            color: var(--sea-blue);
            font-weight: 600;
            border-bottom: 2px solid #E2E8F0;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background: var(--sea-blue);
            border-color: var(--sea-blue);
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--sea-blue-dark);
            border-color: var(--sea-blue-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(15, 76, 129, 0.3);
        }

        .btn-link {
            color: var(--sea-blue);
            text-decoration: none;
            font-weight: 500;
        }

        .btn-link:hover {
            color: var(--sea-blue-dark);
            text-decoration: underline;
        }

        .alert-custom {
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="auth-header">
            <div class="brand-logo">
                <i class="bi bi-shop-window"></i>
            </div>
            <h4 class="mb-1">Registrasi Mitra UMKM</h4>
            <p class="mb-0 text-white-50 small">Bergabunglah dan pasarkan produk unggulan Anda</p>
        </div>

        <div class="auth-body">
            @if($errors->any())
                <div class="alert alert-danger alert-custom mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Mohon perbaiki kesalahan berikut:</strong>
                    <ul class="mb-0 mt-1 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                
                <!-- Section 1: Akun Pemilik -->
                <div class="section-title">
                    <i class="bi bi-person-fill me-2"></i> Informasi Akun Pemilik
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required>
                    </div>
                </div>

                <!-- Section 2: Profil Usaha -->
                <div class="section-title">
                    <i class="bi bi-briefcase-fill me-2"></i> Profil Usaha UMKM
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_usaha" class="form-label">Nama Usaha / Toko</label>
                        <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha') }}" placeholder="Contoh: Kripik Lagoi Indah" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_whatsapp" class="form-label">Nomor WhatsApp Usaha</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">+62</span>
                            <input type="text" class="form-control" id="no_whatsapp" name="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="812XXXXXXXX" required>
                        </div>
                        <div class="form-text text-muted small">Contoh input: 81234567890 (tanpa angka 0 di depan)</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Usaha Lengkap</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Masukkan alamat lengkap lokasi usaha" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi Singkat Usaha</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Jelaskan secara singkat jenis produk atau layanan yang ditawarkan..." required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus-fill me-2"></i> Daftar Sebagai Mitra
                    </button>
                </div>

                <div class="text-center">
                    <span class="text-muted small">Sudah memiliki akun?</span>
                    <a href="{{ route('login') }}" class="btn-link small ms-1">Masuk Sekarang</a>
                </div>

                <hr class="my-4 text-muted">

                <div class="text-center">
                    <a href="/" class="text-muted small text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda Utama
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
