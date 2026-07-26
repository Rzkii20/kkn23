@extends('layouts.app')

@section('title', 'Daftar UMKM - Desa Sebong Lagoi')

@section('content')
    <!-- HEADER COVER -->
    <div class="py-5 text-white" style="background: linear-gradient(135deg, var(--sea-blue) 0%, var(--mangrove-green) 100%);">
        <div class="container text-center py-3">
            <h1 class="display-5 fw-bold mb-2">Daftar Mitra UMKM</h1>
            <p class="lead text-white-50">Dukung Perekonomian Lokal dengan Berbelanja Produk Terbaik Asli Desa</p>
        </div>
    </div>

    <!-- SEARCH & LISTING SECTION -->
    <section class="py-5 bg-light">
        <div class="container">
            <!-- Search bar -->
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-lg-6">
                    <form action="{{ route('umkm.index') }}" method="GET">
                        <div class="input-group shadow-sm bg-white rounded-pill overflow-hidden p-1">
                            <span class="input-group-text border-0 bg-transparent"><i class="bi bi-search text-muted ps-2"></i></span>
                            <input type="text" name="search" value="{{ $search }}" class="form-control border-0 bg-transparent" placeholder="Cari nama usaha atau kategori..." aria-label="Cari UMKM" style="box-shadow: none;">
                            <button class="btn btn-primary-custom px-4 rounded-pill" type="submit">Cari</button>
                        </div>
                        @if($search)
                            <div class="text-center mt-3">
                                <span class="small text-muted">Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong></span>
                                <a href="{{ route('umkm.index') }}" class="btn-link small ms-2 text-decoration-none"><i class="bi bi-x-circle"></i> Bersihkan</a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Grid listing -->
            <div class="row g-4">
                @if($umkms->isNotEmpty())
                    @foreach($umkms as $umkm)
                        <div class="col-lg-3 col-md-6">
                            <div class="card card-custom h-100 border-0 shadow-sm">
                                <div class="position-relative">
                                    <img src="{{ $umkm->foto_toko ? asset('storage/' . $umkm->foto_toko) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=400&auto=format&fit=crop' }}" class="card-img-top" alt="{{ $umkm->nama_usaha }}" style="height: 180px; object-fit: cover;">
                                    @if($umkm->status_aktif)
                                        <span class="badge bg-success position-absolute top-0 start-0 m-3 px-3 py-2" style="border-radius: 20px;">
                                            Mitra Aktif
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body p-4 d-flex flex-column">
                                    <h5 class="fw-bold mb-2 text-dark">{{ $umkm->nama_usaha }}</h5>
                                    <p class="small text-muted mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ Str::limit($umkm->alamat, 50) }}</p>
                                    <p class="card-text text-muted small mb-4 flex-grow-1">{{ Str::limit($umkm->deskripsi, 90) }}</p>
                                    <hr class="text-muted opacity-25">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="small text-muted"><i class="bi bi-box-seam me-1"></i> {{ $umkm->produk->count() }} Produk</span>
                                        <a href="{{ route('umkm.show', $umkm->slug) }}" class="btn btn-outline-primary btn-sm px-3" style="border-radius: 6px;">Kunjungi Toko</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-5">
                        <div class="fs-1 text-muted"><i class="bi bi-shop-window"></i></div>
                        <h4 class="fw-bold text-muted mt-3">Mitra UMKM Tidak Ditemukan</h4>
                        <p class="text-muted">Coba bersihkan pencarian atau masukkan kata kunci yang berbeda.</p>
                        <a href="{{ route('umkm.index') }}" class="btn btn-primary-custom mt-2">Muat Ulang Halaman</a>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $umkms->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
