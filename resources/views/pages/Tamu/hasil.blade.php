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
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
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
                <img src="{{ asset('img/logo-sipujian.png') }}" alt="logo-sipu">
            </a>

            <nav id="navbar" class="navbar">
                {{-- <ul>
                    <li><a class="nav-link scrollto active" href="#beranda">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#langkah">Langkah</a></li>
                    <li><a class="nav-link scrollto" href="#cari-jadwal">Cari Jadwal</a></li>
                </ul> --}}
                <a href="{{ route('/') }}" class="btn-masuk getstarted scrollto rounded-pill"
                    style="font-weight: bold;">
                    &nbsp;&nbsp;Kembali</a> &nbsp;&nbsp;&nbsp;
                {{-- <i class="bi bi-list mobile-nav-toggle"></i> --}}
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    {{-- <section id="hasil" class="hero d-flex align-items-center"> --}}
    <section id="hasil" class="d-flex align-items-center">
        <div class="container">
            <h3 class="cari" style="color: #0061ff; margin-top: 50px;">Hasil Pencarian</h3>
            <h5 class="cari"> Jadwal @if ($jadwal->jenis === 'UTS')
                                                Ujian Tengah Semester
                                            @else
                                                Ujian Akhir Semester
                                            @endif Teori<br> Tahun Akademik {{ $tapel->tahun_pelajaran }} <br> Kelas {{ $ruangan->kelas }} </h5>
           <table style="text-align: left;">
                <tr>
                    <td style="padding-right: 10px;">Gedung</td>
                    <td style="padding: 0 5px;">:</td>
                    <td>{{ $ruangan->ruangan->gedung->gedung }}</td>
                </tr>
                <tr>
                    <td style="padding-right: 10px;">Ruangan</td>
                    <td style="padding: 0 5px;">:</td>
                    <td>{{ $ruangan->ruangan->ruangan }}</td>
                </tr>
            </table>
            <div class="table-responsive">
                                <table class="table table-striped"
                                    id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Tanggal Ujian</th>
                                            <th class="text-center">Sesi</th>
                                            <th class="text-center">Mata Kuliah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($matkul as $m)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td>{{ $m->hari }}, {{ $m->tgl_ujian }}</td>
                                            <td class="text-center">{{ $m->sesi->sesi }}</td>
                                            <td class="text-center">{{ $m->matkul->matakuliah }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
        </div>
    </section>

    {{-- <main id="main">
        <section id="langkah" style="background-color:#0061ff;">
            <div class="container">
                <div class="menu">
                    <h2 class="cara">Cara Mencari Jadwal Ujian Teori</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up">
                                <img src="{{ asset('img/langkah-1.png') }}" alt="langkah-1" class="card-img-top">
                                <div class="card-body">
                                    <p>1. Pilih kelas yang akan dicari jadwalnya</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset('img/langkah-2.png') }}" alt="langkah-2" class="card-img-top">
                                <div class="card-body">
                                    <p>1. Tekan tombol Cari Jadwal untuk memulai proses pencarian</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up" data-aos-delay="200">
                                <div class="card-body">
                                    skfhk
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
                            <div class="col-md-7">
                            <div class="card card-body">
                                    <form method="get" role="form" enctype="multipart/form-data" >
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
                                        <button type="button" id="btnCariJadwal" class="btn btn-primary btn-lg btn-block"
                                            style="font-weight: bold;" tabindex="4" data-toggle="modal" data-target="#periksa">
                                            <i class="fas fa-search"></i> Cari Jadwal
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card card-body">
                                    <img src="{{ asset('img/info-cari.png') }}" alt="info-pencarian" class="card-img-top">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>
    </main> --}}
    <!-- End Hero -->
    {{-- @include('pages.tamu.cek') --}}
    {{-- @include('pages.tamu.kelas') --}}
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

    <!-- Datatables -->
    <script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

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
                <li><a href="{{ route('/') }}/#langkah">Langkah</a></li>
                <li><a href="{{ route('/') }}/#cari-jadwal">Cari Jadwal</a></li>
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
