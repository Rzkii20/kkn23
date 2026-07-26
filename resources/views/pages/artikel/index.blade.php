@extends('layouts.app')

@section('title', 'Kumpulan Artikel - Desa Sebong Lagoi')

@section('content')
    <div class="py-5 bg-white border-bottom">
        <div class="container text-center">
            <h1 class="display-5 fw-bold mb-3 text-dark">Berita & Artikel</h1>
            <p class="lead text-muted mb-0">Informasi terbaru seputar kegiatan dan perkembangan Desa Sebong Lagoi</p>
        </div>
    </div>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                @forelse($artikels as $artikel)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-custom h-100 border-0 shadow-sm overflow-hidden">
                            <a href="{{ route('artikel.show', $artikel->slug) }}" class="text-decoration-none">
                                <img src="{{ $artikel->foto_artikel ? asset('storage/' . $artikel->foto_artikel) : 'https://placehold.co/600x400/png?text=Artikel' }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $artikel->judul }}">
                            </a>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex align-items-center mb-3 small text-muted gap-3">
                                    <span><i class="bi bi-calendar-event me-1 text-primary-custom"></i> {{ $artikel->created_at->format('d M Y') }}</span>
                                    <span><i class="bi bi-eye me-1 text-primary-custom"></i> {{ $artikel->views }}x dibaca</span>
                                </div>
                                <h5 class="fw-bold mb-3">
                                    <a href="{{ route('artikel.show', $artikel->slug) }}" class="text-dark text-decoration-none hover-primary">{{ $artikel->judul }}</a>
                                </h5>
                                <p class="text-muted small mb-4 flex-grow-1">{{ Str::limit(strip_tags($artikel->konten), 120) }}</p>
                                
                                <a href="{{ route('artikel.show', $artikel->slug) }}" class="fw-bold text-primary-custom text-decoration-none">Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-journal-text text-muted fs-1 d-block mb-3"></i>
                        <h4 class="fw-bold text-muted">Belum Ada Artikel</h4>
                        <p class="text-muted">Saat ini belum ada artikel atau berita yang diterbitkan.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $artikels->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
