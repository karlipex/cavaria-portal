<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends CI_Controller {

    private $session_id;
    public function __construct()
    {
     parent::__construct();
     $this->session_id =$this->session->userdata('botox');
    }

   public function menu()
   {
     if(!empty($this->session_id))
     {
       $us=$this->session_id;
       $empleado=$this->Empleado->getEmpleado($us);
       $empleados=$this->Empleado->listEmpleados();
       if( $this->input->post())
       {
         $this->form_validation->set_rules('opcion','Opcion','required'); 
         $this->form_validation->set_rules('buscar','Busqueda','required');
         if($this->form_validation->run())
         {
           $columna=$this->input->post("opcion"); 
           $busqueda=$this->input->post("buscar");
           $empleados=$this->Empleado->search($columna,$busqueda);
          if($empleados == null)
          {
            $this->session->set_flashdata('ErrorSearch','El sistema no encontro coincidecias para su busqueda ');
            redirect(base_url().'menu-empleados', 301);
          }

          $this->layout->setLayout('menu');
          $this->layout->setTitle("Busqueda Empleados");
          $this->layout->setKeywords("Busqueda Empleados");
          $this->layout->setDescripcion("Busqueda Empleados");
          //$this->layout->css(array(base_url()."public/css/menu.css"));
	      //$this->layout->js(array("https://code.jquery.com/jquery-1.12.4.min.js"));
          $this->layout->view('busqueda',compact("empleado","empleados"));
         }
         else
         {
           $this->session->set_flashdata('ErrorSearch','Los campos de busqueda son obligatorios ');
           redirect(base_url().'menu-empleados', 301);
         }

       }
       else
       {
         $this->layout->setLayout('menu');
	     $this->layout->setTitle("Menu Empleados");
	     $this->layout->setKeywords("Menu Empleados");
	     $this->layout->setDescripcion("Menu Empleados");
	     //$this->layout->css(array(base_url()."public/css/menu.css"));
	     //$this->layout->js(array("https://code.jquery.com/jquery-1.12.4.min.js"));
	     $this->layout->js(array(base_url()."public/js/funciones.js"));
	     $this->layout->view('menu',compact('empleado','empleados'));
       }
     }
     else
     {
       redirect(base_url(),  301);
     }
   }

   public function nuevo()
   {
     if(!empty($this->session_id))
     {
       $us=$this->session_id;
       $empleado=$this->Empleado->getEmpleado($us);
       $cargos=$this->Cargo->listCargo();

       $this->layout->setLayout('menu');
	   $this->layout->setTitle("Nuevo Empleado");
	   $this->layout->setKeywords("Nuevo Empleado");
	   $this->layout->setDescripcion("Nuevo Empleados");
	   //$this->layout->css(array(base_url()."public/css/menu.css"));
	   $this->layout->js(array("https://code.jquery.com/jquery-3.1.0.min.js",base_url()."public/js/jquery.Rut.js",base_url()."public/js/rut.js",base_url()."public/js/funciones.js"));
	   $this->layout->js(array(base_url()."public/js/funciones.js"));
	   $this->layout->view('nuevo',compact('empleado','cargos'));
     }
     else
     {
       redirect(base_url(),  301);
     }
   }

   public function ficha($id)
   {
   	 if(!empty($this->session_id))
     {
     
	   $us=$this->session_id;
	   $empleado=$this->Empleado->getEmpleado($us);

	   $this->layout->setLayout('menu');
	   $this->layout->setTitle("Ficha Empleado ".$id."");
	   $this->layout->setKeywords("Ficha  Empleado ".$id."");
	   $this->layout->setDescripcion("Ficha Empleados ".$id."");
	   $this->layout->css(array(base_url()."public/css/menu.css"));
	   //$this->layout->js(array("https://code.jquery.com/jquery-1.12.4.min.js"));
	   $this->layout->js(array(base_url()."public/js/funciones.js"));
	   $this->layout->view('nuevo',compact('empleado'));
	}
	else
	{
      redirect(base_url(),  301);
	}
   }

   public function excel()
   {
     if(!empty($this->session_id))
    {
      $empleados=$this->Empleado->listEmpleadoExcel();
      to_excel($empleados, "Listado General Empleados");
    }
    else
    {
      redirect(base_url(),  301);	
    }
    
   }
}