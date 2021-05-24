<?php
class quimica_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    

    //BARRIDOS
    public function getActas_barrido($fecha)
    { 
        $fecha_inicio=$fecha.'-01-01';
        $fecha++;
        $fecha_fin=$fecha.'-01-01';
        

        $where="barrido.id_usuario = users.id AND
  institucion_solicitante.id_institucion_solicitante = barrido.id_institucion_solicitante AND
  unidad_solicitante.id_unidad_solicitante = barrido.id_unidad_solicitante and fecha_barrido>='$fecha_inicio' and fecha_barrido<='$fecha_fin'";
        $query=$this->db
        ->select("*")
        ->from("quimica.barrido, 
                  public.users, 
                  div_inf_for.institucion_solicitante, 
                  div_inf_for.unidad_solicitante")
        ->where($where)
        ->order_by("nro_acta","asc") 
        ->get();
        return $query->result();
    }

    public function contar_barrido($fecha) 
    {
        $fecha_inicio=$fecha.'-01-01';
        $fecha++;
        $fecha_fin=$fecha.'-01-01';

        $where="fecha_barrido>='$fecha_inicio' and fecha_barrido<='$fecha_fin'";
        $query=$this->db
        ->select("*")
        ->from("quimica.barrido")  
        ->where($where)
        ->get(); 
        return $query->result(); 
    }


    public function buscar_barrido($where)
    {  
        $query=$this->db
        ->select("*")
        ->from("quimica.barrido")
        ->where($where)
        ->get();
        return $query->result(); 
    }



public function modificar_barrido($where,$datos=array())
    {
       
        $this->db->where($where);
        $this->db->update('quimica.barrido', $datos); 
        return true;  
    }

public function eliminar_barrido($campo,$campo2)
    {
        $where=array(
            "nro_acta"=>"$campo",
            "fecha_barrido"=>"$campo2"
            ); 
        $this->db->where($where);
        $this->db->delete('quimica.barrido'); 
        return true;  
    }



//descarte
    public function getActas_descarte($fecha)
    { 
        $fecha_inicio=$fecha.'-01-01';
        $fecha++;
        $fecha_fin=$fecha.'-01-01';

        $where="descarte.id_usuario = users.id AND
  institucion_solicitante.id_institucion_solicitante = descarte.id_institucion_solicitante AND
  unidad_solicitante.id_unidad_solicitante = descarte.id_unidad_solicitante and fecha_acta>='$fecha_inicio' and fecha_acta<='$fecha_fin'";
        $query=$this->db
        ->select("*")
        ->from("quimica.descarte, 
                  public.users, 
                  div_inf_for.institucion_solicitante, 
                  div_inf_for.unidad_solicitante")
        ->where($where)
        ->order_by("nro_acta","asc") 
        ->get();
        return $query->result();
    }







    public function buscar_descarte($where)
    {  
        $query=$this->db
        ->select("*")
        ->from("quimica.descarte")
        ->where($where)
        ->get();
        return $query->result(); 
    }
 
        
function contar_descarte($fecha) 
    {
        $fecha_inicio=$fecha.'-01-01';
        $fecha++;
        $fecha_fin=$fecha.'-01-01';

        $where="fecha_acta>='$fecha_inicio' and fecha_acta<='$fecha_fin'";
        $query=$this->db
        ->select("*")
        ->from("quimica.descarte")  
        ->where($where)
        ->get(); 
        return $query->result(); 
    }


public function modificar_descarte($campo,$datos=array())
    {
        $where=array(
            "nro_acta"=>$campo
            ); 
        $this->db->where($where);
        $this->db->update('quimica.descarte', $datos); 
        return true;  
    }

public function eliminar_descarte($campo)
    {
        $where=array(
            "nro_acta"=>"$campo"
            ); 
        $this->db->where($where);
        $this->db->delete('quimica.descarte'); 
        return true;  
    }









//toxicologia
    public function getActas_toxicologia($fecha)
    {   
        $fecha_inicio=$fecha.'-01-01';
        $fecha++;
        $fecha_fin=$fecha.'-01-01';


         $where="toxicologia.id_usuario = users.id and fecha_tox>='$fecha_inicio' and fecha_tox<='$fecha_fin'";
        $query=$this->db
        ->select("*")
        ->from("quimica.toxicologia,public.users")
        ->where($where)
        ->order_by("nro_acta","asc") 
        ->get();
        return $query->result();
    }




    public function contar_toxicologia($fecha) 
    {
        $fecha_inicio=$fecha.'-01-01';
        $fecha++;
        $fecha_fin=$fecha.'-01-01';

         $where=" fecha_tox>='$fecha_inicio' and fecha_tox<='$fecha_fin'";
        $query=$this->db
        ->select("*")
        ->from("quimica.toxicologia")  
        ->where($where)
        ->get(); 
        return $query->result(); 
    }

    public function buscar_toxicologico($where)
    {   
        $query=$this->db
        ->select("*")
        ->from("quimica.toxicologia")
        ->where($where)
        ->get();
        return $query->result(); 

    }

 public function modificar_toxicologico($campo,$datos=array())
    {
        $where=array(
            "nro_acta"=>$campo
            ); 
        $this->db->where($where);
        $this->db->update('quimica.toxicologia', $datos); 
        return true;  
    }

public function eliminar_toxicologico($campo,$campo2)
    {
        $where=array(
            "nro_acta"=>"$campo",
            "fecha_tox"=>"$campo2"
            ); 
    $this->db->where($where);
        $this->db->delete('quimica.toxicologia'); 
        return true;  
    }



   

    public function getActas($fecha)
    {
        $fecha_inicio=$fecha.'-01-01';
        $fecha++;
        $fecha_fin=$fecha.'-01-01';
        

        $where="acta_peritacion.id_institucion_solicitante = institucion_solicitante.id_institucion_solicitante AND
                unidad_solicitante.id_unidad_solicitante = acta_peritacion.id_unidad_solicitante AND
                users.id = acta_peritacion.id_usuario and tipo_acta='PERITACION' and fecha_acta>='$fecha_inicio' and fecha_acta<='$fecha_fin'"; 
        $query=$this->db
        ->select("*")
        ->from("quimica.acta_peritacion, 
                div_inf_for.institucion_solicitante, 
                div_inf_for.unidad_solicitante, 
                public.users")
        ->order_by("nro_acta","asc")
        ->where($where)
        ->get();
        return $query->result();
    }



    public function buscar_acta($where)
    {  
        $query=$this->db
        ->select("*")
        ->from("quimica.acta_peritacion")
        ->where($where)
        ->get();
        return $query->result(); 
    }


    function contar_actas($fecha) 
    {
        $fecha_inicio=$fecha.'-01-01';
        $fecha++;
        $fecha_fin=$fecha.'-01-01';
        
        $where="tipo_acta='PERITACION' and fecha_acta>='$fecha_inicio' and fecha_acta<='$fecha_fin'";
        $query=$this->db
        ->select("*")
        ->from("quimica.acta_peritacion")  
        ->where($where)
        ->order_by("nro_acta","ASC")
        ->get(); 
        return $query->result(); 
    }



  public function modificar_acta_peritacion($campo,$campo2,$datos=array())
    {
        $where=array(
            "nro_acta"=>$campo,
            "fecha_acta"=>"$campo2"
            ); 
        $this->db->where($where);
        $this->db->update('quimica.acta_peritacion', $datos); 
        return true;  
    }



    public function eliminar_acta_peritacioncion($campo,$campo2)
    {
        $where=array(
            "nro_acta"=>"$campo",
            "fecha_acta"=>"$campo2" 
            ); 
    $this->db->where($where);
        $this->db->delete('quimica.acta_peritacion'); 
        return true;  
    }




    

}