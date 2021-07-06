@include('layouts.header.header')

<body class="hold-transition sidebar-mini layout-navbar-fixed">

    <div class="wrapper">

        <!-- Preloader -->
        @include('layouts.preload.preload')

        <!-- Navbar -->
        @include('layouts.navbar.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar.main-sidebar')

        <!-- Sidebar -->
        @include('layouts.sidebar.sidebar')
        <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @section('content')

        @show
        <!-- /.content-wrapper -->

        <!-- Footer -->
        @include('layouts.footer.footer')
        <!-- /.Footer -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Scripts -->
    @include('layouts.footer.footer-scripts')

    @section('addons-scripts')

    @show
    <!-- /.Scripts -->

</body>

</html>
