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
      <li><input type="date" id="fecha" name="fecha"></li>
     </section>
    <section>
      <div>
          <h3><?php echo $countNew ?></h3>
          <p>Nuevos Contactos</p>

          <div>
             <a>Mas info</a>
          </div>
      </div>
      <div>
          <h3><?php echo $countCall ?></h3>
          <p>Total llamados</p>

          <div>
             <a>Mas info</a>
          </div>
      </div>
      <div>
          <h3><?php echo $countAgend ?></h3>
          <p>Total Agendados</p>

          <div>
             <a>Mas info</a>
          </div>
      </div>
      <div>
          <h3><?php echo $countNotCall ?></h3>
          <p>No llamar mas </p>

          <div>
             <a>Mas info</a>
          </div>
      </div>
    </section>
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
