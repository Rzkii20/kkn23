@extends('layouts.app')

@section('title', 'Tentang Desa - Pemerintah Desa Sebong Lagoi')

@section('content')
    <!-- HEADER COVER -->
    <div class="py-4 py-md-5 text-white position-relative" style="background: linear-gradient(rgba(0, 48, 73, 0.7), rgba(0, 48, 73, 0.7)), url('{{ asset('images/tentang-desa.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="container text-center py-2 py-md-3">
            <h1 class="fs-2 fs-md-1 fw-bold mb-2">Tentang Desa Sebong Lagoi</h1>
            <p class="lead text-white-50 fs-6 fs-md-5 mb-0">Sejarah Singkat, Visi, Misi, dan Struktur Organisasi Desa</p>
        </div>
    </div>

    <!-- MAIN ABOUT CONTENT -->
    <section class="py-4 py-md-5 bg-white">
        <div class="container">
            <div class="row g-4 g-lg-5">
                <!-- Konten Kiri (Sejarah dll) -->
                <div class="col-lg-8">
                    <h3 class="fw-bold text-primary-custom mb-3 border-bottom pb-2">Tentang Desa Sebong Lagoi</h3>
                    <p class="text-muted leading-relaxed">Desa Sebong Lagoi merupakan salah satu desa yang berada di Kecamatan Teluk Sebong, Kabupaten Bintan, Provinsi Kepulauan Riau. Berdasarkan Profil Desa Sebong Lagoi Tahun 2025, desa ini memiliki luas wilayah sekitar <strong>71.000 ha</strong> dan berada pada ketinggian sekitar <strong>10 meter di atas permukaan laut</strong>.</p>
                    <p class="text-muted leading-relaxed">Secara geografis, Desa Sebong Lagoi memiliki dua musim utama, yaitu musim kemarau yang berlangsung sekitar bulan Maret hingga Agustus dan musim hujan sekitar bulan September hingga Februari. Jarak desa menuju pusat Provinsi Kepulauan Riau sekitar 80 km, pusat Kabupaten Bintan sekitar 28,6 km, dan pusat Kecamatan Teluk Sebong sekitar 5 km.</p>

                    <h4 class="fw-bold text-dark mt-5 mb-3">Sejarah Desa</h4>
                    <p class="text-muted leading-relaxed">Secara administratif, Desa Sebong Lagoi pada awalnya termasuk dalam wilayah Kecamatan Bintan Utara. Wilayah ini sebelumnya dikenal sebagai <strong>Kampung Lagoi</strong>. Menurut sejarah yang tercantum dalam Profil Desa Sebong Lagoi, nama Lagoi berkaitan dengan seorang pedagang China bernama Languek yang pertama kali singgah di kawasan pesisir Pantai Banyantree Kampung Baru Lagoi.</p>
                    <p class="text-muted leading-relaxed">Kampung Lagoi telah memiliki kepemimpinan sejak tahun 1903 dengan Tok Said sebagai Kepala Kampung pertama. Setelah melalui beberapa periode kepemimpinan, pada tahun 1991 Kampung Lagoi disahkan menjadi <strong>Desa Sebong Lagoi</strong> seiring dengan terjadinya pemekaran wilayah.</p>
                    <p class="text-muted leading-relaxed">Dalam perkembangannya, Desa Sebong Lagoi kemudian masuk ke dalam wilayah <strong>Kecamatan Teluk Sebong</strong> setelah pemekaran wilayah Kabupaten Kepulauan Riau pada tahun 2008. Hingga tahun 2025, pemerintahan Desa Sebong Lagoi dipimpin oleh <strong>Syamsul Kamal sebagai Penjabat (Pj.) Kepala Desa</strong>.</p>

                    <h4 class="fw-bold text-dark mt-5 mb-3">Kondisi dan Pemerintahan Desa</h4>
                    <p class="text-muted leading-relaxed">Pemerintahan Desa Sebong Lagoi diselenggarakan oleh Kepala Desa bersama perangkat desa sebagai unsur penyelenggara pemerintahan. Dalam menjalankan pemerintahan dan pembangunan, Pemerintah Desa juga bekerja sama dengan Badan Permusyawaratan Desa (BPD) serta berbagai lembaga kemasyarakatan yang ada di desa.</p>
                    <p class="text-muted leading-relaxed">Wilayah administrasi Desa Sebong Lagoi terbagi menjadi <strong>3 dusun, 3 RW, dan 12 RT</strong>. Pembagian wilayah tersebut dilakukan untuk mempermudah pelayanan administrasi pemerintahan kepada masyarakat karena jarak antarpermukiman yang cukup berjauhan. Selain Pemerintah Desa dan BPD, terdapat berbagai lembaga kemasyarakatan yang mendukung kehidupan masyarakat, antara lain <strong>PKK, LPM, LINMAS, Posyandu, Karang Taruna, dan BUMDes</strong>.</p>

                    <h4 class="fw-bold text-dark mt-5 mb-3">Potensi dan Pembangunan Desa</h4>
                    <p class="text-muted leading-relaxed">Pembangunan Desa Sebong Lagoi tidak hanya berfokus pada pembangunan infrastruktur, tetapi juga mencakup pemerintahan, kemasyarakatan, sumber daya manusia, ketertiban dan keamanan, ekonomi, serta pemberdayaan masyarakat.</p>
                    <p class="text-muted leading-relaxed">Pengembangan potensi desa diarahkan untuk meningkatkan kesejahteraan masyarakat dengan tetap memperhatikan keberlanjutan lingkungan. Keberadaan BUMDes juga menjadi salah satu bagian penting dalam mendukung perekonomian desa melalui pengelolaan aset, pelayanan, usaha desa, serta pemanfaatan potensi lokal.</p>
                    <p class="text-muted leading-relaxed">Selain itu, berbagai kegiatan pembangunan dan pemberdayaan masyarakat terus dilaksanakan, termasuk pembangunan dan rehabilitasi sarana desa, peningkatan fasilitas kesehatan, pembangunan infrastruktur jalan dan drainase, serta kegiatan sosial dan kemasyarakatan.</p>

                    <h4 class="fw-bold text-dark mt-5 mb-3">Masyarakat dan Kehidupan Sosial</h4>
                    <p class="text-muted leading-relaxed">Kehidupan masyarakat Desa Sebong Lagoi didukung oleh berbagai lembaga sosial dan kemasyarakatan. PKK berperan dalam pemberdayaan keluarga dan perempuan, Posyandu mendukung pelayanan kesehatan masyarakat, Karang Taruna menjadi wadah pengembangan potensi generasi muda, sedangkan LPM berperan dalam mendorong partisipasi masyarakat dalam pembangunan desa.</p>

                    <h4 class="fw-bold text-dark mt-5 mb-3">Desa Sebong Lagoi Hari Ini</h4>
                    <p class="text-muted leading-relaxed">Dengan kondisi geografis, sejarah, masyarakat, serta berbagai potensi yang dimiliki, Desa Sebong Lagoi terus berkembang melalui pembangunan dan pemberdayaan masyarakat. Profil Desa Sebong Lagoi Tahun 2025 disusun sebagai gambaran mengenai kondisi desa sekaligus menjadi sumber informasi untuk mendukung perencanaan pembangunan dan pengembangan potensi desa.</p>
                    <p class="text-muted leading-relaxed">Melalui kerja sama antara pemerintah desa, lembaga kemasyarakatan, dan masyarakat, Desa Sebong Lagoi diarahkan untuk terus meningkatkan kualitas pelayanan, pembangunan, perekonomian, serta kesejahteraan masyarakat secara berkelanjutan.</p>
                </div>
                
                <!-- Kolom Kanan (Visi Misi & Geografis) -->
                <div class="col-lg-4">
                    <div class="card card-custom bg-light p-3 p-md-4 border-0 shadow-sm mb-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-award-fill text-warning fs-1"></i>
                            <h4 class="fw-bold mt-2 text-dark fs-5 fs-md-4">Visi & Misi Desa</h4>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="fw-bold text-primary-custom"><i class="bi bi-eye-fill me-2"></i> Visi</h5>
                            <p class="text-muted small fw-semibold fst-italic">“Bersama Masyarakat Membangun Desa Sebong Lagoi di Era Milenial Tahun 2022 s/d 2025.”</p>
                        </div>

                        <div>
                            <h5 class="fw-bold text-secondary-custom"><i class="bi bi-card-checklist me-2"></i> Misi</h5>
                            <ul class="text-muted small ps-3 mb-0" style="list-style-type: square;">
                                <li class="mb-2">Meningkatkan pembangunan sumber daya manusia</li>
                                <li class="mb-2">Memperkuat perekonomian masyarakat</li>
                                <li class="mb-2">Meningkatkan tata kelola pemerintahan dan partisipasi masyarakat</li>
                                <li class="mb-2">Mengoptimalkan potensi sumber daya alam secara berkelanjutan</li>
                                <li class="mb-2">Meningkatkan sarana dan prasarana sosial maupun ekonomi</li>
                                <li class="mb-2">Menciptakan lapangan kerja dan pelatihan bagi masyarakat</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card card-custom bg-white p-3 p-md-4 border-0 shadow-sm border-top border-4 border-primary">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-geo-alt-fill text-danger me-2"></i> Informasi Geografis</h5>
                        <ul class="list-unstyled text-muted small mb-0">
                            <li class="mb-3">
                                <strong>Batas Utara:</strong><br> Laut China Selatan
                            </li>
                            <li class="mb-3">
                                <strong>Batas Selatan & Barat:</strong><br> Desa Sebong Pereh
                            </li>
                            <li class="mb-3">
                                <strong>Batas Timur:</strong><br> Desa Sri Bintan
                            </li>
                            <li class="mb-3">
                                <strong>Koordinat:</strong><br> 104°19’21” BT <br> 1°07’36” LU
                            </li>
                            <li class="mb-0">
                                <strong>Luas Wilayah:</strong><br> 71.000 ha
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ====================================================
         PETA DESA SECTION
         ==================================================== -->
    <section class="py-5" style="background: var(--sea-blue-light);">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <div class="section-tagline justify-content-center" style="color: var(--sea-blue);">
                    <span style="width:20px; height:2px; background: var(--sea-blue); display:inline-block;"></span>
                    Lokasi Kami
                </div>
                <h2 class="section-title">Peta Desa Sebong Lagoi</h2>
                <p class="section-subtitle mx-auto mt-2">Jelajahi letak geografis dan batas wilayah Desa Sebong Lagoi melalui peta di bawah ini.</p>
            </div>
            
            <div class="row justify-content-center reveal">
                <div class="col-lg-10">
                    <div style="background: white; padding: 15px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                        <!-- Pastikan Anda meletakkan gambar peta Anda di folder public/images dengan nama peta-desa.jpg -->
                        <img src="{{ asset('images/peta-desa.jpg') }}" 
                             onerror="this.src='https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=1000&auto=format&fit=crop'" 
                             alt="Peta Desa Sebong Lagoi" 
                             class="img-fluid rounded-4 w-100" 
                             style="max-height: 600px; object-fit: contain; cursor: pointer;"
                             data-bs-toggle="modal" data-bs-target="#petaModal">
                    </div>
                    <div class="text-center mt-3">
                        <small class="text-muted"><i class="bi bi-info-circle"></i> Klik gambar peta untuk memperbesar.</small>
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
                    <button type="button" class="btn-close btn-close-white fs-4" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1); background-color: rgba(255,255,255,0.8); border-radius: 50%; padding: 10px; opacity: 1;"></button>
                </div>
                <div class="modal-body text-center pt-0">
                    <img src="{{ asset('images/peta-desa.jpg') }}" 
                         onerror="this.src='https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=1200&auto=format&fit=crop'" 
                         alt="Peta Desa Sebong Lagoi" 
                         class="img-fluid rounded-3 shadow-lg"
                         style="max-height: 85vh;">
                </div>
            </div>
        </div>
    </div>



@endsection
