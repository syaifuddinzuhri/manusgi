@extends('frontend/layouts/v_template')

@section('title', 'Sejarah')

@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="mt-5 bg-success bd">
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb bg-light  d-flex justify-content-center">
                        <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active font-weight-bold">Sejarah</li>
                    </ol>
                </div>
            </nav>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= sejarah Section ======= -->
        <section id="sejarah" class="sejarah">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Sejarah MA NU Sunan Giri Prigen</strong></h2>
                </div>

                <div class="row content">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4 col-8 offset-2 offset-md-4" data-aos="fade-up">
                                <img src="{{ $sejarah->thumbnail }}" class="img-responsive w-100" alt="">
                            </div>
                            <div class="col-12 mt-4" data-aos="fade-left">
                                <p>{!! $sejarah->sejarah !!}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End sejarah Section -->

    </main>
@endsection
