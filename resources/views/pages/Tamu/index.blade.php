<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SIP UJIAN - Politeknik Negeri Cilacap</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/logo.png') }}" rel="icon">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet">
</head>

<body>
    @include('sweetalert::alert')

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="{{ route('/') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('img/logo-sip-ujian.png') }}" alt="logo-sipu">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#beranda">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#langkah">Langkah</a></li>
                    <li><a class="nav-link scrollto" href="#cari-jadwal">Cari Jadwal</a></li>
                </ul>
                <a href="{{ route('masuk') }}" class="btn-masuk getstarted scrollto rounded-pill"
                    style="font-weight: bold;">
                    &nbsp;&nbsp;Masuk</a> &nbsp;&nbsp;&nbsp;
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="beranda" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-7 d-flex flex-column justify-content-center order-2 order-md-1">
                    <h1 data-aos="fade-up" class="mb-3" style="font-size: 65px; font-weight:600;">Periksa <br><span
                            style="color: #0061ff">Jadwal Ujian</span>mu</h1>
                    <h6 data-aos="fade-up" data-aos-delay="400" class="mb-2">Kamu dapat mencari jadwal ujian dengan
                        leluasa, kapanpun dan dimanapun.</h6>
                    <div>
                        <div data-aos="fade-up" data-aos-delay="600">
                            <div class="text-lg-start">
                                <a href="#cari-jadwal"
                                    class="btn-cari rounded-pill scrollto d-inline-flex align-items-center justify-content-center align-items-center">
                                    <i class="ri-search-line"></i>
                                    <span>&nbsp;&nbsp;Mulai Mencari Jadwal</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 col-md-5 hero-img order-md-2 mt-0 mb-1" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('assets/img/kelas.png') }}"  style="margin-top: 50px;" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <main id="main">
        <section id="langkah" style="background-color:#0061ff;">
            <div class="container">
                <div class="menu">
                    <h2 class="cara">Cara Mencari Jadwal Ujian Teori</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up">
                                <img src="{{ asset('img/langkah-1.png') }}" alt="langkah-1" class="card-img-top">
                                <div class="card-body">
                                    <p style="text-align: center;"><strong>Pilih kelas yang akan dicari jadwalnya</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset('img/langkah-2.png') }}" alt="langkah-2" class="card-img-top">
                                <div class="card-body">
                                    <p style="text-align: center;"><strong>Tekan tombol Cari Jadwal</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up" data-aos-delay="200">
                                <div class="card-body">
                                    <img src="{{ asset('img/langkah-3.png') }}" alt="langkah-3" class="card-img-top">
                                <div class="card-body">
                                    <p style="text-align: center;"><strong>Anda akan diarahkan ke halaman hasil pencarian</strong></p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="cari-jadwal">
            <div class="container">
                <div class="menu">
                    <h2 class="cari">Cari Jadwal</h2>
                        <div class="row">

                            <div class="col-md-5">
                                <div class="card card-body" data-aos="fade-up">
                                    <img src="{{ asset('img/info-cari.png') }}" alt="info-pencarian" class="card-img-top">
                                </div>
                            </div>
                            <div class="col-md-7">
                            <div class="card card-body" data-aos="fade-up" data-aos-delay="200">
                                    <form method="get" role="form" enctype="multipart/form-data" action="{{ route('hasil.pencarian') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Kelas</label><br>
                                            <select class="form-control select2" name="kelas" id="kelas"
                                                placeholder="- Pilih Kelas -">
                                                <option value="">- Pilih Kelas -</option>
                                                @foreach ($kelas as $data)
                                                    <option value="{{ $data->kelas }}"> {{ $data->kelas }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block"
                                            style="font-weight: bold;" tabindex="4">
                                            <i class="fas fa-search"></i> Cari Jadwal
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End Hero -->
    @include('pages.tamu.cek')
    @include('pages.tamu.kelas')
    @include('pages.tamu.resetpw')

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/stisla.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script> --}}

    <script>
        function myPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script>
        $('#masuk').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
    </script>

</body>

<footer>
    <div class="container">
        <div class="sec aboutus">
            <img src="{{ asset('img/logo-putih.png') }}" width="50px" alt="logo-SIP UJIAN" style="margin-bottom: 10px;">
            <p>SIP UJIAN atau Sistem Informasi Penjadwalan UTS dan UAS dibuat dalam rangka pemenuhan tugas akhir pada Tahun Akademik 2023 oleh Hardiana Murni Safitri yang bertujuan untuk membantu panitia ujian dalam menyusun jadwal ujian teori di Politeknik Negeri Cilacap.</p>
            <ul class="sci">
                <li><a href="https://www.instagram.com/pncofficials/" target="_blank"><i class="ri ri-instagram-fill" aria-hidden="true"></i></a></li>
                <li><a href="https://www.youtube.com/pncofficials" target="_blank"><i class="ri ri-youtube-fill" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <div class="sec quicklinks">
            <h6>Menu</h6>
            <ul>
                <li><a href="#langkah">Langkah</a></li>
                <li><a href="#cari-jadwal">Cari Jadwal</a></li>
            </ul>
        </div>
        <div class="sec contact">
            <h6>Kontak Kami</h6>
            <ul class="info">
                <li>
                    <span><i class="ri ri-map-pin-fill" aria-hidden="true"></i></span>
                    <span>Jalan Dr. Soetomo Nomor 1,<br> Sidakaya, Cilacap Selatan, Kabupaten Cilacap, Jawa Tengah Kode Pos 53212, <br>Indonesia</span>
                </li>
                <li>
                    <span><i class="ri ri-mail-fill" aria-hidden="true"></i></span>
                    <span>sekretariat@pnc.ac.id</span>
                </li>
            </ul>
        </div>
    </div>
</footer>
<div class="copyright">
    <p>Hak Cipta 2023 © Politeknik Negeri Cilacap</p>
</div>

</html>
