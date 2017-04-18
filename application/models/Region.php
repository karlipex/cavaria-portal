<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends CI_Model {

 public function listRegiones()
 {
    $query=$this->db->select("id,nombre",false)
    ->from("region")
    ->get();
    if($query->num_rows()>0)
    {
      return $query->result();
    } 
 }

}