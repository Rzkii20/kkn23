@extends('layouts.dashboard')

@section('title', 'Kelola Dokumen - Dashboard Admin')
@section('page_title', 'Dokumen & Administrasi')

@section('content')
    <div class="card card-custom border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-folder-fill text-warning me-2"></i> Daftar Dokumen</h5>
            <a href="{{ route('admin.dokumen.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Dokumen
            </a>
        </div>
        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3 border-0 shadow-sm" role="alert" style="border-radius: 10px;">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="ps-4" style="width: 40px;">#</th>
                            <th>Judul Dokumen</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>File</th>
                            <th>Tanggal Upload</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dokumens as $i => $dokumen)
                            <tr>
                                <td class="ps-4 text-muted small">{{ $i + 1 }}</td>
                                <td>
                                    <span class="fw-semibold text-dark d-block" style="max-width: 280px;">{{ $dokumen->judul }}</span>
                                    @if($dokumen->deskripsi)
                                        <small class="text-muted">{{ Str::limit($dokumen->deskripsi, 60) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 small">{{ $dokumen->kategori }}</span>
                                </td>
                                <td><span class="text-muted small">{{ $dokumen->tahun }}</span></td>
                                <td>
                                    @php $ext = pathinfo($dokumen->file_dokumen, PATHINFO_EXTENSION); @endphp
                                    <a href="{{ route('dokumen.lihat', $dokumen->id) }}" target="_blank"
                                       class="btn btn-outline-secondary btn-sm px-2" style="border-radius: 6px;" title="Lihat Dokumen">
                                        <i class="bi bi-{{ $ext === 'pdf' ? 'filetype-pdf' : 'file-earmark-text' }} me-1"></i>
                                        {{ strtoupper($ext) }}
                                    </a>
                                </td>
                                <td><span class="text-muted small">{{ $dokumen->created_at->format('d M Y') }}</span></td>
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}"
                                           class="btn btn-outline-warning btn-sm px-2" style="border-radius: 6px;" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus dokumen ini?');">
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
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder2-open fs-1 d-block mb-3"></i>
                                    Belum ada dokumen yang diunggah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
