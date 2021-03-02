@extends('frontend/layouts/v_template')

@section('title', 'PPDB')

@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section class="mt-5 bg-success bd">
            <nav aria-label="breadcrumb">
                <div class="container">
                    <ol class="breadcrumb bg-light  d-flex justify-content-center">
                        <li class="breadcrumb-item font-weight-bold"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active font-weight-bold">PPDB MA NU Sunan Giri Prigen</li>
                    </ol>
                </div>
            </nav>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= ppdb Section ======= -->
        <section id="ppdb" class="ppdb">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>PPDB MA NU Sunan Giri Prigen</strong></h2>
                </div>

                <div class="row content">
                    <div class="col-12">
                        <img src="{{ asset('img/ppdb.jpg') }}" class="img-responsive w-100" alt="">
                    </div>
                    <div class="col-12 my-4">
                        <p>Pendaftaran Peseta Didik Baru MA NU Sunan Giri Tahun Ajaran 2021/2022 telah dibuka. Pelayanan
                            PPDB bisa dilakukan dengan beberapa cara yaitu secara <strong>Offline</strong> atau
                            <strong>Online</strong>. Berikut informasi selengkapnya:
                        </p>
                        <ul>
                            <li class="font-weight-bold">Jadwal Pendaftaran</li>
                            <p>
                            <ul>
                                <li><strong>Gelombang 1 :</strong> 1 Februari 2021 - 30 Mei 2021</li>
                                <li><strong>Gelombang 2 :</strong> 1 Juni 2021 - 13 Juli 2021</li>
                            </ul>
                            </p>
                            <li class="font-weight-bold">Tempat Pendaftaran</li>
                            <p>
                            <ul>
                                <li><strong>Offline</strong> : Kantor MA NU Sunan Giri atau Rumah Kepala MA NU Sunan Giri
                                    (15.00 - 21.00 WIB)</li>
                                <li><strong>Online</strong> : Isi form pendaftaran online pada link berikut <a
                                        href="https://form.jotform.com/210285606554051" class="font-weight-bold"
                                        title="Form Pendaftaran" target="_blank"><ins>Form
                                            Pendaftaran</ins></a>. Atau scan QR Code dibawah
                                    ini:</li>
                                <img src="{{ asset('img/qr_ppdb.jpeg') }}" class="img-responsive img-thumbnail my-2" alt="">
                            </ul>
                            </p>
                            <li class="font-weight-bold">Biaya Pendaftaran GRATIS!!!</li>
                            <hr>
                            <p>Share via :
                                <a href="https://api.whatsapp.com/send?text={{ route('frontend.ppdb') }}" class="text-dark"
                                    target="_blank" title="Share on Whatsapp"><i class="icofont-brand-whatsapp"></i>
                                    WhatsApp</a>
                                |
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('frontend.ppdb') }}&t=PPDB MA NU Sunan Giri Dibuka"
                                    target="_blank" class="text-dark" title="Share on Facebook"><i
                                        class="icofont-facebook"></i>Facebook</a>
                            </p>
                            <hr>
                        </ul>
                    </div>
                </div>

            </div>
        </section><!-- End ppdb Section -->



    </main>
@endsection
