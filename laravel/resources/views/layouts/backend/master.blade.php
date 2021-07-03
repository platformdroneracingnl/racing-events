<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.includes.title-meta')
    @include('layouts.includes.head')
</head>

@section('body')

    @if (auth()->user()->setting('layout_sidebar'))
        <body>
    @else
        <body data-layout="horizontal" data-topbar="colored">
    @endif

    @show

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.navbars.navbar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <!-- Start content -->
                <div class="container-fluid">
                    @yield('content')
                    <!-- container-fluid -->
                </div>
            </div>
            <!-- End Page-content -->
            @include('layouts.includes.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.navbars.right-sidebar')
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    @include('layouts.includes.vendor-scripts')
</body>

</html>
