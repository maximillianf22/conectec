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
        <link rel="stylesheet" href="http://develoapp.esy.es/font/stylesheet.css">
        <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
        @yield('head')

        <style>
            .pagination>li {
                font-size: 12px;
            }

            .pagination{
                float: right;
            }

            .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
                vertical-align: middle;
                display: table-cell;
            }
        </style>

        <style>
            .text-center{
                text-align: center;
            }
            table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
                vertical-align: middle;
                display: table-cell;
            }
            div.dataTables_wrapper div.dataTables_filter input {
                border-radius: 5px;
            }
            .fade-scale {
                transform: scale(0);
                opacity: 0;
                -webkit-transition: all .25s linear;
                -o-transition: all .25s linear;
                transition: all .25s linear;
            }

            .fade-scale.in {
                opacity: 1;
                transform: scale(1);
            }

            .modal.in .modal-dialog {
                -webkit-transform: translate(0, calc(50vh - 50%));
                -ms-transform: translate(0, 50vh) translate(0, -50%);
                -o-transform: translate(0, calc(50vh - 50%));
                transform: translate(0, 50vh) translate(0, -50%);
            }
            .b-5{
                border-radius: 5px;
            }

            .w100{
                width: 100%;
            }
        </style>
    </head>

    <body class="hold-transition skin-blue sidebar-mini fixed">

        <div class="wrapper">

            <header class="main-header">
                @include('templates.admin.menus.navbar')
            </header>

            <aside class="main-sidebar" >
                @include('templates.admin.sidebars.sidebar')
            </aside>

            <main class="content-wrapper" id="content-wrapper">
                @yield('content')
            </main>

            <footer class="main-footer navbar-fixed-bottom css-3" id="main-footer">
                @include('templates.admin.footer.footer')
            </footer>

        </div>

        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }} "></script>
        <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }} "></script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>
        <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }} "></script>
        <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('dist/js/adminlte.min.js') }} "></script>
        <script src="{{ asset('dist/js/demo.js') }} "></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="{{ asset('plugins/slick/slick.min.js') }} "></script>
        <script src="{{ asset('assets/js/conecte.js') }} "></script>
        {{-- success --}}
        @if(Session::has('message')) <script>toastr.info("{{Session::get('message')}}")</script> @endif

        {{-- error --}}
        @if(Session::has('message_error')) <script>toastr["error"]("{{Session::get('message_error')}}")</script> @endif

        <script>
            $.widget.bridge('uibutton', $.ui.button);
            $(document).ready(function(){
                var heightFooter = $(".main-footer").height();
                $(".content-wrapper").css("margin-bottom",(heightFooter+30));
            });
        </script>

        @yield('js')

    </body>
</html>