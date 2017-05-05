<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cont extends CI_Model {

 public function insert($datos)
 {
    $this->db->insert("cont",$datos);
    return true;
 }
}