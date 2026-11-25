@extends('layouts.app')

@section('title', 'Struktur Desa - Pemerintah Desa Sebong Lagoi')

@section('styles')
<style>
    .ed-kepala-wrap {
        display: flex;
        justify-content: center;
        margin-bottom: 12px;
    }

    .ed-kepala-card {
        background: var(--navy);
        color: var(--white);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 22px;
        padding: 36px 32px;
        text-align: center;
        width: 100%;
        max-width: 360px;
        box-shadow: 0 24px 60px rgba(15, 27, 61, 0.22);
        transition: transform 0.25s ease;
    }

    .ed-kepala-card:hover {
        transform: translateY(-4px);
    }

    .ed-kepala-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--hot-pink);
        color: var(--white);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 300px;
        margin-bottom: 22px;
    }

    .ed-kepala-avatar,
    .ed-kepala-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto;
        border: 3px solid rgba(255, 255, 255, 0.25);
    }

    .ed-kepala-avatar {
        object-fit: cover;
        display: block;
    }

    .ed-kepala-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        color: var(--white);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
    }

    .ed-kepala-nama {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.28rem;
        font-weight: 700;
        color: var(--white);
        margin-top: 18px;
    }

    .ed-kepala-periode {
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 4px;
    }

    .ed-kepala-hp {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 16px;
        padding: 7px 16px;
        border-radius: 300px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: var(--white);
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.2s ease, border-color 0.2s ease;
    }

    .ed-kepala-hp:hover {
        background: var(--hot-pink);
        border-color: var(--hot-pink);
        color: var(--white);
    }

    .ed-connector {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 auto 32px;
    }

    .ed-connector-line {
        width: 1.5px;
        height: 40px;
        background: rgba(15, 27, 61, 0.2);
    }

    .ed-connector-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--hot-pink);
    }

    .ed-anggota-label {
        text-align: center;
        font-size: 0.74rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--ink-muted);
        margin-bottom: 28px;
    }

    .ed-anggota-card {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 16px;
        padding: 26px 20px;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: border-color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    }

    .ed-anggota-card:hover {
        border-color: var(--navy);
        transform: translateY(-4px);
        box-shadow: 0 14px 36px rgba(15, 27, 61, 0.08);
    }

    .ed-anggota-badge {
        display: inline-block;
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        color: var(--navy);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 300px;
        margin-bottom: 18px;
    }

    .ed-anggota-avatar,
    .ed-anggota-placeholder {
        width: 88px;
        height: 88px;
        border-radius: 50%;
        border: 2px solid var(--border-hairline);
    }

    .ed-anggota-avatar {
        object-fit: cover;
        display: block;
    }

    .ed-anggota-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--navy);
        color: var(--white);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.75rem;
        font-weight: 700;
    }

    .ed-anggota-nama {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: var(--navy);
        margin-top: 14px;
    }

    .ed-anggota-periode {
        font-size: 0.78rem;
        color: var(--ink-muted);
        margin-top: 4px;
    }

    .ed-anggota-hp {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: auto;
        padding-top: 14px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--navy);
        text-decoration: none;
    }

    .ed-anggota-hp:hover {
        color: var(--hot-pink);
    }

    .ed-empty-card {
        max-width: 680px;
        margin: 0 auto;
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 20px;
        padding: 48px 32px;
        text-align: center;
    }

    .ed-empty-icon {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        color: var(--navy);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    .ed-empty-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 10px;
    }

    .ed-empty-desc {
        font-size: 0.92rem;
        color: var(--ink-muted);
        line-height: 1.65;
        max-width: 480px;
        margin: 0 auto 24px;
    }
</style>
@endsection

