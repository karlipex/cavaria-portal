<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="header">
   Información Cuenta:
   <br>
   <label>Nombre : <?php echo $usuario->completo ?></label>
   <br>
   <label>Usuario: <?php echo $usuario->usuario ?></label>
    <?php
      if($this->session->flashdata('ErrorMessage')!='') { ?>
      <div class="error"><?php echo $this->session->flashdata('ErrorMessage'); ?></div>
    <?php } ?>
    <br>
    <?php
	if($this->session->flashdata('ControllerMessage')!='') { ?>
	   <div><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
    <?php } ?>
    <br>

    <?php  echo form_open(null, "update"); ?>

      <input type="password" id="pass" name="pass" placeholder="Contraseña Actual">
      <?php echo form_error("pass",'<div class="">','</div>')?>
      <br>
      <input type="password" id="pass1" name="pass1" placeholder="Contraseña Nueva">
      <?php echo form_error("pass1",'<div class="">','</div>')?>
      <br>
      <input type="password" id="pass2" name="pass2" placeholder="Confirme Contraseña">
      <?php echo form_error("pass2",'<div class="">','</div>')?>
      <br>
      <span class="boot"><input type="submit" value="Cambiar Password"></span>

    <?php echo form_close(); ?>


</div>