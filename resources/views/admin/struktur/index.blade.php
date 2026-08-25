@extends('layouts.dashboard')

@section('title', 'Struktur Desa - Dashboard Admin')
@section('page_title', 'Kelola Struktur Desa')

@section('content')
    <div class="card card-custom border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="bi bi-diagram-3-fill text-primary-custom me-2"></i> Daftar Anggota Struktur Desa
            </h5>
            <a href="{{ route('admin.struktur-desa.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Anggota
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="ps-4" style="width: 60px;">Urutan</th>
                            <th style="width: 80px;">Foto</th>
                            <th>Nama & Jabatan</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($strukturs as $item)
                            <tr>
                                <td class="ps-4 text-center">
                                    <span class="badge bg-secondary rounded-pill">{{ $item->urutan }}</span>
                                </td>
                                <td>
                                    <img src="{{ $item->foto ? asset('storage/' . $item->foto) : 'https://placehold.co/60x60/png?text=' . urlencode(substr($item->nama, 0, 1)) }}"
                                         class="rounded-circle shadow-sm"
                                         style="width: 55px; height: 55px; object-fit: cover;"
                                         alt="{{ $item->nama }}">
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block">{{ $item->nama }}</span>
                                    <span class="text-muted small">
                                        <i class="bi bi-person-badge me-1"></i>{{ $item->jabatan }}
                                    </span>
                                    @if($item->nomor_hp)
                                        <span class="text-muted small d-block">
                                            <i class="bi bi-telephone me-1"></i>{{ $item->nomor_hp }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->periode)
                                        <span class="badge bg-light text-dark border">
                                            <i class="bi bi-calendar3 me-1"></i>{{ $item->periode }}
                                        </span>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Non-Aktif</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('admin.struktur-desa.edit', $item->id) }}"
                                           class="btn btn-outline-warning btn-sm px-2"
                                           style="border-radius: 6px;" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.struktur-desa.destroy', $item->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus {{ $item->nama }} dari struktur desa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-2"
                                                    style="border-radius: 6px;" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-diagram-3 fs-1 d-block mb-3 opacity-50"></i>
                                    Belum ada data struktur desa.<br>
                                    <a href="{{ route('admin.struktur-desa.create') }}" class="btn btn-primary-custom btn-sm mt-3">
                                        <i class="bi bi-plus-lg me-1"></i> Tambah Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-0 py-2 px-4">
            <small class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                Urutan menentukan posisi tampil di halaman publik. Semakin kecil angkanya, semakin atas posisinya.
            </small>
        </div>
    </div>
@endsection
