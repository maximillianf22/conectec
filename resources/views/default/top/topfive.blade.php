<div class="container">
     <br />
     <div class="row pad-no " >
          <div class="col-12 pad-top title-top-five ">Mas Solicitados</div>
     </div>
     <div class="row ">
          <div class="col-12 ">
               <div class="row pad-all">

               @if(count($TopFive)>=1)
                    @foreach($TopFive as $TopFive)
                         <div class="col-lg-2 col-md-4 col-6  text-center">
                              <div class="topfive-image">
                                   @if(Auth::user())
                                        <a href="{{route('artista',$TopFive->nombre_artistico)}}"><img class="bd-placeholder-img" src="{{asset('assets/img/artistas')}}/{{$TopFive->foto_perfil}}" /></a>
                                   @else
                                        <a href="{{route('home.profile',$TopFive->id)}}"><img class="bd-placeholder-img" src="{{asset('assets/img/artistas')}}/{{$TopFive->foto_perfil}}" /></a>
                                   @endif
                                   
                                   <div class="name-artits">{{$TopFive->nombre_artistico}}</div>
                              </div>
                         </div>
                    @endforeach
               @endif
                        
               </div>
          </div>
     </div>
     <br />
</div>