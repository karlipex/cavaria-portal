<?php
class Tiempo extends CI_Model {

public function insert($datos)
 {
   $this->db->insert("tiempo",$datos);
   return $this->db->insert_id();
 }

}