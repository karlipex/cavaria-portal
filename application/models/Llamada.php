<?php
class Llamada extends CI_Model {

public function insert($datos)
 {
   $this->db->insert("llamada",$datos);
   return $this->db->insert_id();
 }

 public function listLlamadasContacto($id)
 {
   $where=array("ll.contacto"=>$id);
   $query=$this->db->select("ll.idllamada as recid ,u.usuario,ll.contacto,DATE_FORMAT(ll.fecha,'%d/%m/%Y %H:%m')as fecha,DATE_FORMAT(ll.tiempollamada,'%i:%s')as tiempollamada,ll.estado",false)
   ->from("llamada ll")
   	->join("usuario u","ll.usuario= u.idusuario")
 	->order_by("ll.idllamada","desc")
   ->where($where)
   ->get();
 	return $query->result();
 }

 public function countLlamada($id)
 {
 	$query=$this->db 
     ->select("idllamada")
     ->from("llamada")
     ->where(array("contacto"=>$id))
     ->count_all_results();
     return $query;
 }

}
?>