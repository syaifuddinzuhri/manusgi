@extends('frontend/layouts/v_template')

@section('title', 'Visi & Misi')

@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="mt-5 bg-success bd">
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active font-weight-bold">Visi & Misi</li>
                    </ol>
                </div>
            </nav>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= Visi misi Section ======= -->
        <section id="visi-misi" class="visi-misi">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Visi dan Misi MA NU Sunan Giri Prigen</strong></h2>
                </div>

                <div class="row content">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4 col-8 offset-2 offset-md-4" data-aos="fade-up">
                                <img src="{{ $visimisi->thumbnail }}" class="img-responsive w-100" alt="">
                            </div>
                            <div class="col-12 mt-4" data-aos="fade-left">
                                <h2>Visi</h2>
                                <hr>
                                <p>{!! $visimisi->visi !!}</p>
                            </div>
                            <div class="col-12 mt-4" data-aos="fade-right">
                                <h2>Misi</h2>
                                <hr>
                                <p>{!! $visimisi->misi !!}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

    </main>
@endsection
