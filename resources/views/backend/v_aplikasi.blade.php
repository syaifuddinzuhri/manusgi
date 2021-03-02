@extends('backend/layouts/v_template')

@section('title', 'Pengaturan Aplikasi')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <a href="{{ route('backend.admin_dashboard') }}">
                                    <i class="fas fa-home "></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Pengaturan Aplikasi
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-outline card-success">
                        <div class="card-header d-flex justify-content-start align-items-center">
                            <button class="btn btn-sm btn-outline-success mr-2" type="button" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fas fa-edit"></i>
                            </button>
                            <h3 class="card-title font-weight-bold">Logo Aplikasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{ $aplikasi->logo }}" class="img-responsive" id="previewLogo" alt="">
                                </div>
                                <div class="col-12 mt-4 collapse" id="collapseExample">
                                    <form id="form-logo" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $aplikasi->id }}" id="idapp">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="file_logo"
                                                    id="file-logo">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-right btn_group">
                                                <button class="btn btn-primary btn-loading" type="button" disabled>
                                                    <span class="spinner-grow spinner-grow-sm" role="status"
                                                        aria-hidden="true"></span>
                                                    Loading...
                                                </button>
                                                <button type="submit" class="btn btn-primary btn-submit">
                                                    <i class="fas fa-fw fa-save"></i>
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-outline card-danger">
                        <div class="card-header d-flex justify-content-start align-items-center">
                            <a href="javscript:void(0)" class="btn btn-sm btn-outline-danger mr-2" data-toggle="modal"
                                data-target="#editSosmedModal">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <h3 class="card-title font-weight-bold">Media Sosial</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <p class="font-weight-bold">Facebook</p>
                                </div>
                                <div class="col-12">
                                    <p>{{ $aplikasi->facebook }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="font-weight-bold">Instagram</p>
                                </div>
                                <div class="col-12">
                                    <p>{{ $aplikasi->instagram }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="font-weight-bold">Twitter</p>
                                </div>
                                <div class="col-12">
                                    <p>{{ $aplikasi->twitter }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="font-weight-bold">Youtube</p>
                                </div>
                                <div class="col-12">
                                    <p>{{ $aplikasi->youtube }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header d-flex justify-content-start align-items-center">
                            <a href="javscript:void(0)" class="btn btn-sm btn-outline-info mr-2" data-toggle="modal"
                                data-target="#editAplikasiModal">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <h3 class="card-title font-weight-bold">Data Aplikasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="font-weight-bold">Nama</p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $aplikasi->nama }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="font-weight-bold">Alamat</p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $aplikasi->alamat }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="font-weight-bold">Email</p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $aplikasi->email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="font-weight-bold">Telepon</p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $aplikasi->telepon }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="font-weight-bold">Deskripsi</p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $aplikasi->meta_deskripsi }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="font-weight-bold">Keyword</p>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $aplikasi->meta_keyword }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('modalPage')
    {{-- Data Aplikasi --}}
    <div class="modal fade" id="editAplikasiModal" tabindex="-1" aria-labelledby="editAplikasiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAplikasiModalLabel">Edit Data Aplikasi</h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="form-edit-data-aplikasi" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="{{ $aplikasi->id }}" id="idapp2">
                        <div class="form-group">
                            <label for="nama">Nama<sup class="text-danger">*</sup></label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama"
                                value="{{ $aplikasi->nama }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email">Email<sup class="text-danger">*</sup></label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email"
                                value="{{ $aplikasi->email }}">
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon<sup class="text-danger">*</sup></label>
                            <input type="number" name="telepon" class="form-control" id="telepon"
                                placeholder="Masukkan telepon" value="{{ $aplikasi->telepon }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat">{{ $aplikasi->alamat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="col-form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi"
                                name="deskripsi">{{ $aplikasi->meta_deskripsi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="keyword" class="col-form-label">Keyword</label>
                            <textarea class="form-control" id="keyword"
                                name="keyword">{{ $aplikasi->meta_keyword }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right btn_group">
                                <button class="btn btn-primary btn-loading" type="button" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="fas fa-fw fa-save"></i>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Data Aplikasi --}}
    <div class="modal fade" id="editSosmedModal" tabindex="-1" aria-labelledby="editSosmedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSosmedModalLabel">Edit Sosial Media</h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="form-edit-sosmed" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="{{ $aplikasi->id }}" id="idapp3">
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" name="facebook" class="form-control" id="facebook"
                                placeholder="Masukkan url facebook" value="{{ $aplikasi->facebook }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" name="instagram" class="form-control" id="instagram"
                                placeholder="Masukkan url instagram" value="{{ $aplikasi->instagram }}">
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" name="twitter" class="form-control" id="twitter"
                                placeholder="Masukkan url twitter" value="{{ $aplikasi->twitter }}">
                        </div>
                        <div class="form-group">
                            <label for="youtube">Youtube</label>
                            <input type="text" name="youtube" class="form-control" id="youtube"
                                placeholder="Masukkan url youtube" value="{{ $aplikasi->youtube }}">
                        </div>
                        <div class="row">
                            <div class="col-12 text-right btn_group">
                                <button class="btn btn-primary btn-loading" type="button" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="fas fa-fw fa-save"></i>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('pageJS')
    <!-- jquery-validation -->
    <script src="{{ asset('adminlte') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/jquery-validation/additional-methods.min.js"></script>
    {{-- Script Page --}}
    <script src="{{ asset('js/backend') }}/aplikasi.js" type="module"></script>
@endsection
