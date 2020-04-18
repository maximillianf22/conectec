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
            <div class="col-6">
                <span style="font-size: 20px">{{$contratacion->NOMBRES}}</span>
            </div>
            <div class="col-6 text-right">
                <span style="font-size: 20px">$ {{number_format($valorContratacion->PRECIO)}}</span>
            </div>
        </div>
        <br/>
        <!-- <div class="row">
            <div class="col-12">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre">
            </div>
        </div> -->
        <br/>
        <div class="row">
            <div class="col-12">
                <label for="correo">Correo</label>
                <input class="form-control" type="text" value="{{$dataUser->email}}" name="correo">
            </div>
        </div>
        <br/>
        <br/>
        <div class="row">
            <div class="col-12 text-center">
                <form id="formBtnPayu" action="{{ env('PAYU_URL') }}" method="post"></form>
                <a href="javascript:;" onclick="pagarPayu()" class="btn btn-info">PAGAR</a>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.10.0/js/md5.min.js"></script>
    <script>
        function pagarPayu()
        {
            var referenceCode = {{$contratacion->ID}} + "-" + {{time()}};
            $("#formBtnPayu").append('<input name="ApiKey" type="hidden" value="' + '{{ env('PAYU_API_KEY') }}' + '">');
            $("#formBtnPayu").append('<input name="merchantId" type="hidden" value="' + {{ env('PAYU_MERCHANT_ID') }} + '">');
            $("#formBtnPayu").append('<input name="accountId" type="hidden" value="' + {{ env('PAYU_ACCOUNT_ID') }} + '">');
            $("#formBtnPayu").append('<input name="description" type="hidden" value="Pago de contratacion">');
            $("#formBtnPayu").append('<input name="referenceCode" type="hidden" value="' + referenceCode + '">');

            $("#formBtnPayu").append('<input name="tax" type="hidden" value="0">');
            $("#formBtnPayu").append('<input name="taxReturnBase" type="hidden" value="0">');
            $("#formBtnPayu").append('<input name="currency" type="hidden" value="' + '{{ env('PAYU_CURRENCY') }}' + '">');

            $("#formBtnPayu").append('<input name="payerFullName" type="hidden" value="' + '{{ $contratacion->NOMBRES}}' + '">');
            $("#formBtnPayu").append('<input name="mobilePhone" type="hidden" value="' + '{{ $contratacion->TELEFONO }}' + '">');
            $("#formBtnPayu").append('<input name="buyerEmail" type="hidden" value="' + '{{ $dataUser->email }}' + '">');

            $("#formBtnPayu").append('<input name="test" type="hidden" value="' + {{ env('PAYU_TEST') }} + '">');
            $("#formBtnPayu").append('<input name="extra1" type="hidden" value="' + {{$contratacion->ID}} + '">');
            $("#formBtnPayu").append('<input name="extra2" type="hidden" value="' + referenceCode + '">');

            $("#formBtnPayu").append('<input name="responseUrl" type="hidden" value="' + '{{ env('PAYU_RESPONSE_URL') }}' + '">');
            $("#formBtnPayu").append('<input name="confirmationUrl" type="hidden" value="' + '{{ env('PAYU_CONFIRMATION_URL') }}' + '">');

            var host = "{{$_SERVER["HTTP_HOST"]}}";
            var data = {
                "parametro": {{$contratacion->ID}}
            }
            $.ajax({
                url:"http://"+host+"/pagar/movimiento",
                data: data,
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    
                },
                success: function(response){
                    if (response.state == 1) {
                        var payu_md5 = "{{ env('PAYU_API_KEY') }}~{{ env('PAYU_MERCHANT_ID') }}~" + referenceCode + "~" + response.valor + "~{{ env('PAYU_CURRENCY') }}";
                        var signature = md5(payu_md5);

                        $("#formBtnPayu").append('<input name="amount" type="hidden" value="' + response.valor + '">');
                        $("#formBtnPayu").append('<input name="signature" type="hidden" value="' + signature + '">');
                        $("#formBtnPayu").append('<input name="extra3" type="hidden" value="' + response.idMov + '">');

                        document.getElementById("formBtnPayu").submit();
                        
                    }else{
                        console.log("ERROR");
                    }
                },
                error: function(xhr){
                    console.log(xhr);
                }
            });
        }
    </script>

  </body>
</html>