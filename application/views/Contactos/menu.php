<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->flashdata('ControllerMessage')!='') { ?>
   <div><div><?php echo $this->session->flashdata('ControllerMessage'); ?><br><br></div></div>
<?php } ?>
<div class="grilla">
  <h2>Menú Contactos</h2>
    <a class="agregar" onclick="addContact()">Agregar</a><!---
    <?php if( $usuario->permisos == 1000){ ?>
    <a href="<?php echo base_url()?>menu-principal">Menu Principal</a>
    <?php } ?>--->
   <div id="grid" style="width: 100%; height: 350px"></div>
</div>
<!------------MODAL-------------->
<div id="addNewCont" class="modalback">
    <div class="box">
        <div id="formu">
        <h2>Nuevo Contacto</h2>
        <input id="cname" name="nombre" maxlength="100" placeholder="Nombres Completo:">
	    <input id="cmail" name="email" maxlength="42"  placeholder="E-Mail:">
	    <input id="cnumero" name="numero" maxlength="12" placeholder="Numero Teléfonico:">
        <input id="ctrat" name="tratamiento" maxlength="100" placeholder="Tratamiento">
        <input id="cdesc" name="descuento" maxlength="45"  placeholder="Descuento">
        <input id="ccampa" name="campana" maxlength="100"  placeholder="Campaña">
        <select id="corigen" name="origen" onchange="origen()">
          <option value="0">Seleccione Origen</option>
          <option value="Contacto Pagina Web C.A.">Contacto Pagina Web C.A.</option>
          <option value="Contacto Facebook">Contacto Facebook</option>
          <option value="Contacto Antiguo">Contacto Antiguo</option>
        </select>
        <div id="asesor" style="display: none">
        <?php if($usuario->permisos == 1000){ ?>

            <select id="casesor" name="asesor">
                <option value="">Seleccione CAPE</option>
                <?php foreach ($capes as $cape) { ?>
                 <option value="<?php echo $cape->idusuario ?>"><?php echo $cape->completo ?></option>  
               <?php } ?> 
            </select>
        <?php } else { ?>
           <input type="hidden" id="casesor" name="asesor" value="<?php echo $usuario->idusuario ?>">
        <?php } ?>
        </div>
        <span class="boot" id="ingr" style="display: none">
          <input class="ingr" type="button" value="Agregar" onclick="addNewContact()"></span>
        </div>
          <div class="oculto" id="adviser">
            <h2>Contacto agregado Correctamente</h2>
              <input class="bouts" type="button" value="Ok" onclick="regresa()">
            </div> 
            <span class="cierra" onclick="closeaddCt()">x</span>
    </div>
</div>
<script type="text/javascript">
$(function () {
    $('#grid').w2grid({ 
        name: 'grid', 
        url: '<?php echo base_url() ?>llenar-contactos',
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
        onDblClick: function (event) {
         var id=event.recid;
         window.location.href='<?php echo base_url()?>detalle-contacto/'+id;
     }
    });    
});
    function addContact(){
        document.getElementById("addNewCont").classList.add("abremodal");
    }
    function closeaddCt(){
        document.getElementById("addNewCont").classList.remove("abremodal");
    }
    //AGREGA USUARIO NUEVO
    function addNewContact(){
        nombre = document.getElementById("cname").value;
        email = document.getElementById("cmail").value;
        numero = document.getElementById("cnumero").value;
        tratamiento = document.getElementById("ctrat").value;
        descuento = document.getElementById("cdesc").value;
        campana=document.getElementById("ccampa").value;
        origen = document.getElementById("corigen").value;
        asesor=document.getElementById("casesor").value;
        expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (nombre.length == 0 || /^\s+$/.test(nombre)) {
            document.getElementById("cname").className = "fail";
            document.getElementById("cname").placeholder = "El nombre es Necesario";
        }
        if (email.length == 0 || /^\s+$/.test(email)) {
            document.getElementById("cmail").className = "fail";
            document.getElementById("cmail").placeholder = "El email es Necesario";
        }
        if (email.length > 0 && !expr.test(email)){
            document.getElementById("cmail").value="";
            document.getElementById("cmail").className = "fail";
            document.getElementById("cmail").placeholder = "Email no válido";
        }
        if (numero.length == 0 || /^\s+$/.test(numero)) {
            document.getElementById("cnumero").className = "fail";
            document.getElementById("cnumero").placeholder = "El número es Necesario";
        }
        if (tratamiento.length == 0 || /^\s+$/.test(tratamiento)) {
            document.getElementById("ctrat").className = "fail";
            document.getElementById("ctrat").placeholder = "El tratamiento es Necesario";
        }
        if (descuento.length == 0 || /^\s+$/.test(descuento)) {
            document.getElementById("cdesc").className = "fail";
            document.getElementById("cdesc").placeholder = "El descuento es Necesario";
        }
        if (campana.length == 0 || /^\s+$/.test(campana)) {
            document.getElementById("ccampa").className = "fail";
            document.getElementById("ccampa").placeholder = "La campaña es Necesaria";
        }
        if (origen.length == 0 || /^\s+$/.test(origen)) {
            document.getElementById("corigen").className = "fail";
            document.getElementById("corigen").placeholder = "El origen es Necesario";
        }
        else{
            $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo base_url() ?>nuevo-contacto",
            data:  
                {
                    nombre: $("#cname").val(),
                    email: $("#cmail").val(),
                    numero: $("#cnumero").val(),
                    tratamiento: $("#ctrat").val(),
                    descuento: $("#cdesc").val(),
                    campana: $("#ccampa").val(),
                    origen: $("#corigen").val(),
                    asesor:$("#casesor").val(),
                },
                 success:  function (a) {
                    console.log(a);
                    $("#formu").addClass("oculto");
                    $("#adviser").addClass("libre");
                },
                error: function(){
                    console.log();
                }

            });
        }
    }
        function regresa(){
            $("#addNewCont").removeClass("abremodal");
            w2ui['grid'].reload();
            $("#formu").removeClass("oculto");
            $("#adviser").removeClass("libre");
            document.getElementById("cname").value="";
            document.getElementById("cmail").value="";
            document.getElementById("cnumero").value="";
            document.getElementById("ctrat").value="";
            document.getElementById("cdesc").value="";
            document.getElementById("ccampa").value="";
            document.getElementById("corigen").value=0;
            document.getElementById("casesor").value="";
            document.getElementById("asesor").style.display="none";
        }
</script>