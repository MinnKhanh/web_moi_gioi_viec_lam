<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? '' }} - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css">
    @stack('css')
    <style>
        .container-spin {
            position: fixed;
            display: inline-block;
            box-sizing: border-box;
            padding: 30px;
            width: 25%;
            height: 140px;
            z-index: 10;
            top: 50%;
            left: 50%;
        }


        .circle {
            box-sizing: border-box;
            width: 5rem;
            height: 5rem;
            border-radius: 100%;
            border: 10px solid rgba(133, 130, 128, .3);
            border-top-color: yellow;
            animation: spin 1s infinite linear;
        }

        .circleloader {
            position: absolute;
            box-sizing: border-box;
            top: 50%;
            margin-top: -10px;
            border-radius: 16px;
            width: 80px;
            height: 20px;
            padding: 4px;
            background: rgba(255, 255, 255, 0.4);
        }

        .circleloader:before {
            content: '';
            position: absolute;
            border-radius: 16px;
            width: 20px;
            height: 12px;
            left: 0;
            background: #fff;
            animation: push 1s infinite linear;
        }


        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class=""
    data-layout-config="{&quot;leftSideBarTheme&quot;:&quot;dark&quot;,&quot;layoutBoxed&quot;:false, &quot;leftSidebarCondensed&quot;:false, &quot;leftSidebarScrollable&quot;:false,&quot;darkMode&quot;:false, &quot;showRightSidebarOnStart&quot;: true}"
    data-leftbar-theme="dark">
    <div class="container-spin">
        <div class="circle"></div>
    </div>


    <!-- Begin page -->
    <div class="wrapper mm-active">
        <!-- ========== Left Sidebar Start ========== -->
        @include('layout.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                @include('layout.topbar')
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ $title ?? '' }}</h4>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            @include('layout.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- bundle -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/helper.js') }}"></script>
    @stack('js')
    <script>
        $(window).on("load", function() {
            $(".container-spin").fadeOut("fast");
        });
    </script>

</body>

</html>
