<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tiempos extends CI_Controller {

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
        
        switch ($dett) {
          case 'Llamada Entrante':
                $datos=array("usuario"=>$user,"tipo"=>"Gestión","descripcion"=>$dett,"tiempo"=>$tFuera);
                $insert=$this->Tiempo->insert($datos);
            break;

          case 'Respondiendo Whatsapp':
                $datos=array("usuario"=>$user,"tipo"=>"Gestión","descripcion"=>$dett,"tiempo"=>$tFuera);
                $insert=$this->Tiempo->insert($datos);
            break;

          case 'Respondiendo Correo':
                $datos=array("usuario"=>$user,"tipo"=>"Gestión","descripcion"=>$dett,"tiempo"=>$tFuera);
                $insert=$this->Tiempo->insert($datos);
            break;

          case 'Descanso':
                $datos=array("usuario"=>$user,"tipo"=>"Administrativo","descripcion"=>$dett,"tiempo"=>$tFuera);
                $insert=$this->Tiempo->insert($datos);
            break;

           case 'Colación':
                $datos=array("usuario"=>$user,"tipo"=>"Administrativo","descripcion"=>$dett,"tiempo"=>$tFuera);
                $insert=$this->Tiempo->insert($datos);
            break;

          case 'Requerimiento administrativo':
                $datos=array("usuario"=>$user,"tipo"=>"Administrativo","descripcion"=>$dett,"tiempo"=>$tFuera);
                $insert=$this->Tiempo->insert($datos);
            break;  
        }

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
      $campana=$this->input->post("campana");
      $cape=$this->input->post("capes1");
      $fechaInicio=$this->input->post("fechaInicio");
      $fechaTermino=$this->input->post("fechaTermino");

      date_default_timezone_set("UTC");
      date_default_timezone_set("America/Santiago");
      $start_date=date("Y-m-d", strtotime($fechaInicio));
      $end_date=date("Y-m-d", strtotime($fechaTermino));

      $tiempos1=$this->Tiempo->tiempoLlamadaCampana($cape,$campana,$start_date,$end_date);
      if($tiempos1->llamada == null){

        $time="00:00:00";

      } else {
        $time=$tiempos1->llamada;
      }
      $tiempos2=$this->Tiempo->tiempoGestionCampana($cape,$campana,$start_date,$end_date);
       if($tiempos2->gestion == null){

        $time1="00:00:00";

      } else {
        $time1=$tiempos2->gestion;
      }
      $tiempos3=$this->Tiempo->tiempoAdministrativoCampana($cape,$campana,$start_date,$end_date);
      if($tiempos3->administrativo == null){

        $time2="00:00:00";

      } else {
        $time2=$tiempos3->administrativo;
      }

      $datos=array("llamada"=>$time,"gestion"=>$time1,"administrativo"=>$time2);
      echo json_encode($datos);
    }
    else
    {
      redirect(base_url(),  301);
    }
  }

  public function traeTiempoCape2()
  {
    $us=$this->session_id;
    $usuario=$this->Usuario->getUsuario($us);
    if( $this->input->post())
    {
      $cape=$this->input->post("capes2");

      $tiempos1=$this->Tiempo->tiempoLlamadaHoy($cape);
      if($tiempos1->llamada == null){

        $time="00:00:00";

      } else {
        $time=$tiempos1->llamada;
      }
      $tiempos2=$this->Tiempo->tiempoGestionHoy($cape);
       if($tiempos2->gestion == null){

        $time1="00:00:00";

      } else {
        $time1=$tiempos2->gestion;
      }
      $tiempos3=$this->Tiempo->tiempoAdministrativoHoy($cape);
      if($tiempos3->administrativo == null){

        $time2="00:00:00";

      } else {
        $time2=$tiempos3->administrativo;
      }

      $datos=array("llamada"=>$time,"gestion"=>$time1,"administrativo"=>$time2);
      echo json_encode($datos);

    }
    else
    {
      redirect(base_url(),  301);
    }
  }
}