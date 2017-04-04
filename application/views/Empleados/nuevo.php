<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div>
  <h2>Nuevo Empleado.</h2>
  <?php if($this->session->flashdata('ErrorMessage')!='') { ?>
	    <div class="error"><?php echo $this->session->flashdata('ErrorMessage'); ?></div>
	<?php } ?>
    <?php  
	     echo form_open(null,"name=insertar"); 
	?>
	<input name="rut" id="rut" maxlength="12" value="<?php echo set_value("rut")?>" placeholder="Rut:" onkeypress="ruty()">
	<div class="error" id="check" style="display: none;">El Rut Ingresado no es válido</div>
	<?php echo form_error("rut",'<div class="error">','</div>')?>

	<input name="nombre" maxlength="42" value="<?php echo set_value("nombre")?>" placeholder="Nombres:">
	<?php echo form_error("nombre",'<div class="error">','</div>')?>

	 <input name="paterno" maxlength="42" value="<?php echo set_value("paterno")?>" placeholder="Apellido Paterno:">
	<?php echo form_error("paterno",'<div class="error">','</div>')?>

	<input name="materno" maxlength="42" value="<?php echo set_value("materno")?>" placeholder="Apellido Materno:">
	<?php echo form_error("materno",'<div class="error">','</div>')?>

	<select name="cargo">
		<option value="0">Cargo</option>
		<?php foreach ($cargos as $cargo) { ?>
		 <option value="<?php echo $cargo->idcargo ?>"><?php echo $cargo->descripcion ?></option>
		<?php } ?>
	</select>

	<input name="correo" maxlength="42" value="<?php echo set_value("correo")?>" placeholder="Correo:">
	<?php echo form_error("correo",'<div class="error">','</div>')?>

	 <input name="usuario" maxlength="42" value="<?php echo set_value("usuario")?>" placeholder="Usuario:">
	<?php echo form_error("usuario",'<div class="error">','</div>')?>

	<select name="Permisos">
	   <option value="">Permisos</option>
	   <option value="Admin">Administrador</option>
	   <option value="Cape">Asesor Ejecutivo de Pacientes</option>
       <option value="Tens">Asistente Médico</option>
       <option value="Caje">Cajero</option>
       <option value="Recep">Recepcionista</option>
	</select>




  <input id="ingr" class="ingr" type="submit" value="Ingresar">
  <a class="vol" href="<?php echo base_url() ?>menu-empleados">Volver</a>

	<?php echo form_close();  ?>
</div>
