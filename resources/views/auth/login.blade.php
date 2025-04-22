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

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="Ace" name="author" />
    <link href="{{ asset('res/assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('res/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('res/assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet"
        type="text/css" media="screen" />
    <link href="{{ asset('res/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"
        media="screen" />
    <link class="main-stylesheet" href="{{ asset('res/pages/css/themes/corporate.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="{{ asset('res/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        window.onload = function() {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML +=
                '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
        }
    </script>
    <style>
        .login-container {
            overflow-y: scroll;
        }
    </style>
</head>

<body class="fixed-header menu-pin menu-behind">
    <div class="login-wrapper ">
        <!-- START Login Background Pic Wrapper-->
        <div class="bg-pic">
            <!-- START Background Caption-->
            <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
                <h1 class="semi-bold text-white">
                    Sistem iHadir V2.</h1>
                <p class="small">
                    ©2025-2027 All Rights Reserved. Sistem iHadir® is a registered trademark of
                    KPDN.
                </p>
            </div>
            <!-- END Background Caption-->
        </div>
        <!-- END Login Background Pic Wrapper-->
        <!-- START Login Right Container-->

        <div class="login-container bg-white">
            <div class="p-l-50 p-r-50 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
                <img src="{{ asset('images/logo.png') }}" alt="logo" data-src="{{ asset('images/logo_full.png') }}"
                    data-src-retina="{{ asset('images/logo.png') }}" width="40%">
                <h2 class="p-t-25" style="font-size:25px;margin-bottom: 0px;"> KPDN <br />
                    <h4 style="font-size:20px;margin: 0px;">Sistem iHadir V2</h4>
                </h2>
                <p class="mw-80 m-t-5">Log masuk ke akaun anda</p>
                <div class="row">
                    <div class="col-md-12">
                        @include('flash::message')
                    </div>
                </div>
                <!-- START Login Form -->
                <form action="{{ route('login') }}" method="post" class="p-t-15" role="form" id="form-login">
                    <!-- START Form Control-->
                    @csrf
                    {{-- <div class="form-group form-group-default">
                    <label>Log Masuk</label>
                    <div class="controls">
                        <input type="text" name="email" placeholder="Alamat Email/No Kad Pengenalan" class="form-control" required>
                    </div>
                </div> --}}
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} form-group-default">
                    <label for="email">Log Masuk</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}"  class="form-control" required="required" placeholder="Alamat Email">
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                </div>
                    <!-- END Form Control-->
                    <!-- START Form Control-->
                    {{-- <div class="form-group form-group-default"> --}}
                    {{-- <label>Kata Laluan</label> --}}
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}  form-group-default">
                        <label for="password">Kata Laluan</label>
                        <input type="password" id="password" name="password" class="form-control" required="required">
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                    </div>
                    {{-- <div class="controls">
                    <input type="password" class="form-control" name="password"  required>
                </div> --}}
                    {{-- </div> --}}
                    <!-- START Form Control-->
                    <div class="row">
                        <div class="col-md-6 no-padding sm-p-l-10">
                            {{-- <div class="form-check">
                    <input type="checkbox" value="1" id="checkbox1">
                    <label for="checkbox1">Remember me</label>
                    </div> --}}
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-end">
                            <button aria-label="" id="loginBtn" class="btn btn-primary btn-lg m-t-10"
                                type="button">Log Masuk</button>
                        </div>
                    </div>
                    <div class="m-b-5 m-t-30">
                        {{-- <a href="{{ route('user.passwordreset') }}" class="normal">Lupa Kata Laluan?</a> --}}
                    </div>
                    <div>
                        {{-- <a href="{{route('industry.register')}}" class="normal">Belum mempunyai akaun? Daftar sekarang.</a> --}}
                    </div>
                    <!-- END Form Control-->
                </form>
                <!--END Login Form-->
                <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                    <div class="col-sm-12 no-padding m-t-10">
                        <p class="small-text normal hint-text">
                            ©2023-2025 All Rights Reserved. Sistem iHadir® is a registered trademark
                            of KPDN. <a href="#">Cookie Policy</a>, <a href="#"> Privacy and
                                Terms</a>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- END Login Right Container-->
        </div>

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
        <script src="{{ asset('res/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('res/assets/plugins/select2/js/select2.full.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('res/assets/plugins/classie/classie.js') }}"></script>
        <script src="{{ asset('res/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
        </script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- END VENDOR JS -->
        <script src="{{ asset('res/pages/js/pages.min.js') }}"></script>
        <script>
            $(function() {
                $('#form-login').validate({
                    messages: {
                        'email': "Sila masukkan alamat e-mel yang betul.",
                        'password': "Sila masukkan katalaluan yang betul"
                    }
                });
                //
                $('#loginBtn').click(function(e) {
                    e.preventDefault();
                    if ($('#form-login').validate()) {
                        $('#form-login').submit();
                    }
                });
            })
            var warningKey = localStorage.getItem('session-warning-displayed');
            var logoutallKey = localStorage.getItem('session-logoutall');


            if (warningKey === 'true' && logoutallKey === 'true') {
                swal({
                    title: 'Notice',
                    text: 'You have already logged out because your session ended',
                    icon: 'info',
                });

                setTimeout(function() {
                    localStorage.removeItem('session-warning-displayed');
                    localStorage.removeItem('session-logoutall');
                }, 5000);
            }
        </script>
</body>

</html>
