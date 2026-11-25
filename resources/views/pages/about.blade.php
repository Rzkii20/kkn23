@extends('layouts.app')

@section('title', 'Tentang Desa - Pemerintah Desa Sebong Lagoi')

@section('content')

    <!-- ====================================================
         NAVY HERO HEADER + RINGKASAN PROFIL
         ==================================================== -->
    <section class="ed-page-hero">
        <div class="container ed-container">
            <div class="ed-breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <span>Profil Desa</span>
                <span>/</span>
                <span class="is-current">Tentang Desa</span>
            </div>

            <h1 class="ed-page-title">
                Mengenal Desa <span class="serif-italic">Sebong Lagoi</span> Lebih Dekat.
            </h1>
            <p class="ed-page-lead">
                Sejarah singkat, profil wilayah, pemerintahan, visi dan misi, serta letak geografis Desa Sebong Lagoi berdasarkan Profil Desa Tahun 2025.
            </p>

            <div class="ed-fact-strip">
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Luas Wilayah</span>
                    <div class="ed-fact-value">71.000 ha</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Pembagian Wilayah</span>
                    <div class="ed-fact-value">3 Dusun · 3 RW · 12 RT</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Ketinggian</span>
                    <div class="ed-fact-value">± 10 mdpl</div>
                </div>
                <div class="ed-fact-chip">
                    <span class="ed-fact-label">Jarak ke Kec. Teluk Sebong</span>
                    <div class="ed-fact-value">± 5 km</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         01 / PROFIL WILAYAH & SEJARAH DESA
         ==================================================== -->
    <section class="ed-section">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">01 / Profil &amp; Sejarah</span>
            </div>

            <div class="row g-5 align-items-start">
                <div class="col-lg-5 reveal">
                    <span class="ed-kicker">Selayang Pandang</span>
                    <h2 class="ed-heading mb-4">
                        Gambaran Umum <span class="serif-italic">Wilayah</span> Desa.
                    </h2>

                    <div class="ed-about-photo-card mb-4">
                        <img src="{{ asset('images/tentang-desa.jpg') }}" alt="Desa Sebong Lagoi">
                        <div class="ed-about-photo-cap">
                            <span><strong>Desa Sebong Lagoi</strong></span>
                            <span>Teluk Sebong, Bintan</span>
                        </div>
                    </div>

                    <div class="ed-prose">
                        <p>
                            Desa Sebong Lagoi merupakan salah satu desa yang berada di Kecamatan Teluk Sebong, Kabupaten Bintan, Provinsi Kepulauan Riau. Berdasarkan Profil Desa Sebong Lagoi Tahun 2025, desa ini memiliki luas wilayah sekitar <strong>71.000 ha</strong> dan berada pada ketinggian sekitar <strong>10 meter di atas permukaan laut</strong>.
                        </p>
                        <p>
                            Secara geografis, Desa Sebong Lagoi memiliki dua musim utama, yaitu musim kemarau yang berlangsung sekitar bulan Maret hingga Agustus dan musim hujan sekitar bulan September hingga Februari. Jarak desa menuju pusat Provinsi Kepulauan Riau sekitar 80 km, pusat Kabupaten Bintan sekitar 28,6 km, dan pusat Kecamatan Teluk Sebong sekitar 5 km.
                        </p>
                    </div>
                </div>

                <div class="col-lg-7 reveal">
                    <span class="ed-kicker">Jejak Sejarah</span>
                    <h2 class="ed-heading mb-2">
                        Dari Kampung Lagoi Menjadi <span class="serif-italic">Sebong Lagoi.</span>
                    </h2>

                    <div class="ed-timeline">
                        <div class="ed-timeline-item">
                            <span class="ed-timeline-year">Asal Nama Lagoi</span>
                            <p>
                                Secara administratif, Desa Sebong Lagoi pada awalnya termasuk dalam wilayah Kecamatan Bintan Utara. Wilayah ini sebelumnya dikenal sebagai <strong>Kampung Lagoi</strong>. Menurut sejarah yang tercantum dalam Profil Desa Sebong Lagoi, nama Lagoi berkaitan dengan seorang pedagang China bernama Languek yang pertama kali singgah di kawasan pesisir Pantai Banyantree Kampung Baru Lagoi.
                            </p>
                        </div>

                        <div class="ed-timeline-item">
                            <span class="ed-timeline-year">1903 · Kepemimpinan Awal</span>
                            <p>
                                Kampung Lagoi telah memiliki kepemimpinan sejak tahun <strong>1903</strong> dengan <strong>Tok Said</strong> sebagai Kepala Kampung pertama.
                            </p>
                        </div>

                        <div class="ed-timeline-item">
                            <span class="ed-timeline-year">1991 · Pengesahan Desa</span>
                            <p>
                                Setelah melalui beberapa periode kepemimpinan, pada tahun <strong>1991</strong> Kampung Lagoi disahkan menjadi <strong>Desa Sebong Lagoi</strong> seiring dengan terjadinya pemekaran wilayah.
                            </p>
                        </div>

                        <div class="ed-timeline-item is-latest">
                            <span class="ed-timeline-year">2008 – 2025 · Teluk Sebong</span>
                            <p>
                                Dalam perkembangannya, Desa Sebong Lagoi kemudian masuk ke dalam wilayah <strong>Kecamatan Teluk Sebong</strong> setelah pemekaran wilayah Kabupaten Kepulauan Riau pada tahun 2008. Hingga tahun 2025, pemerintahan Desa Sebong Lagoi dipimpin oleh <strong>Syamsul Kamal sebagai Penjabat (Pj.) Kepala Desa</strong>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         02 / VISI & MISI DESA
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">02 / Visi &amp; Misi</span>
            </div>

            <div class="ed-section-head reveal">
                <div>
                    <span class="ed-kicker">Arah Pembangunan</span>
                    <h2 class="ed-heading">Visi &amp; Misi <span class="serif-italic">Desa Sebong Lagoi.</span></h2>
                </div>
                <a href="/struktur-desa" class="ed-link-arrow">
                    Struktur Desa <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            <div class="row g-4 align-items-stretch">
                <div class="col-lg-5 reveal">
                    <div class="ed-visi-card">
                        <div>
                            <span class="ed-visi-badge"><i class="bi bi-eye-fill"></i> Visi Desa</span>
                            <blockquote class="ed-visi-quote">
                                “Bersama Masyarakat Membangun Desa Sebong Lagoi di Era Milenial Tahun 2022 s/d 2025.”
                            </blockquote>
                        </div>
                        <div class="ed-visi-foot">
                            Pemerintah Desa Sebong Lagoi · Kecamatan Teluk Sebong, Bintan
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 reveal">
                    <div class="ed-misi-grid">
                        @php
                            $misiList = [
                                'Meningkatkan pembangunan sumber daya manusia',
                                'Memperkuat perekonomian masyarakat',
                                'Meningkatkan tata kelola pemerintahan dan partisipasi masyarakat',
                                'Mengoptimalkan potensi sumber daya alam secara berkelanjutan',
                                'Meningkatkan sarana dan prasarana sosial maupun ekonomi',
                                'Menciptakan lapangan kerja dan pelatihan bagi masyarakat',
                            ];
                        @endphp
                        @foreach($misiList as $idx => $misi)
                            <div class="ed-misi-item">
                                <span class="ed-misi-num">MISI {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <p class="ed-misi-text">{{ $misi }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         03 / PEMERINTAHAN, POTENSI & KEHIDUPAN SOSIAL
         ==================================================== -->
    <section class="ed-section">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">03 / Tata Kelola &amp; Sosial</span>
            </div>

            <div class="ed-section-head reveal">
                <div>
                    <span class="ed-kicker">Pemerintahan &amp; Masyarakat</span>
                    <h2 class="ed-heading">Sinergi Lembaga &amp; <span class="serif-italic">Pembangunan</span> Desa.</h2>
                </div>
                <a href="/dokumen" class="ed-link-arrow">
                    Dokumen Desa <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            <div class="ed-about-cards-3 reveal">
                <div class="ed-info-card">
                    <span class="ed-info-card-icon"><i class="bi bi-building"></i></span>
                    <h3>Kondisi dan Pemerintahan Desa</h3>
                    <p>
                        Pemerintahan Desa Sebong Lagoi diselenggarakan oleh Kepala Desa bersama perangkat desa sebagai unsur penyelenggara pemerintahan. Dalam menjalankan pemerintahan dan pembangunan, Pemerintah Desa juga bekerja sama dengan Badan Permusyawaratan Desa (BPD) serta berbagai lembaga kemasyarakatan yang ada di desa.
                    </p>
                    <p>
                        Wilayah administrasi Desa Sebong Lagoi terbagi menjadi <strong>3 dusun, 3 RW, dan 12 RT</strong>. Pembagian wilayah tersebut dilakukan untuk mempermudah pelayanan administrasi pemerintahan kepada masyarakat karena jarak antarpermukiman yang cukup berjauhan.
                    </p>
                    <div class="ed-lembaga-pills">
                        <span class="ed-lembaga-pill">BPD</span>
                        <span class="ed-lembaga-pill">PKK</span>
                        <span class="ed-lembaga-pill">LPM</span>
                        <span class="ed-lembaga-pill">LINMAS</span>
                        <span class="ed-lembaga-pill">Posyandu</span>
                        <span class="ed-lembaga-pill">Karang Taruna</span>
                        <span class="ed-lembaga-pill">BUMDes</span>
                    </div>
                </div>

                <div class="ed-info-card">
                    <span class="ed-info-card-icon"><i class="bi bi-graph-up-arrow"></i></span>
                    <h3>Potensi dan Pembangunan Desa</h3>
                    <p>
                        Pembangunan Desa Sebong Lagoi tidak hanya berfokus pada pembangunan infrastruktur, tetapi juga mencakup pemerintahan, kemasyarakatan, sumber daya manusia, ketertiban dan keamanan, ekonomi, serta pemberdayaan masyarakat.
                    </p>
                    <p>
                        Pengembangan potensi desa diarahkan untuk meningkatkan kesejahteraan masyarakat dengan tetap memperhatikan keberlanjutan lingkungan. Keberadaan BUMDes juga menjadi salah satu bagian penting dalam mendukung perekonomian desa melalui pengelolaan aset, pelayanan, usaha desa, serta pemanfaatan potensi lokal.
                    </p>
                    <p>
                        Selain itu, berbagai kegiatan pembangunan dan pemberdayaan masyarakat terus dilaksanakan, termasuk pembangunan dan rehabilitasi sarana desa, peningkatan fasilitas kesehatan, pembangunan infrastruktur jalan dan drainase, serta kegiatan sosial dan kemasyarakatan.
                    </p>
                </div>

                <div class="ed-info-card">
                    <span class="ed-info-card-icon"><i class="bi bi-people-fill"></i></span>
                    <h3>Masyarakat dan Kehidupan Sosial</h3>
                    <p>
                        Kehidupan masyarakat Desa Sebong Lagoi didukung oleh berbagai lembaga sosial dan kemasyarakatan. PKK berperan dalam pemberdayaan keluarga dan perempuan, Posyandu mendukung pelayanan kesehatan masyarakat, Karang Taruna menjadi wadah pengembangan potensi generasi muda, sedangkan LPM berperan dalam mendorong partisipasi masyarakat dalam pembangunan desa.
                    </p>
                </div>
            </div>

            <div class="ed-today-banner reveal">
                <h3>Desa Sebong Lagoi Hari Ini</h3>
                <p>
                    Dengan kondisi geografis, sejarah, masyarakat, serta berbagai potensi yang dimiliki, Desa Sebong Lagoi terus berkembang melalui pembangunan dan pemberdayaan masyarakat. Profil Desa Sebong Lagoi Tahun 2025 disusun sebagai gambaran mengenai kondisi desa sekaligus menjadi sumber informasi untuk mendukung perencanaan pembangunan dan pengembangan potensi desa.
                </p>
                <p>
                    Melalui kerja sama antara pemerintah desa, lembaga kemasyarakatan, dan masyarakat, Desa Sebong Lagoi diarahkan untuk terus meningkatkan kualitas pelayanan, pembangunan, perekonomian, serta kesejahteraan masyarakat secara berkelanjutan.
                </p>
            </div>
        </div>
    </section>

    <!-- ====================================================
         04 / INFORMASI GEOGRAFIS & PETA WILAYAH
         ==================================================== -->
    <section class="ed-section-alt">
        <div class="container ed-container">
            <div class="ed-section-divider" aria-hidden="true">
                <span class="ed-divider-accent"></span>
                <span class="ed-divider-line"></span>
                <span class="ed-divider-index">04 / Geografis &amp; Peta</span>
            </div>

            <div class="ed-section-head reveal">
                <div>
                    <span class="ed-kicker">Lokasi Kami</span>
                    <h2 class="ed-heading">Informasi Geografis &amp; <span class="serif-italic">Peta Wilayah.</span></h2>
                    <p class="ed-subtext">Jelajahi letak geografis, koordinat, dan batas wilayah Desa Sebong Lagoi.</p>
                </div>
                <a href="/kontak" class="ed-link-arrow">
                    Hubungi Kantor Desa <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            <div class="row g-4 align-items-stretch reveal">
                <div class="col-lg-4">
                    <div class="ed-geo-card">
                        <h3 class="h5 fw-bold mb-3">
                            <i class="bi bi-geo-alt-fill me-2" style="color: var(--hot-pink);"></i>Informasi Geografis
                        </h3>
                        <ul class="ed-geo-list">
                            <li>
                                <span class="ed-geo-key">Batas Utara</span>
                                <span class="ed-geo-val">Laut China Selatan</span>
                            </li>
                            <li>
                                <span class="ed-geo-key">Batas Selatan &amp; Barat</span>
                                <span class="ed-geo-val">Desa Sebong Pereh</span>
                            </li>
                            <li>
                                <span class="ed-geo-key">Batas Timur</span>
                                <span class="ed-geo-val">Desa Sri Bintan</span>
                            </li>
                            <li>
                                <span class="ed-geo-key">Koordinat</span>
                                <span class="ed-geo-val">104°19’21” BT · 1°07’36” LU</span>
                            </li>
                            <li>
                                <span class="ed-geo-key">Luas Wilayah</span>
                                <span class="ed-geo-val">71.000 ha</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="ed-map-frame">
                        <img src="{{ asset('images/peta-desa.jpg') }}"
                             onerror="this.src='{{ asset('images/tentang-desa.jpg') }}'"
                             alt="Peta Desa Sebong Lagoi"
                             data-bs-toggle="modal"
                             data-bs-target="#petaModal">
                    </div>
                    <div class="mt-2 d-flex justify-content-between align-items-center">
                        <small style="color: var(--ink-muted);">
                            <i class="bi bi-zoom-in me-1"></i> Klik gambar peta untuk memperbesar.
                        </small>
                        <small style="color: var(--ink-muted);">Desa Sebong Lagoi · Kab. Bintan</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Peta -->
    <div class="modal fade" id="petaModal" tabindex="-1" aria-labelledby="petaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 bg-transparent">
                <div class="modal-header border-0 d-flex justify-content-end pb-0">
                    <button type="button" class="btn-close btn-close-white fs-4" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1); background-color: rgba(255,255,255,0.85); border-radius: 50%; padding: 10px; opacity: 1;"></button>
                </div>
                <div class="modal-body text-center pt-0">
                    <img src="{{ asset('images/peta-desa.jpg') }}"
                         onerror="this.src='{{ asset('images/tentang-desa.jpg') }}'"
                         alt="Peta Desa Sebong Lagoi"
                         class="img-fluid rounded-3 shadow-lg"
                         style="max-height: 85vh;">
                </div>
            </div>
        </div>
    </div>

@endsection
