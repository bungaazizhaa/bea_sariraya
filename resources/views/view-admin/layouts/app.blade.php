<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('titlepage')

    <link rel="icon" href="{{ asset('assets') }}/images/bunga2.png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/fontawesome-free/css/all.min.css">
    <script src="https://kit.fontawesome.com/637f4baacf.js" crossorigin="anonymous"></script>
    {{-- SweetAlert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('admin-lte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/myadminapp.css">
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- jQuery -->
    <script src="{{ asset('admin-lte') }}/plugins/jquery/jquery.min.js"></script>


    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-lte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin-lte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-lte') }}/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- SelectPicker -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    {{-- <script src="{{ asset('assets/js/moment-with-locales.min.js') }}"></script> --}}

    {{-- Date Picker --}}
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    {{-- Jangan Dihapus --}}
    <script src="{{ asset('assets/js/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.min.js') }}"></script>


    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

</head>

{{-- <body class="hold-transition sidebar-mini layout-fixed"> --}}

<body class="hold-transition sidebar-mini layout-fixed dark-mode">
    <div class="wrapper">
        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets') }}/logo sariraya.png" alt="AdminLTELogo" height="40"
                width="100">
        </div> --}}

        <!-- Navbar -->
        {{-- <nav class="main-header navbar navbar-expand sticky-top"> --}}
        <nav class="main-header navbar navbar-expand sticky-top navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            {{-- <ul class="navbar-nav mx-1">
                <ol class="breadcrumb float-sm-right nav-item text-nowrap">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </ul> --}}
            <ul class="navbar-nav mx-1 text-truncate">
                <li class="nav-item">
                    @yield('title')
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <div class="user-image img-circle image-previewer elevation-2" alt="User Image" style="background-image: url('/pictures/{{ Auth::user()->picture == '' ? 'noimg.png' : Auth::user()->picture }}'); background-size: cover; background-position: center top; width: 36px;
                            height: 36px;">
                        </div>
                        <span class="d-none d-lg-inline ml-2">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header">
                            <div class="row d-flex justify-content-center m-2">
                                <div class="user-image img-circle image-previewer myshadow" alt="User Image" style="background-image: url('/pictures/{{ Auth::user()->picture == '' ? 'noimg.png' : Auth::user()->picture }}'); background-size: cover; background-position: center top; width: 100px;
                                    height: 100px;">
                                </div>
                            </div>
                            <p>
                                {{ Auth::user()->name }}
                                <small>Member since
                                    {{ Auth::user()->created_at->translatedFormat('M. Y') }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            {{-- <a href="{{ route('user.showprofil', Auth::user()->role) }}"
                                class="btn btn-outline-light rounded-sm"><i class="far fa-user"></i> Profile</a> --}}
                            <a href="#" class="btn btn-outline-danger rounded-sm float-right"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="fas fa-sign-out-alt"></i>
                                Sign out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Left side column. contains the logo and sidebar -->
        @include('view-admin.layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pt-3">
            @include('sweetalert::alert')
            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        {{-- <footer class="main-footer text-center text-sm-left">
            <strong>Copyright &copy; 2022 <a href="#">Awardee Sariraya</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>v</b>1.0.0
            </div>
        </footer> --}}

    </div>
    <!-- ./wrapper -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
