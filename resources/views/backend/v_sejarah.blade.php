@extends('backend/layouts/v_template')

@section('title', 'Sejarah')


@section('pageCSS')
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
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.index') }}">
                                    Manajemen Profil
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Sejarah
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content mb-4">
            <div class="container-fluid">
                <div class="row">
                    <button type="button" class="btn btn-secondary" id="btn-kembali-sejarah">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </button>
                    <button type="button" class="btn btn-primary" id="btn-edit-sejarah">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                        Edit Sejarah
                    </button>
                </div>
            </div>
        </section>

        <section class="content" id="edit-sejarah">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Edit Sejarah</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="formSejarah" method="POST">
                                @method('PATCH')
                                @csrf
                                <input type="hidden" name="id_sejarah" id="id_sejarah" value="{{ $sejarah->id }}">
                                <textarea class="textarea" id="tsejarah" name="tsejarah"
                                    data-url-delete="{{ route('backend.sejarah_deleteimage') }}"
                                    data-url-upload="{{ route('backend.sejarah_uploadimage') }}">{{ $sejarah->body }}</textarea>
                                <button class="btn btn-primary btn-loading" type="button" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="fas fa-fw fa-save"></i>
                                    Simpan
                                </button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Edit Thumbnail</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="delete-thumbnail-sejarah"
                                    data-url="{{ route('backend.sejarah_deletethumbnail', ['id' => $sejarah->id]) }}"><i
                                        class="fas fa-trash text-danger"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <img src="" class="img-responsive mb-3" id="previewThumb" alt="">
                            <form id="formThumbnailSejarah" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" name="id_sejarah2" id="id_sejarah2" value="{{ $sejarah->id }}">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/*" name="file"
                                            id="thumbnailSejarah">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-loading" type="button" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="fas fa-fw fa-save"></i>
                                    Simpan
                                </button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>

        <section class="content" id="show-sejarah">
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Sejarah</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 offset-md-4 col-6 offset-3">
                                    <img src="" class="img-responsive mb-3" id="viewThumb" alt="">
                                </div>
                                <div class="col-12">
                                    <p id="body-sejarah"></p>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>

    </div>
    <!-- /.content-wrapper -->
@endsection

@section('pageJS')
    <!-- Summernote -->
    <script src="{{ asset('adminlte') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script type="module" src="{{ asset('js/backend') }}/sejarah.js"></script>


@endsection
