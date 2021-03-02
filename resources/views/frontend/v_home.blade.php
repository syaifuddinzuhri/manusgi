@extends('frontend/layouts/v_template')

@section('title', 'Home')

@section('content')

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                @foreach ($recent_berita as $key => $item)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}"
                        style="background-image: url({{ $item->thumbnail }}">
                        <div class="carousel-container">
                            <div class="carousel-content animate__animated animate__fadeInUp">
                                <h2>{{ $item->judul }}</h2>
                                <p>
                                    @php
                                    $string =strip_tags($item->isi);
                                    $content = html_entity_decode($string);
                                    @endphp
                                    {{ substr($content, 0, 100) }} ...
                                </p>
                                <div class="text-center"><a
                                        href="{{ route('frontend.detailberita', ['slug' => $item->slug]) }}"
                                        class="btn-get-started">Baca Selengkapnya</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        </div>
    </section>
    <!-- End Hero -->

    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section id="about-us" class="about-us">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Selamat Datang</strong></h2>
                </div>

                <div class="row content">
                    <div class="col-lg-6 text-center" data-aos="fade-right">
                        <img src="{{ asset('img/kepala.png') }}" class="img-responsive w-100" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 d-flex align-items-center" data-aos="fade-left">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe incidunt cupiditate doloremque
                            similique. Quasi laboriosam exercitationem, voluptatibus reiciendis consequuntur dolores.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe incidunt cupiditate doloremque
                            similique. Quasi laboriosam exercitationem, voluptatibus reiciendis consequuntur dolores.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe incidunt cupiditate doloremque
                            similique. Quasi laboriosam exercitationem, voluptatibus reiciendis consequuntur dolores.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe incidunt cupiditate doloremque
                            similique. Quasi laboriosam exercitationem, voluptatibus
                            reiciendis consequuntur dolores.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe incidunt cupiditate doloremque
                            similique. Quasi laboriosam exercitationem, voluptatibus reiciendis consequuntur dolores.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe incidunt cupiditate doloremque
                            similique. Quasi laboriosam exercitationem, voluptatibus reiciendis consequuntur dolores.

                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Jurusan Section ======= -->
        <section id="jurusan" class="jurusan section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Jurusan</strong></h2>
                    <p>Jurusan yang ada di <span class="font-weight-bold">MA NU Sunan Giri Prigen</span></p>
                </div>

                <div class="row d-flex justify-content-center">
                    @foreach ($jurusan as $js)
                        <div class="col-lg-4 col-md-4 my-3" data-aos="zoom-in">
                            <div class="icon-box">
                                <i class="{{ $js->icon }} text-success"></i>
                                <h3 style="cursor: default">{{ $js->nama }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
        <!-- End jurusan Section -->

        <!-- ======= Publikasi Section ======= -->
        <section id="publikasi" class="publikasi">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Publikasi</h2>
                </div>
                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="publikasi-flters">
                            <li class="filter-active" id="nav-berita">Berita</li>
                            <li id="nav-pengumuman">Pengumuman</li>
                            <li id="nav-prestasi">Prestasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section><!-- End Publikasi Section -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog mb-4">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h5 class="font-weight-normal">Berita terbaru dari <span class="font-weight-bold">MA NU Sunan Giri
                            Prigen</span></h5>
                </div>
                <div class="row" data-aos="fade-up">
                    @foreach ($recent_berita as $br)
                        <div class="col-lg-4 col-md-3 mb-4">
                            <article class="entry" data-aos="fade-up">
                                <div class="entry-img">
                                    <img src="{{ $br->thumbnail }}" alt="" class="img-fluid">
                                </div>

                                <h2 class="entry-title">
                                    <a
                                        href="{{ route('frontend.detailberita', ['slug' => $br->slug]) }}">{{ $br->judul }}</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                                href="javascript:void(0)">{{ $br->user->name }}</a></li>
                                        <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a
                                                href="javascript:void(0)"><time
                                                    datetime="2020-01-01">{{ $br->created_at->format('d M Y') }}</time></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="entry-content">
                                    <p>
                                        @php
                                        $string =strip_tags($br->isi);
                                        $content = html_entity_decode($string);
                                        @endphp
                                        {{ substr($content, 0, 100) }} ...
                                    </p>
                                    <div class="read-more">
                                        <a href="{{ route('frontend.detailberita', ['slug' => $br->slug]) }}">Baca
                                            selengkapnya</a>
                                    </div>
                                </div>

                            </article><!-- End blog entry -->
                        </div>
                    @endforeach
                </div>
                <div class="row " data-aos="fade-up">
                    <div class="col-12 text-center">
                        <a href="{{ route('frontend.berita') }}" class="btn btn-sm btn-outline-success">Lihat Semua
                            Berita</a>
                    </div>
                </div>
            </div>
        </section><!-- End Blog Section -->

        <!-- ======= Pengumuman Section ======= -->
        <section id="pengumuman" class="pengumuman mb-4">
            <div class="container" data-aos="fade-up">
                <div class="section-title" data-aos="fade-up">
                    <h5 class="font-weight-normal">Pengumuman terbaru dari <span class="font-weight-bold">MA NU Sunan
                            Giri
                            Prigen</span></h5>
                </div>
                <div class="row d-flex justify-content-center" data-aos="fade-up">
                    @foreach ($recent_pengumuman as $p)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch my-3" data-aos="zoom-in"
                            data-aos-delay="200">
                            <div class="icon-box iconbox-green w-100">
                                <div class="icon">
                                    <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke="none" stroke-width="0" fill="#f5f5f5"
                                            d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426">
                                        </path>
                                    </svg>
                                    <i class="icofont-bell-alt"></i>
                                </div>
                                <h4>{{ $p->nama }}</h4>
                                @if ($p->file != null)
                                    <div class="read-more">
                                        <a href="/pengumuman/download/{{ $p->slug }}">Unduh File</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row mt-2" data-aos="fade-up">
                    <div class="col-12 text-center">
                        <a href="{{ route('frontend.pengumuman') }}" class="btn btn-sm btn-outline-success">Lihat Semua
                            Pengumuman</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======= Pengumuman Section ======= -->

        <!-- ======= Prestasi Section ======= -->
        <section id="prestasi" class="prestasi mb-4">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h5 class="font-weight-normal">Prestasi terbaru dari <span class="font-weight-bold">MA NU Sunan Giri
                            Prigen</span></h5>
                </div>
                <div class="row" data-aos="fade-up">
                    @foreach ($recent_prestasi as $ps)
                        <div class="col-lg-4 col-md-3 mb-4">
                            <article class="entry" data-aos="fade-up">
                                <div class="entry-img">
                                    <img src="{{ $ps->thumbnail }}" alt="" class="img-fluid">
                                </div>

                                <h2 class="entry-title">
                                    <a
                                        href="{{ route('frontend.detailprestasi', ['slug' => $ps->slug]) }}">{{ $ps->nama }}</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                                href="">{{ $ps->user->name }}</a></li>
                                        <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a
                                                href=""><time
                                                    datetime="2020-01-01">{{ $ps->created_at->format('d M Y') }}</time></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="entry-content">
                                    <div class="read-more">
                                        <a href="{{ route('frontend.detailprestasi', ['slug' => $ps->slug]) }}">Baca
                                            selengkapnya</a>
                                    </div>
                                </div>

                            </article><!-- End prestasi entry -->
                        </div>
                    @endforeach
                </div>
                <div class="row " data-aos="fade-up">
                    <div class="col-12 text-center">
                        <a href="{{ route('frontend.prestasi') }}" class="btn btn-sm btn-outline-success">Lihat Semua
                            Prestasi</a>
                    </div>
                </div>
            </div>
        </section><!-- End Prestasi Section -->

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials section-bg">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Alumni Testimonial</h2>
                </div>
                <div class="owl-carousel owl-carousel1 owl-theme">
                    <div>
                        <div class="testimonial-item mx-3">
                            <img src="{{ asset('frontend') }}/assets/img/testimonials/testimonials-1.jpg"
                                class="testimonial-img" alt="">
                            <h3>Saul Goodman</h3>
                            <h4>Ceo &amp; Founder</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.
                                Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                    <div>
                        <div class="testimonial-item mx-3">
                            <img src="{{ asset('frontend') }}/assets/img/testimonials/testimonials-1.jpg"
                                class="testimonial-img" alt="">
                            <h3>Saul Goodman</h3>
                            <h4>Ceo &amp; Founder</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.
                                Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="testimonial-item mx-3">
                            <img src="{{ asset('frontend') }}/assets/img/testimonials/testimonials-2.jpg"
                                class="testimonial-img" alt="">
                            <h3>Sara Wilsson</h3>
                            <h4>Designer</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum
                                eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim
                                culpa.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="testimonial-item mx-3">
                            <img src="{{ asset('frontend') }}/assets/img/testimonials/testimonials-3.jpg"
                                class="testimonial-img" alt="">
                            <h3>Jena Karlis</h3>
                            <h4>Store Owner</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis
                                minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="testimonial-item mx-3">
                            <img src="{{ asset('frontend') }}/assets/img/testimonials/testimonials-4.jpg"
                                class="testimonial-img" alt="">
                            <h3>Matt Brandon</h3>
                            <h4>Freelancer</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim
                                velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum
                                veniam.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="testimonial-item mx-3">
                            <img src="{{ asset('frontend') }}/assets/img/testimonials/testimonials-5.jpg"
                                class="testimonial-img" alt="">
                            <h3>John Larson</h3>
                            <h4>Entrepreneur</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam
                                enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore
                                nisi cillum quid.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="testimonial-item mx-3">
                            <img src="{{ asset('frontend') }}/assets/img/testimonials/testimonials-6.jpg"
                                class="testimonial-img" alt="">
                            <h3>Emily Harison</h3>
                            <h4>Store Owner</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Eius ipsam praesentium dolor quaerat inventore rerum odio. Quos laudantium adipisci eius.
                                Accusamus qui iste cupiditate sed temporibus est aspernatur. Sequi officiis ea et quia
                                quidem.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->

        <!-- ======= Our partner Section ======= -->
        <section id="partner" class="partner">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Partner</h2>
                </div>

                <div class="row no-gutters partner-wrap clearfix" data-aos="fade-up">

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="{{ asset('frontend') }}/assets/img/partner/client-1.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="{{ asset('frontend') }}/assets/img/partner/client-2.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="{{ asset('frontend') }}/assets/img/partner/client-3.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="{{ asset('frontend') }}/assets/img/partner/client-4.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="{{ asset('frontend') }}/assets/img/partner/client-5.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="{{ asset('frontend') }}/assets/img/partner/client-6.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="{{ asset('frontend') }}/assets/img/partner/client-7.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="client-logo">
                            <img src="{{ asset('frontend') }}/assets/img/partner/client-8.png" class="img-fluid" alt="">
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Our partner Section -->

    </main><!-- End #main -->
@endsection
