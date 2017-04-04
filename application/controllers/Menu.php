<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

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
        redirect(base_url()."menu-principal",  301);
      }
      else
      {
       if($this->input->post())
       {
       	 $this->form_validation->set_rules('user','Usuario','required');
         $this->form_validation->set_rules('pass','Password','required');
         if($this->form_validation->run() == TRUE)
         {
           $usuario= $this->input->post("user");
           $password= $this->input->post("pass");
           $pass=sha1(md5($password));
           $login=$this->Usuario->login($usuario,$pass);
           if($login == 1)
           {
              $getUsuario=$this->Usuario->getUsuario($usuario);
              if($getUsuario->estado == "Activo")
              {
                $this->session->set_userdata("item");
                $this->session->set_userdata('botox',$usuario);
                $session_id=$this->session->userdata('botox'); 
                $ip =$this->input->ip_address();
                $datos=array('accion'=>'Inicio de sesión','ip'=>$ip,'usuario'=>$getUsuario->idusuario);
                $insert=$this->Accion->insert($datos);
                redirect(base_url()."menu-principal",  301);
              }
              else
              {
              	$this->session->set_flashdata('ErrorMessage','El usuario '.$usuario.' fue desactivado por el administrador.');
	             redirect(base_url(),  301);
              }
           }
           else
           {
             $this->session->set_flashdata('ErrorMessage','El usuario o la contraseña no son validos.');
	         redirect(base_url(),  301);
           }
         }
       }
     $this->layout->setLayout('login');
	   $this->layout->setTitle("Portal Clínica Avaria");
	   $this->layout->setKeywords("Portal Clínica Avaria");
	   $this->layout->setDescripcion("Acceso a Portal Clínica Avaria");
	   $this->layout->css(array(base_url()."public/css/login.css"));
	   //$this->layout->js(array("https://code.jquery.com/jquery-1.12.4.min.js"));
	   $this->layout->view('login');
	  }
	}

	public function principal()
	{
	  if(!empty($this->session_id))
      {
       $us=$this->session_id;
       $usuario=$this->Usuario->getUsuario($us);

	   $this->layout->setLayout('menu');
	   $this->layout->setTitle("Menu Principal");
	   $this->layout->setKeywords("Menu Principal");
	   $this->layout->setDescripcion("Menu Principal");
	   $this->layout->css(array(base_url()."public/css/menu.css"));
	   //$this->layout->js(array("https://code.jquery.com/jquery-1.12.4.min.js"));
	   $this->layout->js(array(base_url()."public/js/funciones.js"));
	   $this->layout->view('menu',compact('usuario'));
	  }
	  else
	  {
	  	redirect(base_url(),  301);
	  }
	}

	public function cambioPassword()
	{
	  if(!empty($this->session_id))
      {
       $us=$this->session_id;
       $usuario=$this->Usuario->getUsuario($us);
       if( $this->input->post())
	   {
	   	 $this->form_validation->set_rules('pass','Contraseña Actual','required'); 
	     $this->form_validation->set_rules('pass1','Contraseña Nueva','required');
	     $this->form_validation->set_rules('pass2','Confirme Constraseña','required|matches[pass1]'); 
	     if($this->form_validation->run())
	     {
         $passwordActual=sha1(md5($this->input->post("pass")));
	       $nuevaPassword=sha1(md5($this->input->post("pass1")));
	       $check=$this->Usuario->checkPassword($passwordActual);
           if($check != 0)
           {
             $ip =$this->input->ip_address();
             $datos1=array('accion'=>'Cambio de Password','ip'=>$ip,'usuario'=>$usuario->idusuario);
             $insert=$this->Accion->insert($datos1);
             $datos=array("password"=>$nuevaPassword);
             $update=$this->Usuario->updateUsuario($datos,$usuario->idusuario);
             if($update == true)
             {
               $this->session->set_flashdata('ControllerMessage','Contraseña Modificada correctamente.');
	             redirect(base_url()."cambiar-password",  301);
             }
             else
             {
               $this->session->set_flashdata('ErrorMessage','Error al cambiar Contraseña, intente mas tarde.');
	             redirect(base_url()."cambiar-password",  301);
             }
           }
           else
           {
           	 $this->session->set_flashdata('ErrorMessage','La Contraseña Actual no es correcta.');
	           redirect(base_url()."cambiar-password",  301);
           }
	     }
	   }
     $this->layout->setLayout('menu');
	   $this->layout->setTitle("Cambiar Contraseña");
	   $this->layout->setKeywords("Cambiar Contraseña");
	   $this->layout->setDescripcion("Cambiar Contraseña");
	   $this->layout->css(array(base_url()."public/css/menu.css"));
	   //$this->layout->js(array("https://code.jquery.com/jquery-1.12.4.min.js"));
	   $this->layout->js(array(base_url()."public/js/funciones.js"));
	   $this->layout->view('cambioPassword',compact('usuario'));
      }
      else
      {
        redirect(base_url(),  301);	
      }
	}

  public function error()
  {
     if(!empty($this->session_id))
     {
        $us=$this->session_id;
        $usuario=$this->Usuario->getUsuario($us);
        
        $this->layout->setLayout('menu');
        $this->layout->setTitle("Cambiar Contraseña");
        $this->layout->setKeywords("Cambiar Contraseña");
        $this->layout->setDescripcion("Cambiar Contraseña");
        $this->layout->css(array(base_url()."public/css/menu.css"));
        //$this->layout->js(array("https://code.jquery.com/jquery-1.12.4.min.js"));
        $this->layout->js(array(base_url()."public/js/funciones.js"));
        $this->layout->view('error',compact('usuario'));
     }
     else
     {
       redirect(base_url(),  301); 
     }
  }

   public function logout()
   {
   	 $us=$this->session_id;
     $usuario=$this->Usuario->getUsuario($us);
      $ip =$this->input->ip_address();
   	  $datos=array('accion'=>'Cerro sesión','ip'=>$ip,'usuario'=>$usuario->idusuario);
      $insert=$this->Accion->insert($datos);
     $this->session->unset_userdata(array('botox' => ''));
     $this->session->sess_destroy("item");
     redirect(base_url(),  301);
   }
}
