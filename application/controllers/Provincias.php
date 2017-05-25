<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class provincias extends CI_Controller {

  private $session_id;
  public function __construct()
  {
   parent::__construct();
   $this->session_id =$this->session->userdata('botox');
  }

  public function traeProvincias()
  {
     $options="";
    if($this->input->post('region'))
    {
      $pro=$this->input->post('region');
      $provincias=$this->Provincia->listRegionesProvincia($pro);
      foreach ($provincias as $provincia) {
       ?>
         <option value="<?php echo $provincia->id ?>"><?php echo $provincia->nombre ?></option>
       <?php
      }
    }
  }

}