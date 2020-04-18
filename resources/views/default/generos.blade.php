<div class="container">
     <div class="row ">
          <div class="col-12 pad-all title-section ">Géneros</div>
     </div>
     @if(count($Generos_)>=1)
          <div class="row ">
               <div class="col-12 ">
               <div class="row pad-all">
                    @foreach($Generos_ as $Generos)
                    <div class="col-lg-2 col-md-3 col-6  text-center">
                         <div class="genero-image-profile ">
                         <a href="#">
                         <img id="genero-{{$Generos->idparametro}}" class="bd-placeholder-img" src="{{asset('assets/img/generos')}}/{{$Generos->imagenDefault}}" />
                         </a>
                         <div class="name-genero">{{$Generos->nombreGenero}}</div>
                         </div>
                    </div>
                    @endforeach
               </div>
               </div>
          </div>
     @else
     @endif
</div>