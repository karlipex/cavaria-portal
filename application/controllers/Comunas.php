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
    if($this->input->post('provincia'))
    {
      $pro=$this->input->post('provincia');
      $comunas=$this->Comuna->listComunaProvincias($pro);
      foreach ($comunas as $comuna)
      {  ?>
          <option value="<?php echo $comuna->id ?>"><?php echo $comuna->nombre ?></option>
      <?php
      }
    }
  }

}