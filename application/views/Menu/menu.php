<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body onload="bringArray()">
     <a class="subir" onclick="csv()">Subir CSV</a>
<div class="contents">
<?php
if($this->session->flashdata('ControllerMessage')!='') { ?>
   <div><div><?php echo $this->session->flashdata('ControllerMessage'); ?><br><br><input type="button" value="Ok"></div></div>
<?php } ?>
<?php
  switch ($usuario->permisos) {
    case '1000':
    ?>

      <div id="csv" class="modalback">
          <div class="box">
     <?php echo form_open_multipart(''.base_url().'carga-contactos-antiguos');  ?>
            <h2>Selecciona tu archivo: </h2>
                <input id="archivo" accept=".csv" name="archivo" type="file" />
    <span class="boot">
                <input type="submit" class="ingr" value="Subir">
     </span>
      <?php form_close() ?>
         <a onclick="closeCsv()" class="cierra" style="padding: 5px 8px 2px 7px">X</a>
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
             <a id="masInfoCantidadContacto" onclick="getFiltro1()" style="display:none">Más info</a>
             <a id="masInfoCantidadContacto1" onclick="getContactos1()" style="display:none">Más info</a>
          </div>
      </div>
      <div class="cuadro">
          <h2>Llamados</h2>
          <h3 id="llamados"><?php echo $countCall ?></h3>

          <div>
             <a style="display:none">Más info</a>
             <a style="display:none">Más info</a>
          </div>
      </div>
      <div class="cuadro">
          <h2>Contactados</h2>
          <h3 id="contactados"><?php echo $contactados ?></h3>

          <div>
             <a id="masInfoContactados" onclick="getFiltro2()" style="display:none">Más info</a>
             <a id="masInfoContactados1" onclick="getContactos2()" style="display:none">Más info</a>
          </div>
      </div>
      <div class="cuadro">
          <h2>Agendados</h2>
          <h3 id="agendados"><?php echo $countAgend ?></h3>

          <div>
             <a id="masInfoAgendados" onclick="getFiltro3()" style="display:none">Más info</a>
             <a id="masInfoAgendados1" onclick="getContactos3()" style="display:none">Más info</a>
          </div>
      </div>
    </section>
    
    
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<div class="white" id="white" style="display:none">
    <div id="chartdiv"></div>
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
     <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <div class="muertosyvivos" id="myv" style="display: none">
    <h3>Tiempos por CAPE</h3>
    <select id="capes1" onchange="tiempos()">
      <option value="">Seleccione un CAPE</option>
      <?php foreach ($capes as $cape){ ?>
         <option value="<?php echo $cape->idusuario ?>"><?php echo $cape->completo ?></option>
      <?php } ?>
    </select>
    <div id="grafTiempos">
        <div class="tiempvs">
        <p id="muertos"></p>
        <p id="llamadas"></p>
        </div>
       <div id="chartdivp"></div>
    </div>
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
                  console.log(a);
                     $("#white").css("display","block");
                     $("#myv").css("display","block");
                   $("#nuevos").html(a["nuevos"]);
                   $("#llamados").html(a["llamados"]);
                   $("#contactados").html(a["contactados"]);
                   $("#agendados").html(a["agendados"]);
var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",
	"startDuration": 2,
    "dataProvider": [{
        "country": "Contactos",
        "visits": a["nuevos"],
        "color": "rgba(255,0,0,0.6)"
    }, {
        "country": "Contactados",
        "visits": a["contactados"],
        "color": "rgba(255,255,0,0.6)"
    }, {
        "country": "Agendados",
        "visits": a["agendados"],
        "color": "rgba(0,205,0,0.6)"
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
        "title": "Totales"
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
                   document.getElementById("masInfoCantidadContacto").style.display="inline";
                   document.getElementById("masInfoContactados").style.display="inline";
                   document.getElementById("masInfoAgendados").style.display="inline";

                   document.getElementById("masInfoCantidadContacto1").style.display="none";
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
                  console.log(a);
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
                  console.log(a);
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
                  console.log(a);
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
    function bringArray(){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() ?>llenar-contactos-diarios-llamados",
            data:  
                {
                },
                 success:  function (a) {
                    console.log(a);
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
                   capes1: $("#capes1").val(),
                   fechaInicio: $("#fechaInicio").val(),
                   fechaTermino: $("#fechaTermino").val(),
                },
                 success:  function (a) {
                   $("#muertos").html("Total tiempos muertos:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>"+a["muerto"]+"</b>");
                   $("#llamadas").html("Total tiempos de llamada: <b>"+a["llamada"]+"</b>");
 var chart = AmCharts.makeChart( "chartdivp", {
  "type": "pie",
  "theme": "light",
  "dataProvider": [ {
    "country": "Tiempo Muerto",
    "litres": (a["muerto"]).replace(":","").replace(":",""),
  }, {
    "country": "En Llamada",
    "litres": (a["llamada"]).replace(":","").replace(":","")
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
