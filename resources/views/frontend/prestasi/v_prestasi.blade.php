@extends('frontend/prestasi/v_pageprestasi')

@section('title', 'Prestasi')

@section('breadcumb')
    <!-- ======= Breadcrumbs ======= -->
    <section class="mt-5 bg-success bd">
        <nav aria-label="breadcrumb">
            <div class="container">
                <ol class="breadcrumb bg-light d-flex justify-content-center">
                    <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active font-weight-bold">Prestasi</li>
                </ol>
            </div>
        </nav>
    </section>
    <!-- End Breadcrumbs -->
@endsection

@section('prestasi-content')
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
                    <small>Share on via : </small>
                    <a href="https://api.whatsapp.com/send?text=http://127.0.0.1:8000/prestasi/{{ $pres->slug }}"
                        target="_blank" title="Share on Whatsapp"><i class="icofont-brand-whatsapp"></i></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000/prestasi/{{ $pres->slug }}"
                        target="_blank" title="Share on Facebook"><i class="icofont-facebook"></i></a>
                </div>
            </div>
        </article><!-- End blog entry -->
    @endforeach
    {{ $prestasi->links('vendor.pagination.bootstrap-4') }}
@endsection
