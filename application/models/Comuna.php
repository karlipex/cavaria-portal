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
    if($query->num_rows()>0)
    {
       return $query->result();
    } 
 }

 public function listComuna($comuna)
 {
    $query=$this->db->select("id,nombre",false)
    ->from("comuna")
    ->like("nombre",$comuna)
    ->get();
    if($query->num_rows()>0)
    {
       return $query->result();
    } 
    else
    {
       return $query->num_rows();
    }
 }

 public function getComuna($nombre)
 {
 	$query=$this->db->select("c.id,c.nombre,r.nombre as region, p.nombre as provincia",false)
 	->from("comuna c")
 	->join("provincia p","c.idprovincia = p.id")
 	->join("region r","p.idregion = r.id ")
 	->like("c.nombre",$nombre)
 	->get();
 	return $query->row();
 }

}