@extends('layouts.dashboard')

@section('title', 'Kelola Artikel - Dashboard Admin')
@section('page_title', 'Kelola Berita & Artikel')

@section('content')
    <div class="card card-custom border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-journal-text text-primary-custom me-2"></i> Daftar Artikel</h5>
            <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="bi bi-pencil-square me-1"></i> Tulis Artikel Baru
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="ps-4">Sampul</th>
                            <th>Judul Artikel</th>
                            <th>Tanggal Terbit</th>
                            <th>Views</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artikels as $artikel)
                            <tr>
                                <td class="ps-4">
                                    <img src="{{ $artikel->foto_artikel ? asset('storage/' . $artikel->foto_artikel) : 'https://placehold.co/80x60/png?text=A' }}" class="rounded shadow-sm" style="width: 80px; height: 60px; object-fit: cover;" alt="{{ $artikel->judul }}">
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block" style="max-width: 300px;">{{ Str::limit($artikel->judul, 50) }}</span>
                                </td>
                                <td>
                                    <span class="text-muted small"><i class="bi bi-calendar2-week"></i> {{ $artikel->created_at->format('d M Y') }}</span>
                                </td>
                                <td><span class="badge bg-secondary-custom small">{{ $artikel->views }}</span></td>
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('artikel.show', $artikel->slug) }}" target="_blank" class="btn btn-outline-info btn-sm px-2" style="border-radius: 6px;" title="Lihat di Publik"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="btn btn-outline-warning btn-sm px-2" style="border-radius: 6px;" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-2" style="border-radius: 6px;" title="Hapus"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-journal-x fs-1 d-block mb-3"></i>
                                    Belum ada artikel yang diterbitkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
