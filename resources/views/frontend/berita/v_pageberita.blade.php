@extends('frontend/layouts/v_template')

@section('content')
    <main id="main">

        @yield('breadcumb')

        <!-- ======= Blog Section ======= -->
        <section id="berita" class="berita">
            <div class="container">

                <div class="row">
                    <div class="col-lg-8 entries mb-4">

                        @yield('berita-content')

                    </div><!-- End blog entries list -->

                    <div class="col-lg-4 mb-4">
                        <div class="sidebar m-0" data-aos="fade-left">
                            <h3 class="sidebar-title">Cari Berita</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ route('frontend.cariberita') }}" id="search-form-berita" method="GET">
                                    <input type="text" id="keywords" name="keywords">
                                    <button type="submit"><i class="icofont-search"></i></button>
                                </form>
                            </div><!-- End sidebar search formn-->

                            <h3 class="sidebar-title">Kategori</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    @foreach ($kategori as $kat)
                                        <li><a href="/berita/search?kategori={{ $kat->nama }}">{{ $kat->nama }}
                                                <span>{{ $kat->berita->count() }}</span></a></li>
                                    @endforeach
                                </ul>

                            </div><!-- End sidebar categories-->

                            <h3 class="sidebar-title">Berita Terbaru</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($recent_berita as $rb)
                                    <div class="post-item clearfix">
                                        <img src="{{ $rb->thumbnail }}" alt="">
                                        <h4>
                                            <a href="{{ route('frontend.detailberita', ['slug' => $rb->slug]) }}">
                                                {{ $rb->judul }}
                                            </a>
                                        </h4>
                                        <time datetime="2020-01-01">{{ $rb->created_at->format('d M Y H:i:s') }}</time>
                                    </div>
                                @endforeach
                            </div><!-- End sidebar recent posts-->

                            <h3 class="sidebar-title">Tag</h3>
                            <div class="sidebar-item tags">
                                <ul>
                                    @foreach ($tag as $t)
                                        <li><a {{--
                                                href="{{ route('frontend.beritabytag', ['tag' => $t->tag]) }}">{{ $t->tag }}
                                                --}}
                                                href="/berita/search?tag={{ $t->tag }}">{{ $t->tag }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- End sidebar tags-->

                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->

                </div>

            </div>
        </section><!-- End Blog Section -->

    </main>
@endsection
