<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body onload="bringArray()">
     <a class="subir" onclick="csv()">Subir CSV</a>
<div class="contents">
<?php
if($this->session->flashdata('ControllerMessage')!='') { ?>
   <div id="flashingby" class="modalback" style="opacity: 1;pointer-events:all"><div class="box"><h2><?php echo $this->session->flashdata('ControllerMessage'); ?></h2><br><br><input class="travieso" type="button" value="Ok" onclick="flashout()"></div></div>
<?php } ?>
<?php
  switch ($usuario->permisos) {
    case '1000':
    ?>

      <div id="csv" class="modalback" style="pointer-events: none">
     <?php echo form_open_multipart(''.base_url().'carga-contactos-antiguos');  ?>
          <div class="box" id="boxid">
              <div id="ridiculo" style="display:none">
              <h2>¿Seguro quieres agregar este archivo CSV?</h2><input type='submit' class='travieso' value='Sí'><input onclick='closeNope()' class='travieso' value='No'>
              </div>
              <div id="csvUpload">
            <h2>Selecciona tu archivo: </h2>
                <input id="archivo" accept=".csv" name="archivo" type="file" onchange='spanBOO()'>
    <span class="boot" id="spanboot" style="display: none">
                <input type="button" class="ingr" value="Subir" onclick="uploadNope()">
     </span>
          <script>
              function spanBOO(){
                  $("#spanboot").css("display","block");
              }
            function uploadNope(){
                $("#csvUpload").css("opacity","0");
                $("#csvUpload").css("pointer-events","none");
                document.getElementById("ridiculo").style.display="block";
            }
              function closeNope(){
                document.getElementById("ridiculo").style.display="none";
                $("#csvUpload").css("opacity","1");
                $("#csvUpload").css("pointer-events","all");
              }
              function flashout(){
                  $("#flashingby").css("opacity","0");
                  $("#flashingby").css("pointer-events","none");
              }
          </script>
      <?php form_close() ?>
         <a onclick="closeCsv()" class="cierra" style="padding: 5px 8px 2px 7px">X</a>
         </div>
          </div>
     </div>
     <section id="primeraSeccion">
     <h1>
       Panel de control
       <small>Ver 1.0.0</small>
     </h1>
          <li id="campi">Campaña: <select id="campana" onchange="actDate()">
              <option value="">Seleccione una campaña</option>
              <?php foreach ($campanas as $campana) { ?>
               <option value="<?php echo $campana->campana ?>"><?php echo $campana->campana ?></option>
             <?php } ?>
         </select></li>
      <li id="inicio" style="display:none" >Inicio: <input type="date" id="fechaInicio" name="fechaInicio" onchange="actButtonDate()"/></li>
      <li id="fin" style="display:none">Fin: <input type="date" id="fechaTermino" name="fechaTermino" onchange="getData()"/></li>
     </section>
    <section id="secondSection">
      <div class="cuadro">
          <h2>Cantidad Contactos</h2>
          <h3 id="nuevos"><?php echo $countAll ?></h3>

          <div>
             <a id="masInfoCantidadContacto" onclick="getFiltro1()" style="display:none">Más info &rarr;</a>
             <a id="masInfoCantidadContacto1" onclick="getContactos1()" style="display:none">Más info &rarr;</a>
          </div>
      </div>
      <div class="cuadro">
          <h2>Llamados</h2>
          <h3 id="llamados"><?php echo $countCall ?></h3>

          <div>
             <a id="masInfoLlamados" onclick="getFiltro4()" style="display:none">Más info &rarr;</a>
             <a id="masInfoLlamados1" onclick="getLlamados()" style="display:none">Más info &rarr;</a>
          </div>
      </div>
      <div class="cuadro">
          <h2>Contactados</h2>
          <h3 id="contactados"><?php echo $contactados ?></h3>

          <div>
             <a id="masInfoContactados" onclick="getFiltro2()" style="display:none">Más info &rarr;</a>
             <a id="masInfoContactados1" onclick="getContactos2()" style="display:none">Más info &rarr;</a>
          </div>
      </div>
      <div class="cuadro">
          <h2>Agendados</h2>
          <h3 id="agendados"><?php echo $countAgend ?></h3>

          <div>
             <a id="masInfoAgendados" onclick="getFiltro3()" style="display:none">Más info &rarr;</a>
             <a id="masInfoAgendados1" onclick="getContactos3()" style="display:none">Más info &rarr;</a>
          </div>
      </div>
    </section>
    
    <div class="muertosyvivos" id="myv" style="display: none">
    <h3>Tiempos por campaña CAPE</h3>
    <select id="capes1" onchange="tiempos(),infoPerCape()">
      <option value="">Seleccione un CAPE</option>
      <?php foreach ($capes as $cape){ ?>
         <option value="<?php echo $cape->idusuario ?>"><?php echo $cape->completo ?></option>
      <?php } ?>
    </select>
    <div id="grafTiempos">
       <div id="chartdivp"></div>
        <div class="tiempvs">
        <p id="gestion"></p>
        <p id="administrativos"></p>
        <p id="llamadas"></p>
        </div>
    </div>
    
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<div class="white" id="white" style="display:none">
    <div id="chartdiv"></div>
</div> 
 </div>
    
    <div class="tabing" id="infoContacto1" style="display:none">
      <div id="grid" style="width: 100%; height: 350px; min-width: "></div>
    <a class="cerrar" id="cerrarContato1" onclick="closeContactos1()">X</a>
    </div>
    <div class="tabing" id="infoContactados1" style="display:none">
      <div id="grid1" style="width: 100%; height: 350px"></div>
      <a class="cerrar" id="cerrarContato2" onclick="closeContactos2()">X</a>
    </div>
     <div class="tabing" id="infoagendados1" style="display:none">
      <div id="grid2" style="width: 100%; height: 350px"></div>
      <a class="cerrar" id="cerrarContato3" onclick="closeContactos3()">X</a>
    </div>
    <div class="tabing" id="infoLlamados" style="display:none">
      <div id="grid7" style="width: 100%; height: 350px"></div>
      <a class="cerrar" id="cerrarContato4" onclick="closeContactos4()">X</a>  
    </div>

    <div class="tabing" id="filtro1" style="display:none">
     <div id="grid4" style="width: 100%; height: 350px"></div>
     <a class="cerrar" id="cerrarFiltro1" onclick="closeFiltro1()">X</a>
    </div>
    <div class="tabing" id="filtro2" style="display:none">
     <div id="grid5" style="width: 100%; height: 350px"></div>
     <a class="cerrar" id="cerrarFiltro2" onclick="closeFiltro2()">X</a>
    </div>
     <div class="tabing" id="filtro3" style="display:none">
     <div id="grid6" style="width: 100%; height: 350px"></div>
     <a class="cerrar" id="cerrarFiltro2" onclick="closeFiltro3()">X</a>
    </div>
    <div class="tabing" id="filtro4" style="display:none">
      <div id="grid8" style="width: 100%; height: 350px"></div>
     <a class="cerrar" id="cerrarFiltro4" onclick="closeFiltro4()">X</a>
    </div>
     <script src="https://www.amcharts.com/lib/3/pie.js"></script>
     <div id="diarios">
       <h3>Tiempos de hoy por CAPE</h3>
      <select id="capes2" onchange="tiempos2(),infoPerCape2()">
        <option value="">Seleccione un CAPE</option>
        <?php foreach ($capes as $cape){ ?>
           <option value="<?php echo $cape->idusuario ?>"><?php echo $cape->completo ?></option>
        <?php } ?>
         </select>  
         <div id="chartdivp2"></div>
        <div class="tiempvs2">
        <p id="gestion2"></p>
        <p id="administrativos2"></p>
        <p id="llamadas2"></p>
        </div>
         <div id="chartdiv2"></div>
     </div>
</div>
    <script type="text/javascript">
      $(function () {
        $('#grid').w2grid({ 
        name: 'grid', 
        url: '<?php echo base_url() ?>llenar-contactos-diarios',
        method: 'GET',
        show: { 
            toolbar: true
        },
         multiSearch: true,
        searches: [
            { field: 'recid', caption: 'ID ', type: 'int' },
            { field: 'nombre', caption: 'Nombre', type: 'text' },
            { field: 'email', caption: 'E-Mail', type: 'text' },
            { field: 'telefono', caption: 'Teléfono', type: 'text' },
            { field: 'descripcion', caption: 'Tratamiento', type: 'text' },
            { field: 'descuento', caption: 'Descuento', type: 'text' },
            { field: 'fechaIngreso', caption: 'Fecha Ingreso', type: 'date' },
            { field: 'origen', caption: 'Origen', type: 'text' },
            { field: 'campana', caption: 'Campaña', type: 'text' }
        ],
        columns: [                
            { field: 'recid', caption: 'ID', size: '4%', sortable: true},
            { field: 'nombre', caption: 'Nombre', size: '20%', sortable: true },
            { field: 'email', caption: 'E-Mail', size: '18%', sortable: true },
            { field: 'telefono', caption: 'Teléfono', size: '10%' },
            { field: 'descripcion', caption: 'Tratamiento', size: '15%' },
            { field: 'descuento', caption: 'Descuento', size: '10%' },
            { field: 'fechaIngreso', caption: 'Fecha Ingreso', size: '10%' },
            { field: 'origen', caption: 'Origen', size: '15%' },
            { field: 'campana', caption: 'Campaña', size: '15%' }

        ],
        onDblClick: function (event) {
         var id=event.recid;
         window.location.href='<?php echo base_url()?>detalle-contacto/'+id;
       }
    });    
      });
    </script>
    <script type="text/javascript">
      $(function () {
        $('#grid1').w2grid({ 
        name: 'grid1', 
        url: '<?php echo base_url() ?>llenar-contactos-diarios-llamados',
        method: 'GET',
        show: { 
            toolbar: true
        },
         multiSearch: true,
        searches: [
            { field: 'recid', caption: 'ID ', type: 'int' },
            { field: 'nombre', caption: 'Nombre', type: 'text' },
            { field: 'email', caption: 'E-Mail', type: 'text' },
            { field: 'telefono', caption: 'Teléfono', type: 'text' },
            { field: 'descripcion', caption: 'Tratamiento', type: 'text' },
            { field: 'descuento', caption: 'Descuento', type: 'text' },
            { field: 'fechaIngreso', caption: 'Fecha Ingreso', type: 'date' },
            { field: 'origen', caption: 'Origen', type: 'text' },
            { field: 'campana', caption: 'Campaña', type: 'text' }
        ],
        columns: [                
            { field: 'recid', caption: 'ID', size: '4%', sortable: true},
            { field: 'nombre', caption: 'Nombre', size: '20%', sortable: true },
            { field: 'email', caption: 'E-Mail', size: '18%', sortable: true },
            { field: 'telefono', caption: 'Teléfono', size: '10%' },
            { field: 'descripcion', caption: 'Tratamiento', size: '15%' },
            { field: 'descuento', caption: 'Descuento', size: '10%' },
            { field: 'fechaIngreso', caption: 'Fecha Ingreso', size: '10%' },
            { field: 'origen', caption: 'Origen', size: '15%' },
            { field: 'campana', caption: 'Campaña', size: '15%' }

        ],
        onDblClick: function (event) {
         var id=event.recid;
         window.location.href='<?php echo base_url()?>detalle-contacto/'+id;
       }
    });    
      });
    </script>
    <script type="text/javascript">
      $(function () {
        $('#grid2').w2grid({ 
        name: 'grid2', 
        url: '<?php echo base_url() ?>llenar-contactos-diarios-agendados',
        method: 'GET',
        show: { 
            toolbar: true
        },
         multiSearch: true,
        searches: [
            { field: 'recid', caption: 'ID ', type: 'int' },
            { field: 'nombre', caption: 'Nombre', type: 'text' },
            { field: 'email', caption: 'E-Mail', type: 'text' },
            { field: 'telefono', caption: 'Teléfono', type: 'text' },
            { field: 'descripcion', caption: 'Tratamiento', type: 'text' },
            { field: 'descuento', caption: 'Descuento', type: 'text' },
            { field: 'fechaIngreso', caption: 'Fecha Ingreso', type: 'date' },
            { field: 'origen', caption: 'Origen', type: 'text' },
            { field: 'campana', caption: 'Campaña', type: 'text' }
        ],
        columns: [                
            { field: 'recid', caption: 'ID', size: '4%', sortable: true},
            { field: 'nombre', caption: 'Nombre', size: '20%', sortable: true },
            { field: 'email', caption: 'E-Mail', size: '18%', sortable: true },
            { field: 'telefono', caption: 'Teléfono', size: '10%' },
            { field: 'descripcion', caption: 'Tratamiento', size: '15%' },
            { field: 'descuento', caption: 'Descuento', size: '10%' },
            { field: 'fechaIngreso', caption: 'Fecha Ingreso', size: '10%' },
            { field: 'origen', caption: 'Origen', size: '15%' },
            { field: 'campana', caption: 'Campaña', size: '15%' }

        ],
        onDblClick: function (event) {
         var id=event.recid;
         window.location.href='<?php echo base_url()?>detalle-contacto/'+id;
       }
    });    
      });
    </script>
    <script type="text/javascript">
        function infoPerCape(){
            $.ajax({
           type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>info-por-cape",
            data:  
                {
                    campana: $("#campana").val(),
                    cape: $("#capes1").val(),
                    fechaInicio:  $("#fechaInicio").val(),
                    fechaTermino: $("#fechaTermino").val(),
                },
                 success:  function (a) {
                  console.log(a);
    var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",
	"startDuration": 2,
    "dataProvider": [{
        "country": "Contactos",
        "visits": a["contactos"],
        "color": "rgba(255,0,0,0.6)"
    }, {
        "country": "Llamados",
        "visits": a["llamados"],
        "color": "rgba(255,255,0,0.6)"
    }, {
        "country": "Contactados",
        "visits": a["contactados"],
        "color": "rgba(0,205,0,0.6)"
    }, {
        "country": "Agendados",
        "visits": a["agendados"],
        "color": "rgba(105,25,144,0.6)"
    }],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "colorField": "color",
        "fillAlphas": 0.85,
        "lineAlpha": 0.1,
        "type": "column",
        "topRadius":1,
        "valueField": "visits"
    }],
    "valueAxes": [{
        "position": "left",
        "title": "Totales por CAPE"
    }],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 1,
        "lineAlpha": 0.1,
        "type": "column",
        "valueField": "visits"
    }],
    "depth3D": 20,
	"angle": 30,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 0
    },
    "export": {
    	"enabled": true
     }

}, 0);},
              error: function(a){
                console.log(a);
              }
        });
        }
      function getData()
      {
        $.ajax({
           type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>trae-contactos-cpanel",
            data:  
                {
                    campana: $("#campana").val(),
                    fechaInicio: $("#fechaInicio").val(),
                    fechaTermino: $("#fechaTermino").val(),
                },
                 success:  function (a) {
                     $("#white").css("display","block");
                     $("#myv").css("display","block");
                   $("#nuevos").html(a["nuevos"]);
                   $("#llamados").html(a["llamados"]);
                   $("#contactados").html(a["contactados"]);
                   $("#agendados").html(a["agendados"]);

                   document.getElementById("masInfoCantidadContacto").style.display="inline";
                   document.getElementById("masInfoLlamados").style.display="inline";
                   document.getElementById("masInfoContactados").style.display="inline";
                   document.getElementById("masInfoAgendados").style.display="inline";

                   document.getElementById("masInfoCantidadContacto1").style.display="none";
                   document.getElementById("masInfoLlamados1").style.display="none";
                   document.getElementById("masInfoContactados1").style.display="none";
                   document.getElementById("masInfoAgendados1").style.display="none";
                 },
                  error: function(a){
                    console.log(a);
                }
        });
      }
      function getFiltro1(){
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo base_url() ?>trae-contactos-filtro",
          data:
              {
                campana: $("#campana").val(),
                fechaInicio: $("#fechaInicio").val(),
                fechaTermino: $("#fechaTermino").val(),
              },
              success: function(a){
                $(function () {
                $('#grid4').w2grid({ 
                name: 'grid4', 
                show: { 
                    toolbar: true
                },
                 multiSearch: true,
                searches: [
                    { field: 'recid', caption: 'ID ', type: 'int' },
                    { field: 'nombre', caption: 'Nombre', type: 'text' },
                    { field: 'email', caption: 'E-Mail', type: 'text' },
                    { field: 'telefono', caption: 'Teléfono', type: 'text' },
                    { field: 'tratamiento', caption: 'Tratamiento', type: 'text' },
                    { field: 'descuento', caption: 'Descuento', type: 'text' },
                    { field: 'fechaIngreso', caption: 'Fecha Ingreso', type: 'date' },
                    { field: 'origen', caption: 'Origen', type: 'text' },
                    { field: 'campana', caption: 'Campaña', type: 'text' }
                ],
                columns: [                
                    { field: 'recid', caption: 'ID', size: '4%', sortable: true},
                    { field: 'nombre', caption: 'Nombre', size: '20%', sortable: true },
                    { field: 'email', caption: 'E-Mail', size: '18%', sortable: true },
                    { field: 'telefono', caption: 'Teléfono', size: '10%' },
                    { field: 'tratamiento', caption: 'Tratamiento', size: '15%' },
                    { field: 'descuento', caption: 'Descuento', size: '10%' },
                    { field: 'fechaIngreso', caption: 'Fecha Ingreso', size: '10%' },
                    { field: 'origen', caption: 'Origen', size: '15%' },
                    { field: 'campana', caption: 'Campaña', size: '15%' }

                ],
                records: a,
                onDblClick: function (event) {
                 var id=event.recid;
                 window.location.href='<?php echo base_url()?>detalle-contacto/'+id;
               }
            });    
              });
                
               document.getElementById("filtro1").style.display="block";
              },
              error: function(a){
                console.log(a);
              }
        });
      }
      function getFiltro2(){
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo base_url() ?>trae-contactados-filtro",
          data:
              {
                campana: $("#campana").val(),
                fechaInicio: $("#fechaInicio").val(),
                fechaTermino: $("#fechaTermino").val(),
              },
              success: function(a){
                $(function () {
                $('#grid5').w2grid({ 
                name: 'grid5', 
                show: { 
                    toolbar: true
                },
                 multiSearch: true,
                searches: [
                    { field: 'recid', caption: 'ID ', type: 'int' },
                    { field: 'nombre', caption: 'Nombre', type: 'text' },
                    { field: 'email', caption: 'E-Mail', type: 'text' },
                    { field: 'telefono', caption: 'Teléfono', type: 'text' },
                    { field: 'tratamiento', caption: 'Tratamiento', type: 'text' },
                    { field: 'descuento', caption: 'Descuento', type: 'text' },
                    { field: 'fechaIngreso', caption: 'Fecha Ingreso', type: 'date' },
                    { field: 'origen', caption: 'Origen', type: 'text' },
                    { field: 'campana', caption: 'Campaña', type: 'text' }
                ],
                columns: [                
                    { field: 'recid', caption: 'ID', size: '4%', sortable: true},
                    { field: 'nombre', caption: 'Nombre', size: '20%', sortable: true },
                    { field: 'email', caption: 'E-Mail', size: '18%', sortable: true },
                    { field: 'telefono', caption: 'Teléfono', size: '10%' },
                    { field: 'tratamiento', caption: 'Tratamiento', size: '15%' },
                    { field: 'descuento', caption: 'Descuento', size: '10%' },
                    { field: 'fechaIngreso', caption: 'Fecha Ingreso', size: '10%' },
                    { field: 'origen', caption: 'Origen', size: '15%' },
                    { field: 'campana', caption: 'Campaña', size: '15%' }

                ],
                records: a,
                onDblClick: function (event) {
                 var id=event.recid;
                 window.location.href='<?php echo base_url()?>detalle-contacto/'+id;
               }
            });    
              });
                
               document.getElementById("filtro2").style.display="block";
              },
              error: function(a){
                console.log(a);
              }
        });
      }
       function getFiltro3(){
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo base_url() ?>trae-agendados-filtro",
          data:
              {
                campana: $("#campana").val(),
                fechaInicio: $("#fechaInicio").val(),
                fechaTermino: $("#fechaTermino").val(),
              },
              success: function(a){
                $(function () {
                $('#grid6').w2grid({ 
                name: 'grid6', 
                show: { 
                    toolbar: true
                },
                 multiSearch: true,
                searches: [
                    { field: 'recid', caption: 'ID ', type: 'int' },
                    { field: 'nombre', caption: 'Nombre', type: 'text' },
                    { field: 'email', caption: 'E-Mail', type: 'text' },
                    { field: 'telefono', caption: 'Teléfono', type: 'text' },
                    { field: 'tratamiento', caption: 'Tratamiento', type: 'text' },
                    { field: 'descuento', caption: 'Descuento', type: 'text' },
                    { field: 'fechaIngreso', caption: 'Fecha Ingreso', type: 'date' },
                    { field: 'origen', caption: 'Origen', type: 'text' },
                    { field: 'campana', caption: 'Campaña', type: 'text' }
                ],
                columns: [                
                    { field: 'recid', caption: 'ID', size: '4%', sortable: true},
                    { field: 'nombre', caption: 'Nombre', size: '20%', sortable: true },
                    { field: 'email', caption: 'E-Mail', size: '18%', sortable: true },
                    { field: 'telefono', caption: 'Teléfono', size: '10%' },
                    { field: 'tratamiento', caption: 'Tratamiento', size: '15%' },
                    { field: 'descuento', caption: 'Descuento', size: '10%' },
                    { field: 'fechaIngreso', caption: 'Fecha Ingreso', size: '10%' },
                    { field: 'origen', caption: 'Origen', size: '15%' },
                    { field: 'campana', caption: 'Campaña', size: '15%' }

                ],
                records: a,
                onDblClick: function (event) {
                 var id=event.recid;
                 window.location.href='<?php echo base_url()?>detalle-contacto/'+id;
               }
            });    
              });
                
               document.getElementById("filtro3").style.display="block";
              },
              error: function(a){
                console.log(a);
              }
        });
      }
      function getFiltro4(){
         $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo base_url() ?>trae-llamados-filtro",
          data:
              {
                campana: $("#campana").val(),
                fechaInicio: $("#fechaInicio").val(),
                fechaTermino: $("#fechaTermino").val(),
              },
              success: function(a){
                $(function () {
                $('#grid8').w2grid({ 
                name: 'grid8', 
                show: { 
                    toolbar: true
                },
                 multiSearch: true,
                searches: [
                    { field: 'recid', caption: 'ID ', type: 'int' },
                    { field: 'nombre', caption: 'Nombre', type: 'text' },
                    { field: 'email', caption: 'E-Mail', type: 'text' },
                    { field: 'telefono', caption: 'Teléfono', type: 'text' },
                    { field: 'tratamiento', caption: 'Tratamiento', type: 'text' },
                    { field: 'descuento', caption: 'Descuento', type: 'text' },
                    { field: 'fechaIngreso', caption: 'Fecha Ingreso', type: 'date' },
                    { field: 'origen', caption: 'Origen', type: 'text' },
                    { field: 'campana', caption: 'Campaña', type: 'text' }
                ],
                columns: [                
                    { field: 'recid', caption: 'ID', size: '4%', sortable: true},
                    { field: 'nombre', caption: 'Nombre', size: '20%', sortable: true },
                    { field: 'email', caption: 'E-Mail', size: '18%', sortable: true },
                    { field: 'telefono', caption: 'Teléfono', size: '10%' },
                    { field: 'tratamiento', caption: 'Tratamiento', size: '15%' },
                    { field: 'descuento', caption: 'Descuento', size: '10%' },
                    { field: 'fechaIngreso', caption: 'Fecha Ingreso', size: '10%' },
                    { field: 'origen', caption: 'Origen', size: '15%' },
                    { field: 'campana', caption: 'Campaña', size: '15%' }

                ],
                records: a,
                onDblClick: function (event) {
                 var id=event.recid;
                 window.location.href='<?php echo base_url()?>detalle-contacto/'+id;
               }
            });    
              });
                
               document.getElementById("filtro4").style.display="block";
              },
              error: function(a){
                console.log(a);
              }
        });
      }
    function bringArray(){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>llenar-contactos-diarios-llamados",
            data:  
                {
                },
                 success:  function (a) {
                },
                error: function(){
                    console.log();
                }

            });
    }
    function tiempos(){
     $.ajax({
         type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>trae-tiempos-usuario",
            data:  
                {
                   campana: $("#campana").val(),
                   capes1: $("#capes1").val(),
                   fechaInicio: $("#fechaInicio").val(),
                   fechaTermino: $("#fechaTermino").val(),
                },
                 success:  function (a) {
                   $("#gestion").html("Total tiempos de gestión:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>"+a["gestion"]+"</b>");
                   $("#administrativos").html("Total tiempos administrativos: <b>"+a["administrativo"]+"</b>");
                   $("#llamadas").html("Total tiempos de llamada: <b>"+a["llamada"]+"</b>");
 var chart = AmCharts.makeChart( "chartdivp", {
  "type": "pie",
  "theme": "light",
  "dataProvider": [ {
    "country": "T. Gestión",
    "litres": (a["gestion"]).replace(":","").replace(":",""),
  }, {
    "country": "En Llamada",
    "litres": (a["llamada"]).replace(":","").replace(":","")
  },{
    "country": "T. Administrativos",
    "litres": (a["administrativo"]).replace(":","").replace(":","")
  } ],
  "valueField": "litres",
  "titleField": "country",
   "balloon":{
   "fixedPosition":true
  },
  "export": {
    "enabled": true
  }
} );
                },
                error: function(){
                    console.log(a);
                }
     });
    }
     function tiempos2(){
     $.ajax({
         type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>trae-tiempos-usuario-diario",
            data:  
                {
                   capes2: $("#capes2").val(),
                },
                 success:  function (a) {
                     console.log(a);
                    $("#gestion2").html("Total tiempos de gestión:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>"+a["gestion"]+"</b>");
                   $("#administrativos2").html("Total tiempos administrativos: <b>"+a["administrativo"]+"</b>");
                   $("#llamadas2").html("Total tiempos de llamada: <b>"+a["llamada"]+"</b>");
 var chart = AmCharts.makeChart( "chartdivp2", {
  "type": "pie",
  "theme": "light",
  "dataProvider": [ {
    "tipo": "T. Gestión",
    "times": (a["gestion"]).replace(":","").replace(":",""),
  }, {
    "tipo": "En Llamada",
    "times": (a["llamada"]).replace(":","").replace(":","")
  },{
    "tipo": "T. Administrativos",
    "times": (a["administrativo"]).replace(":","").replace(":","")
  } ],
  "valueField": "times",
  "titleField": "tipo",
   "balloon":{
   "fixedPosition":true
  },
  "export": {
    "enabled": true
  }
} );
                },
                error: function(a){
                    console.log(a);
                }
     });
    }
     function infoPerCape2(){
            $.ajax({
           type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>info-por-cape-diario",
            data:  
                {
                    cape2: $("#capes2").val(),
                },
                 success:  function (a) {
                  console.log(a);
    var chart = AmCharts.makeChart("chartdiv2", {
    "theme": "light",
    "type": "serial",
  "startDuration": 2,
    "dataProvider": [{
        "country": "Contactos",
        "visits": a["contactos"],
        "color": "rgba(255,0,0,0.6)"
    }, {
        "country": "Llamados",
        "visits": a["llamados"],
        "color": "rgba(255,255,0,0.6)"
    }, {
        "country": "Contactados",
        "visits": a["contactados"],
        "color": "rgba(0,205,0,0.6)"
    }, {
        "country": "Agendados",
        "visits": a["agendados"],
        "color": "rgba(105,25,144,0.6)"
    }],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "colorField": "color",
        "fillAlphas": 0.85,
        "lineAlpha": 0.1,
        "type": "column",
        "topRadius":1,
        "valueField": "visits"
    }],
    "valueAxes": [{
        "position": "left",
        "title": "Totales por CAPE"
    }],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 1,
        "lineAlpha": 0.1,
        "type": "column",
        "valueField": "visits"
    }],
    "depth3D": 20,
  "angle": 30,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 0
    },
    "export": {
      "enabled": true
     }

}, 0);
    },
              error: function(a){
                console.log(a);
              }
        });
        }

    </script>
    <?php     
        break;
    
    case '1001':
    ?>
      
    <?php
        break;

}
?>



  <!--

--->
