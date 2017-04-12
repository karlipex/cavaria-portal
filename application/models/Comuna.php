<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comuna extends CI_Model {

 public function listComunaProvincias($provincias)
 {
 	$where=array("idprovincia"=>$provincias);
    $query=$this->db->select("id,nombre",false)
    ->from("comuna")
    ->where($where)
    ->get();
    return $query->result(); 
 }

}