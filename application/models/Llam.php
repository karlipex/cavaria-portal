<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Llam extends CI_Model {

 public function insert($datos)
 {
    $this->db->insert("llam",$datos);
    return true;
 }

 public function countllam($contacto,$fecha)
 {
   $query=$this->db 
     ->select("idllam")
     ->from("llam")
     ->where(array("contacto"=>$contacto,"DATE_FORMAT(fecha,'%Y-%m-%d')"=>$fecha))
     ->count_all_results();
     return $query;
 }

 public function getLlam($id,$fecha)
 {
 	$query=$this->db 
     ->select("idllam")
     ->from("llam")
     ->where(array("contacto"=>$id,"DATE_FORMAT(fecha,'%Y-%m-%d')"=>$fecha))
     ->get();
     return $query->row();
 }

  public function getLlam2($id,$campana,$start_date,$end_date)
 {
  $query=$this->db 
     ->select("ll.idllam")
     ->from("llam ll")
     ->join("contacto co","ll.contacto = co.idcontacto")
     ->like("co.campana",$campana)
     ->where("ll.usuario",$id)
     ->where("DATE_FORMAT(ll.fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(ll.fecha,'%Y-%m-%d') <=", $end_date)
     ->count_all_results();
     return $query;
 }

 public function getLlamDiario($id)
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(ll.fecha,'%Y-%m-%d')"=>$curr_date,"co.usuario"=>$id);
   $query=$this->db 
     ->select("ll.idllam")
     ->from("llam ll")
     ->join("contacto co","ll.contacto = co.idcontacto")
     ->where($where)
     ->count_all_results();
     return $query;
 }
 
  public function update($datos=array(),$id)
  {
     $this->db->where('idllam', $id);
     $this->db->update('llam', $datos); 
     return true;
  }

}