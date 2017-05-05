<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Con1 extends CI_Model {

 public function insert($datos)
 {
    $this->db->insert("con",$datos);
    return true;
 }
}