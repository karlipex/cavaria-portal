<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactos extends CI_Controller {

  private $session_id;
  public function __construct()
  {
   parent::__construct();
   $this->session_id =$this->session->userdata('botox');
  }

  public function index()
  {
  	if(!empty($this->session_id))
    {
       $us=$this->session_id;
       $usuario=$this->Usuario->getUsuario($us);
       $tratamientos=$this->Tratamiento->listTratamiento();
       if($usuario->permisos == "1000" || $usuario->permisos == "1001" )
       {
       	 $this->layout->setLayout('menu');
	       $this->layout->setTitle("Menú Contactos");
	       $this->layout->setKeywords("Menú Contactos");
	       $this->layout->setDescripcion("Menú Contactos");
	       $this->layout->css(array(base_url()."public/css/menu.css",base_url()."public/css/w2ui.css"));
	       $this->layout->js(array(base_url()."public/js/funciones.js","http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js",base_url()."public/js/w2ui.js"));
	       $this->layout->view('menu',compact('usuario','tratamientos'));
       }
       else
       {
       	 redirect(base_url()."menu-principal",  301);
       }

       
    }
    else
    {
      redirect(base_url(),  301);
    }

  }

  public function llenar()
  {
    if(!empty($this->session_id))
    {
      $contactos=$this->Contacto->listContacto();

      echo json_encode($contactos);

    }
    else
    {
      redirect(base_url(),  301);
    }
  }

  public function getContacto($id)
  {
    if(!empty($this->session_id))
    {
      $contacto=$this->Contacto->getContacto($id);

      echo json_encode($contacto);

    }
    else
    {
      redirect(base_url(),  301);
    }
  }

  public function detalle($id)
  {
    if(!empty($this->session_id))
    {
      $us=$this->session_id;
      $usuario=$this->Usuario->getUsuario($us);
      $check=$this->Contacto->check($id);
      if($check != 0)
      {
        $tratamientos=$this->Tratamiento->listTratamiento();
        $llamadas=$this->Llamada->countLlamada($id);
        $historials=$this->HistorialLlamada->listHistorialPersonal($id);
        $regiones=$this->Region->listRegiones();
        if($usuario->permisos == "1000" || $usuario->permisos == "1001" )
        {
          $contacto=$this->Contacto->getContacto($id);
          $tratamientos=$this->Tratamiento->listTratamiento2($contacto->tratamiento);
          $this->layout->setLayout('menu');
          $this->layout->setTitle("Detalle Contacto ".$id);
          $this->layout->setKeywords("Detalle Contactos ".$id);
          $this->layout->setDescripcion("Detalle Contactos ".$id);
          $this->layout->css(array(base_url()."public/css/menu.css",base_url()."public/css/w2ui.css"));
          $this->layout->js(array(base_url()."public/js/funciones.js","https://code.jquery.com/jquery-3.1.1.min.js",base_url()."public/js/w2ui.js",base_url()."public/js/countdown.js"));
          $this->layout->view('detalle',compact('usuario','contacto','tratamientos','llamadas','historials','regiones'));
        }
        else
        {
          redirect(base_url()."menu-principal",  301);
        }
      }
      else
      {
        $this->session->set_flashdata('ErrorMessage','El contacto no existe.');
        redirect(base_url()."error",  301);
      }
    }
    else
    {
      redirect(base_url(),  301);
    }
  }

  public function reporte($id)
  {
    if(!empty($this->session_id))
    {
       $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Clínica Avaria');
        $pdf->SetTitle('Contacto '.$id.'');
        $pdf->SetSubject('Contacto ');
        $pdf->SetKeywords('Contacto '.$id.'');

        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' ', PDF_HEADER_STRING, array(255, 255, 255), array(255, 255, 255));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(255, 255, 255));

        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
         $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
         $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
         $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------
        // establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

        // Establecer el tipo de letra
 
        //Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
        // Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 14, '', true);

        // Añadir una página
        // Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

        //fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => false, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        //Información a rescatar
        $us=$this->session_id;
        $usuario=$this->Usuario->getUsuario($us);
        $contacto=$this->Contacto->getContacto($id);
        $llamadas=$this->Llamada->countLlamada($id);
        $calls=$this->Llamada->listLlamadasContacto($id);
        $hoy =date("d-m-y");
        $html='<style>
                h2,h3,p, table, .table{color: #555;font-family: helvetica;}
               .tabla{width: 100%;}
               .tabla, .table, td{border: 1px solid #77777c;}
                td.red, th{background-color: #777; color: #fff;}
               .table tr td,.table tr th{text-align: center}
               .table tr .codigo{width: 15%}
               </style>
               <h2>Contacto:</h2>';
        $html.='<table class="tabla">
               <tr>
                  <td colspan="2" class="red">Contacto:</td>
                </tr>
                <tr>
                  <td style="width: 50%"><b>Contacto:</b> '.$contacto->fechaIngreso.' </td>
                  <td style="width: 50%"><b>Origen:</b> '.$contacto->origen.'</td>
                </tr>
                <tr>
                  <td style="width: 50%"><b>Nombre:</b> '.$contacto->nombre.' </td>
                  <td style="width: 50%"><b>Fono:</b> '.$contacto->telefono.'</td>
                </tr>
                <tr>
                  <td style="width: 50%"><b>E-Mail:</b> '.$contacto->email.' </td>
                  <td style="width: 50%"><b>Tratamiento:</b> '.$contacto->descripcion.'</td>
                </tr>
                <tr>
                  <td style="width: 50%"><b>Descuento:</b> '.$contacto->descuento.' </td>
                  <td style="width: 50%"><b>Campaña:</b> '.$contacto->campana.'</td>
                </tr>
                </table>';
                if($llamadas != 0){
                 $html.='<br></h2><table class="table">
                         <tr>
                              <td colspan="2" class="red">Ultima Acción:</td>
                        </tr>
                         <tr>
                             <td style="width: 50%"><b>Fecha:</b> '.$contacto->fechaLlamada.'</td>
                             <td style="width: 50%"><b>Estado:</b> '.$contacto->estado.'</td>
                        </tr>';
                  if($contacto->obs != null){
                  $html.='<tr>
                             <td style="width: 50%"><b>Observaciones:</b> '.$contacto->obs.'</td>
                          </tr>';

                  $html.='</table><br>
                          <h3>Historial de llamadas</h3>'; 
                 }
                  $html.='<br><table class="table">
                        <tr>
                            <td class="red">ID</td>
                            <td class="red">CAPE</td>
                            <td class="red">Fecha</td>
                            <td class="red">Tiempo llamada</td>
                            <td class="red">Estado</td>
                        </tr>';
                   foreach ($calls as $call) {

                     $html .= '<tr>';
                     $html .= '<td>'.$call->recid.'</td>';
                     $html .= '<td>'.$call->usuario.'</td>';
                     $html .= '<td>'.$call->fecha.'</td>';
                     $html .= '<td>'.$call->tiempollamada.'</td>';
                     $html .= '<td>'.$call->estado.'</td>';
                     $html .= '</tr>';
                  }
                   $html .= '</table>';
                } 
                 $html.='
                <br>
                <br>
                <p>Generado por: '.$usuario->usuario.' / '.$hoy.'.</p>';

          // Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        

        // ---------------------------------------------------------
       // Cerrar el documento PDF y preparamos la salida
       // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Contacto ".$id.".pdf");
        $pdf->Output($nombre_archivo, 'D');

    }
    else
    {
      redirect(base_url(),  301);
    }
  }
  
  public function siguiente()
  {
    if(!empty($this->session_id))
    {
      $contacto=$this->Contacto->listContactoCape();
          if(empty($contacto))
          {
            $this->session->set_flashdata('ErrorMessage','No Existen mas contactos por llamar.');
             redirect(base_url()."error",  301);

          } else {
          
           $id=$contacto->idcontacto;
           $datos=array("ocupado"=>"S");
           $update=$this->Contacto->update($datos,$id);
           redirect(base_url()."detalle-contacto/".$contacto->idcontacto);
        }
    }
    else
    {
      redirect(base_url(),  301);
    }
  }

  public function update()
  {
    if(!empty($this->session_id))
    {
      $us=$this->session_id;
      $usuario=$this->Usuario->getUsuario($us);
      if( $this->input->post())
      {
         $id=$this->input->post('idcontacto');
         $nombre=$this->input->post('nombre');
         $nuemero=$this->input->post('numero');
         $email=$this->input->post('email');
         $datos=array('nombre'=>$nombre,'email'=>$email,'telefono'=>$nuemero);
         $update=$this->Contacto->update($datos,$id);
         if($update == true)
         {
            $contacto=$this->Contacto->getContacto($id);
            $ip =$this->input->ip_address();
            $datos=array('accion'=>'Modifico contacto '.$contacto->nombre,'codigo'=>$id,'ip'=>$ip,'usuario'=>$usuario->idusuario);
            $insert=$this->Accion->insert($datos);            
            return true;
         }
         else
         {
            return false;
         }

      }
    }
    else
    {
      redirect(base_url(),  301);
    }
  }

  public function eliminar($id)
  {
    if(!empty($this->session_id))
    {
      $us=$this->session_id;
      $usuario=$this->Usuario->getUsuario($us);
      $llamadas=$this->Llamada->countLlamada($id);
      $contacto=$this->Contacto->getContacto($id);
      
      if($llamadas == 0)
      {
          $delete=$this->Contacto->delete($id);
          if($delete == true)
          {
             
             $ip =$this->input->ip_address();
             $datos=array('accion'=>'Elimino contacto '.$contacto->nombre,'codigo'=>$id,'ip'=>$ip,'usuario'=>$usuario->idusuario);
             $insert=$this->Accion->insert($datos);  
             $this->session->set_flashdata('ControllerMessage','Contacto eliminado correctamente.');
             redirect(base_url()."menu-contactos",  301);
          }
          else
          {
            $this->session->set_flashdata('ErrorMessage','Error al eliminar, intente mas tarde.');
            redirect(base_url()."error",  301);
          }
      }
      else
      {
        $this->session->set_flashdata('ErrorMessage','Error al eliminar este registro posee información asociada.');
        redirect(base_url()."error",  301);
      }
    }
    else
    {
      redirect(base_url(),  301);
    }
  }

  public function getFacebook()
  {
    if( $this->input->post())
    {
       date_default_timezone_set("UTC");
       date_default_timezone_set("America/Santiago");
       $nuevaIteracion=date("Y-m-d H:i:s");
       $nombre=$this->input->post('first_name');
       $apellidos=$this->input->post('last_name');
       $email=$this->input->post('email');
       $fono=$this->input->post('phone');
       $tratamiento=$this->input->post('treatment');
       $trat=$this->Tratamiento->search($tratamiento);
       $oferta=$this->input->post('offer');
       $completo=$nombre.' '.$apellidos;
       $datos=array('nombre'=>$completo,'email'=>$email,'telefono'=>$fono,'tratamiento'=>$trat->idtratamiento,'nuevaIteracion'=>$nuevaIteracion,'prioridad'=>2,'descuento'=>$oferta,'origen'=>'Contacto Facebook','estado'=>'En espera de llamado','ocupado'=>'N');
       $insert=$this->Contacto->insert($datos);
       if($insert != 0)
       {
          return true;
       }
       else
       {
          return false;
       }

    }
    else
    {
      echo "Error";
    }
  }

  public function nuevo()
  {
  	if(!empty($this->session_id))
    {
      $us=$this->session_id;
      $usuario=$this->Usuario->getUsuario($us);
      if( $this->input->post())
      {
        date_default_timezone_set("UTC");
        date_default_timezone_set("America/Santiago");
        $nuevaIteracion=date("Y-m-d H:i:s");
        $nombre=$this->input->post('nombre');
        $email=$this->input->post('email');
        $nuemero=$this->input->post('numero');
        $tratamiento=$this->input->post('tratamiento');
        $descuento=$this->input->post('descuento');
        $origen=$this->input->post('origen');
        $campana=$this->input->post('campana');
        $datos=array('nombre'=>$nombre,'email'=>$email,'telefono'=>$nuemero,'tratamiento'=>$tratamiento,'descuento'=>$descuento.'% Descuento','origen'=>$origen,'campana'=>$campana,'nuevaIteracion'=>$nuevaIteracion,'prioridad'=>2,'estado'=>'En espera de llamado','ocupado'=>'N');
        $insert=$this->Contacto->insert($datos);
        if($insert != 0)
        {
          $ip =$this->input->ip_address();
   	      $datos1=array('accion'=>'Ingreso contacto '.$nombre,'codigo'=>$insert,'ip'=>$ip,'usuario'=>$usuario->idusuario);
          $insert1=$this->Accion->insert($datos1);
          $datos2=array('contacto'=>$insert,'usuario'=>$usuario->idusuario,'accion'=>'Ingreso contacto');
          $insert3=$this->HistorialLlamada->insert($datos2);
          return true;
        }
        else
        {
           return false;
        }
     }
      
    }
    else
    {
      redirect(base_url(),  301);
    }

  }

}