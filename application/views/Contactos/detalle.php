<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body id="body_grill" onload="showArea()">
<script>
// AJAX call for autocomplete 
$(document).ready(function(){
  $("#search-box").keyup(function(){
    $.ajax({
    type: "POST",
    url: "<?php echo base_url() ?>trae-comunas",
    data:'keyword='+$(this).val(),
    beforeSend: function(){
      $("#search-box").css("background","#FFF url(<?php echo base_url()?>public/img/LoaderIcon.gif) no-repeat 165px");
    },
    success: function(data){
      $("#suggesstion-box").show();
      $("#suggesstion-box").html(data);
      $("#search-box").css("background","#FFF");
    }
    });
  });
});
//To select country name
function selectCiudad(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
<div class="grilla">
<h2>Detalle Contacto</h2>
    <div class=" black">
    <?php if($this->session->flashdata('ErrorMessage')!='') { ?>
                <div><?php echo $this->session->flashdata('ErrorMessage'); ?></div>
    <?php } ?>
    <?php if($contacto->estado == "Agenda" || $contacto->estado == "No llamar más") { ?>
    
    <?php } else {?>
          <div id="timer">
            <div class="container">
                <div>Tiempo de la llamada: </div>
                <div id="hour">00</div>
                <div class="divider">:</div>
                <div id="minute">00</div>
                <div class="divider">:</div>
                <div id="second">00</div>                
            </div>
             <?php if($contacto->estado == "Agenda" || $contacto->estado == "No llamar más") { ?>
    
            <?php } else {?>
            <select id="detener" name="detener">
               <option value="0">Opciones de bloqueo</option>
               <option value="Llamada Entrante">Llamada entrante</option>
               <option value="Respondiendo Whatsapp">Llamada Whatsapp</option>
               <option value="Respondiendo Correo">Respondiendo Correo</option>
               <option value="Descanso">Descanso</option>
               <option value="Colación">Colación</option>
               <option value="Requerimiento administrativo">Requerimiento administrativo</option>
          </select>
          <?php } ?>
          </div>
    <?php } ?>
   
  
    <br>
    <table class="table">
   	  <tr>
         <td><i>Fecha Ingreso:</i></td>
   	     <td><?php echo $contacto->fechaIngreso ?><input type="text" id="cid" name="id" value="<?php echo $contacto->idcontacto ?>" hidden></td>
          <td><i>Origen:</i></td>
   	     <td><?php echo $contacto->origen ?></td>
   	  </tr>
   	  <tr>
         <td><i>Nombre:</i></td>
   	     <td><input type="text" id="cnombre" name="nombre"  maxlength="100" value="<?php echo $contacto->nombre ?>" placeholder="Nombres Completo:" readonly></td>
          <td><i>Fono:</i></td>
          <td><input type="text" id="cnumero" name="numero" maxlength="12" placeholder="Teléfono:" value="<?php echo $contacto->telefono ?>" readonly></td>
   	  </tr>
   	  <tr>
   	     <td><i>E-Mail:</i></td>
   	     <td><input type="text" id="cemail" name="email" maxlength="42" value="<?php echo $contacto->email ?>" readonly></td>
          <td><i>Tratamiento:</i></td>
   	     <td><input type="text" value="<?php echo $contacto->descripcion ?>" readonly></td>
   	  </tr>
   	  <tr>
   	     <td><i>Descuento:</i></td>
         <td><input type="text" id="cdescuento" name="descuento" value="<?php echo $contacto->descuento ?>" readonly></td>
         <td><i>Campaña:</i></td>
         <td><input type="text" id="ccampa" name="campana" value="<?php echo $contacto->campana ?>" readonly></td>
      </tr>
      <tr class="area"><td>Ultima Acción</td></tr>
      <tr class="area"> 
        <td><i>Fecha:</i></td>
        <td id="fcall"><?php echo $contacto->fechaLlamada ?></td>
        <td><i>Estado:</i></td>
        <td id="ecall"><?php echo $contacto->estado ?></td>
      </tr>
        <tr id="trObs">
          <td><i>Observaciones:</i></td>
          <td id="ocont"><?php echo $contacto->obs ?></td>
        </tr>
   	  <span class="buttons">
        <?php if($llamadas == "0"){ ?>
          <span class="ingr" onclick="modifying()">Modificar</span>
          <span class="ingr" onclick="deleteCont()">Eliminar</span>
        <?php } ?>
          <a class="ingr" href="<?php echo base_url()?>menu-contactos">Volver</a>
          </span>
<input type="hidden" id="callValue" value="<?php echo $llamadas ?>">
<input type="hidden" id="obsValue" value="<?php echo $contacto->obs ?>">
   </table>

   <br>
 <h3 class="area">Listado de llamadas</h3>
  <div id="grid2" style="width: 100%; height: 300px" class="area"></div>

  <script type="text/javascript">
  $(function () {
     $('#grid2').w2grid({ 
        name: 'grid2', 
        url: '<?php echo base_url() ?>trae-llamadas/<?php echo $contacto->idcontacto ?>',
        method: 'GET',
        show: { 
            toolbar: true
        },
        multiSearch: false,
        searches: [
            { field: 'recid', caption: 'ID ', type: 'int' },
            { field: 'usuario', caption: 'CAPE', type: 'text' },
            { field: 'fecha', caption: 'Fecha', type: 'text' },
            { field: 'tiempollamada', caption: 'Tiempo llamada', type: 'text' },
            { field: 'estado', caption: 'Estado', type: 'text' }
        ],
        columns: [                
            { field: 'recid', caption: 'ID', size: '4%', sortable: true},
            { field: 'usuario', caption: 'CAPE', size: '20%', sortable: true },
            { field: 'fecha', caption: 'Fecha', size: '18%', sortable: true },
            { field: 'tiempollamada', caption: 'Tiempo llamada', size: '10%' },
            { field: 'estado', caption: 'Estado', size: '15%' }
        ]
    });

  });
 
</script>
   <div class="modalback" id="eliminarCont">
            <div class="box">
                <p>Seguro quieres eliminar este contacto?</p>
                <a class="ingr" href="<?php echo base_url() ?>eliminar-contacto/<?php echo $contacto->idcontacto ?>">Sí</a>
                <span class="ingr" onclick="cerrarCont()">No</span>
           </div>
    </div>
        <br>
     <?php if($contacto->estado == "Agenda" || $contacto->estado == "No llamar más") { ?>
    
     <?php } else {?>
     <a class="travieso" onclick="abre()" id="btn-comenzar">Terminar Llamada</a>
     <?php } ?>
     <a class="travieso" href="<?php echo base_url()?>reporte-contacto/<?php echo $contacto->idcontacto ?>">Reporte</a>
     <a class="travieso" id="sigcon" href="<?php echo base_url()?>siguiente-contacto" style="opacity: 0; poiter-events: none">Siguente Contacto</a>

     <div id="newllamada" class="modalback">
     <div class="box">
       <h3>Terminar Llamada</h3>
        <select id="opciones" name="opciones" onchange="opcionLlamada()">
            <option value="0">Seleccione una opción</option>
            <option value="1">Llamar de nuevo</option>
            <option value="2">Agenda</option>
            <option value="3">No llamar Más</option>
        </select>

        <select id="status1" name="status" style="display:none" onchange="status1()">
            <option value="">Seleccione una Opción</option>
            <option value="No contesta">No Contesta</option>
            <option value="Contesta, pero llama después">Contesta, pero llama después</option>
            <option value="Buzón de voz">Buzón de voz</option>
            <option value="Llamará">Llamará</option>
            <option value="Embarazada">Embarazada</option>
        </select>
        <div id="status2" style="display:none">
           <input type="text" id="idmedilink" placeholder="Número de cita" maxlength="7" onchange="actButtonCerrarAgenda()">
        </div>
        <select id="status3" name="status" style="display:none" onchange="status3()">
           <option value="">Seleccione una Opción</option>
           <option value="Solicita no llamar de nuevo">Solicita no llamar de nuevo</option>
           <option value="Solo cotizando">Sólo cotizando</option>
           <option value="De otra ciudad">De otra ciudad</option>
           <option value="Enfermedad autoinmune">Enfermedad autoinmune</option>
           <option value="Solo curiosidad">Sólo curiosidad</option>
           <option value="Fuera de presupuesto">Fuera de presupuesto</option>
           <option value="No tengo dinero">No tengo dinero</option>
           <option value="Ya se lo hizo">Ya se lo hizo</option>
           <option value="Ya lo llamaron">Ya lo llamaron</option>
           <option value="Número no corresponde">Número no corresponde</option>
           <option value="Prestación no existe">Prestación no existe</option>
           <option value="Pensó que la evaluación era gratis">Pensó que la evaluación era gratis</option>
        </select>
         <div id="fechanueva" style="display: none">
            <p>Nueva fecha</p>
             <input type="date" id="newDate" onchange="actButtonTime()">
             <input type="time" id="newTime" style="display:none" onchange="actButtonCerrarNewDate()">
         </div>
         <div id="otraCiudad" style="display: none">
            <input type="text" id="search-box" placeholder="Comuna" onchange="actButtonCerrarOtraCiudad()" />
            <div id="suggesstion-box"></div>
         </div>
         <div id="fueraPresupuesto" style="display: none">
            <input type="text" id="presupuesto" onkeyup="format(this)" placeholder="Presupuesto" maxlength="9" onchange="actButtonCerrarPresupuesto()">
         </div>
         <div id="prestacionNo" style="display: none">
            <input type="text" id="prestacion" placeholder="Prestación" maxlength="100" onchange="actButtonCerrarNP()">
         </div>
         <!------CIERRAMODAL y PARA CONTADOR (PREELIMINAR)------>
         <div class="travieso" id="closecount" onclick="" style="display: none">Terminar</div>
     </div>
     </div>
</div>
    <!------------MODAL MODIFICAR-------------->
<div id="modifyCont" class="modalback">
    <div class="box">
        <div id="formuR">
        <h2>Modificar Contacto</h2>
        <input id="mname" name="nombre" maxlength="100" value="<?php echo $contacto->nombre ?>">
	   <input id="mmail" name="email" maxlength="42" value="<?php echo $contacto->email ?>">
	   <input id="mnumero" name="numero" maxlength="12" value="<?php echo $contacto->telefono ?>">
        <span class="boot">
          <input id="ingr" class="ingr" type="button" value="Modificar" onclick="yesornot()"></span>
        </div>
          <div class="oculto" id="adviserModify">
            <h2 id="h2ad"></h2>
              <input id="siono" class="bouts" type="button" value="Ok" onclick="">
              <input id="nones" class="bouts" type="hidden" value="No" onclick="regresaR()">
            </div> 
            <span class="cierra" onclick="closemodifying()">x</span>
    </div>
</div>
<div id="bloqueo" class="modalback">
        <div class="box">
            <h1>Tu estado actual es <span id="estate"></span></h1>
            <div id="timer">
            <div class="container">
                <div>Tiempo inactivo: </div>
                <div id="hour1">00</div>
                <div class="divider">:</div>
                <div id="minute1">00</div>
                <div class="divider">:</div>
                <div id="second1">00</div>                
            </div>
          </div>
            <input id="reanudar" class="bouts" value="Re Ingresar" onclick="takeTime()">
        </div>
    </div>
 <!------------MODAL HISTORIAL
 <div id="historial" class="modalback">
  <div class="box">
    <table>
       <tr>
         <th>Usuario</th>
         <th>Acción</th>
         <th>Fecha</th>
       </tr>
       <?php foreach ($historials as $historial) { ?>
       <tr>
         <td><?php echo $historial->usuario ;?></td>
         <td><?php echo $historial->accion ;?></td>
         <td><?php echo $historial->fecha ;?></td>
       </tr>
       <?php } ?>
    </table>
    <span class="cierra" onclick="cierraStory()">x</span>
  </div>
 </div>
 -------------->
</div>
<script type="text/javascript">
  $(document).ready(function(){

    var tiempo = {
        hora: 0,
        minuto: 0,
        segundo: 0
    };

     var tiempo1 = {
        hora1: 0,
        minuto1: 0,
        segundo1: 0
    };

    var tiempo_corriendo = null;
    var tiempo_corriendo1 = null;

    

    $("#body_grill").ready(function(){
        if ( $(this).text() !== 'Nueva Llamada' )
        {
            tiempo_corriendo = setInterval(function(){
                // Segundos
                tiempo.segundo++;
                if(tiempo.segundo >= 60)
                {
                    tiempo.segundo = 0;
                    tiempo.minuto++;
                }      

                // Minutos
                if(tiempo.minuto >= 60)
                {
                    tiempo.minuto = 0;
                    tiempo.hora++;
                }

                $("#hour").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
                $("#minute").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
                $("#second").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
            }, 1000);
        }
        else
        {
            $(this).text('Comenzar');
            clearInterval(tiempo_corriendo);
        }
    })
    
   $("#closecount").click(function(){
        if ( $(this).text() == 'Nueva Llamada' )
        {
                                    
            tiempo_corriendo = setInterval(function(){
                // Segundos
                tiempo.segundo++;
                if(tiempo.segundo >= 60)
                {
                    tiempo.segundo = 0;
                    tiempo.minuto++;
                }      

                // Minutos
                if(tiempo.minuto >= 60)
                {
                    tiempo.minuto = 0;
                    tiempo.hora++;
                }

                $("#hour").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
                $("#minute").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
                $("#second").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
            }, 1000);
        }
        else 
        {
            $(this).text('Comenzar');
            clearInterval(tiempo_corriendo);
        }
    })

   $("#detener").change(function(){

     clearInterval(tiempo_corriendo);
      opt = document.getElementById("detener").value;
        if(opt != 0){
            document.getElementById("bloqueo").classList.add("abremodal");
            clearInterval(tiempo_corriendo);
              tiempo_corriendo1 = setInterval(function(){
                // Segundos
                tiempo1.segundo1++;
                if(tiempo1.segundo1 >= 60)
                {
                    tiempo1.segundo1 = 0;
                    tiempo1.minuto1++;
                }      

                // Minutos
                if(tiempo1.minuto1 >= 60)
                {
                    tiempo1.minuto1 = 0;
                    tiempo1.hora1++;
                }

                $("#hour1").text(tiempo1.hora1 < 10 ? '0' + tiempo1.hora1 : tiempo1.hora1);
                $("#minute1").text(tiempo1.minuto1 < 10 ? '0' + tiempo1.minuto1 : tiempo1.minuto1);
                $("#second1").text(tiempo1.segundo1 < 10 ? '0' + tiempo1.segundo1 : tiempo1.segundo1);
            }, 1000);
            $("#estate").html(opt);
            document.onkeydown = function (e) {
            return (e.which || e.keyCode) != 116;
            clearInterval(tiempo_corriendo);
        };
        }
   })
   $("#reanudar").click(function(){
     document.getElementById("bloqueo").classList.remove("abremodal");
     $("#detener").val('0');
      clearInterval(tiempo_corriendo1);
              tiempo1.hora1 =0;
              tiempo1.minuto1=0;
              tiempo1.segundo1=0;
              second1.innerHTML="00";
              minute1.innerHTML="00";
              hour1.innerHTML="00";

     tiempo_corriendo = setInterval(function(){
      // Segundos
      tiempo.segundo++;
      if(tiempo.segundo >= 60)
      {
        tiempo.segundo = 0;
        tiempo.minuto++;
      }      
      // Minutos
      if(tiempo.minuto >= 60)
      {
        tiempo.minuto = 0;
        tiempo.hora++;
      }
      $("#hour").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
      $("#minute").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
      $("#second").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
      }, 1000); 
   })

})
  function modifying(){
        document.getElementById("modifyCont").classList.add("abremodal");
    }
function closemodifying(){
    document.getElementById("modifyCont").classList.remove("abremodal");
}
    function yesornot(){
        $("#formuR").addClass("oculto");
        $("#adviserModify").addClass("libre");
        document.getElementById("h2ad").innerHTML = "¿Seguro deseas modificar este contacto?";
        document.getElementById("siono").setAttribute("onclick","modifyContact()");
        document.getElementById("nones").setAttribute("type","button");
    }
 
    //MODIFICA USUARIO 
    function modifyContact(){
        nombre = document.getElementById("mname").value;
        email = document.getElementById("mmail").value;
        numero = document.getElementById("mnumero").value;
        expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (nombre.length == 0 || /^\s+$/.test(nombre)) {
            document.getElementById("mname").className = "fail";
            document.getElementById("mname").placeholder = "El nombre es Necesario";
        }
        if (email.length == 0 || /^\s+$/.test(email)) {
            document.getElementById("mmail").className = "fail";
            document.getElementById("mmail").placeholder = "El email es Necesario";
        }
        if (email.length > 0 && !expr.test(email)){
            document.getElementById("mmail").value="";
            document.getElementById("mmail").className = "fail";
            document.getElementById("mmail").placeholder = "Email no válido";
        }
        if (numero.length == 0 || /^\s+$/.test(numero)) {
            document.getElementById("mnumero").className = "fail";
            document.getElementById("mnumero").placeholder = "El número es Necesario";
        }
        else{
            $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo base_url() ?>modifica-contacto",
            data:  
                {
                    idcontacto: $("#cid").val(),
                    nombre: $("#mname").val(),
                    email: $("#mmail").val(),
                    numero: $("#mnumero").val(),
                },
                 success:  function (a) {
                    console.log(a);
                    $("#formuR").addClass("oculto");
                    $("#adviserModify").addClass("libre");
                    document.getElementById("h2ad").innerHTML = "Contacto modificado Correctamente";
                     document.getElementById("siono").setAttribute("onclick","regresaR()");
                    document.getElementById("nones").setAttribute("type","hidden");
                },
                error: function(){
                    console.log();
                }

            });
        }
    }
        function regresaR(){
            $("#modifyCont").removeClass("abremodal");
            $("#formuR").removeClass("oculto");
            $("#adviserModify").removeClass("libre");
            w2ui["grid2"].reload();
        }
    
    //Llamar denuevo. Si contesta pero pide llamar despúes o está embarazada
    function callDespues1(){
        hora = document.getElementById("hour").textContent;
        minu = document.getElementById("minute").textContent;
        segu = document.getElementById("second").textContent;
        tiempo = hora+":"+minu+":"+segu;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>nueva-llamada",
            data:  
                {
                    idcontacto: $("#cid").val(),
                    tiempo: tiempo,
                    option: $("#opciones").val(),
                    stat: $("#status1").val(),
                    newDate: $("#newDate").val(),
                    newTime: $("#newTime").val(),
                },
                 success:  function (a) {
                    document.getElementById("newllamada").classList.remove("abremodal");
                     $("#fcall").html(a["fechaLlamada"]);
                     $("#ecall").html(a["estado"]);
                     $("#ocont").html(a["obs"]);
                    document.getElementById("btn-comenzar").style.display="none";
                    obs = document.getElementById("obsValue").value;
                    $(".area").css("display","");
                      if(obs == 0){
                        $("#trObs").css("display","");
                      }
                    w2ui["grid2"].reload();
                     document.getElementById("timer").style.display="none";
                     document.getElementById("sigcon").style.opacity="1";
                     document.getElementById("sigcon").style.pointerEvents="All";
                },
                error: function(){
                    console.log();
                }

            });
    }
    //Llamar denuevo. Las otras opciones
    function callDespues2(){
        hora = document.getElementById("hour").textContent;
        minu = document.getElementById("minute").textContent;
        segu = document.getElementById("second").textContent;
        tiempo = hora+":"+minu+":"+segu;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>nueva-llamada",
            data:  
                {
                    idcontacto: $("#cid").val(),
                    tiempo: tiempo,
                    option: $("#opciones").val(),
                    stat: $("#status1").val(),
                },
                 success:  function (a) {
                    document.getElementById("newllamada").classList.remove("abremodal");
                     $("#fcall").html(a["fechaLlamada"]);
                     $("#ecall").html(a["estado"]);
                     $("#ocont").html(a["obs"]);
                    document.getElementById("btn-comenzar").style.display="none";
                    obs = document.getElementById("obsValue").value;
                    $(".area").css("display","");
                      if(obs == 0){
                        $("#trObs").css("display","");
                      }
                    w2ui["grid2"].reload();
                     document.getElementById("timer").style.display="none";
                     document.getElementById("sigcon").style.opacity="1";
                     document.getElementById("sigcon").style.pointerEvents="All";
                },
                error: function(){
                    console.log(a);
                }

            });
    }
    //Agenda
    function agenda(){
        hora = document.getElementById("hour").textContent;
        minu = document.getElementById("minute").textContent;
        segu = document.getElementById("second").textContent;
        tiempo = hora+":"+minu+":"+segu;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>nueva-llamada",
            data:  
                {
                    idcontacto: $("#cid").val(),
                    tiempo: tiempo,
                    option: $("#opciones").val(),
                    stat: "Agenda",
                    age: $("#idmedilink").val(),
                },
                 success:  function (a) {
                    document.getElementById("newllamada").classList.remove("abremodal");
                    document.getElementById("btn-comenzar").style.display="none";
                     obs = document.getElementById("obsValue").value;
                    $(".area").css("display","");
                      if(obs == 0){
                        $("#trObs").css("display","");
                      }
                     $("#fcall").html(a["fechaLlamada"]);
                     $("#ecall").html(a["estado"]);
                     $("#ocont").html(a["obs"]);
                    w2ui["grid2"].reload();
                     document.getElementById("timer").style.display="none";
                     document.getElementById("sigcon").style.opacity="1";
                     document.getElementById("sigcon").style.pointerEvents="All";
                },
                error: function(){
                    console.log();
                }

            });
    }
    //No llamar más
    function noLlamarMas(){
        hora = document.getElementById("hour").textContent;
        minu = document.getElementById("minute").textContent;
        segu = document.getElementById("second").textContent;
        tiempo = hora+":"+minu+":"+segu;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>nueva-llamada",
            data:  
                {
                    idcontacto: $("#cid").val(),
                    tiempo: tiempo,
                    option: $("#opciones").val(),
                    stat: $("#status3").val(),
                },
                 success:  function (a) {
                    document.getElementById("newllamada").classList.remove("abremodal");
                    document.getElementById("btn-comenzar").style.display="none";
                    obs = document.getElementById("obsValue").value;
                    $(".area").css("display","");
                      if(obs == 0){
                        $("#trObs").css("display","");
                      }
                     $("#fcall").html(a["fechaLlamada"]);
                     $("#ecall").html(a["estado"]);
                     $("#ocont").html(a["obs"]);
                    w2ui["grid2"].reload();
                     document.getElementById("timer").style.display="none";
                     document.getElementById("sigcon").style.opacity="1";
                     document.getElementById("sigcon").style.pointerEvents="All";
                },
                error: function(){
                    alert("Error qliao error.");
                    console.log();
                }

            });
    }
    //otra Ciudad
    function otraCiudadFun(){
        hora = document.getElementById("hour").textContent;
        minu = document.getElementById("minute").textContent;
        segu = document.getElementById("second").textContent;
        tiempo = hora+":"+minu+":"+segu;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>nueva-llamada",
            data:  
                {
                    idcontacto: $("#cid").val(),
                    tiempo: tiempo,
                    option: $("#opciones").val(),
                    stat: $("#status3").val(),
                    comuna: $("#search-box").val(),
                },
                 success:  function (a) {
                  console.log(a);
                    document.getElementById("newllamada").classList.remove("abremodal");
                    document.getElementById("btn-comenzar").style.display="none";
                    obs = document.getElementById("obsValue").value;
                    $(".area").css("display","");
                      if(obs == 0){
                        $("#trObs").css("display","");
                      }
                     $("#fcall").html(a["fechaLlamada"]);
                     $("#ecall").html(a["estado"]);
                     $("#ocont").html(a["obs"]);
                      w2ui["grid2"].reload();
                     document.getElementById("timer").style.display="none";
                     document.getElementById("sigcon").style.opacity="1";
                     document.getElementById("sigcon").style.pointerEvents="All";
                },
                error: function(){
                    console.log("Error");
                }

            });
    }
    //fuera de presupuesto
    function budget(){
        hora = document.getElementById("hour").textContent;
        minu = document.getElementById("minute").textContent;
        segu = document.getElementById("second").textContent;
        tiempo = hora+":"+minu+":"+segu;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>nueva-llamada",
            data:  
                {
                    idcontacto: $("#cid").val(),
                    tiempo: tiempo,
                    option: $("#opciones").val(),
                    stat: $("#status3").val(),
                    prest: $("#presupuesto").val(),
                },
                 success:  function (a) {
                    document.getElementById("newllamada").classList.remove("abremodal");
                    document.getElementById("btn-comenzar").style.display="none";
                    obs = document.getElementById("obsValue").value;
                    $(".area").css("display","");
                      if(obs == 0){
                        $("#trObs").css("display","");
                      }
                     $("#fcall").html(a["fechaLlamada"]);
                     $("#ecall").html(a["estado"]);
                     $("#ocont").html(a["obs"]);
                    w2ui["grid2"].reload();
                     document.getElementById("timer").style.display="none";
                     document.getElementById("sigcon").style.opacity="1";
                     document.getElementById("sigcon").style.pointerEvents="All";
                },
                error: function(){
                    console.log();
                }

            });
    }
    //prestación
    function nopres(){
        hora = document.getElementById("hour").textContent;
        minu = document.getElementById("minute").textContent;
        segu = document.getElementById("second").textContent;
        tiempo = hora+":"+minu+":"+segu;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>nueva-llamada",
            data:  
                {
                    idcontacto: $("#cid").val(),
                    tiempo: tiempo,
                    option: $("#opciones").val(),
                    stat: $("#status3").val(),
                    prest: $("#prestacion").val(),
                },
                 success:  function (a) {
                    document.getElementById("newllamada").classList.remove("abremodal");
                    document.getElementById("btn-comenzar").style.display="none";
                    obs = document.getElementById("obsValue").value;
                    $(".area").css("display","");
                      if(obs == 0){
                        $("#trObs").css("display","");
                      }
                     $("#fcall").html(a["fechaLlamada"]);
                     $("#ecall").html(a["estado"]);
                     $("#ocont").html(a["obs"]);
                    w2ui["grid2"].reload();
                     document.getElementById("timer").style.display="none";
                     document.getElementById("sigcon").style.opacity="1";
                     document.getElementById("sigcon").style.pointerEvents="All";
                },
                error: function(){
                    console.log();
                }

            });
    }

      function showArea(){
          obs = document.getElementById("obsValue").value;
          llamadas = document.getElementById("callValue").value;
          if(llamadas == 0){
              $(".area").css("display","none");
          }
          if(obs == 0){
            $("#trObs").css("display","none");
          }
      }
function takeTime(){
    stte = document.getElementById("estate").textContent;
    hor1 = document.getElementById("hour1").textContent;
    min1 = document.getElementById("minute1").textContent;
    sec1 = document.getElementById("second1").textContent;
    time = hor1+":"+min1+":"+sec1;
       $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo base_url() ?>tiempo-fuera",
            data:  
                {
                    time: time,
                    stte: $("#estate").text(),
                },
                 success:  function (a) {
                    console.log(a);
                    console.log("El tiempo fuera en "+stte+" ha sido de "+time);
                },
                error: function(){
                    console.log("hola, todo mal");
                }

            });
}
</script>
