<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Con1 extends CI_Model {

 public function insert($datos)
 {
    $this->db->insert("con",$datos);
    return true;
 }

 public function countCon1($contacto,$fecha)
 {
   $query=$this->db 
     ->select("idcon")
     ->from("con")
     ->where(array("contacto"=>$contacto,"DATE_FORMAT(fecha,'%Y-%m-%d')"=>$fecha))
     ->count_all_results();
     return $query;
 }

 public function getCon1($id,$fecha)
 {
 	$query=$this->db 
     ->select("idcon")
     ->from("con")
     ->where(array("contacto"=>$id,"DATE_FORMAT(fecha,'%Y-%m-%d')"=>$fecha))
     ->get();
     return $query->row();
 }

 public function getCon2($id,$campana,$start_date,$end_date)
 {
  $query=$this->db 
     ->select("c.idcon")
     ->from("con c")
     ->join("contacto co","c.contacto = co.idcontacto")
     ->like("co.campana",$campana)
     ->where("co.usuario",$id)
     ->where("DATE_FORMAT(c.fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(c.fecha,'%Y-%m-%d') <=", $end_date)
     ->count_all_results();
     return $query;
 }

 public function getConDiario($id)
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("c.usuario"=>$id,"DATE_FORMAT(c.fecha,'%Y-%m-%d')"=>$curr_date);
   $query=$this->db 
     ->select("c.idcon")
     ->from("con c")
     ->join("contacto co","c.contacto = co.idcontacto")
     ->where($where)
     ->count_all_results();
     return $query;
 }

  public function update($datos=array(),$id)
  {
     $this->db->where('idcon', $id);
     $this->db->update('con', $datos); 
     return true;
  }
}