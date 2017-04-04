<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Llamadas extends CI_Controller {

  private $session_id;
  public function __construct()
  {
   parent::__construct();
   $this->session_id =$this->session->userdata('botox');
  }

  public function nueva()
  {
    if(!empty($this->session_id))
    {
       $us=$this->session_id;
       $usuario=$this->Usuario->getUsuario($us);
      if( $this->input->post())
      {
          date_default_timezone_set("UTC");
          date_default_timezone_set("America/Santiago");
          $fechaLLamada=date("Y-m-d H:i:s");
          $contacto=$this->input->post("idcontacto");
          $option=$this->input->post("option");
          $status=$this->input->post("stat");
          $tiempo=$this->input->post("tiempo");
          switch ($status) {
            case 'No contesta':
                    
                     $nuevaIteracion=date("Y-m-d H:i:s",(strtotime("+3 Hours")));
                     $tope=date('Y-m-d 19:00:00');
                     $llamada=date('Y-m-d '.$tiempo.'');
                     if($tope > $nuevaIteracion){
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'nuevaIteracion'=>$nuevaIteracion,'estado'=>'No contesta');
                     } else {
                         $nuevaIteracion=date("Y-m-d H:i:s",(strtotime("+16 Hours")));
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'nuevaIteracion'=>$nuevaIteracion,'estado'=>'No contesta');
                     }
                     $update=$this->Contacto->update($datos1,$contacto);
                     $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'No contesta');
                     $insert1=$this->Llamada->insert($datos2);
                     if ($insert1 != 0) {

                         $ip =$this->input->ip_address();
                         $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                         $insert=$this->Accion->insert($datos);

                         $datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Llamada a contacto, no contesta.');
                         $insert2=$this->HistorialLlamada->insert($datos2);
                     }


              break;

            case 'Contesta, pero llama después':
                   echo "Contesta, pero llama después";
                   exit;
              break;

            case 'Buzón de voz':
                    echo $tiempo;
                    exit;
                   $nuevaIteracion=date("Y-m-d H:i:s",(strtotime("+5 Hours")));
                   $tope=date('Y-m-d 19:00:00');
                   $llamada=date('Y-m-d '.$tiempo.'');
                   if($tope > $nuevaIteracion){
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'nuevaIteracion'=>$nuevaIteracion,'estado'=>'Buzón de voz');
                    } else {
                         $nuevaIteracion=date("Y-m-d H:i:s",(strtotime("+21 Hours")));
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'nuevaIteracion'=>$nuevaIteracion,'estado'=>'Buzón de voz');
                    }
                     $update=$this->Contacto->update($datos1,$contacto);
                     $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Buzón de voz');
                     $insert1=$this->Llamada->insert($datos2);
                     if ($insert1 != 0) {

                         $ip =$this->input->ip_address();
                         $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                         $insert=$this->Accion->insert($datos);

                         $datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Llamada a contacto, buzón de voz.');
                         $insert2=$this->HistorialLlamada->insert($datos2);
                     }

              break;

            case 'Llamará':

                     $nuevaIteracion=date("Y-m-d 10:00:00",(strtotime("+7 Days")));
                     $llamada=date('Y-m-d '.$tiempo.'');
                     $datos1=array('fechaLLamada'=>$fechaLLamada,'nuevaIteracion'=>$nuevaIteracion,'estado'=>'Llamará');
                     $update=$this->Contacto->update($datos1,$contacto);
                     $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Llamará');
                     $insert1=$this->Llamada->insert($datos2);
                     if ($insert1 != 0) {

                         $ip =$this->input->ip_address();
                         $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                         $insert=$this->Accion->insert($datos);

                         $datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Llamada a contacto, Llamará.');
                         $insert2=$this->HistorialLlamada->insert($datos2);
                     }

                    
                   exit;
              break;

            case 'Embarazada':
                  echo "Embarazada";
                  exit;
            break;
          }
          
      } 
    }
    else
    {
      redirect(base_url(),  301);	
    }
  }

  public function traeLlamadas($id)
  {
    if(!empty($this->session_id))
    {
      $llamadas=$this->Llamada->listLlamadasContacto($id);

      echo json_encode($llamadas);

    }
    else
    {
      redirect(base_url(),  301);
    }
  }

}