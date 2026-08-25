@extends('layouts.app')

@section('title', $event->nama_event . ' - Agenda Event Desa Sebong Lagoi')
@section('meta_description', Str::limit(strip_tags($event->deskripsi), 160))
@section('og_image', $event->foto_event ? asset('storage/' . $event->foto_event) : asset('images/logo-bintan.png'))
@section('og_type', 'event')

@section('content')
    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Agenda Acara</a></li>
                    <li class="breadcrumb-item active text-truncate" style="max-width: 200px;">{{ $event->nama_event }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <img src="{{ $event->foto_event ? asset('storage/' . $event->foto_event) : 'https://placehold.co/1000x500/png?text=' . urlencode($event->nama_event) }}" class="img-fluid rounded-4 shadow-sm w-100 mb-4" style="max-height: 450px; object-fit: cover;" alt="{{ $event->nama_event }}">
                    
                    <h1 class="fw-bold text-dark mb-4">{{ $event->nama_event }}</h1>
                    
                    <div class="content text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                        {!! nl2br(e($event->deskripsi)) !!}
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-custom border-0 shadow-sm bg-light sticky-top" style="top: 100px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 border-bottom pb-3">Informasi Acara</h5>
                            
                            <div class="d-flex align-items-start gap-3 mb-4">
                                <div class="bg-primary-custom text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; flex-shrink: 0;">
                                    <i class="bi bi-calendar-event fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small fw-bold mb-1">Tanggal Acara</span>
                                    <span class="text-dark">
                                        {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('l, d F Y') }}
                                        @if($event->tanggal_mulai != $event->tanggal_selesai)
                                            <br>s/d<br>
                                            {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('l, d F Y') }}
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3 mb-4">
                                <div class="bg-primary-custom text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; flex-shrink: 0;">
                                    <i class="bi bi-geo-alt fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small fw-bold mb-1">Lokasi</span>
                                    <span class="text-dark">{{ $event->lokasi }}</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3 mb-4">
                                <div class="bg-primary-custom text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; flex-shrink: 0;">
                                    <i class="bi bi-info-circle fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small fw-bold mb-1">Status</span>
                                    @if($event->tanggal_selesai < now()->toDateString())
                                        <span class="badge bg-secondary">Acara Selesai</span>
                                    @elseif($event->tanggal_mulai > now()->toDateString())
                                        <span class="badge bg-success">Akan Datang</span>
                                    @else
                                        <span class="badge bg-primary-custom">Sedang Berlangsung</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <p class="small text-muted fw-bold mb-2">Bagikan Acara Ini:</p>
                                <div class="d-flex gap-2">
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($event->nama_event . ' - ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-success flex-fill"><i class="bi bi-whatsapp me-1"></i> WhatsApp</a>
                                    <button onclick="navigator.clipboard.writeText(window.location.href).then(() => alert('Tautan disalin!'))" class="btn btn-sm btn-secondary flex-fill"><i class="bi bi-link-45deg me-1"></i> Salin Link</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($otherEvents->isNotEmpty())
        <section class="py-5 bg-light">
            <div class="container">
                <h4 class="fw-bold mb-4">Acara Menarik Lainnya</h4>
                <div class="row g-4">
                    @foreach($otherEvents as $other)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('event.show', $other->slug) }}" class="text-decoration-none">
                                <div class="card card-custom border-0 shadow-sm h-100">
                                    <img src="{{ $other->foto_event ? asset('storage/' . $other->foto_event) : 'https://placehold.co/400x300/png?text=' . urlencode($other->nama_event) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $other->nama_event }}">
                                    <div class="card-body p-3">
                                        <h6 class="fw-bold text-dark mb-1">{{ Str::limit($other->nama_event, 40) }}</h6>
                                        <div class="small text-muted"><i class="bi bi-calendar2 me-1"></i> {{ \Carbon\Carbon::parse($other->tanggal_mulai)->translatedFormat('d M Y') }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
