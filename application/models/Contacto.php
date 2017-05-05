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

 public function countContactOdl($usuario)
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $query=$this->db 
     ->select("idcontacto")
     ->from("contacto")
     ->where(array("orden"=>0,"usuario"=>$usuario,"DATE_FORMAT(nuevaIteracion,'%Y-%m-%d')"=>$curr_date))
     ->count_all_results();
     return $query;
 }

 public function countCola($usuario)
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $query=$this->db 
    ->select("idcontacto")
    ->from("contacto")
    ->where(array("orden"=>1,"usuario"=>$usuario,"DATE_FORMAT(nuevaIteracion,'%Y-%m-%d')"=>$curr_date))
    ->count_all_results();
    return $query;
 }

 public function countNew()
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $query=$this->db 
    ->select("idcontacto")
    ->from("contacto")
    ->where(array("orden"=>2,"DATE_FORMAT(nuevaIteracion,'%Y-%m-%d')"=>$curr_date))
    ->count_all_results();
    return $query;
 }

 public function countNewContact()
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(cn.fecha,'%Y-%m-%d')"=>$curr_date);
    $query=$this->db 
     ->select("cn.idcon as id")
     ->from("contacto cto")
     ->join("con cn","cn.usuario = cto.idcontacto")
     ->where($where)
     ->count_all_results();
     return $query;
 }

 public function countContactCall()
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(ll.fecha,'%Y-%m-%d')"=>$curr_date);
    $query=$this->db 
     ->select("cn.idllam as id")
     ->from("contacto cto")
     ->join("llam ll","ll.usuario = cto.idcontacto")
     ->where($where)
     ->count_all_results();
     return $query;
 }

 public function countContactados()
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(cnt.fecha,'%Y-%m-%d')"=>$curr_date);
    $query=$this->db 
     ->select("cnt.idcont as id")
     ->from("contacto cto")
     ->join("cont cnt","cnt.usuario = cto.idcontacto")
     ->where($where)
     ->count_all_results();
     return $query;
 }

 public function countAgendContact()
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(ag.fecha,'%Y-%m-%d')"=>$curr_date);
    $query=$this->db 
     ->select("ag.idagen as id")
     ->from("contacto cto")
     ->join("agen ag","ag.usuario = cto.idcontacto")
     ->where($where)
     ->count_all_results();
     return $query;
 }

 public function countNewContact2($campana,$start_date,$end_date)
 {

   $query=$this->db 
     ->select("cn.idcon as id")
     ->from("contacto cto")
     ->join("con cn","cn.usuario = cto.idcontacto")
     ->like("cto.campana",$campana)
     ->where("DATE_FORMAT(cn.fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(cn.fecha,'%Y-%m-%d') <=", $end_date)
     ->count_all_results();
     return $query;
 }

 public function countCallContact2($campana,$start_date,$end_date)
 {

   $query=$this->db 
     ->select("ll.idllam as id")
     ->from("contacto cto")
     ->join("llam ll","ll.usuario = cto.idcontacto")
     ->like("cto.campana",$campana)
     ->where("DATE_FORMAT(ll.fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(ll.fecha,'%Y-%m-%d') <=", $end_date)
     ->count_all_results();
     return $query;
 }

 public function countContactados2($campana,$start_date,$end_date)
 {
   $query=$this->db 
     ->select("cnt.idcont as id")
     ->from("contacto cto")
     ->join("cont cnt","cnt.usuario = cto.idcontacto")
     ->like("cto.campana",$campana)
     ->where("DATE_FORMAT(cnt.fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(cnt.fecha,'%Y-%m-%d') <=", $end_date)
     ->count_all_results();
     return $query;
 }

 public function coundAgendContact2($campana,$start_date,$end_date)
 {
    $query=$this->db 
     ->select("ag.idagen as id")
     ->from("contacto cto")
     ->join("agen ag","ag.usuario = cto.idcontacto")
     ->like("cto.campana",$campana)
     ->where("DATE_FORMAT(ag.fecha,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(ag.fecha,'%Y-%m-%d') <=", $end_date)
     ->count_all_results();
     return $query;
 }

 public function traeCampana()
 {
   $query=$this->db
   ->distinct()
   ->select("campana")
   ->from("contacto")
   ->order_by("campana")
   ->get();
   return $query->result();
 }

 public function listContacto()
 {
 	$query=$this->db->select("c.idcontacto as recid,c.nombre,c.email,c.telefono,c.tratamiento,c.descuento,DATE_FORMAT(c.fechaIngreso,'%d/%m/%Y %H:%m')as fechaIngreso,c.origen,c.campana",false)
 	->from("contacto c")
 	->order_by("c.idcontacto","desc")
 	->get();
 	return $query->result();
 }

 public function listContacto1()
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(c.fechaIngreso,'%Y-%m-%d')"=>$curr_date);
  $query=$this->db->select("c.idcontacto as recid,c.nombre,c.email,c.telefono,c.tratamiento,c.descuento,DATE_FORMAT(c.fechaIngreso,'%d/%m/%Y %H:%m')as fechaIngreso,c.origen,c.campana",false)
  ->from("contacto c")
  ->where($where)
  ->order_by("c.idcontacto","desc")
  ->get();
  return $query->result();
 }

 public function listContacto2()
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(c.fechaIngreso,'%Y-%m-%d')"=>$curr_date,"estado !="=>"En espera de llamado");
   $query=$this->db->select("c.idcontacto as recid,c.nombre,c.email,c.telefono,c.tratamiento,c.descuento,DATE_FORMAT(c.fechaIngreso,'%d/%m/%Y %H:%m')as fechaIngreso,c.origen,c.campana",false)
   ->from("contacto c")
   ->where($where)
   ->order_by("c.idcontacto","desc")
   ->get();
  return $query->result();
 }

 public function listContacto3()
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(c.fechaIngreso,'%Y-%m-%d')"=>$curr_date,"estado"=>"Agenda");
   $query=$this->db->select("c.idcontacto as recid,c.nombre,c.email,c.telefono,c.tratamiento,c.descuento,DATE_FORMAT(c.fechaIngreso,'%d/%m/%Y %H:%m')as fechaIngreso,c.origen,c.campana",false)
   ->from("contacto c")
   ->where($where)
   ->order_by("c.idcontacto","desc")
   ->get();
  return $query->result();
 }

 public function listContacto4($campana,$start_date,$end_date)
 {
    $query=$this->db->select("c.idcontacto as recid,c.nombre,c.email,c.telefono,c.tratamiento,c.descuento,DATE_FORMAT(c.fechaIngreso,'%d/%m/%Y %H:%m')as fechaIngreso,c.origen,c.campana",false)
     ->from("contacto c")
     ->like("c.campana",$campana)
     ->where("DATE_FORMAT(c.fechaIngreso,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(c.fechaIngreso,'%Y-%m-%d') <=", $end_date)
     ->get();
  return $query->result();
 }

 public function listContacto5($campana,$start_date,$end_date)
 {
    $query=$this->db->select("c.idcontacto as recid,c.nombre,c.email,c.telefono,c.tratamiento,c.descuento,DATE_FORMAT(c.fechaIngreso,'%d/%m/%Y %H:%m')as fechaIngreso,c.origen,c.campana",false)
     ->from("contacto c")
     ->like("c.campana",$campana)
     ->where("c.estado !=","En espera de llamado")
     ->where("DATE_FORMAT(c.fechaIngreso,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(c.fechaIngreso,'%Y-%m-%d') <=", $end_date)
     ->get();
  return $query->result();
 }

 public function listContacto6($campana,$start_date,$end_date)
 {
    $query=$this->db->select("c.idcontacto as recid,c.nombre,c.email,c.telefono,c.tratamiento,c.descuento,DATE_FORMAT(c.fechaIngreso,'%d/%m/%Y %H:%m')as fechaIngreso,c.origen,c.campana",false)
     ->from("contacto c")
     ->like("c.campana",$campana)
     ->where("c.estado","Agenda")
     ->where("DATE_FORMAT(c.fechaIngreso,'%Y-%m-%d') >=", $start_date)
     ->where("DATE_FORMAT(c.fechaIngreso,'%Y-%m-%d') <=", $end_date)
     ->get();
  return $query->result();
 }

 public function getContacto($id)
 {
   $where=array("c.idcontacto"=>$id);
   $query=$this->db->select("c.idcontacto,c.nombre,c.email,c.telefono,c.tratamiento,c.descuento,DATE_FORMAT(c.fechaIngreso,'%d/%m/%Y')as fechaIngreso,DATE_FORMAT(c.fechaLlamada,'%d/%m/%Y %H:%m')as fechaLlamada,c.origen,c.campana,c.estado,c.obs,c.ocupado",false)
   ->from("contacto c")
   ->where($where)
   ->get();
 	return $query->row();

 }

 public function listContactoCape($usuario)
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(nuevaIteracion,'%Y-%m-%d')"=>$curr_date,"orden"=>0,"usuario"=>$usuario);
   $query=$this->db->select("idcontacto,DATE_FORMAT(nuevaIteracion,'%Y-%m-%d') as fecha,estado,cita",false)
   ->from("contacto")
   ->where($where)
   //->order_by("idcontacto","random")
   ->order_by("prioridad","asc")
   ->get();
    return $query->row();
 }

 public function listContactoCape1($usuario)
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(nuevaIteracion,'%Y-%m-%d')"=>$curr_date,"orden"=>1,"usuario"=>$usuario);
   $query=$this->db->select("idcontacto,DATE_FORMAT(nuevaIteracion,'%Y-%m-%d') as fecha,estado,cita",false)
   ->from("contacto")
   ->where($where)
   //->order_by("idcontacto","random")
   ->order_by("prioridad","asc")
   ->get();
    return $query->row();
 }

 public function listContactoCape2()
 {
   $day= new DateTime("now");
   $curr_date = $day->format('Y-m-d');
   $where=array("DATE_FORMAT(nuevaIteracion,'%Y-%m-%d')"=>$curr_date,"orden"=>2);
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