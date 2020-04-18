<div class="container">
     <div class="row pad-no">
          <div class="col-12 pad-lft title-section ">Artistas</div>
     </div>

     <div class="row pad-no">
          <div class="col-12  ">
          <div class="row pad-all">
               @if(count($Artistas)>=1)
                    @foreach($Artistas as $Artistas)
                    <div class="col-lg-3 col-md-4 col-6 pad-btm text-center">
                         <div class="artits-info">
                              <div class="img-artits">
                                   @if(Auth::user())
                                        <a href="{{route('artista',$Artistas->nombre_artistico)}}">
                                             <img class="bd-placeholder-img zoom " src="{{asset('assets/img/artistas')}}/{{$Artistas->foto_perfil}}" />
                                        </a>
                                   @else
                                        <a href="{{route('home.profile',$Artistas->nombre_artistico)}}">
                                             <img class="bd-placeholder-img zoom " src="{{asset('assets/img/artistas')}}/{{$Artistas->foto_perfil}}" />
                                        </a>
                                   @endif
                              </div>
                              <div class="name">
                                   @if(empty($Artistas->nombre_artistico))
                                        {{$Artistas->name}}
                                   @else
                                        {{$Artistas->nombre_artistico}}
                                   @endif
                              </div>
                         </div>
                    </div>
                    @endforeach
               @endif
          </div>
          </div>    
     </div>
     <br />

</div>
