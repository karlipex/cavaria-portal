<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comunas extends CI_Controller {

  private $session_id;
  public function __construct()
  {
   parent::__construct();
   $this->session_id =$this->session->userdata('botox');
  }

  public function traeComunas()
  {

      if(!empty($_POST["keyword"])) {
      $comunas=$this->Comuna->listComuna($_POST["keyword"]); ?>
      <ul id="country-list">
      <?php
      if($comunas != 0)
      {
        foreach ($comunas as $comuna)
        {  ?>
            <li onClick="selectCiudad('<?php echo $comuna->nombre ?>')"><?php echo $comuna->nombre ?></li>
        <?php
        }
      }
      else
      {
      ?>
           <li>No existen coincidencias</li>
      <?php
      }
      ?>
      </ul>
      <?php
    }
  }

}