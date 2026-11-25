@extends('layouts.app')

@section('title', 'Hubungi Kami - Desa Sebong Lagoi')
@section('minimal_footer', true)

@section('styles')
<style>
    .kt-fact-strip {
        grid-template-columns: repeat(3, 1fr);
        max-width: 820px;
    }

    /* Left Deep Navy Contact Card */
    .kt-info-card {
        background: var(--navy);
        color: var(--white);
        border-radius: 20px;
        padding: 34px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 28px;
        box-shadow: 0 18px 46px rgba(15, 27, 61, 0.14);
    }

    .kt-card-kicker {
        display: block;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--hot-pink);
        margin-bottom: 8px;
    }

    .kt-info-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--white);
        margin: 0 0 24px;
    }

    .kt-info-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .kt-info-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .kt-info-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.09);
        border: 1px solid rgba(255, 255, 255, 0.14);
        color: var(--hot-pink);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        flex-shrink: 0;
    }

    .kt-info-label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.84rem;
        font-weight: 700;
        color: var(--white);
        margin: 0 0 4px;
    }

    .kt-info-text {
        font-size: 0.86rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.76);
        margin: 0;
    }

    .kt-info-link {
        color: rgba(255, 255, 255, 0.86);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .kt-info-link:hover {
        color: var(--hot-pink);
    }

    .kt-social-wrap {
        padding-top: 22px;
        border-top: 1px solid rgba(255, 255, 255, 0.14);
    }

    .kt-social-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.68);
        margin: 0 0 12px;
    }

    .kt-social-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .kt-social-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 14px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.09);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: var(--white);
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.2s ease, border-color 0.2s ease;
    }

    .kt-social-pill:hover {
        background: var(--hot-pink);
        border-color: var(--hot-pink);
        color: var(--white);
    }

    /* Right Clean White Form Card */
    .kt-form-card {
        background: var(--white);
        border: 1px solid var(--border-hairline);
        border-radius: 20px;
        padding: 34px;
        height: 100%;
    }

    .kt-form-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--navy);
        margin: 0 0 22px;
    }

    .kt-label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 6px;
    }

    .kt-input,
    .kt-select {
        background: var(--bg-alt);
        border: 1px solid var(--border-hairline);
        border-radius: 12px;
        padding: 11px 14px;
        font-size: 0.9rem;
        color: var(--navy);
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    }

    .kt-input:focus,
    .kt-select:focus {
        background: var(--white);
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(15, 27, 61, 0.08);
    }

    .kt-submit-btn {
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px 24px;
        border: none;
        border-radius: 999px;
        background: var(--hot-pink);
        color: var(--white);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.92rem;
        font-weight: 700;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }

    .kt-submit-btn:hover {
        background: var(--hot-pink-hover);
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 12px 26px rgba(255, 61, 139, 0.28);
    }

    /* Map Container */
    .kt-map-frame {
        border: 1px solid var(--border-hairline);
        border-radius: 20px;
        overflow: hidden;
        background: var(--white);
        box-shadow: 0 12px 32px rgba(15, 27, 61, 0.06);
    }

    @media (max-width: 767px) {
        .kt-fact-strip {
            grid-template-columns: 1fr;
        }

        .kt-info-card,
        .kt-form-card {
            padding: 24px;
        }
    }
</style>
@endsection

