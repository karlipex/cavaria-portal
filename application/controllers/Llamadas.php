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
                     $fecha=date("d-m-Y  H:i", strtotime($nuevaIteracion));
                     if($tope > $nuevaIteracion){
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'estado'=>'No contesta');
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
                         $traeContacto=$this->Contacto->getContacto($contacto);
                         echo json_encode($traeContacto);
                         //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Llamada a contacto, no contesta.');
                         //$insert2=$this->HistorialLlamada->insert($datos2);
                     }


              break;

            case 'Contesta, pero llama después':
                    
                      $newDate=$this->input->post("newDate");
                      $newTime=$this->input->post("newTime");
                      $llamada=date('Y-m-d '.$tiempo.'');
                      $nuevaIteracion=$newDate." ".$newTime.":00";
                      $fecha=date("d-m-Y  H:i", strtotime($nuevaIteracion));
                      $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'estado'=>'Contesta, pero llama después');
                      $update=$this->Contacto->update($datos1,$contacto);
                    
                      $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Contesta, pero llama después');
                      $insert1=$this->Llamada->insert($datos2);
                     if ($insert1 != 0) {

                         $ip =$this->input->ip_address();
                         $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                         $insert=$this->Accion->insert($datos);

                         $traeContacto=$this->Contacto->getContacto($contacto);
                         echo json_encode($traeContacto);

                         //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Llamada a contacto, contesta, pero llama después.');
                         //$insert2=$this->HistorialLlamada->insert($datos2);
                     }
                     
              break;

            case 'Buzón de voz':

                   $nuevaIteracion=date("Y-m-d H:i:s",(strtotime("+5 Hours")));
                   $tope=date('Y-m-d 19:00:00');
                   $llamada=date('Y-m-d '.$tiempo.'');
                   $fecha=date("d-m-Y  H:i", strtotime($nuevaIteracion));
                   if($tope > $nuevaIteracion){
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'estado'=>'Buzón de voz');
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

                         $traeContacto=$this->Contacto->getContacto($contacto);
                         echo json_encode($traeContacto);

                         //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Llamada a contacto, buzón de voz.');
                         //$insert2=$this->HistorialLlamada->insert($datos2);
                     }

              break;

            case 'Llamará':

                     $nuevaIteracion=date("Y-m-d 10:00:00",(strtotime("+7 Days")));
                     $llamada=date('Y-m-d '.$tiempo.'');
                     $fecha=date("d-m-Y  H:i", strtotime($nuevaIteracion));
                     $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'estado'=>'Llamará');
                     $update=$this->Contacto->update($datos1,$contacto);

                     $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Llamará');
                     $insert1=$this->Llamada->insert($datos2);
                     if ($insert1 != 0) {

                         $ip =$this->input->ip_address();
                         $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                         $insert=$this->Accion->insert($datos);

                         $traeContacto=$this->Contacto->getContacto($contacto);
                         echo json_encode($traeContacto);

                         //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Llamada a contacto, Llamará.');
                         //$insert2=$this->HistorialLlamada->insert($datos2);
                     }

                    
                   exit;
              break;

            case 'Embarazada':
                  
                   $newDate=$this->input->post("newDate");
                   $newTime=$this->input->post("newTime");
                   $llamada=date('Y-m-d '.$tiempo.'');
                   $nuevaIteracion=date($newDate." ".$newTime.":00");
                   $fecha=date("d-m-Y  H:i", strtotime($nuevaIteracion));
                   $datos1=array('fechaLLamada'=>$fechaLLamada,'nuevaIteracion'=>$nuevaIteracion,'obs'=>'Próximo llamado el: '.$fecha,'estado'=>'Embarazada');
                   $update=$this->Contacto->update($datos1,$contacto);
                    
                   $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Embarazada');
                   $insert1=$this->Llamada->insert($datos2);
                   if ($insert1 != 0) {

                      $ip =$this->input->ip_address();
                      $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                      $insert=$this->Accion->insert($datos);

                      $traeContacto=$this->Contacto->getContacto($contacto);
                      echo json_encode($traeContacto);

                      //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Llamada a contacto, Embarazada.');
                      //$insert2=$this->HistorialLlamada->insert($datos2);
                    }
            break;

            case 'Agenda':

                  $llamada=date('Y-m-d '.$tiempo.'');
                  $idMedilink=$this->input->post("age");
                  $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Agendo Cita N°: '.$idMedilink,'estado'=>'Agenda');
                  $update=$this->Contacto->update($datos1,$contacto);
                  $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Agenda');
                  $insert1=$this->Llamada->insert($datos2);
                  if ($insert1 != 0) {

                      $ip =$this->input->ip_address();
                      $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                      $insert=$this->Accion->insert($datos);

                      $traeContacto=$this->Contacto->getContacto($contacto);
                      echo json_encode($traeContacto);

                      //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Agendo, cita N°:'.$idMedilink);
                      //$insert2=$this->HistorialLlamada->insert($datos2);
                    }
                  
            break;

            case 'Solicita no llamar de nuevo':
                 
                  $llamada=date('Y-m-d '.$tiempo.'');
                  $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Solicita no llamar de nuevo ','estado'=>'No llamar más');
                  $update=$this->Contacto->update($datos1,$contacto);

                  $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Solicita no llamar de nuevo');
                  $insert1=$this->Llamada->insert($datos2);
                  if ($insert1 != 0) {

                      $ip =$this->input->ip_address();
                      $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                      $insert=$this->Accion->insert($datos);

                      $traeContacto=$this->Contacto->getContacto($contacto);
                      echo json_encode($traeContacto);

                      //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                      //$insert2=$this->HistorialLlamada->insert($datos2);
                    }
            break;

            case 'Solo cotizando':

                  $llamada=date('Y-m-d '.$tiempo.'');
                  $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Solo cotizando ','estado'=>'No llamar más');
                  $update=$this->Contacto->update($datos1,$contacto);

                  $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Solo cotizando');
                  $insert1=$this->Llamada->insert($datos2);
                  if ($insert1 != 0) {

                      $ip =$this->input->ip_address();
                      $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                      $insert=$this->Accion->insert($datos);

                      $traeContacto=$this->Contacto->getContacto($contacto);
                      echo json_encode($traeContacto);

                      //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                      //$insert2=$this->HistorialLlamada->insert($datos2);
                    }
            break;

            case 'De otra ciudad':
                  
                  $ciudad=$this->input->post('city');
                  $llamada=date('Y-m-d '.$tiempo.'');
                  $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'De otra ciudad : '.$ciudad,'estado'=>'No llamar más');
                  $update=$this->Contacto->update($datos1,$contacto);

                  $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'De otra ciudad');
                  $insert1=$this->Llamada->insert($datos2);
                  if ($insert1 != 0) {

                      $ip =$this->input->ip_address();
                      $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                      $insert=$this->Accion->insert($datos);

                      $traeContacto=$this->Contacto->getContacto($contacto);
                      echo json_encode($traeContacto);

                      //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                      //$insert2=$this->HistorialLlamada->insert($datos2);
                    }
            break;

            case 'Enfermedad autoinmune':

                $llamada=date('Y-m-d '.$tiempo.'');
                $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Enfermedad autoinmune ','estado'=>'No llamar más');
                $update=$this->Contacto->update($datos1,$contacto);

                $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Enfermedad autoinmune');
                $insert1=$this->Llamada->insert($datos2);
                if ($insert1 != 0) {

                    $ip =$this->input->ip_address();
                    $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                    $insert=$this->Accion->insert($datos);

                    $traeContacto=$this->Contacto->getContacto($contacto);
                    echo json_encode($traeContacto);

                      //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                      //$insert2=$this->HistorialLlamada->insert($datos2);
                    }
            break;

             case 'Solo curiosidad':

                $llamada=date('Y-m-d '.$tiempo.'');
                $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Solo curiosidad','estado'=>'No llamar más');
                $update=$this->Contacto->update($datos1,$contacto);

                $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Solo curiosidad');
                $insert1=$this->Llamada->insert($datos2);
                if ($insert1 != 0) {

                    $ip =$this->input->ip_address();
                    $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                    $insert=$this->Accion->insert($datos);

                     $traeContacto=$this->Contacto->getContacto($contacto);
                     echo json_encode($traeContacto);

                      //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                      //$insert2=$this->HistorialLlamada->insert($datos2);
                    }
            break;

            case 'Fuera de presupuesto':
                  
                $presupuesto= $this->input->post("prest");
                $llamada=date('Y-m-d '.$tiempo.'');
                $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Fuera de presupuesto, estimado a pagar: '.$presupuesto,'estado'=>'No llamar más');
                $update=$this->Contacto->update($datos1,$contacto);

                $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Fuera de presupuesto');
                $insert1=$this->Llamada->insert($datos2);
                if ($insert1 != 0) {

                    $ip =$this->input->ip_address();
                    $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                    $insert=$this->Accion->insert($datos);

                     $traeContacto=$this->Contacto->getContacto($contacto);
                     echo json_encode($traeContacto);

                      //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                      //$insert2=$this->HistorialLlamada->insert($datos2);
                    }


            break;

            case 'No tengo dinero':
               
               $llamada=date('Y-m-d '.$tiempo.'');
               $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'No tengo dinero','estado'=>'No llamar más');
               $update=$this->Contacto->update($datos1,$contacto);

               $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'No tengo dinero');
               $insert1=$this->Llamada->insert($datos2);
               if ($insert1 != 0) {

                $ip =$this->input->ip_address();
                $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                $insert=$this->Accion->insert($datos);

                 $traeContacto=$this->Contacto->getContacto($contacto);
                 echo json_encode($traeContacto);

                  //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                  //$insert2=$this->HistorialLlamada->insert($datos2);
                }

            break;

            case 'Ya se lo hizo':
                  
              $llamada=date('Y-m-d '.$tiempo.'');
              $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Ya se lo hizo','estado'=>'No llamar más');
              $update=$this->Contacto->update($datos1,$contacto);

              $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Ya se lo hizo');
              $insert1=$this->Llamada->insert($datos2);
              if ($insert1 != 0) {

               $ip =$this->input->ip_address();
               $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
               $insert=$this->Accion->insert($datos);

                $traeContacto=$this->Contacto->getContacto($contacto);
                echo json_encode($traeContacto);

                //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                //$insert2=$this->HistorialLlamada->insert($datos2);
              }   

            break;

            case 'Ya lo llamaron':

              $llamada=date('Y-m-d '.$tiempo.'');
              $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Ya lo llamaron','estado'=>'No llamar más');
              $update=$this->Contacto->update($datos1,$contacto);

              $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Ya lo llamaron');
              $insert1=$this->Llamada->insert($datos2);
              if ($insert1 != 0) {

               $ip =$this->input->ip_address();
               $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
               $insert=$this->Accion->insert($datos);

                $traeContacto=$this->Contacto->getContacto($contacto);
                echo json_encode($traeContacto);

                //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                //$insert2=$this->HistorialLlamada->insert($datos2);
              }
                
            break;

            case 'Número no corresponde':

              $llamada=date('Y-m-d '.$tiempo.'');
              $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Número no corresponde','estado'=>'No llamar más');
              $update=$this->Contacto->update($datos1,$contacto);

              $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Número no corresponde');
              $insert1=$this->Llamada->insert($datos2);
              if ($insert1 != 0) {

               $ip =$this->input->ip_address();
               $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
               $insert=$this->Accion->insert($datos);

                $traeContacto=$this->Contacto->getContacto($contacto);
                echo json_encode($traeContacto);

                //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                //$insert2=$this->HistorialLlamada->insert($datos2);
              }
            break;
            
            case 'Prestación no existe':
              
              $prestacion=$this->input->post("prest");    
              $llamada=date('Y-m-d '.$tiempo.'');
              $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Prestación no existe: '.$prestacion,'estado'=>'No llamar más');
              $update=$this->Contacto->update($datos1,$contacto);

              $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Prestación no existe');
              $insert1=$this->Llamada->insert($datos2);
              if ($insert1 != 0) {

               $ip =$this->input->ip_address();
               $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
               $insert=$this->Accion->insert($datos);

                $traeContacto=$this->Contacto->getContacto($contacto);
                echo json_encode($traeContacto);

                //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                //$insert2=$this->HistorialLlamada->insert($datos2);
              }

            break;

            case 'Pensó que la evaluación era gratis':

              $llamada=date('Y-m-d '.$tiempo.'');
              $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Pensó que la evaluación era gratis','estado'=>'No llamar más');
              $update=$this->Contacto->update($datos1,$contacto);

              $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Pensó que la evaluación era gratis');
              $insert1=$this->Llamada->insert($datos2);
              if ($insert1 != 0) {

               $ip =$this->input->ip_address();
               $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
               $insert=$this->Accion->insert($datos);

                $traeContacto=$this->Contacto->getContacto($contacto);
                echo json_encode($traeContacto);

                //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Solicita no llamar de nuevo');
                //$insert2=$this->HistorialLlamada->insert($datos2);
              }

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