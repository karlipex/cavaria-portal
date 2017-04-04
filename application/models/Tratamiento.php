<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tratamiento extends CI_Model {

 public function listTratamiento()
 {
    $query=$this->db->select("idtratamiento,descripcion",false)
    ->from("tratamiento")
    ->get();
    return $query->result(); 
 }

 public function listTratamiento2($id)
 {
 	$where=array("idtratamiento <>"=>$id);
 	$query=$this->db->select("idtratamiento,descripcion",false)
    ->from("tratamiento")
    ->where($where)
    ->get();
    return $query->result();
 }

  public function search($tratamiento)
  {
    $query=$this->db->select("idtratamiento,descripcion",false)
    ->from("tratamiento")
    ->like("descripcion",$tratamiento)
    ->get();
    return $query->row();
  }

}