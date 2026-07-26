@extends('layouts.dashboard')

@section('title', 'Detail Pesan - Admin')
@section('page_title', 'Detail Pesan Kontak')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-envelope-fill me-2 text-primary-custom"></i>Detail Pesan</h6>
                    <a href="{{ route('admin.pesan.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body p-4">
                    <!-- Sender Info -->
                    <div class="row g-3 mb-4 p-3 bg-light rounded-3">
                        <div class="col-sm-6">
                            <div class="text-muted small fw-medium mb-1">Nama Pengirim</div>
                            <div class="fw-semibold text-dark">{{ $pesan->nama }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small fw-medium mb-1">Email</div>
                            <a href="mailto:{{ $pesan->email }}" class="fw-semibold text-primary-custom">{{ $pesan->email }}</a>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small fw-medium mb-1">Subjek</div>
                            <span class="badge bg-primary-custom">{{ $pesan->subjek }}</span>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small fw-medium mb-1">Dikirim Pada</div>
                            <div class="text-dark">{{ $pesan->created_at->format('d F Y, H:i') }} WIB</div>
                        </div>
                    </div>

                    <!-- Message Body -->
                    <div class="mb-4">
                        <div class="text-muted small fw-medium mb-2">Isi Pesan</div>
                        <div class="p-3 border rounded-3 bg-white" style="min-height: 120px; line-height: 1.7;">
                            {{ $pesan->pesan }}
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-2">
                        <a href="mailto:{{ $pesan->email }}?subject=Re: {{ $pesan->subjek }}" class="btn btn-primary-custom">
                            <i class="bi bi-reply me-1"></i> Balas via Email
                        </a>
                        <form action="{{ route('admin.pesan.destroy', $pesan) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash me-1"></i> Hapus Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
