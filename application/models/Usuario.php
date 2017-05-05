<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {

 public function login($usuario,$password)
 {
    $query=$this->db 
     ->select("usuario,password")
     ->from("usuario")
     ->where(array("usuario"=>$usuario,"password"=>$password))
     ->count_all_results();
     return $query;
 }

 public function getUsuario($usuario)
 {
    $where=array("u.usuario"=>$usuario);
    $query=$this->db 
    ->select("u.idusuario,CONCAT(e.nombre,' ',e.paterno,' ',e.materno)as completo,u.permisos,u.usuario,u.password,u.estado",false)
    ->from("usuario u")
    ->join("empleado e","u.empleado= e.idempleado")
    ->where($where)
    ->get();
    return $query->row();
 }

 public function checkPassword($password)
 {
     $query=$this->db 
     ->select("usuario,password")
     ->from("usuario")
     ->where(array("password"=>$password))
     ->count_all_results();
     return $query;
 }

 public function updateUsuario($datos=array(),$id)
 {
   $this->db->where('idusuario',$id);
   $this->db->update('usuario', $datos); 
   return true;
 }

 public function listCape()
 {
   $where=array("u.permisos"=>1001);
   $query=$this->db 
   ->select("u.idusuario,CONCAT(e.nombre,' ',e.paterno,' ',e.materno)as completo,u.permisos,u.usuario,u.password,u.estado",false)
   ->from("usuario u")
   ->join("empleado e","u.empleado= e.idempleado")
   ->where($where)
   ->get();
   return $query->result();
 }

}