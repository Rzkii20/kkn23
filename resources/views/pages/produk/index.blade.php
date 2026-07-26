@extends('layouts.app')

@section('title', 'Katalog Produk UMKM - Desa Sebong Lagoi')
@section('meta_description', 'Temukan berbagai produk lokal asli UMKM Desa Sebong Lagoi. Kerajinan tangan, kuliner, dan produk unggulan masyarakat Kepulauan Riau.')

@section('content')

    {{-- ===== HERO BANNER ===== --}}
    <div class="produk-hero py-5 text-white position-relative overflow-hidden">
        <div class="produk-hero-overlay"></div>
        <div class="container text-center py-4 position-relative z-1">
            <span class="badge mb-3 px-3 py-2" style="background: rgba(255,255,255,0.2); border-radius: 20px; font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase;">
                <i class="bi bi-grid-3x3-gap me-1"></i> Katalog Resmi
            </span>
            <h1 class="display-5 fw-bold mb-3">Katalog Produk UMKM</h1>
            <p class="lead mb-0" style="color: rgba(255,255,255,0.8); max-width: 520px; margin: 0 auto;">
                Temukan produk lokal asli buatan masyarakat Desa Sebong Lagoi, Kepulauan Riau
            </p>
        </div>
    </div>

    {{-- ===== INFO BANNER: CARA PEMESANAN ===== --}}
    <div class="bg-white border-bottom py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap text-center">
                <div class="d-flex align-items-center gap-2 text-muted small">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:28px;height:28px;background:#f0fdf4;">
                        <i class="bi bi-eye" style="color:#16a34a;font-size:0.75rem;"></i>
                    </div>
                    <span><strong>1.</strong> Lihat produk pilihan Anda</span>
                </div>
                <i class="bi bi-chevron-right text-muted d-none d-md-inline"></i>
                <div class="d-flex align-items-center gap-2 text-muted small">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:28px;height:28px;background:#f0fdf4;">
                        <i class="bi bi-info-circle" style="color:#16a34a;font-size:0.75rem;"></i>
                    </div>
                    <span><strong>2.</strong> Buka detail & hubungi penjual</span>
                </div>
                <i class="bi bi-chevron-right text-muted d-none d-md-inline"></i>
                <div class="d-flex align-items-center gap-2 text-muted small">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:28px;height:28px;background:#dcfce7;">
                        <i class="bi bi-whatsapp" style="color:#16a34a;font-size:0.75rem;"></i>
                    </div>
                    <span><strong>3.</strong> Pesan langsung via <strong class="text-success">WhatsApp</strong></span>
                </div>
                <span class="ms-md-3 badge text-bg-light border small" style="border-radius:20px;">
                    <i class="bi bi-shield-check text-success me-1"></i>Tidak ada pemesanan online
                </span>
            </div>
        </div>
    </div>

    <section class="py-5 bg-light">
        <div class="container">
            {{-- ===== FILTER & SEARCH ===== --}}
            <div class="row g-3 mb-5 align-items-center">
                <div class="col-md-5">
                    <form action="{{ route('produk.index') }}" method="GET">
                        <input type="hidden" name="kategori" value="{{ $kategoriSlug }}">
                        <div class="input-group shadow-sm bg-white rounded-pill overflow-hidden p-1">
                            <span class="input-group-text border-0 bg-transparent">
                                <i class="bi bi-search text-muted ps-2"></i>
                            </span>
                            <input type="text" name="search" value="{{ $search }}"
                                class="form-control border-0 bg-transparent"
                                placeholder="Cari nama produk..."
                                style="box-shadow: none;">
                            <button class="btn btn-primary-custom px-4 rounded-pill" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                        <a href="{{ route('produk.index', ['search' => $search]) }}"
                            class="btn {{ !$kategoriSlug ? 'btn-primary-custom' : 'btn-outline-secondary' }} btn-sm px-3"
                            style="border-radius: 20px;">
                            Semua
                        </a>
                        @foreach($kategoris as $kat)
                            <a href="{{ route('produk.index', ['kategori' => $kat->slug, 'search' => $search]) }}"
                                class="btn {{ $kategoriSlug == $kat->slug ? 'btn-primary-custom' : 'btn-outline-secondary' }} btn-sm px-3"
                                style="border-radius: 20px;">
                                {{ $kat->nama_kategori }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ===== PRODUCT GRID ===== --}}
            <div class="row g-4">
                @forelse($produks as $produk)
                    <div class="col-lg-3 col-md-6">
                        <div class="card produk-card h-100 border-0 shadow-sm">
                            <div class="produk-card-img-wrap position-relative overflow-hidden">
                                <img src="{{ $produk->foto_produk ? asset('storage/' . $produk->foto_produk) : 'https://placehold.co/400x300/png?text=' . urlencode($produk->nama_produk) }}"
                                    class="produk-card-img"
                                    alt="{{ $produk->nama_produk }}">
                                <span class="badge bg-secondary-custom position-absolute top-0 end-0 m-3 px-2 py-1" style="border-radius: 20px; font-size: 0.7rem;">
                                    {{ $produk->kategori->nama_kategori }}
                                </span>
                                @if($produk->stok == 0)
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.45);">
                                        <span class="badge bg-danger px-3 py-2" style="border-radius:20px; font-size:0.85rem;">Stok Habis</span>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <p class="small text-muted mb-1">
                                    <i class="bi bi-shop me-1 text-warning"></i>{{ $produk->umkm->nama_usaha }}
                                </p>
                                <h5 class="fw-bold mb-2 text-dark" style="font-size:1rem; line-height:1.4;">{{ $produk->nama_produk }}</h5>
                                <h6 class="fw-bold text-primary-custom mb-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h6>
                                <p class="text-muted small flex-grow-1">{{ Str::limit($produk->deskripsi, 70) }}</p>
                                <div class="d-flex align-items-center gap-2 mt-1">
                                    <span class="badge {{ $produk->stok > 0 ? 'bg-success' : 'bg-secondary' }} small">
                                        {{ $produk->stok > 0 ? 'Tersedia' : 'Habis' }}
                                    </span>
                                    <span class="text-muted small"><i class="bi bi-eye me-1"></i>{{ $produk->views }}</span>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 p-4 pt-0 d-flex gap-2">
                                <a href="{{ route('produk.show', $produk->slug) }}"
                                    class="btn btn-outline-secondary btn-sm w-50"
                                    style="border-radius: 8px;">
                                    <i class="bi bi-info-circle me-1"></i>Detail
                                </a>
                                @if($produk->stok > 0)
                                    <a href="https://wa.me/{{ $produk->umkm->no_whatsapp }}?text=Halo%20{{ urlencode($produk->umkm->nama_usaha) }}%2C%20saya%20tertarik%20dengan%20produk%20%22{{ urlencode($produk->nama_produk) }}%22.%20Boleh%20saya%20tanya%20informasi%20lebih%20lanjut%3F"
                                        target="_blank"
                                        class="btn btn-sm w-50 text-white fw-semibold"
                                        style="border-radius: 8px; background-color: #25D366; border-color: #25D366;">
                                        <i class="bi bi-whatsapp"></i> Tanya WA
                                    </a>
                                @else
                                    <button class="btn btn-sm w-50 btn-secondary" disabled style="border-radius: 8px; opacity:0.5; cursor:not-allowed;">
                                        Stok Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="fs-1 text-muted"><i class="bi bi-box-seam"></i></div>
                        <h4 class="fw-bold text-muted mt-3">Produk Tidak Ditemukan</h4>
                        <p class="text-muted small">Coba ubah kata kunci atau filter kategori</p>
                        <a href="{{ route('produk.index') }}" class="btn btn-primary-custom mt-2">Tampilkan Semua Produk</a>
                    </div>
                @endforelse
            </div>

            {{-- ===== PAGINATION ===== --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $produks->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>

    {{-- ===== STYLES ===== --}}
    @section('styles')
    <style>
        .produk-hero {
            background: linear-gradient(135deg, var(--sea-blue) 0%, var(--mangrove-green) 100%);
        }
        .produk-hero-overlay {
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .produk-card {
            border-radius: 16px !important;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            overflow: hidden;
        }
        .produk-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.12) !important;
        }
        .produk-card-img-wrap {
            height: 200px;
        }
        .produk-card-img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.4s ease;
        }
        .produk-card:hover .produk-card-img {
            transform: scale(1.06);
        }
    </style>
    @endsection
@endsection
