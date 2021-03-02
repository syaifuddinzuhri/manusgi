@extends('backend.layouts/v_template')

@section('title', 'Tenaga Pendidik & Kependidikan')

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
                                Tenaga Pendidik & Kependidikan
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content mb-4">
            <div class="container-fluid">
                <div class="row">
                    <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal"
                        data-target="#addPendidikModal">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Tambah
                    </a>
                    <button class="btn btn-success mx-2" id="sync-pendidik">
                        <i class="fas fa-sync" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Tenaga Pendidik & Kependidikan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tablePendidik" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Email</th>
                                <th>Nomor HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Email</th>
                                <th>Nomor HP</th>
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
    <div class="modal fade" id="addPendidikModal" tabindex="-1" aria-labelledby="addPendidikModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPendidikModalLabel">Tambah Data Tenaga Pendidik & Kependidikan</h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="formAddPendidik">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama<sup class="text-danger">*</sup></label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama"
                                autofocus value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" id="jabatan"
                                placeholder="Masukkan jabatan" value="{{ old('jabatan') }}">
                            <small class="text-dark">Jabatan boleh lebih dari satu. Pisahkan dengan koma (,)</small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email<sup class="text-danger">*</sup></label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email"
                                value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="nohp">Nomor HP</label>
                            <input type="number" name="nohp" class="form-control" id="nohp" placeholder="Masukkan nomor HP"
                                value="{{ old('nohp') }}">
                        </div>
                        <div class="row">
                            <div class="col-2 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('img/avatar.png') }}" class="img-responsive mb-3" id="previewFoto"
                                    alt="">
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/*" name="foto" id="foto">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
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

    <!-- Modal -->
    <div class="modal fade" id="deletePendidikModal" tabindex="-1" aria-labelledby="deletePendidikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePendidikModalLabel">Apakah Anda ingin menghapus data ini?</h5>
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
                    <form id="formDeletePendidik" class="d-inline" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button id="deletePendidik" type="submit" class="btn btn-danger btn-submit">
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
    <script src="{{ asset('js/backend') }}/pendidik.js" type="module"></script>

@endsection
