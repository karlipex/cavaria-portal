<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es-CL">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->layout->getTitle(); ?></title>  
    <meta name="application-name" content="Sistema de inventario">
    <meta name="author" content="Felipe Meza Mora">
    <meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
    <meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
    <link rel="shorcut icon" href="<?php echo base_url()?>public/img/favicon.jpg">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:100,200,300,400" rel="stylesheet">
    
<!--*************auxiliares*****************-->

<?php echo $this->layout->css; ?> 

<?php echo $this->layout->js; ?> 

<!--**********fin auxiliares*****************-->
</head>
<body>
<img class="fondo" src="<?php echo base_url()?>public/img/maxresdefault.jpg">
    <p class="hola">Hola, <?php echo $usuario->completo ?>  &nbsp;</p><span class="sp" id="sp" onclick="options()"> &or;</span>
    <div class="option" id="op">
        <a onclick="change()">Cambiar Contraseña</a>
        <a href="<?php echo base_url() ?>logout">Cerrar Sesion</a>
    </div>
    <div class="header">
     <img src="<?php echo base_url() ?>public/img/avarialong.jpg">
     <?php switch ($usuario->permisos) {
         case '1000':
             ?> 
               <a href="<?php echo base_url()?>menu-contactos">
                <div class="cont-ico">
                        <img src="<?php echo base_url() ?>public/img/menus/con-azul.png">
                    <p>Contactos</p>
                   </div>
        </a>
             <?php
             break;

         case '1001':
              ?> 
               <a href="<?php echo base_url()?>menu-contactos">
                   <div class="cont-ico">
                        <img src="<?php echo base_url() ?>public/img/menus/con-azul.png">
                    <p>Contactos</p>
                   </div>
                </a>
             <?php
             break;

     } ?>

       

    </div>
<?php echo $content_for_layout; ?>
    <div id="modalback" class="modalback">
        <div class="box">
            <div id="forma">
            <h2>Cambio Password</h2>
            <label><b>Nombre:</b> <?php echo $usuario->completo ?></label>
           <br>
           <label><b>Usuario:</b> <?php echo $usuario->usuario ?></label>
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
              <?php echo form_error("pass",'<div class="falta">','</div>')?>
              <input type="password" id="pass1" name="pass1" placeholder="Contraseña Nueva">
              <?php echo form_error("pass1",'<div class="falta">','</div>')?>
              <input type="password" id="pass2" name="pass2" placeholder="Confirme Contraseña">
              <?php echo form_error("pass2",'<div class="falta">','</div>')?>
              <span class="boot"><input type="button" value="Cambiar Password" onclick="presend()"></span>
            <span class="cierra" onclick="closemodal()">x</span>
            </div>
              <div class="oculto" id="advise">
                <h2>¿Seguro quieres realizar esta acción</h2>
                  <input class="bouts" type="submit" value="Sí">
                  <input class="bouts" type="button" value="No" onclick="location.reload();">
                </div>  
            <?php echo form_close(); ?>
        </div>
    </div>
</body>
</html>
<script>
    function change(){
        document.getElementById("modalback").classList.add("abremodal");
    }
    function closemodal(){
        document.getElementById("modalback").classList.remove("abremodal");
    }
    function presend(){
        pass = document.getElementById("pass").value;
        pass1 = document.getElementById("pass1").value;
        pass2 = document.getElementById("pass2").value;
        if (pass.length == 0 || /^\s+$/.test(pass)) {
            document.getElementById("pass").className = "fail";
            document.getElementById("pass").placeholder = "Este campo es Necesario";
        }
        if (pass1.length == 0 || /^\s+$/.test(pass1)) {
            document.getElementById("pass1").className = "fail";
            document.getElementById("pass1").placeholder = "Este campo es Necesario";
        }
        if (pass2.length == 0 || /^\s+$/.test(pass2)) {
            document.getElementById("pass2").className = "fail";
            document.getElementById("pass2").placeholder = "Este campo es Necesario";
        }else{
            document.getElementById("forma").classList.add("oculto");
            document.getElementById("advise").classList.add("libre");
        }
    }
</script>