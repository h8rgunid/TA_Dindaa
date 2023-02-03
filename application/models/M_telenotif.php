<?php
 class M_telenotif extends CI_Model {
 
    public function __construct(){
           parent::__construct();
      }

    function getAllData()
    {
        $query=$this->db->query("SELECT * FROM telenotif");
        return $query->result();
    }
}