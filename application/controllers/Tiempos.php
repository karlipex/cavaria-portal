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
        $datos=array("usuario"=>$user,"tipo"=>"Tiempo muerto","descripcion"=>$dett,"tiempo"=>$tFuera);
        $insert=$this->Tiempo->insert($datos);
      }
    }
    else
    {
      redirect(base_url(),  301);
    }
  }

  public function traeTiempoCape()
  {
    $us=$this->session_id;
    $usuario=$this->Usuario->getUsuario($us);
    if( $this->input->post())
    {
      $cape=$this->input->post("capes1");
      $fechaInicio=$this->input->post("fechaInicio");
      $fechaTermino=$this->input->post("fechaTermino");

      date_default_timezone_set("UTC");
      date_default_timezone_set("America/Santiago");
      $start_date=date("Y-m-d", strtotime($fechaInicio));
      $end_date=date("Y-m-d", strtotime($fechaTermino));

      $tiempos1=$this->Tiempo->tiempoLlamada($cape,$start_date,$end_date);
      if($tiempos1->llamada == null){

        $time="00:00:00";

      } else {
        $time=$tiempos1->llamada;
      }
      $tiempos2=$this->Tiempo->tiempoMuerto($cape,$start_date,$end_date);
       if($tiempos2->muerto == null){

        $time1="00:00:00";

      } else {
        $time1=$tiempos2->muerto;
      }
      $datos=array("llamada"=>$time,"muerto"=>$time1);
      echo json_encode($datos);
      exit;

    }
    else
    {
      redirect(base_url(),  301);
    }
  }
}