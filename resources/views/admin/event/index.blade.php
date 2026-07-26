@extends('layouts.dashboard')

@section('title', 'Kelola Event - Dashboard Admin')
@section('page_title', 'Kelola Agenda Event')

@section('content')
    <div class="card card-custom border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-calendar2-event text-primary-custom me-2"></i> Daftar Agenda Acara</h5>
            <a href="{{ route('admin.event.create') }}" class="btn btn-primary-custom btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Event Baru
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="ps-4">Poster</th>
                            <th>Nama Event</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Status</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr>
                                <td class="ps-4">
                                    <img src="{{ $event->foto_event ? asset('storage/' . $event->foto_event) : 'https://placehold.co/80x60/png?text=E' }}" class="rounded shadow-sm" style="width: 80px; height: 60px; object-fit: cover;" alt="{{ $event->nama_event }}">
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block" style="max-width: 250px;">{{ Str::limit($event->nama_event, 50) }}</span>
                                    <span class="text-muted small"><i class="bi bi-geo-alt"></i> {{ Str::limit($event->lokasi, 30) }}</span>
                                </td>
                                <td>
                                    <div class="small">
                                        <span class="fw-medium text-dark">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d M Y') }}</span>
                                        @if($event->tanggal_mulai != $event->tanggal_selesai)
                                            <span class="text-muted"> - {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d M Y') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($event->tanggal_selesai < now()->toDateString())
                                        <span class="badge bg-secondary">Selesai</span>
                                    @elseif($event->tanggal_mulai > now()->toDateString())
                                        <span class="badge bg-success">Akan Datang</span>
                                    @else
                                        <span class="badge bg-primary-custom">Berlangsung</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('event.show', $event->slug) }}" target="_blank" class="btn btn-outline-info btn-sm px-2" style="border-radius: 6px;" title="Lihat di Publik"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-outline-warning btn-sm px-2" style="border-radius: 6px;" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
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
                                    <i class="bi bi-calendar-x fs-1 d-block mb-3"></i>
                                    Belum ada agenda event yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
