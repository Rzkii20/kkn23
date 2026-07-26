@extends('layouts.dashboard')

@section('title', 'Dashboard Admin - Desa Sebong Lagoi')
@section('page_title', 'Ringkasan Sistem')

@section('content')
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- UMKM -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-custom border-0 shadow-sm h-100 py-2" style="border-left: 4px solid var(--ocean-blue) !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-uppercase mb-1" style="color: var(--ocean-blue);">Total UMKM Mitra</div>
                            <div class="h3 mb-0 fw-bold text-dark">{{ $stats['total_umkm'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-shop fs-1 text-muted opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-custom border-0 shadow-sm h-100 py-2" style="border-left: 4px solid var(--sea-blue) !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-uppercase mb-1" style="color: var(--sea-blue);">Total Produk Dijual</div>
                            <div class="h3 mb-0 fw-bold text-dark">{{ $stats['total_produk'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-seam fs-1 text-muted opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wisata -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-custom border-0 shadow-sm h-100 py-2" style="border-left: 4px solid var(--mangrove-green) !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-uppercase mb-1" style="color: var(--mangrove-green);">Destinasi Wisata</div>
                            <div class="h3 mb-0 fw-bold text-dark">{{ $stats['total_wisata'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-geo-alt fs-1 text-muted opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Artikel -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-custom border-0 shadow-sm h-100 py-2" style="border-left: 4px solid #f6c23e !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-uppercase mb-1" style="color: #f6c23e;">Berita & Artikel</div>
                            <div class="h3 mb-0 fw-bold text-dark">{{ $stats['total_artikel'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-journal-text fs-1 text-muted opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Latest UMKM -->
        <div class="col-lg-6">
            <div class="card card-custom border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-primary-custom"><i class="bi bi-shop me-2"></i> UMKM Baru Bergabung</h6>
                    <a href="{{ route('admin.umkm.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted small">
                                <tr>
                                    <th class="ps-4">Toko</th>
                                    <th>Pemilik</th>
                                    <th class="pe-4 text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestUmkms as $umkm)
                                    <tr>
                                        <td class="ps-4 fw-medium text-dark">{{ $umkm->nama_usaha }}</td>
                                        <td class="text-muted small">{{ $umkm->user?->name ?? 'Tidak ada pemilik' }}</td>
                                        <td class="pe-4 text-end">
                                            @if($umkm->status_aktif)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Non-Aktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted py-3">Belum ada UMKM terdaftar</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart UMKM Status -->
        <div class="col-lg-4 mb-4">
            <div class="card card-custom border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-dark"><i class="bi bi-pie-chart-fill me-2 text-warning"></i> Status UMKM Mitra</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2" style="position: relative; height: 250px;">
                        <canvas id="umkmStatusChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2"><i class="bi bi-circle-fill text-success"></i> Aktif ({{ $umkmByStatus['aktif'] }})</span>
                        <span class="mr-2"><i class="bi bi-circle-fill text-danger"></i> Non-Aktif ({{ $umkmByStatus['nonaktif'] }})</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Produk -->
        <div class="col-lg-8 mb-4">
            <div class="card card-custom border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-secondary-custom"><i class="bi bi-box-seam me-2"></i> Produk Baru Ditambahkan</h6>
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted small">
                                <tr>
                                    <th class="ps-4">Produk</th>
                                    <th>Toko</th>
                                    <th class="pe-4 text-end">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestProduks as $produk)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ $produk->foto_produk ? asset('storage/' . $produk->foto_produk) : 'https://placehold.co/40x40/png?text=P' }}" class="rounded" style="width: 32px; height: 32px; object-fit: cover;">
                                                <span class="fw-medium text-dark">{{ Str::limit($produk->nama_produk, 25) }}</span>
                                            </div>
                                        </td>
                                        <td class="text-muted small">{{ Str::limit($produk->umkm->nama_usaha, 20) }}</td>
                                        <td class="pe-4 text-end text-primary-custom fw-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted py-3">Belum ada produk ditambahkan</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("umkmStatusChart").getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Aktif", "Non-Aktif"],
                datasets: [{
                    data: [{{ $umkmByStatus['aktif'] }}, {{ $umkmByStatus['nonaktif'] }}],
                    backgroundColor: ['#1cc88a', '#e74a3b'],
                    hoverBackgroundColor: ['#17a673', '#e02d1b'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    });
</script>
@endsection
