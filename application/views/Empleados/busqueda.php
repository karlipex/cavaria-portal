<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->flashdata('ControllerMessage')!='') { ?>
   <div><div><?php echo $this->session->flashdata('ControllerMessage'); ?><br><br></div></div>
<?php } ?>
<div>
   <h2> Menu Empleados.</h2>
   <?php echo form_open(null,"busqueda");  ?>
    <a class="add" href="<?php echo base_url() ?>nuevo-empleado">Agregar</a>
        <select name="opcion">
                <option value="">Selecciona</option>
                <option value="e.rut">Rut</option>
                <option value="e.nombre">Nombre</option>
                <option value="e.paterno">Apellido Paterno</option>
                <option value="e.materno">Apellido Materno</option>
        </select>
     <input type="text" name="buscar">
     <input type="submit" value="Buscar">

   <?php echo form_close(); ?>
      <?php if($this->session->flashdata('ErrorSearch')!='')  { ?>
       <div class="errores"><br><?php echo $this->session->flashdata('ErrorSearch'); ?></div>
   <?php } ?> 
<table>
  <tr>
     <th>Rut</th>
     <th>Nombre</th>
     <th>A. Paterno</th>
     <th>A. Materno</th>
     <th>F. Ingreso</th>
     <th>Cargo</th>
  </tr>
  <?php foreach ($empleados as $empleado) { ?>
    <tr onclick="abrir<?php echo $empleado->idEmpleado?>()">
      <script>
            function abrir<?php echo $empleado->idEmpleado ?>() {

               location.href = "<?php echo base_url()?>ficha-empleado/<?php echo $empleado->idEmpleado ?>";
             }
       </script>
       <td><?php echo $empleado->rut ?></td>
       <td><?php echo $empleado->nombre ?></td>
       <td><?php echo $empleado->paterno ?></td>
       <td><?php echo $empleado->materno ?></td>
       <td><?php echo $empleado->fecha ?></td>
       <td><?php echo $empleado->cargo ?></td>
    </tr>
  <?php } ?>
</table>
</div>


