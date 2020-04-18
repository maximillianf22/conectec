<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <title>Pagos Contratacion!</title>
  </head>
  <body style="margin-top: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2>CONECTE</h2>
            </div>
        </div>
        <br/>
        <br/>
        <div class="row">
            <div class="col-12 text-center">
                @if(Session::has('message'))
                    <i class="fas fa-check-circle fa-4x" style="color:#ff578a"></i>
                    <div class="alert alert-success alert-dismissible" style="margin-top:25px;" role="alert">
                        {{Session::get('message')}}
                    </div>
                @endif
                @if(Session::has('message_error'))
                    <i class="fas fa-times-circle fa-4x" style="color:#ff578a"></i>
                    <div class="alert alert-danger alert-dismissible" style="margin-top:25px;" role="alert">
                        {{Session::get('message_error')}}
                    </div>
                @endif
            </div>
        </div>
        <br/>
        <br/>
        <div class="row">
            <div class="col-12 text-center">
                <a href="app://conecte" class="btn btn-info">VOLVER ALA APLICACIÓN</a>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.10.0/js/md5.min.js"></script>

  </body>
</html>