<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Sistem iHadir</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Ace" name="KamalNorizan" />
    <link href="{{ asset('res/assets/plugins/pace/pace-theme-flash.cs') }}s" rel="stylesheet" type="text/css" />
    <link href="{{ asset('res/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('res/assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet"
        type="text/css" media="screen" />
    <link href="{{ asset('res/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"
        media="screen" />
    @yield('headbefore')
    <link class="main-stylesheet" href="{{ asset('res/pages/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.13.2/r-2.4.0/datatables.min.css" /> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('res/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('res/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('res/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet">
    <style>
        .swal-text {
            text-align: center;
        }

        .dataTables_wrapper .row>div {
            display: flex;
            flex-direction: column;
        }

        th.dt-center,
        td.dt-center {
            text-align: center;
        }

        .header .brand {
            width: 250px;
            padding-left: 80px;
        }

        @media (max-width: 1920px) {
            .btn-icon-link {
                margin-left: -30px;
            }
        }

        @media (max-width: 991px) {
            .header .brand {
                width: 180px;
                padding-left: 0px;
            }

            .btn-icon-link {
                margin-left: 0px;
            }
        }

        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            /* Semi-transparent white background */
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .loader-container {
            display: flex;
            width: 100%;
            height: 100%;
            align-items: center;
            justify-content: center;
        }

        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    @yield('head')
</head>

<body class="fixed-header">
{{-- <body class="fixed-header {{ Auth::user()->pinSidebar == '1' ? 'sidebar-visible menu-pin' : '' }}"> --}}
    <!-- BEGIN SIDEBPANEL-->

    <nav class="page-sidebar" data-pages="sidebar">
        <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
        <div class="sidebar-overlay-slide from-top" id="appMenu">
        </div>
        <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
        <!-- BEGIN SIDEBAR MENU HEADER-->
        <div class="sidebar-header">
            {{-- <img src="{{ asset('storage/' . Auth::user()->masjid->logoBlack) }}" alt="logo" class="brand"
                data-src="{{ asset('storage/' . Auth::user()->masjid->logoBlack) }}"
                data-src-retina="{{ asset('storage/' . Auth::user()->masjid->logoBlack) }}" width="80%"
                style="padding-top: 10px"> --}}
            <div class="sidebar-header-controls">
                <button aria-label="Pin Menu" id="sidebarPin" type="button"
                    class="btn btn-icon-link invert d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none"
                    data-toggle-pin="sidebar">
                    <i class="pg-icon"></i>
                </button>
            </div>
        </div>
        <!-- END SIDEBAR MENU HEADER-->
        <!-- START SIDEBAR MENU -->
        @include('layouts.sidebar')
        <!-- END SIDEBAR MENU -->
    </nav>
    <!-- END SIDEBAR -->
    <!-- END SIDEBPANEL-->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container ">
        <!-- START HEADER -->
        <div class="header ">
            <!-- START MOBILE SIDEBAR TOGGLE -->
            <a href="#" class="btn-link toggle-sidebar d-lg-none pg-icon btn-icon-link" data-toggle="sidebar">
                menu</a>
            <!-- END MOBILE SIDEBAR TOGGLE -->
            <div class="">
                <div class="brand inline">
                    {{-- <img src="{{ asset('storage/' . Auth::user()->masjid->logoWhite) }}" alt="logo"
                        data-src="{{ asset('storage/' . Auth::user()->masjid->logoWhite) }}"
                        data-src-retina="{{ asset('storage/' . Auth::user()->masjid->logoWhite) }}" width="95%"> --}}
                </div>
            </div>
            <div class="d-flex align-items-center">
                <!-- START User Info-->
                <div class="dropdown pull-right d-lg-block d-none">
                    <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" aria-label="profile dropdown">
                        <span class="thumbnail-wrapper d32 circular inline">
                            <img src="{{ asset('res/assets/img/profiles/avatar.jpg') }}" alt=""
                                data-src="{{ asset('res/assets/img/profiles/avatar.jpg') }}"
                                data-src-retina="{{ asset('res/assets/img/profiles/avatar_small2x.jpg') }}"
                                width="32" height="32">
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                        <a href="#" class="dropdown-item"><span>Signed in as
                                <br /><b>{{ Auth::user()->name }}</b></span></a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Your Profile</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </div>
                <!-- END User Info-->
                {{-- <a href="#" class="header-icon m-l-5 sm-no-margin d-inline-block" data-toggle="quickview" data-toggle-element="#quickview">
            <i class="pg-icon btn-icon-link">menu_add</i>
          </a> --}}
            </div>
        </div>
        <!-- END HEADER -->
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper ">
            <!-- START PAGE CONTENT -->
            <div class="content ">
                <!-- START JUMBOTRON -->
                <div class="jumbotron" data-pages="parallax">
                    <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                        <div class="inner">
                            <!-- START BREADCRUMB -->
                            <div class="float-right " style="padding: 15px">
                                @yield('actions')
                            </div>
                            <ol class="breadcrumb">
                                {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li>
                  <li class="breadcrumb-item active">Blank template</li> --}}
                                @yield('breadcrumb')

                            </ol>
                            <!-- END BREADCRUMB -->
                        </div>
                    </div>
                </div>
                <!-- END JUMBOTRON -->
                <!-- START CONTAINER FLUID -->
                <div class=" container-fluid   container-fixed-lg">
                    <div class="row">
                        <div class="col-md-12">

                            @include('flash::message')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div id="loading-overlay">
                                <div class="loader-container">
                                    <div class="loader"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @yield('content')
                </div>
                <!-- END CONTAINER FLUID -->
            </div>
            <!-- END PAGE CONTENT -->
            <!-- START COPYRIGHT -->
            <!-- START CONTAINER FLUID -->
            <!-- START CONTAINER FLUID -->
            <div class=" container-fluid  container-fixed-lg footer">
                <div class="copyright sm-text-center">
                    <p class="small-text no-margin pull-left sm-pull-reset">
                        ©2025 All Rights Reserved. KPDN.
                        <span class="hint-text m-l-15">KPDN v01.00</span>
                    </p>
                    {{-- <p class="small no-margin pull-right sm-pull-reset">
              Hand-crafted <span class="hint-text">&amp; made with Love</span>
            </p> --}}
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- END COPYRIGHT -->
        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->
    <!--START QUICKVIEW -->
    <form action="{{ route('logout') }}" method="post" id="logoutForm">@csrf</form>
    <!-- END OVERLAY -->
    <!-- BEGIN VENDOR JS -->
    <script src="{{ asset('res/assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    <!--  A polyfill for browsers that don't support ligatures: remove liga.js if not needed-->
    <script src="{{ asset('res/assets/plugins/liga.js') }}" type="text/javascript"></script>
    <script src="{{ asset('res/assets/plugins/jquery/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('res/assets/plugins/modernizr.custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('res/assets/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('res/assets/plugins/popper/umd/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('res/assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('res/assets/plugins/jquery/jquery-easy.js') }}" type="text/javascript"></script>
    <script src="{{ asset('res/assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('res/assets/plugins/jquery-ios-list/jquery.ioslist.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('res/assets/plugins/jquery-actual/jquery.actual.min.js') }}"></script>
    <script src="{{ asset('res/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.j') }}s"></script>
    <script src="{{ asset('res/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
    </script>
    <script type="text/javascript" src="{{ asset('res/assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('res/assets/plugins/classie/classie.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/plug-ins/1.10.25/sorting/datetime-moment.js"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{ asset('res/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('res/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}">
    </script>
    <script src="{{ asset('res/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('res/assets/plugins/jquery-datatable/extensions/Responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('res/assets/plugins/jquery-datatable/extensions/FixedColumns/js/dataTables.fixedColumns.min.js') }}">
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.2/r-2.4.0/datatables.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" --}}
        {{-- integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"> --}}
    </script>

    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="{{ asset('res/pages/js/pages.js') }}"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="{{ asset('res/assets/js/scripts.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
    <script>
        $('.logoutBtn').click(function(e) {
            e.preventDefault();
            $('#logoutForm').submit();
        });

        function showLoadingOverlay() {
            $('#loading-overlay').fadeIn();
        }


        function hideLoadingOverlay() {
            $('#loading-overlay').fadeOut();
        }


        function simulateContentLoading() {
            showLoadingOverlay();
            setTimeout(function() {

                hideLoadingOverlay();
            }, 2000);
        }

    </script>
    @yield('script')
</body>

</html>
