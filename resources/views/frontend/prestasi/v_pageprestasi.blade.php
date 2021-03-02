@extends('frontend/layouts/v_template')

@section('content')
    <main id="main">

        @yield('breadcumb')

        <!-- ======= Prestasi Section ======= -->
        <section id="page-prestasi" class="page-prestasi">
            <div class="container">

                <div class="row">
                    <div class="col-lg-8 entries mb-4">

                        @yield('prestasi-content')

                    </div><!-- End Prestasi entries list -->

                    <div class="col-lg-4 mb-4">
                        <div class="sidebar m-0" data-aos="fade-left">
                            <h3 class="sidebar-title">Cari Prestasi</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ route('frontend.cariprestasi') }}" id="search-form-prestasi" method="GET">
                                    <input type="text" id="keywords" name="keywords">
                                    <button type="submit"><i class="icofont-search"></i></button>
                                </form>
                            </div><!-- End sidebar search formn-->

                            <h3 class="sidebar-title">Prestasi Terbaru</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($recent_prestasi as $rp)
                                    <div class="post-item clearfix">
                                        <img src="{{ $rp->thumbnail }}" alt="">
                                        <h4>
                                            <a href="{{ route('frontend.detailprestasi', ['slug' => $rp->slug]) }}">
                                                {{ $rp->nama }}
                                            </a>
                                        </h4>
                                        <time datetime="2020-01-01">{{ $rp->created_at->format('d M Y H:i:s') }}</time>
                                    </div>
                                @endforeach
                            </div><!-- End sidebar recent posts-->

                        </div><!-- End sidebar -->

                    </div><!-- End Prestasi sidebar -->

                </div>

            </div>
        </section><!-- End Prestasi Section -->

    </main>
@endsection
