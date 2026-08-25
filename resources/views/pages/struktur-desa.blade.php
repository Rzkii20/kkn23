@extends('layouts.app')

@section('title', 'Struktur Desa - Pemerintah Desa Sebong Lagoi')

@section('styles')
<style>
    /* === HERO SECTION === */
    .struktur-hero {
        background: linear-gradient(135deg, rgba(0,48,73,0.85) 0%, rgba(11,100,72,0.8) 100%),
                    url('{{ asset('images/tentang-desa.jpg') }}') no-repeat center center;
        background-size: cover;
        padding: 80px 0 60px;
        text-align: center;
        color: #fff;
    }
    .struktur-hero h1 {
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        font-weight: 800;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    .hero-breadcrumb a { color: rgba(255,255,255,0.75); text-decoration: none; }
    .hero-breadcrumb a:hover { color: #fff; }
    .hero-breadcrumb span { color: rgba(255,255,255,0.5); margin: 0 6px; }

    /* === STRUKTUR CARDS === */
    .struktur-section { padding: 60px 0 80px; background: #f8f9fa; }

    .kepala-desa-wrap {
        display: flex;
        justify-content: center;
        margin-bottom: 50px;
    }

    /* Card kepala desa — lebih besar */
    .card-kepala {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,48,73,0.12);
        padding: 36px 40px;
        text-align: center;
        width: 100%;
        max-width: 320px;
        position: relative;
        border-top: 5px solid var(--mangrove-green, #0b6448);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-kepala:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 50px rgba(0,48,73,0.18);
    }
    .card-kepala .jabatan-badge {
        display: inline-block;
        background: linear-gradient(135deg, #0b6448, #1a8a62);
        color: #fff;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 4px 16px;
        border-radius: 50px;
        margin-bottom: 20px;
    }
    .card-kepala .foto-wrap img,
    .card-kepala .foto-wrap .foto-placeholder {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #e8f5f0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    }
    .card-kepala .foto-wrap .foto-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0b6448, #1a8a62);
        color: #fff;
        font-size: 2.8rem;
        font-weight: 700;
    }
    .card-kepala .nama { font-size: 1.25rem; font-weight: 700; color: #1a1a2e; margin-top: 16px; }
    .card-kepala .periode-text { font-size: 0.82rem; color: #888; margin-top: 4px; }
    .card-kepala .hp-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 12px;
        font-size: 0.84rem;
        color: #0b6448;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }
    .card-kepala .hp-link:hover { color: #003049; }

    /* Connector line between kepala and bawahan */
    .connector-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 auto 40px;
    }
    .connector-line {
        width: 3px;
        height: 36px;
        background: linear-gradient(to bottom, #0b6448, #d0e9e0);
    }
    .connector-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #0b6448;
        border: 3px solid #d0e9e0;
    }

    /* Grid untuk anggota lainnya */
    .grid-title {
        text-align: center;
        font-size: 1.05rem;
        font-weight: 700;
        color: #555;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 30px;
        position: relative;
    }
    .grid-title::before, .grid-title::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 80px;
        height: 1px;
        background: #ccc;
    }
    .grid-title::before { right: calc(50% + 120px); }
    .grid-title::after  { left:  calc(50% + 120px); }

    .card-anggota {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        padding: 28px 20px;
        text-align: center;
        height: 100%;
        border-top: 4px solid var(--sea-blue, #0077b6);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-anggota:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.12);
    }
    .card-anggota .jabatan-badge {
        display: inline-block;
        background: #eaf4ff;
        color: #0077b6;
        font-size: 0.73rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        padding: 3px 12px;
        border-radius: 50px;
        margin-bottom: 16px;
    }
    .card-anggota .foto-wrap img,
    .card-anggota .foto-wrap .foto-placeholder {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e8f0fb;
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        margin: 0 auto;
    }
    .card-anggota .foto-wrap .foto-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0077b6, #0096d6);
        color: #fff;
        font-size: 1.8rem;
        font-weight: 700;
    }
    .card-anggota .nama { font-size: 1rem; font-weight: 700; color: #1a1a2e; margin-top: 12px; }
    .card-anggota .periode-text { font-size: 0.78rem; color: #999; margin-top: 3px; }
    .card-anggota .hp-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-top: 10px;
        font-size: 0.8rem;
        color: #0077b6;
        text-decoration: none;
        font-weight: 600;
    }
    .card-anggota .hp-link:hover { color: #003049; }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #aaa;
    }
    .empty-state i { font-size: 4rem; opacity: 0.3; }

    @media (max-width: 576px) {
        .grid-title::before, .grid-title::after { display: none; }
        .card-kepala { max-width: 100%; }
    }
</style>
@endsection

@section('content')
    {{-- HERO --}}
    <div class="struktur-hero">
        <div class="container">
            <nav class="hero-breadcrumb mb-3" aria-label="breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <a href="{{ route('about') }}">Tentang Desa</a>
                <span>/</span>
                <span>Struktur Desa</span>
            </nav>
            <h1>Struktur Pemerintahan Desa</h1>
            <p class="lead text-white-50 mt-2 mb-0" style="font-size: 1.05rem;">
                Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan
            </p>
        </div>
    </div>

    {{-- STRUKTUR SECTION --}}
    <section class="struktur-section">
        <div class="container">

            @if($strukturs->isEmpty())
                {{-- Empty state --}}
                <div class="empty-state">
                    <i class="bi bi-diagram-3 d-block mb-3"></i>
                    <p class="fw-semibold">Data struktur desa belum tersedia.</p>
                </div>
            @else
                @php
                    // Pisahkan Kepala Desa (urutan 0 / terendah) dari anggota lainnya
                    $kepala   = $strukturs->first();
                    $anggota  = $strukturs->skip(1);
                @endphp

                {{-- KEPALA DESA (center / paling atas) --}}
                <div class="kepala-desa-wrap reveal">
                    <div class="card-kepala">
                        <span class="jabatan-badge">
                            <i class="bi bi-star-fill me-1"></i>{{ $kepala->jabatan }}
                        </span>
                        <div class="foto-wrap">
                            @if($kepala->foto)
                                <img src="{{ asset('storage/' . $kepala->foto) }}" alt="{{ $kepala->nama }}">
                            @else
                                <div class="foto-placeholder">{{ strtoupper(substr($kepala->nama, 0, 1)) }}</div>
                            @endif
                        </div>
                        <div class="nama">{{ $kepala->nama }}</div>
                        @if($kepala->periode)
                            <div class="periode-text"><i class="bi bi-calendar3 me-1"></i>{{ $kepala->periode }}</div>
                        @endif
                        @if($kepala->nomor_hp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kepala->nomor_hp) }}"
                               target="_blank" class="hp-link">
                                <i class="bi bi-whatsapp"></i> {{ $kepala->nomor_hp }}
                            </a>
                        @endif
                    </div>
                </div>

                @if($anggota->isNotEmpty())
                    {{-- Konektor garis --}}
                    <div class="connector-wrap reveal">
                        <div class="connector-line"></div>
                        <div class="connector-dot"></div>
                    </div>

                    {{-- LABEL PERANGKAT DESA --}}
                    <div class="grid-title reveal">Perangkat Desa</div>

                    {{-- GRID ANGGOTA LAINNYA --}}
                    <div class="row g-4 justify-content-center">
                        @foreach($anggota as $item)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 reveal">
                                <div class="card-anggota">
                                    <span class="jabatan-badge">{{ $item->jabatan }}</span>
                                    <div class="foto-wrap">
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
                                        @else
                                            <div class="foto-placeholder">{{ strtoupper(substr($item->nama, 0, 1)) }}</div>
                                        @endif
                                    </div>
                                    <div class="nama">{{ $item->nama }}</div>
                                    @if($item->periode)
                                        <div class="periode-text"><i class="bi bi-calendar3 me-1"></i>{{ $item->periode }}</div>
                                    @endif
                                    @if($item->nomor_hp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->nomor_hp) }}"
                                           target="_blank" class="hp-link">
                                            <i class="bi bi-whatsapp"></i> {{ $item->nomor_hp }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            @endif

            {{-- Tombol kembali --}}
            <div class="text-center mt-5 reveal">
                <a href="{{ route('about') }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Tentang Desa
                </a>
            </div>

        </div>
    </section>
@endsection
