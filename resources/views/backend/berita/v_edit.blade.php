@extends('backend.layouts/v_template')

@section('title', 'Berita')


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
                                <a href="{{ route('berita.index') }}">
                                    Berita
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Edit Berita
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content mb-4">
            <div class="container-fluid">
                <div class="row">
                    <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Edit Berita</h3>
                        </div>
                        <div class="card-body">
                            <form id="form-edit-berita" method="POST">
                                {{ csrf_field() }}
                                @method('PUT')
                                <input type="hidden" name="idb" id="idb" value="{{ $berita->id }}">
                                <div class="form-group">
                                    <label for="judul">Judul<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" id="judul2" name="judul"
                                        value="{{ $berita->judul }}" placeholder="Masukkan judul">
                                </div>
                                <div class="form-group">
                                    <label for="isiberita">Isi<sup class="text-danger">*</sup></label>
                                    <textarea class="textarea" id="isiberita2" name="isiberita"
                                        data-url-delete="{{ route('backend.berita_deleteimage') }}"
                                        data-url-upload="{{ route('backend.berita_uploadimage') }}">{{ $berita->isi }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori <sup class="text-danger">*</sup></label>
                                    <select class="form-control" name="kategori" id="kategori2">
                                        <option selected="selected" disabled="disabled">Pilih Kategori</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}"
                                                {{ $k->id == $berita->kategori_id ? 'selected' : '' }}>{{ $k->nama }}
                                            </option>
                                        @endforeach
                                    </select>
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
                <div class="col-md-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header card-outline card-success">
                                <h3 class="card-title font-weight-bold">Edit Thumbnail</h3>
                            </div>
                            <div class="card-body">
                                <img src="{{ $berita->thumbnail }}" class="img-responsive mb-3" id="previewThumbBerita"
                                    alt="">
                                <form id="form-edit-thumbnail" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="idb" id="idb2" value="{{ $berita->id }}">
                                    <div class="form-group">
                                        <label for="thumb-berita">Thumbnail<sup class="text-danger">*</sup></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept="image/*"
                                                name="thumb-berita" id="updateThumbnailBerita">
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header card-outline card-danger">
                                <h3 class="card-title font-weight-bold">Edit Tag</h3>
                            </div>
                            <div class="card-body">
                                <form id="form-edit-tags" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="idb" id="idb3" value="{{ $berita->id }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select class="form-control mul-select" id="edit-tag" name="edit-tag"
                                                    multiple="true">
                                                    @foreach ($tag as $t)
                                                        <option value="{{ $t->id }}">{{ $t->tag }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
    <!-- Select2 -->
    {{-- <script src="{{ asset('adminlte') }}/plugins/select2/js/select2.full.min.js">
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('adminlte') }}/plugins/summernote/summernote-bs4.min.js"></script>

    {{-- Script Page --}}
    <script src="{{ asset('js/backend') }}/berita.js" type="module"></script>


@endsection
