<div class="footer">
<div class="container-fluid">
     <div class="row d-xl-flex justify-content-xl-center align-items-xl-start" style="height: 100%;">
          <div class="col-md-2 pad-all brd_all"><img src="assets/img/logo.png" style="padding-top: 30px;"></div>
          <div class="col-md-2">
          <ul class="list-unstyled d-none">
               <li>Compañía</li>
               <li >Acerca de </li>
               <li >Empleo</li>
               <li >Contratar</li>
          </ul>
          </div>
          <div class="col-md-2">
          <ul class="list-unstyled d-none">
               <li style="color: rgb(255,255,255);opacity: 0.36;padding-bottom: 15px;padding-top: 30px;">Comunidades</li>
               <li style="color: rgb(255,255,255);">Servicios para artistas </li>
               <li style="color: rgb(255,255,255);">Desarrolladores<br></li>
               <li style="color: rgb(255,255,255);">Managers</li>
               <li style="color: rgb(255,255,255);">Inversionistas</li>
               <li style="color: rgb(255,255,255);">Proveedores<br></li>
          </ul>
          </div>
          <div class="col-md-2">
          <ul class="list-unstyled d-none">
               <li style="color: rgb(255,255,255);opacity: 0.36;padding-bottom: 15px;padding-top: 30px;">Enlaces útiles</li>
               <li style="color: rgb(255,255,255);">Ayuda<br></li>
               <li style="color: rgb(255,255,255);">Artistas</li>
               <li style="color: rgb(255,255,255);">Registrarse</li>
               <li style="color: rgb(255,255,255);">Iniciar sesión</li>
          </ul>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-2">
          <ul class="list-inline" style="padding-top: 30px;">
               <li class="list-inline-item" style="color: rgb(255,255,255);" onclick="window.location='{{ $redesSociales[0]->DESCRIPCION }}';">
                    <img src="{{ asset('assets/img/instagram.svg') }}" style="padding: 8px;">
               </li>
               <li class="list-inline-item" style="color: rgb(255,255,255);" onclick="window.location='{{ $redesSociales[1]->DESCRIPCION }}';">
                    <img src="{{ asset('assets/img/twiter.svg') }}" style="padding: 8px;">
               </li>
               <li class="list-inline-item" style="color: rgb(255,255,255);" onclick="window.location='{{ $redesSociales[2]->DESCRIPCION }}';">
                    <img src="{{ asset('assets/img/facebook.svg') }}" style="padding: 8px;">
               </li>
          </ul>
          </div>
     </div>
</div>
</div>