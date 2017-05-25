<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agen extends CI_Model {

 public function insert($datos)
 {
    $this->db->insert("agen",$datos);
    return true;
 }

 public function getAgen($id,$campana,$start_date,$end_date)
 {
  $query=$this->db 
     ->select("ag.idagen")
     ->from("agen ag")
     ->join("contacto co","ag.contacto = co.idcontacto")
     ->like("co.campana",$campana)
     ->where("ag.usuario",$id)
     ->where("DATE_FORMAT(ag.fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(ag.fecha,'%Y-%m-%d') <=", $end_date)
     ->count_all_results();
     return $query;
 }

 public function getAgenDiario($id)
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(ag.fecha,'%Y-%m-%d')"=>$curr_date,"co.usuario"=>$id);
   $query=$this->db 
     ->select("ag.idagen")
     ->from("agen ag")
     ->join("contacto co","ag.contacto = co.idcontacto")
     ->where($where)
     ->count_all_results();
     return $query;
 }

}