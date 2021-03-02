@extends('frontend/layouts/v_template')

@section('title', 'Jurusan')

@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="mt-5 bg-success bd">
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb bg-light  d-flex justify-content-center">
                        <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active font-weight-bold">Jurusan</li>
                    </ol>
                </div>
            </nav>
        </section>
        <!-- End Breadcrumbs -->

        <section id="jurusan" class="jurusan">
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

    </main>
@endsection
