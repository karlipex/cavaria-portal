<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accion extends CI_Model {

 public function insert($datos)
 {
    $this->db->insert("accion",$datos);
    return true;
 }
}