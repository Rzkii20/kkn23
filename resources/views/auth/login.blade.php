<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem UMKM Desa Sebong Lagoi</title>
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
            padding: 20px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .auth-card:hover {
            transform: translateY(-5px);
        }

        .auth-header {
            background: linear-gradient(135deg, var(--sea-blue-dark) 0%, var(--sea-blue) 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .auth-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: var(--accent-yellow);
        }

        .brand-logo {
            font-size: 2.5rem;
            color: var(--accent-yellow);
            margin-bottom: 10px;
            animation: pulse 2s infinite;
        }

        .auth-body {
            padding: 40px 35px;
        }

        .form-label {
            font-weight: 500;
            color: #334155;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #CBD5E1;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--sea-blue);
            box-shadow: 0 0 0 4px rgba(15, 76, 129, 0.15);
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

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="auth-header">
            <div class="brand-logo">
                <i class="bi bi-shop"></i>
            </div>
            <h4 class="mb-1 font-weight-bold">Desa Sebong Lagoi</h4>
            <p class="mb-0 text-white-50 small">Sistem Informasi Promosi & Pemasaran UMKM</p>
        </div>

        <div class="auth-body">
            @if(session('success'))
                <div class="alert alert-success alert-custom alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-custom mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="email" autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <label for="password" class="form-label mb-0">Kata Sandi</label>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock text-muted"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
                    </div>
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted small" for="remember">
                            Ingat Saya
                        </label>
                    </div>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Masuk ke Sistem
                    </button>
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
