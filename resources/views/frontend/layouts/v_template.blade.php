<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://manusunangiri.sch.id/">
    <meta property="og:image" content="{{ $app->logo }}">

    {{-- <meta property="og:title" content="{{ $title }}"> --}}
    <meta property="og:description" content="{{ $app->meta_deskripsi }}">
    <meta name="image_url" content="{{ $app->logo }}">
    <meta name="googlebot" content="all, index, follow" />
    <meta name="robots" content="all, index, follow" />
    <meta name="msnbot" content="all, index, follow" />
    <link rel="canonical" href="https://manusunangiri.sch.id/">
    <meta name="robots" content="noodp">


    <title>@yield('title') - {{ $app->nama }}</title>
    <meta content="{{ $app->meta_deskripsi }}" name="description">
    <meta content="{{ $app->meta_keyword }}" name="keywords">

    <!-- Favicons -->
    <link href="{{ $app->logo }}" rel="icon">
    <link href="{{ $app->logo }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="{{ asset('frontend') }}/assets/css/style.css" rel="stylesheet">

</head>

<body>

    @include('frontend/layouts/v_navbar')

    @yield('content')

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <div class="d-flex justify-content-start align-items-center mb-2">
                            <img src="{{ asset('img/logo_ma.png') }}" alt="" class="img-responsive mx-1" width="50">
                            <img src="{{ asset('img/vokasi.png') }}" alt="" class="img-responsive mx-1" width="50">
                            <img src="{{ asset('img/madrasah.png') }}" alt="" class="img-responsive mx-1" width="110">
                        </div>
                        <h3>{{ $app->nama }}</h3>
                        <p>
                            {{ $app->alamat }}
                            <br><br>
                            <strong>Phone : </strong>{{ $app->telepon }}<br>
                            <strong>Email : </strong>{{ $app->email }}<br>
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Kunjungi Halaman Lain</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a
                                    href="{{ route('frontend.sejarah') }}">Sejarah</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('frontend.berita') }}">Berita</a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i> <a
                                    href="{{ route('frontend.pengumuman') }}">Pengumuman</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Prestasi</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Galeri</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Berita Terbaru</h4>
                        <ul>
                            @foreach ($recent_berita as $b)
                                <li><i class="bx bx-chevron-right"></i> <a
                                        href="{{ route('frontend.detailberita', ['slug' => $b->slug]) }}">{{ $b->judul }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Prestasi Terbaru</h4>
                        <ul>
                            @foreach ($recent_prestasi as $p)
                                <li><i class="bx bx-chevron-right"></i> <a
                                        href="{{ route('frontend.detailprestasi', ['slug' => $p->slug]) }}">{{ $p->nama }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="mr-md-auto text-center text-md-left">
                <div class="copyright">
                    &copy; Copyright <strong><span>MA NU Sunan Giri Prigen</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Powered by <a href="">MA NU Sunan Giri Prigen</a>.
                    Developed by <a href="https://bootstrapmade.com/">Syaifuddin Zuhri</a>
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('frontend') }}/assets/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/jquery-sticky/jquery.sticky.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/venobox/venobox.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/aos/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"
        integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ=="
        crossorigin="anonymous"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('frontend') }}/assets/js/main.js"></script>

</body>

</html>
