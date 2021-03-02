@extends('backend.layouts/v_template')

@section('title', 'Album Galeri')

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
                                Manajemen Publikasi
                            </li>
                            <li class="breadcrumb-item active">
                                Album Galeri
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content mb-4">
            <div class="container-fluid">
                <div class="row">
                    <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#addAlbumModal">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Tambah Album
                    </a>
                    <button class="btn btn-success mx-2" id="sync-album">
                        <i class="fas fa-sync" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Album Galeri</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tableAlbum" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Album</th>
                                <th>Jumlah Foto</th>
                                <th>Tanggal dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nama Album</th>
                                <th>Jumlah Foto</th>
                                <th>Tanggal dibuat</th>
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

    <div class="modal fade" id="addAlbumModal" tabindex="-1" aria-labelledby="addAlbumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAlbumModalLabel">Tambah Album</h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="form-add-album">
                        @csrf
                        <div class="form-group">
                            <label for="album">Nama Album<sup class="text-danger">*</sup></label>
                            <input type="text" name="album" class="form-control" id="album" placeholder="Masukkan album"
                                value="{{ old('album') }}" autofocus>
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
    <div class="modal fade" id="deleteAlbumModal" tabindex="-1" aria-labelledby="deleteAlbumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAlbumModalLabel">Apakah Anda ingin menghapus data ini?</h5>
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
                    <form id="formDeleteAlbum" class="d-inline" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button id="deleteAlbum" type="submit" class="btn btn-danger btn-submit">
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
    <script src="{{ asset('js/backend') }}/album.js" type="module"></script>

@endsection
