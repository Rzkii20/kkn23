@extends('layouts.dashboard')

@section('title', 'Slider Banner - Admin')
@section('page_title', 'Manajemen Slider Banner')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold text-dark mb-1">Daftar Banner Slider</h5>
            <p class="text-muted small mb-0">Kelola gambar banner yang tampil di halaman utama</p>
        </div>
        <a href="{{ route('admin.slider.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-lg me-1"></i> Tambah Banner
        </a>
    </div>

    <div class="card card-custom border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="ps-4">Preview</th>
                            <th>Judul</th>
                            <th>Sub Judul</th>
                            <th class="text-center">Urutan</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td class="ps-4">
                                    <img src="{{ asset('storage/' . $slider->foto_banner) }}"
                                         alt="{{ $slider->judul }}"
                                         class="rounded" style="width: 80px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="fw-semibold text-dark">{{ $slider->judul ?? '-' }}</td>
                                <td class="text-muted small">{{ Str::limit($slider->subjudul, 50) ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary rounded-pill">{{ $slider->urutan }}</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="{{ route('admin.slider.edit', $slider) }}" class="btn btn-sm btn-outline-secondary me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.slider.destroy', $slider) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus banner ini?')">
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
                                    <i class="bi bi-card-image fs-1 d-block mb-2 opacity-25"></i>
                                    Belum ada banner slider. Silakan tambah banner baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
