<?php
class Contacto extends CI_Model {

 public function insert($datos)
 {
   $this->db->insert("contacto",$datos);
   return $this->db->insert_id();
 }

 public function check($id)
 {
    $query=$this->db 
     ->select("idcontacto")
     ->from("contacto")
     ->where(array("idcontacto"=>$id))
     ->count_all_results();
     return $query;
 }

 public function listContacto()
 {
 	$query=$this->db->select("c.idcontacto as recid,c.nombre,c.email,c.telefono,t.descripcion,c.descuento,DATE_FORMAT(c.fechaIngreso,'%d/%m/%Y %H:%m')as fechaIngreso,c.origen,c.campana",false)
 	->from("contacto c")
 	->join("tratamiento t","c.tratamiento= t.idtratamiento")
 	->order_by("idcontacto","desc")
 	->get();
 	return $query->result();
 }

 public function getContacto($id)
 {
   $where=array("c.idcontacto"=>$id);
   $query=$this->db->select("c.idcontacto,c.nombre,c.email,c.telefono,c.tratamiento,t.descripcion,c.descuento,DATE_FORMAT(c.fechaIngreso,'%d/%m/%Y')as fechaIngreso,DATE_FORMAT(c.fechaLlamada,'%d/%m/%Y %H:%m')as fechaLlamada,c.origen,c.campana,c.estado,c.obs",false)
   ->from("contacto c")
   ->join("tratamiento t","c.tratamiento= t.idtratamiento")
   ->where($where)
   ->get();
 	return $query->row();

 }

  public function update($datos=array(),$id)
  {
     $this->db->where('idcontacto', $id);
     $this->db->update('contacto', $datos); 
     return true;
  }

   public function delete($id)
  {
    $this->db->delete('contacto', array('idcontacto' => $id));
     return true;
  }

}