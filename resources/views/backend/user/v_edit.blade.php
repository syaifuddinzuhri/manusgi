@extends('backend.layouts/v_template')

@section('title', 'User')

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
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.index') }}">
                                    Manajemen User
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Edit User
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content mb-4">
            <div class="container-fluid">
                <div class="row">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6">
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
                            <form id="formEditDataUser">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Masukkan nama" value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Masukkan email" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select class="form-control select2bs4" id="level" name="level" style="width: 100%;">
                                        <option selected="selected" disabled>--- Pilih Level ---</option>
                                        <option value="1" {{ $user->level == 1 ? 'selected' : '' }}>Super
                                            Admin</option>
                                        <option value="0" {{ $user->level == 0 ? 'selected' : '' }}>Admin
                                        </option>
                                    </select>
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
                <div class="col-md-6">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Ubah Password</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="formUbahPassword">
                                @csrf
                                <input type="hidden" name="id" id="id2" value="{{ $user->id }}">
                                <div class="form-group">
                                    <label for="password1">Password Baru</label>
                                    <input type="password" name="password1" class="form-control" id="password1"
                                        placeholder="Masukkan password baru">
                                </div>
                                <div class="form-group">
                                    <label for="password2">Password Baru</label>
                                    <input type="password" name="password2" class="form-control" id="password2"
                                        placeholder="Masukkan konfirmasi password baru">
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


    </div>
    <!-- /.content-wrapper -->
@endsection

@section('pageJS')
    <!-- jquery-validation -->
    <script src="{{ asset('adminlte') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte') }}/plugins/select2/js/select2.full.min.js"></script>
    {{-- Script Page --}}
    <script src="{{ asset('js/backend') }}/user.js" type="module"></script>

@endsection
