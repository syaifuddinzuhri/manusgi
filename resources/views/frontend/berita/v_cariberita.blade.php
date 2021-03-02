@extends('frontend/berita/v_pageberita')

@php
$title = $keyword
@endphp

@section('title', $title)

@section('breadcumb')
    <!-- ======= Breadcrumbs ======= -->
    <section class="mt-5 bg-success bd">
        <nav aria-label="breadcrumb">
            <div class="container">
                <ol class="breadcrumb bg-light d-flex justify-content-center">
                    <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.berita') }}">Berita</a></li>
                    <li class="breadcrumb-item active font-weight-bold">{{ $keyword }}</li>
                </ol>
            </div>
        </nav>
    </section>
    <!-- End Breadcrumbs -->
@endsection

@section('berita-content')

    <div class="section-title">
        <h4>Pencarian keyword <span class="font-weight-bold">{{ $keyword }}</span> ... </h4>
        <p data-aos="fade-bottom">Ditemukan <span class="font-weight-bold">{{ $berita->count() }}</span> berita</p>
    </div>

    @if (!$berita->isEMpty())
        @foreach ($berita as $ber)
            <article class="entry" data-aos="fade-up">
                <div class="entry-img">
                    <img src="{{ $ber->thumbnail }}" alt="" class="img-fluid">
                </div>
                <h2 class="entry-title">
                    <a href="{{ route('frontend.detailberita', ['slug' => $ber->slug]) }}">{{ $ber->judul }}</a>
                </h2>
                <div class="entry-meta">
                    <ul>
                        <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                href="javascript:void(0)">{{ $ber->user->name }}</a></li>
                        <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a
                                href="javascript:void(0)"><time
                                    datetime="2020-01-01">{{ $ber->created_at->format('d M Y H:i:s') }}</time></a>
                        </li>
                    </ul>
                </div>

                <div class="entry-content">
                    <p>
                        @php
                        $string =strip_tags($ber->isi);
                        $content = html_entity_decode($string);
                        @endphp
                        {{ substr($content, 0, 150) }}
                    </p>
                    <div class="read-more">
                        <a href="{{ route('frontend.detailberita', ['slug' => $ber->slug]) }}">Baca
                            selengkapnya</a>
                    </div>
                </div>
                <div class="entry-footer clearfix mt-3">
                    <div class="float-left">
                        <i class="icofont-folder"></i>
                        <ul class="cats">
                            <li>{{ optional($ber->kategori)->nama }}</li>
                        </ul>

                        <i class="icofont-tags"></i>
                        <ul class="tags">
                            @foreach ($ber->tag as $item)
                                <li>{{ $item->tag }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="float-right share">
                        <a href="" title="Share on Twitter"><i class="icofont-twitter"></i></a>
                        <a href="" title="Share on Facebook"><i class="icofont-facebook"></i></a>
                        <a href="" title="Share on Instagram"><i class="icofont-instagram"></i></a>
                    </div>
                </div>

            </article><!-- End blog entry -->
        @endforeach
        {{ $berita->links('vendor.pagination.bootstrap-4') }}
    @else
        <div class="row" data-aos="fade-up">
            <div class="col-md-6 offset-md-3 text-center">
                <img src="{{ asset('img/nodata.png') }}" class="img-responsive w-100 my-3" alt="">
                <p><span class="font-weight-bold">Oopss!</span> Keyword {{ $keyword }} tidak ditemukan</p>
            </div>
        </div>
    @endif

@endsection
