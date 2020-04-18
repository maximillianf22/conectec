<div class="container">

     <div class="row pad-no"><div class="col-12 pad-lft title-section-generos ">Artistas Género {{$NameGenero_->nombreGenero}}</div></div>

     <div class="row pad-no">
          <div class="col-12  ">
          <div class="row pad-all">
               @if(count($Artistasfilter)>=1)
                    @foreach($Artistasfilter as $Artistas)
                    <div class="col-lg-3 col-md-4 col-6 pad-btm text-center">
                         <div class="artits-info">
                              <div class="img-artits">
                                   @if(Auth::user())
                                        <a href="{{route('artista',$Artistas->nombre_artistico)}}">
                                             <img class="bd-placeholder-img zoom " src="{{asset('assets/img/artistas')}}/{{$Artistas->foto_perfil}}" />
                                        </a>
                                   @else
                                        <a href="{{route('home.profile',$Artistas->id)}}"><img class="bd-placeholder-img zoom " src="{{asset('assets/img/artistas')}}/{{$Artistas->foto_perfil}}" /></a>
                                   @endif
                                   
                              </div>
                              <div class="name">{{$Artistas->nombre_artistico}}</div>
                         </div>
                    </div>
                    @endforeach
               @else
               <div class="nofilterFound">En el momento no tenemos artistas disponibles para este Género</div>
               @endif
          </div>
          </div>    
     </div>
     <br />

</div>
