@extends('layouts.app')

@section('title', 'Galeri Desa - Sebong Lagoi')

@section('content')
    <div class="py-5 text-white" style="background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--sea-blue) 100%);">
        <div class="container text-center py-4">
            <h1 class="display-5 fw-bold mb-3">Galeri Sebong Lagoi</h1>
            <p class="lead text-white-50 mx-auto" style="max-width: 600px;">Kumpulan potret dan dokumentasi pesona keindahan serta berbagai kegiatan di Desa Sebong Lagoi.</p>
        </div>
    </div>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @forelse($galeris as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-custom h-100 border-0 shadow-sm overflow-hidden">
                            @if($item->tipe === 'foto')
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="d-block overflow-hidden" style="height: 250px;">
                                    <img src="{{ asset('storage/' . $item->file_path) }}" class="w-100 h-100" style="object-fit: cover; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" alt="{{ $item->judul }}">
                                </a>
                            @else
                                <div class="ratio ratio-16x9 h-100">
                                    <iframe src="{{ str_replace('watch?v=', 'embed/', $item->file_path) }}" title="{{ $item->judul }}" allowfullscreen></iframe>
                                </div>
                            @endif
                            <div class="card-body p-3 text-center bg-white">
                                <h6 class="fw-bold mb-1 text-dark">{{ $item->judul }}</h6>
                                <span class="badge {{ $item->tipe === 'foto' ? 'bg-primary-custom' : 'bg-danger' }} small">
                                    <i class="bi {{ $item->tipe === 'foto' ? 'bi-camera' : 'bi-play-circle' }} me-1"></i> {{ ucfirst($item->tipe) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-images text-muted fs-1 d-block mb-3"></i>
                        <h4 class="fw-bold text-muted">Belum Ada Media Galeri</h4>
                        <p class="text-muted mb-0">Galeri foto dan video belum ditambahkan.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $galeris->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
