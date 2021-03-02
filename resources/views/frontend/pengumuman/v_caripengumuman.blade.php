@extends('frontend/pengumuman/v_pagepengumuman')

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
                    <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.pengumuman') }}">pengumuman</a>
                    </li>
                    <li class="breadcrumb-item active font-weight-bold">{{ $keyword }}</li>
                </ol>
            </div>
        </nav>
    </section>
    <!-- End Breadcrumbs -->
@endsection

@section('pengumuman-content')

    <div class="section-title">
        <h4>Pencarian keyword pengumuman <span class="font-weight-bold">{{ $keyword }}</span> ... </h4>
        <p>Ditemukan <span class="font-weight-bold">{{ $pengumuman->count() }}</span> pengumuman</p>
    </div>

    @if (!$pengumuman->isEMpty())
        @foreach ($pengumuman as $peng)
            <div class="entry mb-4">
                <div class="entry-pengumuman bg-dark" data-aos="zoom-in">
                    <div class="icon-box">
                        <i class="icofont-bell-alt text-success"></i>
                        <div class="w-100">
                            <h3 class="mt-1 mb-2" style="cursor: default"><a href="javascript:void(0)">{{ $peng->nama }}</a>
                            </h3>
                            <p>
                                @php
                                $string =strip_tags($peng->keterangan);
                                $content = html_entity_decode($string);
                                @endphp
                                {{ substr($content, 0, 150) }}
                            </p>
                            <hr>
                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center mt-1"><i class="icofont-user"></i>
                                        <a href="javascript:void(0)">{{ $peng->user->name }}</a>
                                    </li>
                                    <li class="d-flex align-items-center mt-1"><i class="icofont-wall-clock"></i>
                                        <a href="javascript:void(0)"><time
                                                datetime="2020-01-01">{{ $peng->created_at->format('d M Y') }}</time></a>
                                    </li>
                                    @if ($peng->file != null)
                                        <li class="d-flex align-items-center mt-1"><i class='bx bx-download'></i>
                                            <a href="/pengumuman/download/{{ $peng->slug }}"><time
                                                    datetime="2020-01-01">Unduh
                                                    File</time></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <img src="{{ asset('img/nodata.png') }}" class="img-responsive w-100 my-3" alt="">
                <p><span class="font-weight-bold">Oopss!</span> Keywords pengumuman tidak ditemukan</p>
            </div>
        </div>
    @endif

@endsection
