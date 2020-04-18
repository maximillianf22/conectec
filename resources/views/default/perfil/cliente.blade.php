<section class="content">
        <div class="row">
            <div class="col-md-5 ">
                <div class="box box-widget widget-user">
                    <div class="widget-user-header " >
                        <h3 class="widget-user-username">{{ $user->name }}</h3>
                        <h5 class="widget-user-desc">{{ $user->tipoUsuario->NOMBRE }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset('assets/img/clientes/'.$user->foto_perfil) }}" alt="{{ $user->name }}">
                    </div>
                    <div class="box-footer">
                        <br />
                        <div class="row pad-no">
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <div class="description-header">{{ count($user->dedicatorias) }}</div>
                                    <span class="description-text">@lang('conecte.dedications')</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <div class="description-header">{{ count($user->contrataciones) }}</div>
                                    <span class="description-text">@lang('conecte.hirings')</span>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="description-block">
                                    <div class="description-header">{{ number_format($user->billetera->SALDO, 2) }}</div>
                                    <span class="description-text">@lang('conecte.wallet')</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box bg-yellow" style="background-color: #f4f4f4 !important; border-radius: 15px;">
                            <div class="info-box-content" style="margin-left:0px;padding: 10px 15px">
                                <span class="info-box-text" style="color: #2f2f2f; text-transform: inherit; font-weight: bold;">@lang('conecte.available')</span>
                                <span class="info-box-number" style="color: #2f2f2f; text-transform: inherit; font-weight: bold; font-size: 30px;font-size: 20px;">${{ number_format($totalDisponibles, 2) }}</span>
    
                                <span class="progress-description" style="color: #2f2f2f; text-transform: inherit; font-weight: 500;opacity: 0.39;font-size: 12px;">
                                    @lang('conecte.balance') ${{ number_format($balance, 2) }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="small-box bg-red" style="background-color: #f4f4f4 !important; border-radius: 15px;">
                            <div class="inner">
                                <h5 style="padding-bottom: 45px;color: #2f2f2f; text-transform: inherit; font-weight: bold;opacity: 0.79;">@lang('conecte.deposit_money')</h5>
                            </div>
                            <div class="icon" style="top: -15px; display: block">
                                <img src="{{ asset('assets/img/depositar.png') }}" alt="depositar" style="cursor: pointer;" data-toggle="modal" data-target="#depositar">
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="depositar" tabindex="-1" role="dialog" aria-labelledby="depositarLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content" style="background: linear-gradient(45deg, rgba(255,168,134,1) 0%, rgba(255,150,134,1) 22%, rgba(255,95,132,1) 90%, rgba(255,87,132,1) 100%);">
                                <div class="modal-header text-center" style="border: none;">
                                    <h4 class="modal-title" id="depositarLabel" style="color:#FFF;">Depositar dinero</h4>
                                </div>
                                <div class="modal-body text-center" style="padding: 0px 20px;">
                                    <div class="form-dedication">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 pad-btm">
                                                <input id="valor" autocomplete="off" type="text" style="background: #FFFFFF60;" class="form-control" placeholder="Digita el valor a depositar">
                                                <form id="formBtnPayu" action="{{ env('PAYU_URL') }}" method="post"></form>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer text-center" id="botonPayu" style="border: none;">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" onclick="recargarSaldo()">Recargar</button>
                                </div>
                                <div class="modal-footer text-center" id="cargandoPayu" style="border: none; display: none;">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" style="padding: 0;" class="btn btn-primary"><img width="78" height="32" src="{{asset('assets/img/cargando.svg')}}"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="col-md-3 d-none  ">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('assets/img/clientes/'.$user->foto_perfil) }}" alt="{{ $user->name }}">
        
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
        
                        <p class="text-muted text-center">{{ $user->tipoUsuario->first()->NOMBRE }}</p>
        
                        <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Genero</b> <a class="pull-right">Sin definir</a>
                        </li>
                        <li class="list-group-item">
                            <b>Billetera</b> <a class="pull-right">{{ number_format($user->billetera->first()->SALDO, 2) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Dedicatorias</b> <a class="pull-right">{{ count($user->dedicatorias) }}</a>
                        </li>
                        </ul>
        
                        <a href="#" class="btn btn-primary btn-block"><b>Recargar billetera</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <div class="col-md-7">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#perfil" data-toggle="tab">@lang('conecte.profile_information')</a>
                        </li>
                        <li>
                            <a href="#pass" data-toggle="tab">@lang('conecte.password')</a>
                        </li>
                    </ul>

                    <div class="tab-content">                    
                        <div class="active tab-pane" id="perfil">
                            <form class="form-horizontal" method="POST" action="{{ route('actulizarCliente') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <input type="hidden" name="TIPO" value="1">

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">@lang('conecte.name')</label>                
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="@lang('conecte.name')" name="NAME" value="{{$user->name}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">@lang('conecte.email')</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" placeholder="@lang('conecte.email')" value="{{$user->email}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">@lang('conecte.profile_picture')</label>                
                                    <div class="col-sm-10">
                                        <input type="file" name="FOTO_PERFIL">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">@lang('conecte.update')</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="pass">
                                <form class="form-horizontal" id="passCliente" method="POST" action="{{ route('actulizarCliente') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
        
                                    <input type="hidden" name="TIPO" value="2">
        
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">@lang('conecte.password')</label>                
                                        <div class="col-sm-10">
                                            <input type="password" id="password" onkeyup="validarPass(this.value)" name="password" class="form-control">
                                            <div id="result_pass" style="font-size:11px;color:#FF578A;padding-left:7px;"></div>
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">@lang('conecte.confirm_password')</label>                
                                        <div class="col-sm-10">
                                            <input type="password" name="password_confirmation" class="form-control" >
                                            
                                        </div>
                                    </div>
        
                                    <div class="form-group btnText">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button onclick="ejecutarForm()" class="btn btn-primary">@lang('conecte.update')</button>
                                        </div>
                                    </div>
        
                                </form>
                            </div>


                    </div>

                    
                </div>
            </div>

        </div>
</section>

@section('js')
    <script>
        function ejecutarForm(){
            $("#passCliente").submit();
        }
        function validarPass(password){
            var cont = document.getElementsByClassName('btnText')[0];
            if (!/^(?=(?:.*\d){2})(?=(?:.*[A-Z]){2})(?=(?:.*[a-z]){2})\S{10,}$/.test(password)) {
                if (password.length > 20) {
                    document.getElementById("result_pass").innerHTML="Debe ingresar maximo 10 caracteres";
                    document.getElementById("password").value="";
                }
                document.getElementById("result_pass").innerHTML="Debe tener almenos 2 mayusculas, 2 minusculas y un maximo de 20 caracteres";
                cont.style.pointerEvents = "none";
            }else{
                document.getElementById("result_pass").innerHTML="";
                cont.style.pointerEvents = "auto";
            }
        }
    </script>
    <script>
        function recargarSaldo(){
            var referenceCode = {{$user->id}} + "-" + {{time()}};
            var valorRecarga = $("#valor").val();
            $("#botonPayu").css('display', 'none');
            $("#cargandoPayu").css({"display": "block", "border": "none"});
            try {

                $("#formBtnPayu").append('<input name="ApiKey" type="hidden" value="' + '{{ env('PAYU_API_KEY') }}' + '">');
                $("#formBtnPayu").append('<input name="merchantId" type="hidden" value="' + {{ env('PAYU_MERCHANT_ID') }} + '">');
                $("#formBtnPayu").append('<input name="accountId" type="hidden" value="' + {{ env('PAYU_ACCOUNT_ID') }} + '">');
                $("#formBtnPayu").append('<input name="description" type="hidden" value="Conecte - Recargas">');
                $("#formBtnPayu").append('<input name="referenceCode" type="hidden" value="' + referenceCode + '">');

                $("#formBtnPayu").append('<input name="tax" type="hidden" value="0">');
                $("#formBtnPayu").append('<input name="taxReturnBase" type="hidden" value="0">');
                $("#formBtnPayu").append('<input name="currency" type="hidden" value="' + '{{ env('PAYU_CURRENCY') }}' + '">');

                $("#formBtnPayu").append('<input name="payerFullName" type="hidden" value="' + '{{ Auth::user()->name  }}' + '">');
                $("#formBtnPayu").append('<input name="buyerFullName" type="hidden" value="' + '{{ Auth::user()->name }}' + '">');
                $("#formBtnPayu").append('<input name="mobilePhone" type="hidden" value="' + '{{ Auth::user()->celular }}' + '">');
                $("#formBtnPayu").append('<input name="payerMobilePhone" type="hidden" value="' + '{{ Auth::user()->celular }}' + '">');
                $("#formBtnPayu").append('<input name="buyerEmail" type="hidden" value="' + '{{ Auth::user()->email }}' + '">');

                $("#formBtnPayu").append('<input name="test" type="hidden" value="' + {{ env('PAYU_TEST') }} + '">');
                $("#formBtnPayu").append('<input name="extra1" type="hidden" value="' + referenceCode + '">');
                $("#formBtnPayu").append('<input name="extra2" type="hidden" value="' + '{{ Auth::user()->id }}' + '">');

                $("#formBtnPayu").append('<input name="responseUrl" type="hidden" value="' + '{{ env('PAYU_RESPONSE_URL_RC') }}' + '">');
                $("#formBtnPayu").append('<input name="confirmationUrl" type="hidden" value="' + '{{ env('PAYU_CONFIRMATION_URL_RC') }}' + '">');

                var payu_md5 = "{{ env('PAYU_API_KEY') }}~{{ env('PAYU_MERCHANT_ID') }}~" + referenceCode + "~" + valorRecarga + "~{{ env('PAYU_CURRENCY') }}";
                var signature = md5(payu_md5);

                $("#formBtnPayu").append('<input name="amount" type="hidden" value="' + valorRecarga + '">');
                $("#formBtnPayu").append('<input name="signature" type="hidden" value="' + signature + '">');

                document.getElementById("formBtnPayu").submit();
            }
            catch(err) {
                toastr.info(err.message);
            }
        }
    </script>
@endsection