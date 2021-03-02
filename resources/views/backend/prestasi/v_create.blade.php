@extends('backend.layouts/v_template')

@section('title', 'Prestasi')


@section('pageCSS')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
        crossorigin="anonymous" />
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/summernote/summernote-bs4.css">
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
                            <li class="breadcrumb-item">
                                <a href="{{ route('prestasi.index') }}">
                                    Prestasi
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tambah Prestasi
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content mb-4">
            <div class="container-fluid">
                <div class="row">
                    <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <form id="form-create-prestasi" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Prestasi<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukkan nama" value="{{ old('nama') }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="textarea" id="keterangan" name="keterangan"
                                        data-url-delete="{{ route('backend.prestasi_deleteimage') }}"
                                        data-url-upload="{{ route('backend.prestasi_uploadimage') }}"
                                        value="{{ old('keterangan') }}"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="file">Thumbnail</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/*"
                                            name="thumbnail_prestasi" id="thumbnailPrestasi">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
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
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



@section('pageJS')
    <!-- jquery-validation -->
    <script src="{{ asset('adminlte') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('adminlte') }}/plugins/summernote/summernote-bs4.min.js"></script>

    {{-- Script Page --}}
    <script src="{{ asset('js/backend') }}/prestasi.js" type="module"></script>

@endsection