@section('content')

    <!-- ====================================================
         NAVY HERO HEADER
         ==================================================== -->
    <section class="ed-page-hero">
        <div class="container ed-container">
            <div class="ed-breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <a href="{{ route('about') }}">Tentang Desa</a>
                <span>/</span>
                <span class="is-current">Struktur Desa</span>
            </div>

            <h1 class="ed-page-title">
                Struktur Pemerintahan <span class="serif-italic">Desa Sebong Lagoi.</span>
            </h1>
            <p class="ed-page-lead">
                Susunan perangkat pemerintahan, pembagian wilayah administrasi, dan lembaga kemasyarakatan Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan.
            </p>
        </div>
    </section>

    <!-- ====================================================
         01 / SUSUNAN ORGANISASI DESA
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / Susunan Organisasi</span>
            </div>

            @if($strukturs->isEmpty())
                <div class="ed-empty-card reveal">
                    <div class="ed-empty-icon">
                        <i class="bi bi-diagram-3"></i>
                    </div>
                    <h2 class="ed-empty-title">Data Struktur Desa Belum Diunggah</h2>
                    <p class="ed-empty-desc">
                        Bagan susunan perangkat Desa Sebong Lagoi akan tampil otomatis di halaman ini setelah admin menginput data pejabat dan perangkat desa melalui Dashboard Admin.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('about') }}" class="ed-btn-secondary">
                            <i class="bi bi-arrow-left"></i> Tentang Desa
                        </a>
                        <a href="/kontak" class="ed-btn-primary">
                            Hubungi Kantor Desa <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </div>
                </div>
            @else
                @php
                    $kepala  = $strukturs->first();
                    $anggota = $strukturs->skip(1);
                @endphp

                <div class="ed-kepala-wrap reveal">
                    <div class="ed-kepala-card">
                        <span class="ed-kepala-badge">
                            <i class="bi bi-star-fill"></i> {{ $kepala->jabatan }}
                        </span>
                        <div>
                            @if($kepala->foto)
                                <img src="{{ asset('storage/' . $kepala->foto) }}" alt="{{ $kepala->nama }}" class="ed-kepala-avatar">
                            @else
                                <div class="ed-kepala-placeholder">{{ strtoupper(substr($kepala->nama, 0, 1)) }}</div>
                            @endif
                        </div>
                        <div class="ed-kepala-nama">{{ $kepala->nama }}</div>
                        @if($kepala->periode)
                            <div class="ed-kepala-periode"><i class="bi bi-calendar3 me-1"></i>{{ $kepala->periode }}</div>
                        @endif
                        @if($kepala->nomor_hp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kepala->nomor_hp) }}"
                               target="_blank" class="ed-kepala-hp">
                                <i class="bi bi-whatsapp"></i> {{ $kepala->nomor_hp }}
                            </a>
                        @endif
                    </div>
                </div>

                @if($anggota->isNotEmpty())
                    <div class="ed-connector reveal" aria-hidden="true">
                        <div class="ed-connector-line"></div>
                        <div class="ed-connector-dot"></div>
                    </div>

                    <div class="ed-anggota-label reveal">Perangkat Desa</div>

                    <div class="row g-4 justify-content-center">
                        @foreach($anggota as $item)
                            <div class="col-xl-3 col-lg-4 col-md-6 reveal">
                                <div class="ed-anggota-card">
                                    <span class="ed-anggota-badge">{{ $item->jabatan }}</span>
                                    <div>
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="ed-anggota-avatar">
                                        @else
                                            <div class="ed-anggota-placeholder">{{ strtoupper(substr($item->nama, 0, 1)) }}</div>
                                        @endif
                                    </div>
                                    <div class="ed-anggota-nama">{{ $item->nama }}</div>
                                    @if($item->periode)
                                        <div class="ed-anggota-periode"><i class="bi bi-calendar3 me-1"></i>{{ $item->periode }}</div>
                                    @endif
                                    @if($item->nomor_hp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->nomor_hp) }}"
                                           target="_blank" class="ed-anggota-hp">
                                            <i class="bi bi-whatsapp"></i> {{ $item->nomor_hp }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </section>

    <!-- ====================================================
         02 / TATA KELOLA & LEMBAGA DESA
         ==================================================== -->
    <section class="ed-section">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">02 / Tata Kelola &amp; Lembaga</span>
            </div>

            <div class="ed-section-head reveal">
                <div>
                    <span class="ed-kicker">Pemerintahan &amp; Kewilayahan</span>
                    <h2 class="ed-heading">Ringkasan Lembaga &amp; <span class="serif-italic">Administrasi</span> Desa.</h2>
                </div>
                <a href="{{ route('about') }}" class="ed-link-arrow">
                    Profil Lengkap Desa <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            <div class="ed-about-cards-3 reveal">
                <div class="ed-info-card">
                    <span class="ed-info-card-icon"><i class="bi bi-map"></i></span>
                    <h3>Pembagian Wilayah Administrasi</h3>
                    <p>
                        Wilayah Desa Sebong Lagoi terbagi menjadi <strong>3 Dusun, 3 RW, dan 12 RT</strong> guna mempermudah pelayanan administrasi pemerintahan kepada masyarakat.
                    </p>
                </div>

                <div class="ed-info-card">
                    <span class="ed-info-card-icon"><i class="bi bi-building"></i></span>
                    <h3>Penyelenggara Pemerintahan</h3>
                    <p>
                        Pemerintahan dijalankan oleh Kepala Desa bersama Perangkat Desa, bersinergi dengan <strong>Badan Permusyawaratan Desa (BPD)</strong> dalam perencanaan dan pembangunan desa.
                    </p>
                </div>

                <div class="ed-info-card">
                    <span class="ed-info-card-icon"><i class="bi bi-people"></i></span>
                    <h3>Lembaga Kemasyarakatan</h3>
                    <p>
                        Kehidupan sosial dan pemberdayaan ekonomi warga didukung aktif oleh lembaga desa lintas sektor.
                    </p>
                    <div class="ed-lembaga-pills">
                        <span class="ed-lembaga-pill">PKK</span>
                        <span class="ed-lembaga-pill">LPM</span>
                        <span class="ed-lembaga-pill">LINMAS</span>
                        <span class="ed-lembaga-pill">Posyandu</span>
                        <span class="ed-lembaga-pill">Karang Taruna</span>
                        <span class="ed-lembaga-pill">BUMDes</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
