@extends ('templates.default.layouts.default')
@section ('title','Nuestros artistas')

@section('content')
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-6 p-t-30">
             <!-- <h1 class="ArtistasParaTi">@lang('conecte.artists_for_you')</h1>-->
             <div class="titleGeneros pad-btm">Artistas Para ti</div>
          </div>
          <div class="col-lg-8  col-6 pad-all">
              <div class="searchArtists">
              <form action="{{ route('welcome')}}" method="get" class="form-inline1 css-12">
                  <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-addon css-2">
                              <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                          </div>
                          <input type="text" name="query" value="{{$query}}" class="form-control css-2" placeholder="Ej, maluma, etc." style="margin: 10px;">
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="carousel">
            <!--
            @foreach ($artistas as $item)
              <div onclick="location.href = '/artista/{{$item->id}}'">
                  <figure class="figure"  style="cursor:pointer">
                        <?php $profileimage_ = public_path().'/assets/img/artistas/'.$item->foto_perfil; ?>
                        <?php if (@getimagesize($profileimage_)) { ?>
                            <img class="figure-img" src= "{{ asset('assets/img/artistas/'.$item->foto_perfil) }}" alt="{{$item->name}}">
                        <?php }else{ ?>
                            <img class="figure-img" style="background:#1f1f1f; min-height:252px;" src= "{{ asset('assets/img/no-image-profile.png') }}" alt="">
                        <?php } ?>
                        <figcaption class="figure-caption">
                            {{$item->name}}
                        </figcaption>
                  </figure>
              </div>
            @endforeach
            -->

            @if(count($artistas)>=1)
                @foreach($artistas as $Artistas)
                <div class="col-lg-3 col-md-4 col-6 pad-btm text-center">
                    <div class="artits-info">
                        <div class="img-artits">
                            <a href="{{route('artista',$Artistas->nombre_artistico)}}"><img class="bd-placeholder-img zoom " src="{{asset('assets/img/artistas')}}/{{$Artistas->foto_perfil}}" /></a>
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
        @if (count($artistas) == 0)
            <div class="nofilterFound">
                No se encontraron resultados para "{{ $query }}"
            </div>
        @endif
    </div>

    <div class="container-fluid pad-all " style="min-height:400px">
        <div class="titleGeneros pad-btm pad-top ">Generos Disponibles</div>

        <div class="carouselGenero" style=" height:60px;">
            @foreach ($generos as $index => $item)
                <div>
                    @if($index == 0)
                        <h2 class="genero active" onclick="changeGeneros({{$item->ID}})" id="{{ $item->ID}}">{{$item->NOMBRE}}</h2>
                    @else
                        <h2 class="genero" id="{{ $item ->ID}}" onclick="changeGeneros({{$item ->ID}})">{{$item->NOMBRE}}</h2>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="row pad-all text-left">
        @foreach ($generos as $index => $item)
            <div class="tempCarousel carousel-{{ $item->ID }} d-none" id="carousel-{{ $item->ID }}">
                @if(sizeof($item->artistas)>=1)
               
               
                    @foreach ($item->artistas as $artista)          
                            <!--
                            <div onclick="location.href = '/artista/{{$artista->id}}'">
                                <figure class="figure"  style="cursor:pointer">
                                    <?php $profileimage_ = public_path().'/assets/img/artistas/'.$artista->foto_perfil; ?>
                                    <?php if (@getimagesize($profileimage_)) { ?>
                                        <img class="figure-img" src= "{{ asset('assets/img/artistas/'.$artista->foto_perfil) }}" alt="{{$artista->nombre_artistico}}">
                                    <?php }else{ ?>
                                        <img class="figure-img" style="background:#1f1f1f; min-height:252px;" src= "{{ asset('assets/img/no-image-profile.png') }}" alt="">
                                    <?php } ?>                                    
                                    <figcaption class="figure-caption">
                                        {{$artista->nombre_artistico}}
                                    </figcaption>
                                </figure>
                            </div>  
                            -->  
                            <div class="col-lg-3 col-md-4 col-6 pad-btm text-center">
                                <div class="artits-info">
                                    <div class="img-artits">
                                        <a href="{{route('artista',$artista->nombre_artistico)}}"><img class="bd-placeholder-img zoom " src="{{asset('assets/img/artistas')}}/{{$artista->foto_perfil}}" /></a>
                                    </div>
                                    <div class="name">{{$artista->nombre_artistico}}</div>
                                </div>
                            </div>
                           
                    @endforeach
               
               
                @else
                    <br />
                    <div class="nofilterFound">No se encontraron resultados </div>
                @endif
            </div>
        @endforeach
        </div>
    </div>

    
    {{----- celebridades  ----}}

    <div class="container-fluid p-t-30" style="min-height:500px ">
    <div class="titleGeneros pad-btm pad-top ">@lang('conecte.celebrities')</div>
        <div class="carouselGenero" style=" height:60px;">
                @foreach ($generoscelebridades as $index => $itemc)
                    <div>
                        @if($index == 0)
                            <h2 class="celebridades active" onclick="changeCelebridades({{$itemc->ID}})" id="{{ $itemc->ID}}">{{$itemc->NOMBRE}}</h2>
                        @else
                            <h2 class="celebridades" id="{{ $itemc ->ID}}" onclick="changeCelebridades({{$itemc ->ID}})">{{$itemc->NOMBRE}}</h2>
                        @endif
                    </div>
                @endforeach
            </div>

            @foreach ($generoscelebridades as $index => $itemc)
                <div class="tempCarousel carousel-{{ $itemc->ID }} d-none" id="carousel-{{ $itemc->ID }}">
                    @foreach ($itemc->artistas as $artista)          
                        <div>      
                            <div onclick="location.href = '/artista/{{$artista->id}}'">
                                <figure class="figure"  style="cursor:pointer">
                                    <img class="figure-img" src= "{{ asset('/assets/img/artistas/'.$artista->foto_perfil) }}" alt="{{$artista->name}}">
                                    <figcaption class="figure-caption">
                                        {{$artista->nombre_artistico}}
                                    </figcaption>
                                </figure>
                            </div>    
                        </div>        
                    @endforeach
                </div>
            @endforeach

        {{--
        <div class="carousel">
            @foreach ($celebridades as $itemc)
                <div onclick="location.href = '/artista/{{$itemc->id}}'">
                    <figure class="figure">
                        <img class="figure-img" src= "{{ asset('upload/perfil/'.$itemc->foto_perfil) }}" alt="{{$itemc->name}}">
                        <figcaption class="figure-caption">
                            {{$itemc->name}}
                        </figcaption>
                    </figure>
                </div>
            @endforeach
        </div>
        --}}

    </div>

