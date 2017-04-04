<?php
class HistorialLlamada extends CI_Model {

 public function insert($datos)
 {
   $this->db->insert("historialLlamada
    ",$datos);
   return $this->db->insert_id();
 }

 public function listHistorialPersonal($id)
 {
   $where=array("contacto"=>$id);
   $query=$this->db->select("h.idhistorial,contacto,u.usuario,h.accion,DATE_FORMAT(h.fecha,'%d/%m/%Y %H:%m')as fecha",false)
   ->from("historialLlamada h")
   ->join("usuario u","h.usuario= u.idusuario")
   ->order_by("h.idhistorial","desc")
   ->where($where)
   ->get();
 	return $query->result();
 }
}