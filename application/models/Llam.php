<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Llam extends CI_Model {

 public function insert($datos)
 {
    $this->db->insert("llam",$datos);
    return true;
 }
}