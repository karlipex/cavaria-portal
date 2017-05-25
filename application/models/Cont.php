<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cont extends CI_Model {

 public function insert($datos)
 {
    $this->db->insert("cont",$datos);
    return true;
 }

 public function countCont($contacto,$fecha)
 {
   $query=$this->db 
     ->select("idllcont")
     ->from("cont")
     ->where(array("contacto"=>$contacto,"DATE_FORMAT(fecha,'%Y-%m-%d')"=>$fecha))
     ->count_all_results();
     return $query;
 }

 public function getCont($id,$campana,$start_date,$end_date)
 {
  $query=$this->db 
     ->select("cnt.idcont")
     ->from("cont cnt")
     ->join("contacto co","cnt.contacto = co.idcontacto")
     ->like("co.campana",$campana)
     ->where("cnt.usuario",$id)
     ->where("DATE_FORMAT(cnt.fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(cnt.fecha,'%Y-%m-%d') <=", $end_date)
     ->count_all_results();
     return $query;
 }

 public function getContDiario($id)
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(cnt.fecha,'%Y-%m-%d')"=>$curr_date,"co.usuario"=>$id);
   $query=$this->db 
     ->select("cnt.idcont")
     ->from("cont cnt")
     ->join("contacto co","cnt.contacto = co.idcontacto")
     ->where($where)
     ->count_all_results();
     return $query;
 }
 
}