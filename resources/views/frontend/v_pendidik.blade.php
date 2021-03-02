@extends('frontend/layouts/v_template')

@section('title', 'Tenaga Pendidik dan Kependidikan')

@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="mt-5 bg-success bd">
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb bg-light d-flex justify-content-center">
                        <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active font-weight-bold">Tenaga Pendidik dan Kependidikan</li>
                    </ol>
                </div>
            </nav>
        </section>
        <!-- End Breadcrumbs -->

        <section id="pendidik" class="pendidik mb-4">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Tenaga Pendidik dan Kependidikan</strong></h2>
                </div>
                <div class="row justify-content-center" data-aos="fade-up">
                    @foreach ($pendidik as $pd)
                        <div class="col-lg-3 col-6 d-flex align-items-stretch">
                            <div class="member" data-aos="fade-up">
                                <div class="member-img">
                                    <img src="{{ $pd->foto }}" class="img-fluid" alt="">
                                    <div class="social">
                                        <a href="#" title="{{ $pd->email }}"><i class="icofont-email"></i></a>
                                        <a href="#" title="{{ $pd->telepon }}"><i class="icofont-phone"></i></a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4>{{ $pd->nama }}</h4>
                                    <span>{{ str_replace(',', '|', $pd->jabatan) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>
@endsection
