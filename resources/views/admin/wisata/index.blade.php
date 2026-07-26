@extends('layouts.dashboard')

@section('title', 'Kelola Wisata - Dashboard Admin')
@section('page_title', 'Kelola Destinasi Wisata')

@section('content')
    <div class="card card-custom border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-geo-alt-fill text-primary-custom me-2"></i> Daftar Objek Wisata</h5>
            <a href="{{ route('admin.wisata.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Wisata
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="ps-4">Foto</th>
                            <th>Nama Objek Wisata</th>
                            <th>Alamat</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wisatas as $wisata)
                            <tr>
                                <td class="ps-4">
                                    <img src="{{ $wisata->foto_wisata ? asset('storage/' . $wisata->foto_wisata) : 'https://placehold.co/80x60/png?text=W' }}" class="rounded shadow-sm" style="width: 80px; height: 60px; object-fit: cover;" alt="{{ $wisata->nama_wisata }}">
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block">{{ $wisata->nama_wisata }}</span>
                                    <span class="text-muted small">{{ Str::limit($wisata->deskripsi, 60) }}</span>
                                </td>
                                <td>
                                    <span class="text-muted small"><i class="bi bi-pin-map-fill text-danger"></i> {{ Str::limit($wisata->alamat, 40) }}</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('wisata.show', $wisata->slug) }}" target="_blank" class="btn btn-outline-info btn-sm px-2" style="border-radius: 6px;" title="Lihat di Publik"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('admin.wisata.edit', $wisata->id) }}" class="btn btn-outline-warning btn-sm px-2" style="border-radius: 6px;" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('admin.wisata.destroy', $wisata->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus wisata ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-2" style="border-radius: 6px;" title="Hapus"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-map fs-1 d-block mb-3"></i>
                                    Belum ada data destinasi wisata.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
