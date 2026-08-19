@extends('layouts.dashboard')

@section('title', 'Kelola Produk - Dashboard Admin')
@section('page_title', 'Kelola Semua Produk UMKM')

@section('content')
    <div class="card card-custom border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-box-seam-fill text-primary-custom me-2"></i> Daftar Produk</h5>
            <a href="{{ route('admin.produk.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="ps-4">Produk</th>
                            <th>UMKM Pemilik</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produk as $item)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $item->foto_produk ? asset('storage/' . $item->foto_produk) : 'https://placehold.co/60x60/png?text=P' }}" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;" alt="{{ $item->nama_produk }}">
                                        <div>
                                            <span class="fw-bold text-dark d-block">{{ $item->nama_produk }}</span>
                                            <span class="text-muted small"><i class="bi bi-eye"></i> {{ $item->views }} views</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="fw-medium text-dark">{{ $item->umkm->nama_usaha }}</span></td>
                                <td><span class="badge bg-secondary-custom small">{{ $item->kategori->nama_kategori }}</span></td>
                                <td class="fw-bold text-primary-custom">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('produk.show', $item->slug) }}" target="_blank" class="btn btn-outline-info btn-sm px-2" style="border-radius: 6px;" title="Lihat di Publik"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('admin.produk.edit', $item->id) }}" class="btn btn-outline-warning btn-sm px-2" style="border-radius: 6px;" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-2" style="border-radius: 6px;" title="Hapus"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-box-seam fs-1 d-block mb-3"></i>
                                    Belum ada produk yang terdaftar dalam sistem.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
