<?php
class Tiempo extends CI_Model {

public function insert($datos)
 {
   $this->db->insert("tiempo",$datos);
   return $this->db->insert_id();
 }

 public function tiempoLlamada($id,$start_date,$end_date)
 {
    $query=$this->db 
     ->select("SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) as llamada",false)
     ->from("tiempo")
     ->where(array("usuario"=>$id,"tipo"=>"Tiempo llamada"))
     ->where("DATE_FORMAT(fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(fecha,'%Y-%m-%d') <=", $end_date)
     ->get();
     return $query->row();
 }

 public function tiempoMuerto($id,$start_date,$end_date)
 {
    $query=$this->db 
     ->select("SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) as muerto",false)
     ->from("tiempo")
     ->where(array("usuario"=>$id,"tipo"=>"Tiempo muerto"))
     ->where("DATE_FORMAT(fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(fecha,'%Y-%m-%d') <=", $end_date)
     ->get();
     return $query->row();
 }

}