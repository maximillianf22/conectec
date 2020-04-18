<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/slick/slick.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/slick/slick-theme.css') }}"/>
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }} ">

        <link rel="stylesheet" href="{{asset('assets/css/conectev2.css')}}">

        @yield('head')

        <style>
            .pagination>li {
                font-size: 12px;
            }

            .pagination{
                float: right;
                margin: 0px 0;
            }

            .pagination>.active>span{
                background-color: #ff578a;
                border-color: #ff578a;
            }
            @media (max-width: 767px){
                .main-header .logo, .main-header .navbar {
                    background-color: #31283e !important;
                }
            }
            
        </style>
    </head>

    <body class="hold-transition skin-blue sidebar-mini fixed">

        <div class="wrapper">

            <header class="main-header">
                @include('templates.default.menus.navbar')
            </header>

            <aside class="main-sidebar" >
                @include('templates.default.sidebars.sidebar')
            </aside>

            <main class="content-wrapper" id="content-wrapper">
                @yield('content')
            </main>

            <!--
            <footer class="main-footer navbar-fixed-bottom css-3" id="main-footer">
                @include('templates.default.footer.footer')
            </footer>
            -->

        </div>

        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }} "></script>
        <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }} "></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>
        <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }} "></script>
        <script src="{{ asset('dist/js/adminlte.min.js') }} "></script>
        {{--<script src="{{ asset('dist/js/pages/dashboard.js') }} "></script>--}}
        <script src="{{ asset('dist/js/demo.js') }} "></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="{{ asset('plugins/slick/slick.min.js') }} "></script>

        <script type="text/javascript">
            var Protocol_ = window.location.protocol;
            var UrlHost_ = Protocol_+"//"+"{{$_SERVER["HTTP_HOST"]}}";
        </script>
        <script src="{{ asset('assets/Js/conecte.js') }} "></script>
        <script src="{{ asset('assets/Js/md5.js')}}"></script>


        {{-- success --}}
        @if(Session::has('message')) <script>toastr.info("{{Session::get('message')}}")</script> @endif

        {{-- error --}}
        @if(Session::has('message_error')) <script>toastr["error"]("{{Session::get('message_error')}}")</script> @endif

        

        <script>
            $(document).ready(function(){
                var heightFooter = $(".main-footer").height();
                $(".content-wrapper").css("margin-bottom",(heightFooter+30));
            });            

            $(function() {
                var header = $(".navbar-static-top");
                $(window).scroll(function() {    
                    var scroll = $(window).scrollTop();
                
                    if (scroll >= 70) {
                        $(".navbar-static-top").css("background-color", "#332940");
                    } else {
                        $(".navbar-static-top").css("background-color", "transparent");
                    }
                });
            });
        </script>

        @yield('js')

    </body>
</html>