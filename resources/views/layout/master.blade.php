<!DOCTYPE html>
<html lang="en">
@include('partials._head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('assets/backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('partials._header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('partials._sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{--<div class="content-header">--}}
            {{--<div class="container-fluid">--}}
                {{--<div class="row mb-2">--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<h1 class="m-0">Dashboard</h1>--}}
                    {{--</div><!-- /.col -->--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<ol class="breadcrumb float-sm-right">--}}
                            {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                            {{--<li class="breadcrumb-item active">Dashboard v1</li>--}}
                        {{--</ol>--}}
                    {{--</div><!-- /.col -->--}}
                {{--</div><!-- /.row -->--}}
            {{--</div><!-- /.container-fluid -->--}}
        {{--</div>--}}
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <nav aria-label="breadcrumb mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    @yield('breadcrumb')
                </ol>
            </nav>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
           @yield('main_content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('partials._footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('partials._scripts')
</body>
</html>
