@extends('backend.layouts/v_template')

@section('title', 'Tenaga Pendidik & Kependidikan')

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
                                    <i class="fas fa-tachometer-alt "></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Manajemen Profil
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pendidik.index') }}">
                                    Tenaga Pendidik & Kependidikan
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Edit Tenaga Pendidik & Kependidikan
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content mb-4">
            <div class="container-fluid">
                <div class="row">
                    <a href="{{ route('pendidik.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Edit Data</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="formEditDataPendidik">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $pendidik->id }}">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        placeholder="Masukkan nama" value="{{ $pendidik->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control" id="jabatan"
                                        placeholder="Masukkan jabatan" value="{{ $pendidik->jabatan }}">
                                    <small class="text-dark">Jabatan boleh lebih dari satu. Pisahkan dengan koma (,)</small>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email<sup class="text-danger">*</sup></label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Masukkan email" value="{{ $pendidik->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="nohp">Nomor HP</label>
                                    <input type="number" name="nohp" class="form-control" id="nohp"
                                        placeholder="Masukkan nomor HP" value="{{ $pendidik->telepon }}">
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
                    <!-- /.card -->

                </div>
                <div class="col-md-4">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Edit Foto</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <img src="{{ $pendidik->foto }}" class="img-responsive mb-3" id="previewFoto" alt="">
                            <form id="formEditFotoPendidik" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="idp" id="idp2" value="{{ $pendidik->id }}">
                                <div class="form-group">
                                    <label for="foto">Foto<sup class="text-danger">*</sup></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/*" name="foto" id="foto">
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
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>


    </div>
    <!-- /.content-wrapper -->
@endsection

@section('pageJS')
    <!-- jquery-validation -->
    <script src="{{ asset('adminlte') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/jquery-validation/additional-methods.min.js"></script>

    {{-- Script Page --}}
    <script src="{{ asset('js/backend') }}/pendidik.js" type="module"></script>

@endsection
