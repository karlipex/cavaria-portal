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

 public function countNewContact()
 {
    $query=$this->db 
     ->select("idcontacto")
     ->from("contacto")
     ->where(array("estado"=>"En espera de llamado"))
     ->count_all_results();
     return $query;
 }

 public function countCallContact()
 {
    $query=$this->db 
     ->select("idcontacto")
     ->from("contacto")
     ->where(array("estado !="=>"En espera de llamado"))
     ->count_all_results();
     return $query;
 }

 public function countAgendContact()
 {
    $query=$this->db 
     ->select("idcontacto")
     ->from("contacto")
     ->where(array("estado "=>"Agendo"))
     ->count_all_results();
     return $query;
 }

 public function countNotCallContact()
 {
    $query=$this->db 
     ->select("idcontacto")
     ->from("contacto")
     ->where(array("estado "=>"No llamar más"))
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
   $query=$this->db->select("c.idcontacto,c.nombre,c.email,c.telefono,c.tratamiento,t.descripcion,c.descuento,DATE_FORMAT(c.fechaIngreso,'%d/%m/%Y')as fechaIngreso,DATE_FORMAT(c.fechaLlamada,'%d/%m/%Y %H:%m')as fechaLlamada,c.origen,c.campana,c.estado,c.obs,c.ocupado",false)
   ->from("contacto c")
   ->join("tratamiento t","c.tratamiento= t.idtratamiento")
   ->where($where)
   ->get();
 	return $query->row();

 }

 public function listContactoCape()
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(nuevaIteracion,'%Y-%m-%d')"=>$curr_date,"estado !="=>"No llamar más","ocupado !="=>"S","cita"=>0);
   $query=$this->db->select("idcontacto,DATE_FORMAT(nuevaIteracion,'%Y-%m-%d') as fecha,estado,cita",false)
   ->from("contacto")
   ->where($where)
   //->order_by("idcontacto","random")
   ->order_by("prioridad","asc")
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