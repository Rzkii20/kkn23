@extends('layouts.dashboard')

@section('title', 'Kelola Galeri - Dashboard Admin')
@section('page_title', 'Kelola Media Galeri')

@section('content')
    <div class="card card-custom border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-images text-primary-custom me-2"></i> Kumpulan Media</h5>
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Media
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="ps-4">Preview</th>
                            <th>Judul Media</th>
                            <th>Tipe</th>
                            <th>Ditambahkan Pada</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galeris as $item)
                            <tr>
                                <td class="ps-4">
                                    @if($item->tipe === 'foto')
                                        <img src="{{ asset('storage/' . $item->file_path) }}" class="rounded shadow-sm" style="width: 80px; height: 60px; object-fit: cover;" alt="{{ $item->judul }}">
                                    @else
                                        <div class="bg-dark text-white rounded d-flex align-items-center justify-content-center" style="width: 80px; height: 60px;">
                                            <i class="bi bi-play-circle-fill fs-3"></i>
                                        </div>
                                    @endif
                                </td>
                                <td><span class="fw-bold text-dark">{{ $item->judul }}</span></td>
                                <td>
                                    <span class="badge {{ $item->tipe === 'foto' ? 'bg-info' : 'bg-danger' }}">
                                        {{ ucfirst($item->tipe) }}
                                    </span>
                                </td>
                                <td><span class="text-muted small">{{ $item->created_at->format('d M Y') }}</span></td>
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-outline-warning btn-sm px-2" style="border-radius: 6px;" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus media ini dari galeri?');">
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
                                    <i class="bi bi-images fs-1 d-block mb-3"></i>
                                    Belum ada foto atau video di galeri.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