@endsection

@section('js')
    <style>
      .carousel, .tempCarousel{
          width:100%;
          margin:0px auto;
          float: left;
      }
      .slick-slide{
        margin: 0px 8px;
      }
      .slick-slide img{
          width:100%;
          border: 0px solid #fff;
      }
    </style>

    <script>
      $(document).ready(function(){
        var windowWidth = $(window).width();
        var slidesToShow = 7;
        var slidesToShow2 = 4;
        if(windowWidth >= 320 && windowWidth < 600){
            slidesToShow = 2;
            slidesToShow2 = 2;
        }else if(windowWidth >= 600 && windowWidth < 1024){
            slidesToShow = 3;
            slidesToShow2 = 3;
        }else if(windowWidth >= 1024 && windowWidth < 1280){
            slidesToShow = 4;
            slidesToShow2 = 3;
        }else if(windowWidth >= 1280 && windowWidth < 1366){
            slidesToShow = 5;
        }else if(windowWidth >= 1366 && windowWidth < 1440){
            slidesToShow = 6;
        }else{
            slidesToShow = 7;
        }


        $('.carousel').slick({
            slidesToShow: slidesToShow2,
            dots:false,
            slidesToScroll: slidesToShow2,
            speed: 300,
            centerMode: false,
        });

        $('.carousel-{{ $generos->first()->ID }}').slick({
            slidesToShow: slidesToShow2,
            dots:false,
            slidesToScroll: slidesToShow2,
            speed: 300,
            centerMode: false,
        });
        
        $('.carousel-{{ $generoscelebridades->first()->ID }}').slick({
            slidesToShow: slidesToShow2,
            dots:false,
            slidesToScroll: slidesToShow2,
            speed: 300,
            centerMode: false,
        });

        $('.carouselGenero').slick({
            slidesToShow: slidesToShow,
            speed: 300,
            slidesToScroll: slidesToShow,
            dots:false,
            centerMode: false,
        });
      });
    </script>

    <script>
        var ID_1 = {{$generos->first()->ID}};
        var IDC_1 = {{$generoscelebridades->first()->ID}};

        var ID_CAOUSEL_1 = '#carousel-' + {{ $generos->first()->ID }};
        var ID_CAOUSELC_1 = '#carousel-' + {{ $generoscelebridades->first()->ID }};

        $(ID_CAOUSEL_1).removeClass("d-none");
        $(ID_CAOUSELC_1).removeClass("d-none");

        function changeGeneros(ID_2) {
            TEMP_1 = '#' + ID_1;
            $(TEMP_1).removeClass("active");
            TEMP_CAOUSEL_1 = '#carousel-' + ID_1;
            $(TEMP_CAOUSEL_1).addClass("d-none");
            TEMP_2 = '#' + ID_2;
            TEMP_CAOUSEL_2 = '#carousel-' + ID_2;
            $(TEMP_2).addClass("active");
            $(TEMP_CAOUSEL_2).removeClass("d-none");
            ID_1 = ID_2;
        }
        function changeCelebridades(IDC_2) {
            
            TEMP_1 = '#' + IDC_1;
            $(TEMP_1).removeClass("active");
            TEMP_CAOUSEL_1 = '#carousel-' + IDC_1;
            $(TEMP_CAOUSEL_1).addClass("d-none");
            TEMP_2 = '#' + IDC_2;
            TEMP_CAOUSEL_2 = '#carousel-' + IDC_2;
            $(TEMP_2).addClass("active");
            $(TEMP_CAOUSEL_2).removeClass("d-none");
            IDC_1 = IDC_2;
        }
        

    </script>
@endsection