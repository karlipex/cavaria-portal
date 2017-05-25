<?php
class Tiempo extends CI_Model {

public function insert($datos)
 {
   $this->db->insert("tiempo",$datos);
   return $this->db->insert_id();
 }

 public function tiempoLlamadaCampana($id,$campana,$start_date,$end_date)
 {
    $query=$this->db 
     ->select("SEC_TO_TIME(SUM(TIME_TO_SEC(t.tiempo))) as llamada",false)
     ->from("tiempo t")
     ->join("usuario u","t.usuario = u.idusuario")
     ->join("contacto c","u.idusuario = c.usuario")
     ->like("c.campana",$campana)
     ->where(array("t.usuario"=>$id,"t.tipo"=>"Tiempo llamada"))
     ->where("DATE_FORMAT(t.fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(t.fecha,'%Y-%m-%d') <=", $end_date)
     ->get();
     return $query->row();
 }

 public function tiempoGestionCampana($id,$campana,$start_date,$end_date)
 {
    $query=$this->db 
     ->select("SEC_TO_TIME(SUM(TIME_TO_SEC(t.tiempo))) as gestion",false)
     ->from("tiempo t")
     ->join("usuario u","t.usuario = u.idusuario")
     ->join("contacto c","u.idusuario = c.usuario")
     ->like("c.campana",$campana)
     ->where(array("t.usuario"=>$id,"t.tipo"=>"Gestión"))
     ->where("DATE_FORMAT(t.fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(t.fecha,'%Y-%m-%d') <=", $end_date)
     ->get();
     return $query->row();
 }

 public function tiempoAdministrativoCampana($id,$campana,$start_date,$end_date)
 {
    $query=$this->db 
     ->select("SEC_TO_TIME(SUM(TIME_TO_SEC(t.tiempo))) as administrativo",false)
     ->from("tiempo t")
     ->join("usuario u","t.usuario = u.idusuario")
     ->join("contacto c","u.idusuario = c.usuario")
     ->like("c.campana",$campana)
     ->where(array("t.usuario"=>$id,"t.tipo"=>"Administrativo"))
     ->where("DATE_FORMAT(t.fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(t.fecha,'%Y-%m-%d') <=", $end_date)
     ->get();
     return $query->row();
 }

 public function tiempoLlamadaHoy($id)
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(fecha,'%Y-%m-%d')"=>$curr_date,"usuario"=>$id,"tipo"=>"Tiempo llamada");
   $query=$this->db 
     ->select("SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) as llamada",false)
     ->from("tiempo")
     ->where($where)
     ->get();
    return $query->row();
 }

 public function tiempoGestionHoy($id)
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(fecha,'%Y-%m-%d')"=>$curr_date,"usuario"=>$id,"tipo"=>"Gestión");
   $query=$this->db 
     ->select("SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) as gestion",false)
     ->from("tiempo")
     ->where($where)
     ->get();
    return $query->row();
 }

 public function tiempoAdministrativoHoy($id)
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(fecha,'%Y-%m-%d')"=>$curr_date,"usuario"=>$id,"tipo"=>"Administrativo");
   $query=$this->db 
     ->select("SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) as administrativo",false)
     ->from("tiempo")
     ->where($where)
     ->get();
    return $query->row();
 }

}