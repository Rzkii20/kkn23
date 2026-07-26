@extends('layouts.app')

@section('title', $artikel->judul . ' - Desa Sebong Lagoi')

@section('content')
    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}">Berita & Artikel</a></li>
                    <li class="breadcrumb-item active text-truncate" style="max-width: 200px;">{{ $artikel->judul }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-4">
                        <h1 class="fw-bold text-dark mb-3 leading-tight">{{ $artikel->judul }}</h1>
                        <div class="d-flex align-items-center justify-content-center gap-3 text-muted small">
                            <span><i class="bi bi-calendar-event me-1"></i> {{ $artikel->created_at->translatedFormat('l, d F Y') }}</span>
                            <span><i class="bi bi-eye me-1"></i> {{ $artikel->views }} kali dibaca</span>
                        </div>
                    </div>

                    <div class="mb-5 text-center">
                        <img src="{{ $artikel->foto_artikel ? asset('storage/' . $artikel->foto_artikel) : 'https://placehold.co/1000x500/png?text=' . urlencode($artikel->judul) }}" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 500px; object-fit: cover;" alt="{{ $artikel->judul }}">
                    </div>

                    <div class="artikel-content" style="line-height: 1.9; font-size: 1.1rem; color: #4a5568;">
                        {!! nl2br(e($artikel->konten)) !!}
                    </div>

                    <!-- Share Section -->
                    <div class="d-flex align-items-center gap-3 mt-5 pt-4 border-top">
                        <span class="fw-bold text-dark">Bagikan:</span>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($artikel->judul . ' - ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-success rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;"><i class="bi bi-whatsapp"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;"><i class="bi bi-facebook"></i></a>
                        <button onclick="navigator.clipboard.writeText(window.location.href).then(() => alert('Tautan disalin!'))" class="btn btn-sm btn-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;"><i class="bi bi-link-45deg"></i></button>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-custom border-0 shadow-sm bg-light sticky-top" style="top: 100px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 border-bottom pb-2">Berita Terbaru</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach($latest_artikels as $latest)
                                    <li class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom border-light-subtle' : '' }}">
                                        <a href="{{ route('artikel.show', $latest->slug) }}" class="text-decoration-none d-flex gap-3 align-items-start">
                                            <img src="{{ $latest->foto_artikel ? asset('storage/' . $latest->foto_artikel) : 'https://placehold.co/80x80/png?text=Berita' }}" class="rounded" style="width: 70px; height: 70px; object-fit: cover;" alt="{{ $latest->judul }}">
                                            <div>
                                                <h6 class="fw-bold text-dark mb-1 hover-primary" style="font-size: 0.95rem; line-height: 1.4;">{{ Str::limit($latest->judul, 45) }}</h6>
                                                <span class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-clock me-1"></i> {{ $latest->created_at->diffForHumans() }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .hover-primary:hover {
        color: var(--sea-blue) !important;
    }
    .artikel-content p {
        margin-bottom: 1.5rem;
    }
    .artikel-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
</style>
@endsection
