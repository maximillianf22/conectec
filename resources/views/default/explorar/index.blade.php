<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Conecte... Tu artista cerca de ti</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('assets/css/conectev2.css')}}">
        <style>
            .figure-caption{
                display: none !important;
            }
            .figure:hover .figure-caption {
                display: flex!important; 
            }
        </style>
    </head>
    <body class="bg-white">

    <div class="page-cover"></div>
    @include('default.head')
    @include('default.explorar.notices')
    @include('default.explorar.events')
    @include('default.footer')
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    </body>

</html>