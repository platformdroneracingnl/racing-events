<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.includes.title-meta')
    @include('layouts.includes.head')
</head>

@section('body')

<body data-layout="horizontal" data-topbar="colored" data-layout-size="boxed">
    @show

    @include('sweetalert::alert')

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.navbars.navbar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.includes.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    {{-- @include('layouts.right-sidebar') --}}
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    @include('layouts.includes.vendor-scripts')
</body>

</html>
