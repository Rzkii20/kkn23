@extends('layouts.dashboard')

@section('title', 'Edit FAQ - Admin')
@section('page_title', 'Edit FAQ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-pencil-fill me-2 text-warning"></i>Edit FAQ</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.faq.update', $faq) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label for="pertanyaan" class="form-label fw-medium">Pertanyaan <span class="text-danger">*</span></label>
                            <input type="text" name="pertanyaan" id="pertanyaan"
                                   class="form-control @error('pertanyaan') is-invalid @enderror"
                                   value="{{ old('pertanyaan', $faq->pertanyaan) }}"
                                   placeholder="Contoh: Bagaimana cara mendaftarkan UMKM saya?">
                            @error('pertanyaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="jawaban" class="form-label fw-medium">Jawaban <span class="text-danger">*</span></label>
                            <textarea name="jawaban" id="jawaban" rows="5"
                                      class="form-control @error('jawaban') is-invalid @enderror"
                                      placeholder="Tuliskan jawaban yang jelas dan informatif...">{{ old('jawaban', $faq->jawaban) }}</textarea>
                            @error('jawaban')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="bi bi-check-lg me-1"></i> Perbarui FAQ
                            </button>
                            <a href="{{ route('admin.faq.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
