<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiempos extends CI_Controller {

  private $session_id;
  public function __construct()
  {
   parent::__construct();
   $this->session_id =$this->session->userdata('botox');
  }


  public function insertTime()
  {
  	if(!empty($this->session_id))
    {
       $us=$this->session_id;
       $usuario=$this->Usuario->getUsuario($us);
      if( $this->input->post())
      {
        date_default_timezone_set("UTC");
        date_default_timezone_set("America/Santiago");
      	$tiempo=$this->input->post("time");
        $tFuera=date('Y-m-d '.$tiempo.'');
      	$dett=$this->input->post("stte");
      	$user=$usuario->idusuario;
        $datos=array("usuario"=>$user,"descripcion"=>$dett,"tiempo"=>$tFuera);
        $insert=$this->Tiempo->insert($datos);
      }
    }
    else
    {
      redirect(base_url(),  301);
    }
  }
}