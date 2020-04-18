<div class=" pad-all eventExplorer text-center ">
@if(sizeof($eventos)>=1)
     <?php 
          $TotEventos_ = count($eventos);
          $ItemBase_ = 4 ;
     ?>
     <div class="col-lg-12 pad-btm text-center ">
          <div class="title ">Eventos de mes</div>
     </div>

     <div class="events-galery">

          <div id="myCarousel" class="carousel slide " data-ride="carousel" >  
               <div class="carousel-inner ">
               <div class="row">
                    <div class="col-lg-1  "></div>
                    <div class="col-lg-10  ">
                         <?php $ItemsSlider_ = 1; $active=0 ?>
                         @foreach($eventos as $key => $itemevents_)
                              
                              @if($ItemsSlider_==1)
                                   <div class="carousel-item <?php echo $active == 0 ?  "active" :"" ; ?> text-center events-months ">
                                   <div class="row pad-all text-center ">
                                   <?php $active=1; ?>
                              @endif
                               <div class="col-lg-3 col-md-2 col-6 text-center  " >
                                 <img class="bd-placeholder-img" src="{{asset('assets/img/explorar')}}/{{$itemevents_->imgEvento}}" />
                    
                               </div>
                              
                              @if($ItemsSlider_==$ItemBase_ || $TotEventos_ == $key+1)
                                   </div>
                                   </div>
                                   <?php $ItemsSlider_=0; ?>
                              @endif
                              <?php $ItemsSlider_++; ?>
                         @endforeach
                      
                         
                    </div>               
                    <div class="col-lg-1 "></div>
               </div>
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
@else
@endif
</div>