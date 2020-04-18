/* $('#celular_usuario').mask('(999) 999-9999'); */

function validarEmail(elemento){
     var texto = document.getElementById(elemento.id).value;
     var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
   
     if (!regex.test(texto)) {
         document.getElementById("resultado").innerHTML = "Correo invalido";
     } else {
       document.getElementById("resultado").innerHTML = "";
     }
   
   }
   function validarEmail1(elemento){
     var texto = document.getElementById(elemento.id).value;
     var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
   
     if (!regex.test(texto)) {
         document.getElementById("resultado1").innerHTML = "Correo invalido";
     } else {
       document.getElementById("resultado1").innerHTML = "";
     }
   
   }

/* Opciones busqueda y filtro artistas / Celebridades */

function SendFilterGenero(){
      //   $('#loader_content').removeClass('hidden');
      //   $("#loader_content").css("display", "block");
     var orderByGenero_ = "ASC";
     if($('select[id=order_filter]').val() != "DESC"){
          var orderByGenero_ = "DESC";
     }
     var nameGenero_ = "none";
     if($('select[id=name_genero]').val() != "none"){
          var nameGenero_ = $('select[id=name_genero]').val();
     }
     var nombreArtista = $('input[name="searchArtits"]').val();
     var UrlfilterGen_ = UrlHost_+"/favoritos/filtergeneros";
     $.ajax({
          type:'POST',
          url:UrlfilterGen_,
          data:{nameGenero_:nameGenero_,orderBy_:orderByGenero_,nombreArtista: nombreArtista},
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success:function(data){
               // $('#loader_content').addClass('hidden');
               // $("#loader_content").css("display", "none");
               $("#ContentFilter_").html(data);
          },
          error: function(xhr){
               console.log(xhr);
               swal("Ups!", "Hemos tenido problemas, intenta mas tarde", "warning");
          }
     });
 }

 
/* $('#name_genero').change(function(){ SendFilterGenero(); });
$('#order_filter').change(function(){ SendFilterGenero(); }); */


function isValidDate(day,month,year){
    var dteDate;

    // En javascript, el mes empieza en la posicion 0 y termina en la 11 
    //   siendo 0 el mes de enero
    // Por esta razon, tenemos que restar 1 al mes
    month=month-1;
    // Establecemos un objeto Data con los valore recibidos
    // Los parametros son: año, mes, dia, hora, minuto y segundos
    // getDate(); devuelve el dia como un entero entre 1 y 31
    // getDay(); devuelve un num del 0 al 6 indicando siel dia es lunes,
    //   martes, miercoles ...
    // getHours(); Devuelve la hora
    // getMinutes(); Devuelve los minutos
    // getMonth(); devuelve el mes como un numero de 0 a 11
    // getTime(); Devuelve el tiempo transcurrido en milisegundos desde el 1
    //   de enero de 1970 hasta el momento definido en el objeto date
    // setTime(); Establece una fecha pasandole en milisegundos el valor de esta.
    // getYear(); devuelve el año
    // getFullYear(); devuelve el año
    dteDate=new Date(year,month,day);
    //Devuelva true o false...
    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
}
function validate_fecha(fecha){
    var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");
    if(fecha.search(patron)==0){
        var values=fecha.split("-");
        if(isValidDate(values[2],values[1],values[0])){
          return true;
        }
    }
    return false;
}

 

function calcularEdad(){
    var fecha=document.getElementById("user_date").value;
    if(validate_fecha(fecha)===true){
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes ){
          edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia)){
          edad--;
        }
        if (edad > 1900){
          edad -= 1900;
        }

        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
          meses=ahora_mes-mes;
        if(ahora_mes<mes)
          meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
          meses=11;
        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
          dias=ahora_dia-dia;

        if(ahora_dia<dia){
          ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
          dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        if(edad>=18){
          // document.getElementById("result_edad").innerHTML="";
          document.getElementById("register-users").submit();
        }else{
          document.getElementById("result_edad").innerHTML="Debe ser mayor de edad, para el registro";
          return false;
        }
     }else{
          document.getElementById("result_edad").innerHTML="La fecha "+fecha+" es incorrecta";
          return false;
     }
}