@extends('layouts.dashboard')

@section('title', 'FAQ - Admin')
@section('page_title', 'Manajemen FAQ')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold text-dark mb-1">Daftar FAQ</h5>
            <p class="text-muted small mb-0">Kelola pertanyaan yang sering diajukan oleh pengunjung</p>
        </div>
        <a href="{{ route('admin.faq.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-lg me-1"></i> Tambah FAQ
        </a>
    </div>

    <div class="card card-custom border-0 shadow-sm">
        <div class="card-body p-0">
            @forelse($faqs as $index => $faq)
                <div class="border-bottom p-4 d-flex justify-content-between align-items-start gap-3">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-primary-custom">Q{{ $index + 1 }}</span>
                            <h6 class="fw-semibold text-dark mb-0">{{ $faq->pertanyaan }}</h6>
                        </div>
                        <p class="text-muted small mb-0 ms-4">{{ Str::limit($faq->jawaban, 150) }}</p>
                    </div>
                    <div class="d-flex gap-2 flex-shrink-0">
                        <a href="{{ route('admin.faq.edit', $faq) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    <i class="bi bi-question-circle fs-1 d-block mb-2 opacity-25"></i>
                    Belum ada FAQ. Silakan tambah FAQ baru.
                </div>
            @endforelse
        </div>
    </div>
@endsection
