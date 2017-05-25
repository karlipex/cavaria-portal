<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class regiones extends CI_Controller {

  private $session_id;
  public function __construct()
  {
   parent::__construct();
   $this->session_id =$this->session->userdata('botox');
  }

  public function getRegiones()
  {
    $regiones=$this->Region->listRegiones();
    echo json_encode($regiones);
  }

}