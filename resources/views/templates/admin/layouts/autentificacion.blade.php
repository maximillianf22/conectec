<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }} ">
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="http://develoapp.esy.es/font/stylesheet.css">

        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }} "></script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>
        <script src="{{ asset('plugins/iCheck/icheck.min.js') }} "></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }} "></script>
        <script src="{{ asset('plugins/iCheck/icheck.min.js') }} "></script>
       

        @yield('head')

    </head>


    @yield('body')

    {{-- success --}}
    @if(Session::has('message')) <script>toastr.info("{{Session::get('message')}}")</script> @endif

    {{-- error --}}
    @if(Session::has('message_error')) <script>toastr["error"]("{{Session::get('message_error')}}")</script> @endif

    @yield('js')

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        })
</script>
    
</html>