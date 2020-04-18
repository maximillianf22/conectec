@if(sizeof($Slider_)>=1)
<div class="container-fluid">
<div class="row pad-no sliderMusics text-center ">
     <div class="col-lg-12 pad-slider" >
     <div id="myCarousel" class="carousel slide " data-ride="carousel" >
          
          <div class="carousel-inner ">
          @foreach($Slider_ as $item => $Slider)
               <div class="carousel-item <?php echo ($item)==0 ? 'active' : '' ; ?>">
               <a href="{{$Slider->urlLink}}" target="new">
               <img class="bd-placeholder-img brd-radius shadow" src="{{asset('assets/img/Slider')}}/{{$Slider->imgSlider}}" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"  width="100%"  />
               </a>
               <div class="container"></div>
               </div>
          @endforeach
          </div>
          

          <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next </span>
          </a>
     </div>
     
     </div>
     
</div>
</div>
@endif