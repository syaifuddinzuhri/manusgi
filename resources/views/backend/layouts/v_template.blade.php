<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | MA NU Sunan Giri Prigen</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    {{--
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    --}}
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    {{-- Theme --}}
    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('toastr') }}/toastr.css" />
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
    @yield('pageCSS')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="preloader">
        <div class="loading">
            <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Site wrapper -->
    <div class="wrapper">

        @include('backend/layouts/v_navbar')
        @include('backend/layouts/v_sidebar')


        @yield('content')

        <!-- Modal -->
        <div class="modal hide fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Do you want to Logout?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Press <strong>Logout</strong> to end session from system.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="btn btn-danger">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('backend.admin_logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @yield('modalPage')

        <footer class="main-footer">
            Copyright &copy; 2021 All rights reserved. Powered by <a href="">MA NU Sunan Giri.</a> Developed by <a
                href="">Syaifuddin Zuhri</a>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('adminlte') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte') }}/dist/js/demo.js"></script>
    <script src="{{ asset('toastr') }}/toastr.js"></script>

    <!--Main -->
    <script type="text/javascript">
        var APP_URL = "{!!  url('/') !!}";

    </script>
    <script type="text/javascript" src="{{ asset('js/backend') }}/script.js"></script>
    @yield('pageJS')

</body>

</html>
