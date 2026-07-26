@extends('layouts.dashboard')

@section('title', 'Pesan Masuk - Admin')
@section('page_title', 'Pesan Kontak Masuk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold text-dark mb-1">Kotak Masuk</h5>
            <p class="text-muted small mb-0">Pesan yang dikirim oleh pengunjung melalui halaman kontak</p>
        </div>
        <span class="badge bg-primary-custom fs-6">{{ $pesans->total() }} Pesan</span>
    </div>

    <div class="card card-custom border-0 shadow-sm">
        <div class="card-body p-0">
            @forelse($pesans as $pesan)
                <div class="border-bottom p-4 d-flex justify-content-between align-items-start gap-3 {{ $loop->even ? 'bg-light bg-opacity-50' : '' }}">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-3 mb-1">
                            <div class="bg-primary-custom text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width: 40px; height: 40px; font-weight: bold;">
                                {{ strtoupper(substr($pesan->nama, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-semibold text-dark">{{ $pesan->nama }}</div>
                                <div class="text-muted small">{{ $pesan->email }} &bull; <span class="text-muted">{{ $pesan->created_at->diffForHumans() }}</span></div>
                            </div>
                            <span class="badge bg-light text-dark border ms-2">{{ $pesan->subjek }}</span>
                        </div>
                        <p class="text-muted small mb-0 ms-5 ps-2">{{ Str::limit($pesan->pesan, 120) }}</p>
                    </div>
                    <div class="d-flex gap-2 flex-shrink-0">
                        <a href="{{ route('admin.pesan.show', $pesan) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Baca
                        </a>
                        <form action="{{ route('admin.pesan.destroy', $pesan) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    <i class="bi bi-envelope-open fs-1 d-block mb-2 opacity-25"></i>
                    Belum ada pesan masuk.
                </div>
            @endforelse
        </div>
        @if($pesans->hasPages())
            <div class="card-footer bg-white border-top py-3">
                {{ $pesans->links() }}
            </div>
        @endif
    </div>
@endsection
