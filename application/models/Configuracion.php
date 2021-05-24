<?php
class configuracion_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
 //descarte
    public function getUsuarios()
    {  
        $query=$this->db
        ->select("*")
        ->from("")
        ->where($where)
        ->order_by("nro_acta","asc") 
        ->get();
        return $query->result();
    }

}