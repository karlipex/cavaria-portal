<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class externos extends CI_Controller {

public function __construct()
  {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
    }
    parent::__construct();
  }

 public function getFacebook()
  {
    try
    {
        $email=$this->input->get("contact[email]");
        $nombre=$this->input->get("contact[first_name]");
        $apellido=$this->input->get("contact[last_name]");
        $fono=$this->input->get("contact[phone]");
        $promo=$this->input->get("contact[fields][14]");
        $descuento=$this->input->get("contact[fields][15]");
        $completo=$nombre." ".$apellido;
        $campana="Campaña Facebook";

        date_default_timezone_set("UTC");
        date_default_timezone_set("America/Santiago");
        $nuevaIteracion=date("Y-m-d H:i:s");

        $datos=array("nombre"=>$completo,"email"=>$email,"telefono"=>$fono,"tratamiento"=>$promo,"descuento"=>$descuento,"campana"=>$campana,'nuevaIteracion'=>$nuevaIteracion,"origen"=>"Nuevo Contacto","fechaIngreso"=>$nuevaIteracion,"fechallamada"=>"0000-00-00 00:00:00","orden"=>2,"prioridad"=>2,"dias"=>0,"estado"=>"En espera de llamado","ocupado"=>"N","cita"=>0,"usuario"=>1001);
         $insert=$this->Contacto->insert($datos);

         $datos2=array('contacto'=>$insert,'usuario'=>1001,'fecha'=>$nuevaIteracion,'tipo'=>'Nuevo Contacto','estado'=>'En espera de llamado');
         $insert2=$this->Con1->insert($datos2); 

         echo "todo bien";
      }
      catch(Exception $e)
      {
         var_dump($e->getMessage());
      }
  }

}