@section('content')

    <!-- ====================================================
         NAVY EDITORIAL HERO
         ==================================================== -->
    <section class="ed-page-hero">
        <div class="container ed-container">
            <div class="ed-breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <span class="is-current">Kontak</span>
            </div>

            <h1 class="ed-page-title">
                Hubungi <span class="serif-italic">Pemerintah Desa.</span>
            </h1>
            <p class="ed-page-lead">
                Kami siap mendengarkan dan membantu Anda. Sampaikan pertanyaan, aspirasi, atau kerja sama kepada Pemerintah Desa dan pengelola UMKM Desa Sebong Lagoi.
            </p>

            <div class="ed-fact-strip kt-fact-strip">
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Jam Pelayanan</span>
                    <div class="ed-fact-value">Senin – Jumat, 08:00–16:00 WIB</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Telepon / WhatsApp</span>
                    <div class="ed-fact-value">+62 812-6155-4737</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Email Resmi</span>
                    <div class="ed-fact-value">sebonglagoi11@gmail.com</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         01 / SALURAN & PESAN
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / SALURAN &amp; PESAN</span>
            </div>

            <div class="row g-4 align-items-stretch">
                {{-- Left: Deep Navy Contact Card --}}
                <div class="col-lg-5 reveal">
                    <div class="kt-info-card">
                        <div>
                            <span class="kt-card-kicker">Kantor Desa Sebong Lagoi</span>
                            <h2 class="kt-info-title">Informasi Kontak</h2>

                            <div class="kt-info-list">
                                <div class="kt-info-item">
                                    <div class="kt-info-icon">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <div>
                                        <h3 class="kt-info-label">Alamat Kantor</h3>
                                        <p class="kt-info-text">
                                            Jl. Pancamarga No. 3A, Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan, Kepulauan Riau 29152
                                        </p>
                                    </div>
                                </div>

                                <div class="kt-info-item">
                                    <div class="kt-info-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div>
                                        <h3 class="kt-info-label">Email</h3>
                                        <p class="kt-info-text">
                                            <a href="mailto:sebonglagoi11@gmail.com" class="kt-info-link">sebonglagoi11@gmail.com</a>
                                        </p>
                                    </div>
                                </div>

                                <div class="kt-info-item">
                                    <div class="kt-info-icon">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div>
                                        <h3 class="kt-info-label">Telepon / WhatsApp</h3>
                                        <p class="kt-info-text">
                                            <a href="https://wa.me/6281261554737" target="_blank" rel="noopener" class="kt-info-link">+62 812-6155-4737</a>
                                            (Pemerintah Desa / Pelayanan)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="kt-social-wrap">
                            <h3 class="kt-social-title">Ikuti Kami</h3>
                            <div class="kt-social-pills">
                                <a href="https://www.facebook.com/sebonglagoi" target="_blank" rel="noopener" class="kt-social-pill" title="Facebook">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                                <a href="https://www.instagram.com/sebonglagoibintan" target="_blank" rel="noopener" class="kt-social-pill" title="Instagram">
                                    <i class="bi bi-instagram"></i> Instagram
                                </a>
                                <a href="https://sebonglagoi.simdesprima.id/" target="_blank" rel="noopener" class="kt-social-pill" title="Website Resmi">
                                    <i class="bi bi-globe"></i> Website Resmi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Clean White Form Card --}}
                <div class="col-lg-7 reveal">
                    <div class="kt-form-card">
                        <span class="kt-card-kicker">Kirim Pesan Langsung</span>
                        <h2 class="kt-form-title">Tulis Pesan Anda</h2>

                        @if(session('success'))
                            <div class="alert alert-success border-0 rounded-3 mb-4">
                                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('kontak.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label kt-label">Nama Lengkap <span style="color: var(--hot-pink);">*</span></label>
                                    <input type="text"
                                           name="nama"
                                           id="nama"
                                           class="form-control kt-input @error('nama') is-invalid @enderror"
                                           value="{{ old('nama') }}"
                                           placeholder="Masukkan nama lengkap">
                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label kt-label">Email <span style="color: var(--hot-pink);">*</span></label>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="form-control kt-input @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}"
                                           placeholder="nama@email.com">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label for="subjek" class="form-label kt-label">Subjek / Keperluan <span style="color: var(--hot-pink);">*</span></label>
                                    <select name="subjek"
                                            id="subjek"
                                            class="form-select kt-select @error('subjek') is-invalid @enderror">
                                        <option value="" disabled {{ old('subjek') ? '' : 'selected' }}>Pilih Keperluan...</option>
                                        <option value="Informasi UMKM" {{ old('subjek') == 'Informasi UMKM' ? 'selected' : '' }}>Informasi UMKM &amp; Produk</option>
                                        <option value="Informasi Wisata" {{ old('subjek') == 'Informasi Wisata' ? 'selected' : '' }}>Informasi Pariwisata</option>
                                        <option value="Kerja Sama" {{ old('subjek') == 'Kerja Sama' ? 'selected' : '' }}>Kerja Sama / Sponsorship</option>
                                        <option value="Lainnya" {{ old('subjek') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('subjek')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label for="pesan" class="form-label kt-label">Pesan Anda <span style="color: var(--hot-pink);">*</span></label>
                                    <textarea name="pesan"
                                              id="pesan"
                                              rows="5"
                                              class="form-control kt-input @error('pesan') is-invalid @enderror"
                                              placeholder="Tuliskan pesan, aspirasi, atau pertanyaan Anda di sini...">{{ old('pesan') }}</textarea>
                                    @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12 pt-2">
                                    <button type="submit" class="kt-submit-btn">
                                        <i class="bi bi-send"></i> Kirim Pesan Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         02 / PETA LOKASI
         ==================================================== -->
    <section class="ed-section">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">02 / PETA LOKASI</span>
            </div>

            <div class="ed-section-head reveal">
                <div>
                    <span class="ed-kicker">Peta Wilayah</span>
                    <h2 class="ed-heading">
                        Lokasi <span class="serif-italic">Sebong Lagoi.</span>
                    </h2>
                </div>
                <a href="https://maps.google.com/?q=Sebong+Lagoi,+Teluk+Sebong,+Bintan,+Kepulauan+Riau"
                   target="_blank"
                   rel="noopener"
                   class="ed-link-arrow">
                    Buka di Google Maps <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            <div class="kt-map-frame reveal">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127608.2037142436!2d104.2541315609459!3d1.1189382604857416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d99fb627d3c0a5%3A0xc3b841ea87d19e9!2sSebong%20Lagoi%2C%20Kec.%20Tlk.%20Sebong%2C%20Kabupaten%20Bintan%2C%20Kepulauan%20Riau!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        width="100%"
                        height="400"
                        style="border:0; display: block;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Peta Lokasi Desa Sebong Lagoi"></iframe>
            </div>
        </div>
    </section>

@endsection
