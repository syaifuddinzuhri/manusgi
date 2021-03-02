@extends('backend.layouts/v_template')

@section('title', 'Album Galeri')

@section('pageCSS')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.admin_dashboard') }}">
                                    <i class="fas fa-home "></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Manajemen Publikasi
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="{{ route('album.index') }}">
                                    Album Galeri
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Edit Album Galeri
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content mb-4">
            <div class="container-fluid">
                <div class="row">
                    <a href="{{ route('album.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Edit Nama Album</h3>
                        </div>
                        <div class="card-body">
                            <form id="form-edit-nama-album" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $album->id }}" id="ida">
                                <div class="form-group">
                                    <label for="album2">Nama Album<sup class="text-danger">*</sup></label>
                                    <input type="text" name="album2" class="form-control" id="album2"
                                        placeholder="Masukkan album" value="{{ $album->nama }}" autofocus>
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
            <div class="row">
                <div class="col">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Upload Foto</h3>
                        </div>
                        <div class="card-body">
                            <form id="dropzoneForm" class="dropzone" method="POST"
                                action="{{ route('backend.upload_dropzone') }}">
                                @csrf
                                <input type="hidden" value="{{ $album->id }}" name="iddz">
                            </form>
                            <div class="row mt-3">
                                <div class="col text-right btn-group-dz">
                                    <button class="btn btn-primary btn-loading" type="button" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                    <button type="button" class="btn btn-primary" id="submit-all">
                                        <i class="fas fa-save"></i>
                                        Upload
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Galeri</h3>
                        </div>
                        <div class="card-body">
                            <div class="row" id="show-galeri">
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
    <!-- Modal -->
    <div class="modal fade" id="deleteGambarModal" tabindex="-1" aria-labelledby="deleteGambarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteGambarModalLabel">Apakah Anda ingin menghapus data ini?</h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Pilih <strong>Hapus</strong> untuk menghapus data.
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Kembali</button>
                    <button class="btn btn-danger btn-loading" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <form id="formDeleteGambar" class="d-inline" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button id="deleteGambar" type="submit" class="btn btn-danger btn-submit">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageJS')
    <script src="{{ asset('js/backend') }}/album.js" type="module"></script>
@endsection
