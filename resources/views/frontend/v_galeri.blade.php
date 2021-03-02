@extends('frontend/layouts/v_template')

@section('title', 'Galeri MA NU Sunan Giri Prigen')

@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="mt-5 bg-success bd">
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb bg-light d-flex justify-content-center">
                        <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active font-weight-bold">Galeri MA NU Sunan Giri Prigen</li>
                    </ol>
                </div>
            </nav>
        </section>
        <!-- End Breadcrumbs -->

        <section id="portfolio" class="portfolio mb-4">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Galeri MA NU Sunan Giri Prigen</strong></h2>
                </div>
                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            @foreach ($album as $alb)
                                <li data-filter=".{{ $alb->slug }}">{{ $alb->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row portfolio-container" data-aos="fade-up">
                    @foreach ($album as $al)
                        @foreach ($al->galeri as $gal)
                            <div class="col-lg-4 col-md-6 portfolio-item {{ $al->slug }}">
                                <a href="{{ $gal->gambar }}" data-gall="portfolioGallery" class="venobox preview-link"
                                    title="{{ $al->nama }}">
                                    <img src="{{ $gal->gambar }}" class="img-fluid gambar-galeri" alt="">
                                </a>
                            </div>
                        @endforeach
                    @endforeach

                </div>
            </div>
        </section>

    </main>
@endsection
