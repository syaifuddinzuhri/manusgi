@extends('frontend/prestasi/v_pageprestasi')

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
                    <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.prestasi') }}">Prestasi</a>
                    </li>
                    <li class="breadcrumb-item active font-weight-bold">{{ $keyword }}</li>
                </ol>
            </div>
        </nav>
    </section>
    <!-- End Breadcrumbs -->
@endsection

@section('prestasi-content')

    <div class="section-title">
        <h4>Pencarian keyword prestasi <span class="font-weight-bold">{{ $keyword }}</span> ... </h4>
        <p>Ditemukan <span class="font-weight-bold">{{ $prestasi->count() }}</span> prestasi</p>
    </div>

    @if (!$prestasi->isEMpty())
        @foreach ($prestasi as $pres)
            <article class="entry" data-aos="fade-up">
                <div class="entry-img">
                    <img src="{{ $pres->thumbnail }}" alt="" class="img-fluid">
                </div>
                <h2 class="entry-title">
                    <a href="{{ route('frontend.detailprestasi', ['slug' => $pres->slug]) }}">{{ $pres->nama }}</a>
                </h2>
                <div class="entry-meta">
                    <ul>
                        <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                href="javascript:void(0)">{{ $pres->user->name }}</a></li>
                        <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a
                                href="javascript:void(0)"><time
                                    datetime="2020-01-01">{{ $pres->created_at->format('d M Y H:i:s') }}</time></a>
                        </li>
                    </ul>
                </div>
                <div class="entry-footer clearfix mt-3">
                    <div class="float-left">
                        <a href="{{ route('frontend.detailprestasi', ['slug' => $pres->slug]) }}"
                            class="btn btn-sm btn-success text-white">Baca
                            selengkapnya</a>
                    </div>
                    <div class="float-right share">
                        <a href="" title="Share on Twitter"><i class="icofont-twitter"></i></a>
                        <a href="" title="Share on Facebook"><i class="icofont-facebook"></i></a>
                        <a href="" title="Share on Instagram"><i class="icofont-instagram"></i></a>
                    </div>
                </div>

            </article><!-- End blog entry -->
        @endforeach
        {{ $prestasi->links('vendor.pagination.bootstrap-4') }}
    @else
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <img src="{{ asset('img/nodata.png') }}" class="img-responsive w-100 my-3" alt="">
                <p><span class="font-weight-bold">Oopss!</span> Keywords prestasi tidak ditemukan</p>
            </div>
        </div>
    @endif

@endsection
