<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargo extends CI_Model {

 public function listCargo()
 {
    $query=$this->db->select("idcargo,descripcion",false)
    ->from("cargo")
    ->get();
    return $query->result(); 
 }

}