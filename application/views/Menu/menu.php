<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
  switch ($usuario->permisos) {
    case '1000':
    ?>
   
    <?php     
        break;
    
    case '1001':
    ?>
    <div class="header">
     <img src="<?php echo base_url() ?>public/img/avarialong.jpg">
     <select>
        <option>Elige una opción</option>
        <option>No contesta</option>
        <option>Agenda</option>
        <option>Llamar mas tarde</option>
        <option>Corta llamada</option>
        <option>Numero equivocado</option>
        <option>Solo cotizar</option>
        <option>Cirugia</option>
        <option>Enfermedades autoinmunes</option>
        <option>No agenda</option>
        <option>EV. Gratis</option>
     </select>  
    </div>
    <div class="data">
        <div>Fecha: {dato}</div>
        <div>Campaña: {dato}</div>
        <div>Nombre: {dato}</div>
        <div>Teléfono: {dato}</div>
        <div>e-mail: {dato}</div>
        <div>Tratamiento: {dato}</div>
    </div>
      
    <?php
        break;

}
?>



  <!--

--->
