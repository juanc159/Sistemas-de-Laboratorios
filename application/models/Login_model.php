<?php
class login_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    


   public function logueo($login,$pass)
    {
        $query=$this->db
        ->select("*")
        ->from("div_inf_for.usuarios")
        ->where(array("usuario"=>$login,"clave"=>$pass))
        ->get();
        //echo $this->db->last_query();
        return $query->row();
    }

 
}