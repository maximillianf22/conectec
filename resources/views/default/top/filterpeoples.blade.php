<div class=" pad-all filterPeoples text-center ">
     <div class="col-lg-12 pad-top text-center ">
          <div class="title ">Busca a tu <strong>Persona</strong> favorita</div>
     </div>

     <div class="row pad-no text-center ">
         <div class="col-lg-1 pad-all "> </div>
         <div class="col-lg-3  pad-all "><input name="searchArtits" placeholder="Buscar Artista" /> </div>
         <div class="col-lg-1  pad-all ">
         <div class="select" >
               <select class="outlinenone"  id="order_filter" name="order_filter">
                    <option value="DESC" select >A-Z</option> 
                    <option value="ASC" >Z-A</option>
               </select>
          </div>
         </div>
         <div class="col-lg-2  pad-all ">
          <div class="select outlinenone">
               <select class="outlinenone" id="name_genero" name="name_genero">
               <option value="0">Buscar por Genero</option>
               @if(sizeof($listado_genero)>=1)
                    @foreach($listado_genero as $item_genero => $genero)
                         <option value="{{ $genero->idparametro }}">{{ $genero->nombre_genero }}</option>
                    @endforeach
               @endif
               </select>
          </div>
         </div>
         <div class="col-lg-2  pad-all ">
               <div class="btn-musica" onclick="SendFilterGenero()">
                    <a href="javascript:;">
                         <i class="fa fa-filter"></i>
                         Filtrar
                    </a>
               </div>
         </div>
         <div class="col-lg-2  pad-all "><div class="btn-musica "><a href="{{route('home.music')}}">Música</a></div></div>
         <div class="col-lg-1  pad-all "> </div>
     </div>
     <div class=" pad-all"><div class="row">
          <div class="col-lg-1 pad-all "></div>
          <div class="col-lg-10 pad-no ">
               <div id="ContentFilter_">
               <div class="row">
                    @if(sizeof($Artistas)>=1)
                     @foreach($Artistas as $list=> $Artista_)
                         <div class="col-lg-3 col-md-2 col-6 pad-lft pad-rgt " >
                              @if(Auth::user())
                                   <a href="{{route('artista',$Artista_->nombre_artistico)}}">
                              @else
                                   <a href="{{route('home.profile',$Artista_->nombre_artistico)}}">
                              @endif
                              <div class="favorites-peoples">
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
                    @endif
               </div>
               </div>
          </div>
          <div class="col-lg-1  "></div>
     </div>
</div>
</div>