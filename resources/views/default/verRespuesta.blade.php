@extends ('templates.default.layouts.default')

@section ('title','Respuesta')

@section('head')
    <style>
        .content-wrapper{
            background-color: #1f1f1f;
            background-image: inherit;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row pad-all">
            <div class="col-sm-5 text-center pad-all" style="text-align: -webkit-center;">
                <video class="embed-responsive-item" style="width: 100%" src="{{$dedicatoria->URL_DE_RESPUESTA}}" controls>
                </video>
            </div>
            <div class="col-sm-7 text-center" style="text-align: -webkit-center;">
                <p style="font-size:36px; color:white; font-weight: bold;padding-top: 30px;">Compartir a través de </p>
                <ul class="list-inline" style="padding-top: 30px;">
                    <li class="list-inline-item link-actions" onclick="share()" style="color: rgb(255,255,255); cursor: pointer">
                        <img src="{{ asset('assets/img/instagram.svg') }}" style="padding: 8px;">
                    </li>
                    <li class="list-inline-item" onclick="share()" style="color: rgb(255,255,255); cursor: pointer">
                        <img src="{{ asset('assets/img/twiter.svg') }}" style="padding: 8px;">
                    </li>
                    <li class="list-inline-item" onclick="share()" style="color: rgb(255,255,255); cursor: pointer">
                        <img src="{{ asset('assets/img/facebook.svg') }}" style="padding: 8px;">
                    </li>
                    <li class="list-inline-item" style="color: rgb(255,255,255); cursor: pointer">
                        <a href="{{$dedicatoria->URL_DE_RESPUESTA}}" download="dedicatoria.mp4"> 
                            <img src="{{ asset('assets/img/descargar.svg') }}" style="padding: 8px;" height="45px"> 
                        </a>
                    </li>
                </ul>
                <p style="font-size:14px; color:white; font-weight: 400; padding-top: 30px;">también puedes compartir el link</p>
                <p style="border:1px solid #FF578A;color:#FF578A; width: fit-content;padding:5px 60px;border-radius:30px;">{{$dedicatoria->URL_DE_RESPUESTA}}</p>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>      
        function share(){
            if(navigator.share) {
                e.preventDefault();
                const URL = this.href;

                navigator.share({
                    title: "Title",
                    text: "Msj",
                    url: URL
                })
                .then(() => console.log("Se compartio con éxito"))
                .catch((err) => console.log(`Hubo un error: ${err}`));

                return false;
            }else {
                alert("Tu navegador no es compatible");
            }
        } 
    </script>
@endsection