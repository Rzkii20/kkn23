@extends('layouts.dashboard')

@section('title', 'Kelola UMKM - Dashboard Admin')
@section('page_title', 'Kelola Data UMKM')

@section('content')
    <div class="card card-custom border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-shop-window text-primary-custom me-2"></i> Daftar UMKM Desa</h5>
            <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="bi bi-plus-circle-fill me-1"></i> Tambah UMKM
            </a>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small uppercase">
                        <tr>
                            <th class="ps-4">Foto Toko</th>
                            <th>Nama Toko / Usaha</th>
                            <th>WhatsApp</th>
                            <th>Status Keaktifan</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($umkms as $umkm)
                            <tr>
                                <td class="ps-4">
                                    <img src="{{ $umkm->foto_toko ? asset('storage/' . $umkm->foto_toko) : 'https://placehold.co/100x80/png?text=' . urlencode($umkm->nama_usaha) }}" class="rounded shadow-sm" alt="{{ $umkm->nama_usaha }}" style="width: 70px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <span class="d-block fw-bold text-dark">{{ $umkm->nama_usaha }}</span>
                                    <span class="text-muted small"><i class="bi bi-tag-fill me-1"></i> /umkm/{{ $umkm->slug }}</span>
                                </td>
                                <td>
                                    <a href="https://wa.me/{{ $umkm->no_whatsapp }}" target="_blank" class="text-decoration-none fw-medium text-success">
                                        <i class="bi bi-whatsapp me-1"></i> +{{ $umkm->no_whatsapp }}
                                    </a>
                                </td>
                                <td>
                                    @if($umkm->status_aktif)
                                        <span class="badge bg-success small">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary small">Non-Aktif</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('umkm.show', $umkm->slug) }}" target="_blank" class="btn btn-outline-info btn-sm px-2" style="border-radius: 6px;" title="Lihat Halaman Publik">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="btn btn-outline-warning btn-sm px-2" style="border-radius: 6px;" title="Edit Profil & Akun">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mitra ini? Semua data produk terkait akan ikut terhapus!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-2" style="border-radius: 6px;" title="Hapus Akun & Profil">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-shop fs-1 text-muted d-block mb-3"></i>
                                    <span>Belum ada pelaku UMKM terdaftar dalam sistem.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
