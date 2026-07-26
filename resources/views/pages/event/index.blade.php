@extends('layouts.app')

@section('title', 'Agenda Event - Desa Sebong Lagoi')

@section('content')
    <div class="py-5 text-white position-relative" style="background: linear-gradient(rgba(45, 106, 79, 0.8), rgba(45, 106, 79, 0.8)), url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2000&auto=format&fit=crop') no-repeat center center; background-size: cover;">
        <div class="container text-center py-4">
            <h1 class="display-4 fw-bold mb-3">Agenda & Acara Desa</h1>
            <p class="lead mb-0 text-white-50 mx-auto" style="max-width: 600px;">Ikuti berbagai kegiatan, festival, dan perayaan yang diselenggarakan di Desa Sebong Lagoi</p>
        </div>
    </div>

    <section class="py-5 bg-light">
        <div class="container">
            <!-- UPCOMING EVENTS -->
            <div class="d-flex align-items-center mb-4">
                <h3 class="fw-bold text-dark mb-0"><i class="bi bi-calendar2-event text-primary-custom me-2"></i> Acara Akan Datang</h3>
                <div class="ms-auto">
                    <span class="badge bg-primary-custom px-3 py-2 rounded-pill">{{ $events->total() }} Acara</span>
                </div>
            </div>

            <div class="row g-4 mb-5">
                @forelse($events as $event)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-custom h-100 border-0 shadow-sm overflow-hidden">
                            <div class="position-relative">
                                <img src="{{ $event->foto_event ? asset('storage/' . $event->foto_event) : 'https://placehold.co/600x400/png?text=' . urlencode($event->nama_event) }}" class="card-img-top w-100" style="height: 220px; object-fit: cover;" alt="{{ $event->nama_event }}">
                                
                                <div class="position-absolute top-0 start-0 m-3 text-center bg-white rounded-3 shadow-sm overflow-hidden" style="width: 60px;">
                                    <div class="bg-danger text-white fw-bold small py-1">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('M') }}</div>
                                    <div class="fw-bold fs-4 py-1 text-dark">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d') }}</div>
                                </div>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <h5 class="fw-bold mb-3">
                                    <a href="{{ route('event.show', $event->slug) }}" class="text-dark text-decoration-none hover-primary">{{ $event->nama_event }}</a>
                                </h5>
                                
                                <div class="d-flex flex-column gap-2 mb-4 text-muted small">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="bi bi-calendar3 mt-1"></i>
                                        <span>
                                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}
                                            @if($event->tanggal_mulai != $event->tanggal_selesai)
                                                - {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d F Y') }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="bi bi-geo-alt mt-1"></i>
                                        <span>{{ Str::limit($event->lokasi, 40) }}</span>
                                    </div>
                                </div>

                                <p class="text-muted small flex-grow-1">{{ Str::limit($event->deskripsi, 90) }}</p>
                                
                                <a href="{{ route('event.show', $event->slug) }}" class="btn btn-outline-secondary w-100 mt-2" style="border-radius: 8px;">Detail Acara</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
                        <i class="bi bi-calendar-x text-muted fs-1 d-block mb-3"></i>
                        <h4 class="fw-bold text-muted">Tidak Ada Acara Terjadwal</h4>
                        <p class="text-muted mb-0">Saat ini tidak ada acara yang akan datang di Desa Sebong Lagoi.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center">
                {{ $events->links('pagination::bootstrap-5') }}
            </div>

            <!-- PAST EVENTS -->
            @if($pastEvents->isNotEmpty())
                <div class="mt-5 pt-5 border-top">
                    <h3 class="fw-bold text-dark mb-4"><i class="bi bi-clock-history text-secondary me-2"></i> Acara Sebelumnya</h3>
                    <div class="row g-4">
                        @foreach($pastEvents as $past)
                            <div class="col-md-4">
                                <a href="{{ route('event.show', $past->slug) }}" class="text-decoration-none">
                                    <div class="card card-custom bg-white border-0 shadow-sm d-flex flex-row align-items-center p-2">
                                        <img src="{{ $past->foto_event ? asset('storage/' . $past->foto_event) : 'https://placehold.co/100x100/png?text=Event' }}" class="rounded-3" style="width: 80px; height: 80px; object-fit: cover;" alt="{{ $past->nama_event }}">
                                        <div class="ms-3 py-2">
                                            <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">{{ Str::limit($past->nama_event, 35) }}</h6>
                                            <div class="small text-muted"><i class="bi bi-calendar2 me-1"></i> {{ \Carbon\Carbon::parse($past->tanggal_mulai)->translatedFormat('d M Y') }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
