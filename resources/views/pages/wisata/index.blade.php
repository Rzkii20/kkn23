@extends('layouts.app')

@section('title', 'Destinasi Wisata - Desa Sebong Lagoi')

@section('content')
    <!-- Hero Section -->
    <div class="py-5 text-white position-relative" style="background: linear-gradient(rgba(0, 48, 73, 0.7), rgba(0, 48, 73, 0.7)), url('https://images.unsplash.com/photo-1596404981142-9c3f15006b52?q=80&w=2000&auto=format&fit=crop') no-repeat center center; background-size: cover;">
        <div class="container text-center py-5">
            <h1 class="display-4 fw-bold mb-3">Pesona Alam Sebong Lagoi</h1>
            <p class="lead mb-0 text-white-50 mx-auto" style="max-width: 700px;">Jelajahi berbagai destinasi wisata menarik yang menawarkan keindahan alam, budaya, dan pengalaman tak terlupakan.</p>
        </div>
    </div>

    <!-- Wisata List -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                @forelse($wisatas as $wisata)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-custom h-100 border-0 shadow-sm overflow-hidden">
                            <div class="position-relative">
                                <img src="{{ $wisata->foto_wisata ? asset('storage/' . $wisata->foto_wisata) : 'https://placehold.co/600x400/png?text=' . urlencode($wisata->nama_wisata) }}" class="card-img-top w-100" style="height: 250px; object-fit: cover;" alt="{{ $wisata->nama_wisata }}">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-primary-custom px-3 py-2" style="border-radius: 20px;"><i class="bi bi-geo-alt-fill me-1"></i> Destinasi</span>
                                </div>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <h4 class="fw-bold mb-3 text-dark">{{ $wisata->nama_wisata }}</h4>
                                <p class="text-muted small mb-4 flex-grow-1">{{ Str::limit($wisata->deskripsi, 120) }}</p>
                                
                                <div class="d-flex align-items-center text-muted small mb-4">
                                    <i class="bi bi-geo-alt text-danger me-2 fs-5"></i> 
                                    <span>{{ Str::limit($wisata->alamat, 50) }}</span>
                                </div>
                                
                                <a href="{{ route('wisata.show', $wisata->slug) }}" class="btn btn-outline-secondary w-100" style="border-radius: 8px;">
                                    Lihat Detail Wisata <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-map text-muted fs-1 d-block mb-3"></i>
                        <h4 class="fw-bold text-muted">Belum Ada Data Wisata</h4>
                        <p class="text-muted">Data destinasi wisata belum ditambahkan ke dalam sistem.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $wisatas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
