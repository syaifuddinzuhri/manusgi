@extends('frontend/pengumuman/v_pagepengumuman')

@section('title', 'Pengumuman')

@section('pengumuman-content')

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
                                        <a href="/pengumuman/download/{{ $peng->slug }}"><time datetime="2020-01-01">Unduh
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

@endsection
