<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provincia extends CI_Model {

 public function listRegionesProvincia($region)
 {
 	$where=array("idregion"=>$region);
    $query=$this->db->select("id,nombre",false)
    ->from("provincia")
    ->where($where)
    ->get();
    if($query->num_rows()>0)
    {
      return $query->result(); 
    }
    
 }

}