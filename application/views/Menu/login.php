<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<img class="backgr" src="<?php echo base_url()?>public/img/overlay.jpg">
<div class="login">
    <img src="<?php echo base_url() ?>public/img/avaria.jpg">
  <?php
      if($this->session->flashdata('ErrorMessage')!='') { ?>
      <div class="error"><?php echo $this->session->flashdata('ErrorMessage'); ?></div>
 <?php } ?>
      <p class="title"></p>
      <?php  
            $attributes = array('id' => 'login'); 
            echo form_open(null,$attributes); 
       ?>
       <input type="text" id="user" name="user" placeholder="Usuario">
       <?php echo form_error("user",'<div class="">','</div>')?>
       <input type="password" id="pass" name="pass" placeholder="Contraseña">
       <?php echo form_error("pass",'<div class="">','</div>')?>
       <span class="boot"><input onclick="logining()" type="button" value="Iniciar Sesión"></span>
<script>
    function logining(){
        usuario = document.getElementById("user").value;
        pass = document.getElementById("pass").value;
        if (usuario.length == 0 || /^\s+$/.test(usuario)) {
            document.getElementById("user").className = "fail";
            document.getElementById("user").placeholder = "El nombre es Necesario";
        }
        if (pass.length == 0 || /^\s+$/.test(pass)) {
            document.getElementById("pass").className = "fail";
            document.getElementById("pass").placeholder = "La contraseña es Necesaria";
        }
        else{
            document.getElementById("login").submit();
        }
    }
</script>
      <?php echo form_close(); ?>
</div>