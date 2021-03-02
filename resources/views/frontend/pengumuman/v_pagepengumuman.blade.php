@extends('frontend/layouts/v_template')

@section('title', 'Pengumuman')

@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="mt-5 bg-success bd">
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb bg-light d-flex justify-content-center">
                        <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active font-weight-bold">Pengumuman</li>
                    </ol>
                </div>
            </nav>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= Pengumuman Section ======= -->
        <section id="list-pengumuman" class="list-pengumuman">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 entries mb-4">
                        @yield('pengumuman-content')
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="sidebar m-0" data-aos="fade-left">
                            <h3 class="sidebar-title">Cari Pengumuman</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ route('frontend.caripengumuman') }}" id="search-form-pengumuman"
                                    method="GET">
                                    <input type="text" id="keywords" name="keywords">
                                    <button type="submit"><i class="icofont-search"></i></button>
                                </form>
                            </div><!-- End sidebar search formn-->

                            <h3 class="sidebar-title">Pengumuman Terbaru</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($recent_pengumuman as $pn)
                                    <div class="post-item clearfix">
                                        <h4>
                                            <i class="bx bx-chevron-right text-success"></i>
                                            <a href="/pengumuman/download/{{ $pn->slug }}">{{ $pn->nama }}</a>
                                        </h4>
                                        <time datetime="2020-01-01">{{ $pn->created_at->format('d M Y H:i:s') }}</time>
                                    </div>
                                @endforeach
                            </div><!-- End sidebar recent posts-->

                        </div><!-- End sidebar -->

                    </div>

                </div>

            </div>
        </section>

    </main>
@endsection
