@extends('layouts.dashboard')

@section('title', 'Kategori Produk - Admin')
@section('page_title', 'Manajemen Kategori Produk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold text-dark mb-1">Daftar Kategori</h5>
            <p class="text-muted small mb-0">Kelola kategori untuk produk UMKM</p>
        </div>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
        </a>
    </div>

    <div class="card card-custom border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="ps-4" style="width: 60px;">#</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th class="text-center">Jumlah Produk</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $index => $kategori)
                            <tr>
                                <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                                <td class="fw-semibold text-dark">{{ $kategori->nama_kategori }}</td>
                                <td><code class="text-muted small">{{ $kategori->slug }}</code></td>
                                <td class="text-center">
                                    <span class="badge bg-primary-custom rounded-pill">{{ $kategori->produk_count }}</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-sm btn-outline-secondary me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-tags fs-1 d-block mb-2 opacity-25"></i>
                                    Belum ada kategori. Silakan tambah kategori baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
