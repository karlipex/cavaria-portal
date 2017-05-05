<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agen extends CI_Model {

 public function insert($datos)
 {
    $this->db->insert("agen",$datos);
    return true;
 }
}