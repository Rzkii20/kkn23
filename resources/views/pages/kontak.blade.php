@extends('layouts.app')

@section('title', 'Hubungi Kami - Desa Sebong Lagoi')

@section('content')
    <div class="py-5 bg-white border-bottom text-center">
        <div class="container">
            <h1 class="display-5 fw-bold mb-3 text-dark">Hubungi Kami</h1>
            <p class="lead text-muted mb-0 mx-auto" style="max-width: 600px;">Kami siap mendengarkan dan membantu Anda. Jangan ragu untuk menghubungi Pemerintah Desa atau pengelola UMKM Sebong Lagoi.</p>
        </div>
    </div>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="card card-custom border-0 shadow-sm h-100">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold text-dark mb-4">Informasi Kontak</h4>
                            
                            <div class="d-flex align-items-start mb-4 gap-3">
                                <div class="bg-primary-custom text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                                    <i class="bi bi-geo-alt fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Alamat Kantor</h6>
                                    <p class="text-muted mb-0 small">Jl. Pariwisata KM. 46, Desa Sebong Lagoi, Kecamatan Teluk Sebong, Kabupaten Bintan, Kepulauan Riau, Indonesia 29152</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-start mb-4 gap-3">
                                <div class="bg-primary-custom text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                                    <i class="bi bi-envelope fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Email</h6>
                                    <p class="text-muted mb-0 small">info@sebonglagoi.desa.id<br>support.umkm@sebonglagoi.desa.id</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-start mb-4 gap-3">
                                <div class="bg-primary-custom text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                                    <i class="bi bi-telephone fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Telepon / WhatsApp</h6>
                                    <p class="text-muted mb-0 small">+62 812-3456-7890 (Pelayanan)<br>+62 811-2233-4455 (Admin UMKM)</p>
                                </div>
                            </div>

                            <hr class="my-4">
                            
                            <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-outline-primary" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%;"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="btn btn-outline-danger" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%;"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="btn btn-outline-danger" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%;"><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div class="card card-custom border-0 shadow-sm h-100">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold text-dark mb-4">Kirim Pesan</h4>

                            @if(session('success'))
                                <div class="alert alert-success border-0 rounded-3 mb-4">
                                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('kontak.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama" class="form-label fw-medium text-dark small">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" id="nama"
                                               class="form-control @error('nama') is-invalid @enderror"
                                               value="{{ old('nama') }}" placeholder="John Doe">
                                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label fw-medium text-dark small">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" placeholder="john@example.com">
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="subjek" class="form-label fw-medium text-dark small">Subjek / Keperluan <span class="text-danger">*</span></label>
                                    <select name="subjek" id="subjek"
                                            class="form-select @error('subjek') is-invalid @enderror">
                                        <option value="" disabled {{ old('subjek') ? '' : 'selected' }}>Pilih Keperluan...</option>
                                        <option value="Informasi UMKM" {{ old('subjek') == 'Informasi UMKM' ? 'selected' : '' }}>Informasi UMKM &amp; Produk</option>
                                        <option value="Informasi Wisata" {{ old('subjek') == 'Informasi Wisata' ? 'selected' : '' }}>Informasi Pariwisata</option>
                                        <option value="Kerja Sama" {{ old('subjek') == 'Kerja Sama' ? 'selected' : '' }}>Kerja Sama / Sponsorship</option>
                                        <option value="Lainnya" {{ old('subjek') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('subjek')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-4">
                                    <label for="pesan" class="form-label fw-medium text-dark small">Pesan Anda <span class="text-danger">*</span></label>
                                    <textarea name="pesan" id="pesan" rows="5"
                                              class="form-control @error('pesan') is-invalid @enderror"
                                              placeholder="Tuliskan pesan atau pertanyaan Anda di sini...">{{ old('pesan') }}</textarea>
                                    @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <button type="submit" class="btn btn-primary-custom w-100 py-2 fw-bold">
                                    <i class="bi bi-send me-2"></i> Kirim Pesan Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Peta Lokasi -->
            <div class="mt-5">
                <div class="card card-custom border-0 shadow-sm overflow-hidden">
                    <div class="card-body p-0">
                        <!-- Menggunakan iframe embed Google Maps Desa Sebong Lagoi atau titik umum -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127608.2037142436!2d104.2541315609459!3d1.1189382604857416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d99fb627d3c0a5%3A0xc3b841ea87d19e9!2sSebong%20Lagoi%2C%20Kec.%20Tlk.%20Sebong%2C%20Kabupaten%20Bintan%2C%20Kepulauan%20Riau!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="400" style="border:0; display: block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
