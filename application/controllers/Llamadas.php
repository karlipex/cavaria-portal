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
          $user=$usuario->idusuario;
          $getContacto=$this->Contacto->getContacto($contacto);
          switch ($status) {
            case 'No contesta':
                    
                     $nuevaIteracion=date("Y-m-d H:i:s",(strtotime("+3 Hours")));
                     $tope=date('Y-m-d 19:00:00');
                     $llamada=date('Y-m-d '.$tiempo.'');
                     $fecha=date("d-m-Y  H:i", strtotime($nuevaIteracion));
                     if($tope > $nuevaIteracion){
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'orden'=>1,'prioridad'=>3,'estado'=>'No contesta','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                         $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'No contesta');
                         $insertx=$this->Llam->insert($datosx);

                     } else {
                         $nuevaIteracion=date("Y-m-d H:i:s",(strtotime("+16 Hours")));
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'orden'=>1,'prioridad'=>3,'estado'=>'No contesta','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                         $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'No contesta');
                         $insertx=$this->Llam->insert($datosx);
                        
                         $datosx1=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$nuevaIteracion,'tipo'=>$getContacto->origen,'estado'=>'No contesta');
                         $insertx1=$this->Con1->insert($datosx1);


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
                         $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'No contesta',"tiempo"=>$llamada);
                         $insert2=$this->Tiempo->insert($datos3);
                     }


              break;

            case 'Contesta, pero llama después':
                    
                      $newDate=$this->input->post("newDate");
                      $newTime=$this->input->post("newTime");
                      $llamada=date('Y-m-d '.$tiempo.'');
                      $nuevaIteracion=$newDate." ".$newTime.":00";
                      $fecha=date("d-m-Y  H:i", strtotime($nuevaIteracion));
                      $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'orden'=>1,'prioridad'=>1,'estado'=>'Contesta, pero llama después','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                      $update=$this->Contacto->update($datos1,$contacto);

                         $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Constesta, pero llama despúes');
                         $insertx=$this->Llam->insert($datosx);
                        
                         $datosx1=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$nuevaIteracion,'tipo'=>$getContacto->origen,'estado'=>'Contesta, pero llama después');
                         $insertx1=$this->Con1->insert($datosx1);

                         $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Constesta, pero llama despúes');
                         $insertx2=$this->Cont->insert($datosx2);
                    
                      $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Contesta, pero llama después');
                      $insert1=$this->Llamada->insert($datos2);
                     if ($insert1 != 0) {

                         $ip =$this->input->ip_address();
                         $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                         $insert=$this->Accion->insert($datos);
                         $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Contesta, pero llama después',"tiempo"=>$llamada);
                         $insert2=$this->Tiempo->insert($datos3);

                         $traeContacto=$this->Contacto->getContacto($contacto);
                         echo json_encode($traeContacto);

                     }
                     
              break;

            case 'Buzón de voz':

                   $nuevaIteracion=date("Y-m-d H:i:s",(strtotime("+5 Hours")));
                   $tope=date('Y-m-d 19:00:00');
                   $llamada=date('Y-m-d '.$tiempo.'');
                   $fecha=date("d-m-Y  H:i", strtotime($nuevaIteracion));
                   if($tope > $nuevaIteracion){
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'orden'=>1,'prioridad'=>4,'estado'=>'Buzón de voz','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                         $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Buzón de voz');
                         $insertx=$this->Llam->insert($datosx);
                    } else {
                         $nuevaIteracion=date("Y-m-d H:i:s",(strtotime("+21 Hours")));
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'orden'=>1,'prioridad'=>4,'estado'=>'Buzón de voz','ocupado'=>'N',"usuario"=>$usuario->idusuario);

                         $datosx=array('contacto'=>$contacto,'usuario'=>$user,'tipo'=>$getContacto->origen,'estado'=>'Buzón de voz');
                         $insertx=$this->Llam->insert($datosx);
                        
                         $datosx1=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$nuevaIteracion,'tipo'=>$getContacto->origen,'estado'=>'Buzón de voz');
                         $insertx1=$this->Con1->insert($datosx1);

                    }
                     $update=$this->Contacto->update($datos1,$contacto);

                     $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Buzón de voz');
                     $insert1=$this->Llamada->insert($datos2);
                     if ($insert1 != 0) {

                         $ip =$this->input->ip_address();
                         $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                         $insert=$this->Accion->insert($datos);

                         $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Buzón de voz',"tiempo"=>$llamada);
                         $insert2=$this->Tiempo->insert($datos3);

                         $traeContacto=$this->Contacto->getContacto($contacto);
                         echo json_encode($traeContacto);

                     }

              break;

            case 'Llamará':

                     $nuevaIteracion=date("Y-m-d 10:00:00",(strtotime("+7 Days")));
                     $llamada=date('Y-m-d '.$tiempo.'');
                     $fecha=date("d-m-Y  H:i", strtotime($nuevaIteracion));
                     $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'estado'=>'Llamará','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                     $update=$this->Contacto->update($datos1,$contacto);

                         $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Llamará');
                         $insertx=$this->Llam->insert($datosx);
                        
                         $datosx1=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$nuevaIteracion,'tipo'=>$getContacto->origen,'estado'=>'Llamará');
                         $insertx1=$this->Con1->insert($datosx1);

                         $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Llamará');
                         $insertx2=$this->Cont->insert($datosx2);

                     $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Llamará');
                     $insert1=$this->Llamada->insert($datos2);
                     if ($insert1 != 0) {

                         $ip =$this->input->ip_address();
                         $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                         $insert=$this->Accion->insert($datos);

                         $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Llamará',"tiempo"=>$llamada);
                         $insert2=$this->Tiempo->insert($datos3);

                         $traeContacto=$this->Contacto->getContacto($contacto);
                         echo json_encode($traeContacto);

                         //$datos2=array('contacto'=>$contacto,'usuario'=>$usuario->idusuario,'accion'=>'Llamada a contacto, Llamará.');
                         //$insert2=$this->HistorialLlamada->insert($datos2);
                     }
              break;

              case 'Corta llamada':
                     
                     $nuevaIteracion=date("Y-m-d H:i:s",(strtotime("+3 Hours")));
                     $tope=date('Y-m-d 19:00:00');
                     $llamada=date('Y-m-d '.$tiempo.'');
                     $fecha=date("d-m-Y  H:i", strtotime($nuevaIteracion));
                     if($tope > $nuevaIteracion){
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'orden'=>1,'prioridad'=>5,'estado'=>'Corta llamada','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                         $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Corta llamada');
                         $insertx=$this->Llam->insert($datosx);
                     } else {
                         $nuevaIteracion=date("Y-m-d H:i:s",(strtotime("+16 Hours")));
                         $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'orden'=>1,'prioridad'=>5,'estado'=>'Corta llamada','ocupado'=>'N',"usuario"=>$usuario->idusuario);

                         $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Corta llamada');
                         $insertx=$this->Llam->insert($datosx);
                        
                         $datosx1=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$nuevaIteracion,'tipo'=>$getContacto->origen,'estado'=>'Corta llamada');
                         $insertx1=$this->Con1->insert($datosx1);
                     }
                     $update=$this->Contacto->update($datos1,$contacto);

                     $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Corta llamada');
                     $insert1=$this->Llamada->insert($datos2);
                     if ($insert1 != 0) {

                         $ip =$this->input->ip_address();
                         $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                         $insert=$this->Accion->insert($datos);

                         $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Corta llamada',"tiempo"=>$llamada);
                         $insert2=$this->Tiempo->insert($datos3);

                         $traeContacto=$this->Contacto->getContacto($contacto);
                         echo json_encode($traeContacto);
                     }


              break;

            case 'Embarazada':
                  
                   $newDate=$this->input->post("newDate");
                   $newTime=$this->input->post("newTime");
                   $llamada=date('Y-m-d '.$tiempo.'');
                   $nuevaIteracion=date($newDate." ".$newTime.":00");
                   $fecha=date("d-m-Y  H:i", strtotime($nuevaIteracion));
                   $datos1=array('fechaLLamada'=>$fechaLLamada,'obs'=>'Próximo llamado el: '.$fecha,'nuevaIteracion'=>$nuevaIteracion,'orden'=>1,'prioridad'=>6,'estado'=>'Embarazada','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                   $update=$this->Contacto->update($datos1,$contacto);

                         $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Embarazada');
                         $insertx=$this->Llam->insert($datosx);
                        
                         $datosx1=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$nuevaIteracion,'tipo'=>$getContacto->origen,'estado'=>'Embarazada');
                         $insertx1=$this->Con1->insert($datosx1);

                         $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Embarazada');
                         $insertx2=$this->Cont->insert($datosx2);
                    
                   $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Embarazada');
                   $insert1=$this->Llamada->insert($datos2);
                   if ($insert1 != 0) {

                      $ip =$this->input->ip_address();
                      $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                      $insert=$this->Accion->insert($datos);

                      $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Embarazada',"tiempo"=>$llamada);
                      $insert2=$this->Tiempo->insert($datos3);

                      $traeContacto=$this->Contacto->getContacto($contacto);
                      echo json_encode($traeContacto);

                    }
            break;

            case 'Agenda':

                  $llamada=date('Y-m-d '.$tiempo.'');
                  $idMedilink=$this->input->post("age");
                  $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>3,'obs'=>'Agendo Cita N°: '.$idMedilink,'estado'=>'Agenda','ocupado'=>'N','cita'=>$idMedilink,"usuario"=>$usuario->idusuario);
                  $update=$this->Contacto->update($datos1,$contacto);

                  $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Agenda');
                  $insertx=$this->Llam->insert($datosx);

                  $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Agenda');
                  $insertx2=$this->Cont->insert($datosx2);

                  $datosx3=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Agenda');
                  $insertx3=$this->Agen->insert($datosx3);

                  $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Agenda');
                  $insert1=$this->Llamada->insert($datos2);
                  if ($insert1 != 0) {

                      $ip =$this->input->ip_address();
                      $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                      $insert=$this->Accion->insert($datos);

                      $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Agenda',"tiempo"=>$llamada);
                      $insert2=$this->Tiempo->insert($datos3);

                      $traeContacto=$this->Contacto->getContacto($contacto);
                      echo json_encode($traeContacto);
                    }
                  
            break;

            case 'Solicita no llamar de nuevo':
                 
                  $llamada=date('Y-m-d '.$tiempo.'');
                  $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'Solicita no llamar de nuevo ','estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                  $update=$this->Contacto->update($datos1,$contacto);

                   $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Solicita no llamar de nuevo');
                   $insertx=$this->Llam->insert($datosx);

                   $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Solicita no llamar de nuevo');
                   $insertx2=$this->Cont->insert($datosx2);

                  $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Solicita no llamar de nuevo');
                  $insert1=$this->Llamada->insert($datos2);
                  if ($insert1 != 0) {

                      $ip =$this->input->ip_address();
                      $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                      $insert=$this->Accion->insert($datos);

                      $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Solicita no llamar de nuevo',"tiempo"=>$llamada);
                      $insert2=$this->Tiempo->insert($datos3);

                      $traeContacto=$this->Contacto->getContacto($contacto);
                      echo json_encode($traeContacto);
                    }
            break;

            case 'Solo cotizando':

                  $llamada=date('Y-m-d '.$tiempo.'');
                  $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'Solo cotizando ','estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                  $update=$this->Contacto->update($datos1,$contacto);

                   $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Solo cotizando');
                   $insertx=$this->Llam->insert($datosx);

                   $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Solo cotizando');
                   $insertx2=$this->Cont->insert($datosx2);


                  $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Solo cotizando');
                  $insert1=$this->Llamada->insert($datos2);
                  if ($insert1 != 0) {

                      $ip =$this->input->ip_address();
                      $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                      $insert=$this->Accion->insert($datos);

                      $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Solo cotizando',"tiempo"=>$llamada);
                      $insert2=$this->Tiempo->insert($datos3);

                      $traeContacto=$this->Contacto->getContacto($contacto);
                      echo json_encode($traeContacto);
                    }
            break;

            case 'De otra ciudad':
                  
                  $comuna=$this->input->post('comuna');
                  $getComuna=$this->Comuna->getComuna($comuna);
                  $llamada=date('Y-m-d '.$tiempo.'');
                  $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'De otra '.$getComuna->region.', provincia: '.$getComuna->provincia.',  comuna: '.$getComuna->nombre,'estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                  $update=$this->Contacto->update($datos1,$contacto);

                   $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'De otra ciudad');
                   $insertx=$this->Llam->insert($datosx);

                   $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'De otra ciudad');
                   $insertx2=$this->Cont->insert($datosx2);


                  $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'De otra ciudad');
                  $insert1=$this->Llamada->insert($datos2);
                  if ($insert1 != 0) {

                      $ip =$this->input->ip_address();
                      $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                      $insert=$this->Accion->insert($datos);

                      $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'De otra ciudad',"tiempo"=>$llamada);
                      $insert2=$this->Tiempo->insert($datos3);

                      $traeContacto=$this->Contacto->getContacto($contacto);
                      echo json_encode($traeContacto);

                    }
            break;

            case 'Enfermedad autoinmune':

                $llamada=date('Y-m-d '.$tiempo.'');
                $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'Enfermedad autoinmune ','estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                $update=$this->Contacto->update($datos1,$contacto);

                  $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Enfermedad autoinmune');
                  $insertx=$this->Llam->insert($datosx);

                  $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Enfermedad autoinmune');
                  $insertx2=$this->Cont->insert($datosx2);


                $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Enfermedad autoinmune');
                $insert1=$this->Llamada->insert($datos2);
                if ($insert1 != 0) {

                    $ip =$this->input->ip_address();
                    $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                    $insert=$this->Accion->insert($datos);

                    $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Enfermedad autoinmune',"tiempo"=>$llamada);
                    $insert2=$this->Tiempo->insert($datos3);

                    $traeContacto=$this->Contacto->getContacto($contacto);
                    echo json_encode($traeContacto);

                    }
            break;

             case 'Solo curiosidad':

                $llamada=date('Y-m-d '.$tiempo.'');
                $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'Solo curiosidad','estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                $update=$this->Contacto->update($datos1,$contacto);

                $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Solo curiosidad');
                $insertx=$this->Llam->insert($datosx);

                $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Solo curiosidad');
                $insertx2=$this->Cont->insert($datosx2);

                $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Solo curiosidad');
                $insert1=$this->Llamada->insert($datos2);
                if ($insert1 != 0) {

                    $ip =$this->input->ip_address();
                    $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                    $insert=$this->Accion->insert($datos);

                    $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Solo curiosidad',"tiempo"=>$llamada);
                    $insert2=$this->Tiempo->insert($datos3);

                     $traeContacto=$this->Contacto->getContacto($contacto);
                     echo json_encode($traeContacto);
                    }
            break;

            case 'Fuera de presupuesto':
                  
                $presupuesto= $this->input->post("prest");
                $llamada=date('Y-m-d '.$tiempo.'');
                $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'Fuera de presupuesto, estimado a pagar: '.$presupuesto,'estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
                $update=$this->Contacto->update($datos1,$contacto);

                $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Fuera de presupuesto');
                $insertx=$this->Llam->insert($datosx);

                $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Fuera de presupuesto');
                $insertx2=$this->Cont->insert($datosx2);

                $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Fuera de presupuesto');
                $insert1=$this->Llamada->insert($datos2);
                if ($insert1 != 0) {

                    $ip =$this->input->ip_address();
                    $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                    $insert=$this->Accion->insert($datos);


                    $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Fuera de presupuesto',"tiempo"=>$llamada);
                    $insert2=$this->Tiempo->insert($datos3);

                     $traeContacto=$this->Contacto->getContacto($contacto);
                     echo json_encode($traeContacto);
                    }


            break;

            case 'No tengo dinero':
               
               $llamada=date('Y-m-d '.$tiempo.'');
               $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'No tengo dinero','estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
               $update=$this->Contacto->update($datos1,$contacto);


                $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'No tengo dinero');
                $insertx=$this->Llam->insert($datosx);

                $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'No tengo dinero');
                $insertx2=$this->Cont->insert($datosx2);

               $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'No tengo dinero');
               $insert1=$this->Llamada->insert($datos2);
               if ($insert1 != 0) {

                $ip =$this->input->ip_address();
                $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
                $insert=$this->Accion->insert($datos);

                $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'No tengo dinero',"tiempo"=>$llamada);
                $insert2=$this->Tiempo->insert($datos3);

                 $traeContacto=$this->Contacto->getContacto($contacto);
                 echo json_encode($traeContacto);

                }

            break;

            case 'Ya se lo hizo':
                  
              $llamada=date('Y-m-d '.$tiempo.'');
              $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'Ya se lo hizo','estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
              $update=$this->Contacto->update($datos1,$contacto);

               $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Ya se lo hizo');
                $insertx=$this->Llam->insert($datosx);

                $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Ya se lo hizo');
                $insertx2=$this->Cont->insert($datosx2);

              $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Ya se lo hizo');
              $insert1=$this->Llamada->insert($datos2);
              if ($insert1 != 0) {

               $ip =$this->input->ip_address();
               $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
               $insert=$this->Accion->insert($datos);

               $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Ya se lo hizo',"tiempo"=>$llamada);
               $insert2=$this->Tiempo->insert($datos3);

                $traeContacto=$this->Contacto->getContacto($contacto);
                echo json_encode($traeContacto);

              }   

            break;

            case 'Ya lo llamaron':

              $llamada=date('Y-m-d '.$tiempo.'');
              $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'Ya lo llamaron','estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
              $update=$this->Contacto->update($datos1,$contacto);

              $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Ya lo llamaron');
                $insertx=$this->Llam->insert($datosx);

                $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Ya lo llamaron');
                $insertx2=$this->Cont->insert($datosx2);

              $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Ya lo llamaron');
              $insert1=$this->Llamada->insert($datos2);
              if ($insert1 != 0) {

               $ip =$this->input->ip_address();
               $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
               $insert=$this->Accion->insert($datos);

               $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Ya lo llamaron',"tiempo"=>$llamada);
               $insert2=$this->Tiempo->insert($datos3);

                $traeContacto=$this->Contacto->getContacto($contacto);
                echo json_encode($traeContacto);
              }
                
            break;

            case 'Número no corresponde':

              $llamada=date('Y-m-d '.$tiempo.'');
              $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'Número no corresponde','estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
              $update=$this->Contacto->update($datos1,$contacto);

                $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Número no corresponde');
                $insertx=$this->Llam->insert($datosx);

                $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Número no corresponde');
                $insertx2=$this->Cont->insert($datosx2);

              $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Número no corresponde');
              $insert1=$this->Llamada->insert($datos2);
              if ($insert1 != 0) {

               $ip =$this->input->ip_address();
               $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
               $insert=$this->Accion->insert($datos);


               $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Número no corresponde',"tiempo"=>$llamada);
               $insert2=$this->Tiempo->insert($datos3);

                $traeContacto=$this->Contacto->getContacto($contacto);
                echo json_encode($traeContacto);
              }
            break;
            
            case 'Prestación no existe':
              
              $prestacion=$this->input->post("prest");    
              $llamada=date('Y-m-d '.$tiempo.'');
              $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'Prestación no existe: '.$prestacion,'estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
              $update=$this->Contacto->update($datos1,$contacto);

                $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Prestación no existe');
                $insertx=$this->Llam->insert($datosx);

                $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Prestación no existe');
                $insertx2=$this->Cont->insert($datosx2);

              $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Prestación no existe');
              $insert1=$this->Llamada->insert($datos2);
              if ($insert1 != 0) {

               $ip =$this->input->ip_address();
               $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
               $insert=$this->Accion->insert($datos);

               $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Prestación no existe',"tiempo"=>$llamada);
               $insert2=$this->Tiempo->insert($datos3);

                $traeContacto=$this->Contacto->getContacto($contacto);
                echo json_encode($traeContacto);
              }

            break;

            case 'Pensó que la evaluación era gratis':

              $llamada=date('Y-m-d '.$tiempo.'');
              $datos1=array('fechaLLamada'=>$fechaLLamada,'orden'=>4,'obs'=>'Pensó que la evaluación era gratis','estado'=>'No llamar más','ocupado'=>'N',"usuario"=>$usuario->idusuario);
              $update=$this->Contacto->update($datos1,$contacto);

                $datosx=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Pensó que la evaluación era gratis');
                $insertx=$this->Llam->insert($datosx);

                $datosx2=array('contacto'=>$contacto,'usuario'=>$user,'fecha'=>$fechaLLamada,'tipo'=>$getContacto->origen,'estado'=>'Pensó que la evaluación era gratis');
                $insertx2=$this->Cont->insert($datosx2);

              $datos2=array('usuario'=>$usuario->idusuario,'contacto'=>$contacto,'tiempoLlamada'=>$llamada,'estado'=>'Pensó que la evaluación era gratis');
              $insert1=$this->Llamada->insert($datos2);
              if ($insert1 != 0) {

               $ip =$this->input->ip_address();
               $datos=array('accion'=>'llamada a contacto '.$contacto,'codigo'=>$insert1,'ip'=>$ip,'usuario'=>$usuario->idusuario);
               $insert=$this->Accion->insert($datos);

               $datos3=array("usuario"=>$user,"tipo"=>"Tiempo llamada","descripcion"=>'Pensó que la evaluación era gratis',"tiempo"=>$llamada);
               $insert2=$this->Tiempo->insert($datos3);

                $traeContacto=$this->Contacto->getContacto($contacto);
                echo json_encode($traeContacto);
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