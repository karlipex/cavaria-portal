<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends CI_Model {

 public function listRegiones()
 {
    $query=$this->db->select("id,nombre",false)
    ->from("region")
    ->get();
    return $query->result(); 
 }

}