@extends('backend.layouts/v_template')

@section('title', 'Jurusan')


@section('pageCSS')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
                                Manajemen Profil
                            </li>
                            <li class="breadcrumb-item active">
                                Jurusan
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content mb-4">
            <div class="container-fluid">
                <div class="row">
                    <a href="Javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#addJurusanModal">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Tambah Jurusan
                    </a>
                    <button class="btn btn-success mx-2" id="sync-jurusan">
                        <i class="fas fa-sync" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Jurusan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tableJurusan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thumbnail</th>
                                <th>Nama Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Thumbnail</th>
                                <th>Nama Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('modalPage')
    <div class="modal fade" id="addJurusanModal" tabindex="-1" aria-labelledby="addJurusanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJurusanModalLabel">Tambah Jurusan</h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="formAddJurusan" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama<sup class="text-danger">*</sup></label>
                            <input type="text" name="nama" class="form-control" id="nama"
                                placeholder="Masukkan nama jurusan" autofocus value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="thubmnail-jurusan">File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="thumbnail_jurusan"
                                    id="thumbnail-jurusan">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
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

    <div class="modal fade" id="editJurusanModal" tabindex="-1" aria-labelledby="editJurusanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJurusanModalLabel">Edit Jurusan</h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="formEditJurusan" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama2">Nama<sup class="text-danger">*</sup></label>
                            <input type="text" name="nama2" class="form-control" id="nama2"
                                placeholder="Masukkan nama jurusan" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="thumb-jurusan">File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="thumb_jurusan" id="thumb-jurusan">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <small class="text-danger">Kosongi input file jika tidak ingin mengupdate file lama!</small>
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

    <!-- Modal -->
    <div class="modal fade" id="deleteJurusanModal" tabindex="-1" aria-labelledby="deleteJurusanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteJurusanModalLabel">Apakah Anda ingin menghapus data ini?</h5>
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
                    <form id="formDeleteJurusan" class="d-inline" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button id="deleteJurusan" type="submit" class="btn btn-danger btn-submit">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('pageJS')
    <!-- DataTables -->
    <script src="{{ asset('adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <!-- jquery-validation -->
    <script src="{{ asset('adminlte') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/jquery-validation/additional-methods.min.js"></script>

    {{-- Script Page --}}
    <script src="{{ asset('js/backend') }}/jurusan.js" type="module"></script>
@endsection
