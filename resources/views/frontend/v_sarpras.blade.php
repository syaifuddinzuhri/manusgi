@extends('frontend/layouts/v_template')

@section('title', 'Sarana dan Prasarana')

@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="mt-5 bg-success bd">
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb bg-light d-flex justify-content-center">
                        <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active font-weight-bold">Sarana dan Prasarana</li>
                    </ol>
                </div>
            </nav>
        </section>
        <!-- End Breadcrumbs -->

        <section id="sarpras" class="sarpras mb-4">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Sarana dan Prasarana</strong></h2>
                </div>
                <div class="row justify-content-center" data-aos="fade-up">
                    @foreach ($sarpras as $sr)
                        <div class="col-lg-4 col-md-3 mb-4">
                            <article class="entry text-center" data-aos="fade-up">
                                <div class="entry-img">
                                    <img src="{{ $sr->thumbnail }}" alt="" class="img-fluid">
                                </div>
                                <h2 class="entry-title m-0">{{ $sr->nama }} </h2>
                            </article>

                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>
@endsection
