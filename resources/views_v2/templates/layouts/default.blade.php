<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/scss/style.css') }}">
        <link rel="stylesheet" href="http://develoapp.esy.es/font/stylesheet.css">

        @yield('head')

    </head>

    <body>
	    <div class="loader-bg">
            <div class="loader-bar"></div>
        </div>

        <div id="pageWrapper" class="pageWrapper">

            @include('templates.menus.navbarDefault')

            @yield('breadcrumb')

            @yield('content')

        </div>

        @include('templates.footer.defaultFooter')


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>

        {{-- success --}}
        @if(Session::has('message')) <script>toastr.info("{{Session::get('message')}}")</script> @endif

        {{-- error --}}
        @if(Session::has('message_error')) <script>toastr["error"]("{{Session::get('message_error')}}")</script> @endif

        @yield('js')

    </body>

</html>