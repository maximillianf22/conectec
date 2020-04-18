<div class="footer pad-all ">
     <div class="pad-all row"><br /></div>
     <div class="container-fluid">
          <div class="row d-xl-flex justify-content-xl-center align-items-xl-start" style="height: 100%;">
               <div class="col-md-3 text-center"><img src="assets/img/LogoConecteWeb.png" ></div>
               <div class="col-md-2 pad-all">
               <div class="title">COMPAÑÍA</div>
               <ul class="list-unstyled ">
                    <li><a href="#">Acerca de </a></li>
                    <li><a href="#">Contratar</a></li>
               </ul>
               </div>
               <div class="col-md-2 pad-all">
               <div class="title">COMUNIDADES</div>
               <ul class="list-unstyled ">
                    <li><a href="#">Servicios para artistas</a></li>
                    <li><a href="http://developapp.co/">Desarrolladores</a></li>
                    <li><a href="#">Proveedores</a></li>
                    <li><a href="https://www.brpabogados.com/" target="_blank">BRP</a></li>
                    <li><a href="http://developapp.co/" target="_blank">develop app</a></li>
               </ul>
               </div>
               <div class="col-md-2 pad-all">
               <div class="title">ENLACES ÚTILES</div>
               <ul class="list-unstyled ">
                    <li><a href="#">Ayuda</a></li>
                    <li><a href="{{route('register.artista')}}">Registro Artista</a></li>
                    <li><a href="{{route('register.usuarios')}}">Registro Usuario</a></li>
                    <li><a href="{{route('loginView')}}">Iniciar sesión</a></li>
               </ul>
               </div>
               <div class="col-md-3 pad-all text-center">
               <ul class="list-inline">
                    <li class="list-inline-item" style="color: rgb(255,255,255);">
                         <a href="{{$redesSociales[0]->DESCRIPCION}}" target="_blank">
                              <img src="{{ asset('assets/img/instagram.svg') }}" style="padding: 8px;">
                         </a>
                    </li>
                    <li class="list-inline-item" style="color: rgb(255,255,255);">
                         <a href="{{$redesSociales[1]->DESCRIPCION}}" target="_blank">
                              <img src="{{ asset('assets/img/twiter.svg') }}" style="padding: 8px;">
                         </a>
                    </li>
                    <li class="list-inline-item" style="color: rgb(255,255,255);">
                         <a href="{{$redesSociales[2]->DESCRIPCION}}" target="_blank">
                              <img src="{{ asset('assets/img/facebook.svg') }}" style="padding: 8px;">
                         </a>
                    </li>
               </ul>
               </div>
          </div>
     </div>

     <div class="pad-all row  ">
          <div class="col-md-1 pad-all">
          </div>
          <div class="col-md-10 pad-all sub-footer">
               <a href="#">Legal</a>&nbsp;  &nbsp;  
               <a href="#">Centro de Privacidad</a>&nbsp;  &nbsp;  
               <a href="#">Política de Privacidad</a>&nbsp;  &nbsp;  
               <a href="#">Cookies</a>&nbsp;  &nbsp;  
               <a href="#">Sobre los anuncios</a>&nbsp;
          </div>
          <div class="col-md-1 pad-all">
          </div>
          
     </div>
</div>