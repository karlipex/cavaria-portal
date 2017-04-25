<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
  switch ($usuario->permisos) {
    case '1000':
    ?>
     <section>
     <h1>
       Panel de control
       <small>Ver 1.0.0</small>
     </h1>
      <li>
          Campaña:
          <select id="campana" onchange="actDate()">
              <option value="">Seleccione una campaña</option>
              <?php foreach ($campanas as $campana) { ?>
               <option value="<?php echo $campana->campana ?>"><?php echo $campana->campana ?></option>
             <?php } ?>
          </select>
      <li id="inicio" style="display:none" >Inicio:<input type="date" id="fechaInicio" name="fechaInicio" onchange="actButtonDate()"/></li>
      <li id="fin" style="display:none">Fin:<input type="date" id="fechaTermino" name="fechaTermino" onchange="getData()"/></li>
     </section>
    <section>
      <div>
          <h3 id="nuevos"><?php echo $countAll ?></h3>
          <p>Cantidad Contactos</p>

          <div>
             <a id="masInfoCantidadContacto" onclick="getContactos()" style="display:none">Mas info</a>
             <a id="masInfoCantidadContacto1" onclick="getContactos1()">Mas info</a>
          </div>
      </div>
      <div>
          <h3 id="contactados"><?php echo $countCall ?></h3>
          <p>Contactatados</p>

          <div>
             <a id="masInfoContactados" onclick="getContactos()" style="display:none">Mas info</a>
             <a id="masInfoContactados1">Mas info</a>
          </div>
      </div>
      <div>
          <h3 id="masInfoagendados"><?php echo $countAgend ?></h3>
          <p>Agendados</p>

          <div>
             <a id="masInfoAgendados" onclick="getContactos()" style="display:none">Mas info</a>
             <a id="masInfoAgendados1">Mas info</a>
          </div>
      </div>
    </section>
    <div id="infoContacto1" style="display:none">
      <div id="grid" style="width: 100%; height: 350px"></div>
    <a id="cerrarContato1" onclick="closeContactos1()">X</a>
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

        ]
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
                   $("#nuevos").html(a["nuevos"]);
                   $("#contactados").html(a["contactados"]);
                   $("#agendados").html(a["agendados"]);
                   document.getElementById("masInfoCantidadContacto").style.display="block";
                   document.getElementById("masInfoContactados").style.display="block";
                   document.getElementById("masInfoAgendados").style.display="block";

                   document.getElementById("masInfoCantidadContacto1").style.display="none";
                   document.getElementById("masInfoContactados1").style.display="none";
                   document.getElementById("masInfoAgendados1").style.display="none";
                 },
                  error: function(a){
                    console.log(a);
                }
        });
      }

      function getContactos()
      {
        alert("contactos");
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
