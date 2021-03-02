@extends('frontend/layouts/v_template')

@php
$judul = $berita->judul
@endphp

@section('title', $judul)

@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="mt-5 bg-success bd">
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb bg-light d-flex justify-content-center">
                        <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.berita') }}">Berita</a>
                        </li>
                        <li class="breadcrumb-item active font-weight-bold">{{ $berita->judul }}</li>
                    </ol>
                </div>
            </nav>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="detail-berita" class="detail-berita">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <article class="entry" data-aos="fade-up">
                            <h2 class="entry-title">
                                <a href="javascript:void(0)">{{ $berita->judul }}</a>
                            </h2>
                            <hr>
                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                            href="javascript:void(0)">{{ $berita->user->name }}</a></li>
                                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a
                                            href="javascript:void(0)"><time
                                                datetime="2020-01-01">{{ $berita->created_at->format('d M Y H:i:s') }}</time></a>
                                    </li>
                                </ul>
                            </div>
                            <hr>
                            <div class="entry-img">
                                <img src="{{ $berita->thumbnail }}" alt="" class="img-fluid">
                            </div>
                            <div class="entry-content">
                                <p>{!! $berita->isi !!}</p>
                            </div>
                            <div class="entry-footer clearfix">
                                <div class="float-left">
                                    <i class="icofont-folder"></i>
                                    <ul class="cats">
                                        <li>{{ $berita->kategori->nama }}</li>
                                    </ul>

                                    <i class="icofont-tags"></i>
                                    <ul class="tags">
                                        @foreach ($berita->tag as $item)
                                            <li>{{ $item->tag }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="float-right share">
                                    <small>Share on via : </small>
                                    <a href="https://api.whatsapp.com/send?text=http://127.0.0.1:8000/berita/{{ $berita->slug }}"
                                        target="_blank" title="Share on Whatsapp"><i class="icofont-brand-whatsapp"></i></a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000/berita/{{ $berita->slug }}"
                                        target="_blank" title="Share on Facebook"><i class="icofont-facebook"></i></a>
                                    {{-- <a
                                        href="https://www.instagram.com/?url=http://127.0.0.1:8000/berita/{{ $berita->slug }}"
                                        target="_blank" title="Share on Instagram"><i class="icofont-instagram"></i></a>
                                    --}}
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="sidebar m-0" data-aos="fade-left">
                            <h3 class="sidebar-title">Cari Berita</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ route('frontend.cariberita') }}" id="search-form-berita" method="GET">
                                    <input type="text" id="keywords" name="keywords">
                                    <button type="submit"><i class="icofont-search"></i></button>
                                </form>
                            </div><!-- End sidebar search formn-->
                            <h3 class="sidebar-title">Berita Terbaru Lainnya</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($recent_berita as $rb)
                                    <div class="post-item clearfix">
                                        <img src="{{ $rb->thumbnail }}" class="img-responsive mb-2" alt="">
                                        <h4>
                                            <a href="{{ route('frontend.detailberita', ['slug' => $rb->slug]) }}">
                                                {{ $rb->judul }} </a>
                                        </h4>
                                        <time datetime="2020-01-01">{{ $rb->created_at->format('d M Y H:i:s') }}</time>
                                    </div>
                                    <hr>
                                @endforeach
                                <div class="text-center">
                                    <a href="{{ route('frontend.berita') }}" class="btn btn-sm btn-outline-success">Lihat
                                        semua berita</a>
                                </div>
                            </div><!-- End sidebar recent posts-->
                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->
                </div>
            </div>
        </section><!-- End Blog Section -->

    </main>
@endsection
