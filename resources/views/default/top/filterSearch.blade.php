<div class="row">
     @if(sizeof($Artistas)>=1)
          @foreach($Artistas as $list=> $Artista_)
          <div class="col-lg-3 col-md-2 col-6 pad-lft pad-rgt " >
               @if(Auth::user())
                    <a href="{{route('artista',$Artista_->nombre_artistico)}}">
               @else
                    <a href="{{route('home.profile',$Artista_->nombre_artistico)}}">
               @endif
               <div class="favorites-peoples ">
                    <div class="photo">
                         <img class="bd-placeholder-img " src="{{asset('assets/img/artistas')}}/{{$Artista_->foto_perfil}}" />
                    </div>
                    <div class="detail-artist">
                         <div class="name">{{ $Artista_->nombre_artistico }}</div>
                         <div class="category">{{ $Artista_->nombre_genero }}</div>
                    </div>
               </div>
               </a>
          </div>
          @endforeach

     @else
     <div class="nofiltersFound">En el momento no tenemos artistas disponibles para este filtro de búsqueda</div>
     @endif
</div>