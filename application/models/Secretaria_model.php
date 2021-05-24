<?php
class secretaria_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
   
   //REMISION TOXICOLOGICO
public function getToxcicologico()
    {
        $where="toxicologia.id_usuario = usuarios.id_usuario";
        $query=$this->db
        ->select("*")
        ->from("div_inf_for.usuarios, 
                quimica.toxicologia")
        ->order_by("nro_acta","asc")
        ->where($where)
        ->get();
        return $query->result();
    }

   //REMISION DESCARTES
    public function getToxicologico_id($campo)
    {
        $where=" id_remision_tox='$campo'";
        $query=$this->db
        ->select("*")
        ->from("quimica.remision_toxicologico")
        ->where($where)
        ->get();
        return $query->result();
    }









   //REMISION DESCARTES
    public function getDescartes_id($campo)
    {
        $where=" id_remision_des='$campo'";
        $query=$this->db
        ->select("*")
        ->from("quimica.remision_descarte")
        ->where($where)
        ->get();
        return $query->result();
    }
 

 public function getDescarte($fecha)
    {

        $fecha_inicio=$fecha.'-01-01';
        $fecha++;
        $fecha_fin=$fecha.'-01-01';

        $where="descarte.id_usuario = users.id AND
  institucion_solicitante.id_institucion_solicitante = descarte.id_institucion_solicitante AND
  unidad_solicitante.id_unidad_solicitante = descarte.id_unidad_solicitante  and fecha_acta>='$fecha_inicio' and fecha_acta<='$fecha_fin'";
        $query=$this->db
        ->select("*")
        ->from("quimica.descarte, 
  public.users, 
  div_inf_for.institucion_solicitante, 
  div_inf_for.unidad_solicitante")
        ->order_by("nro_acta","asc")
        ->where($where)
        ->get();
        return $query->result();
    }




     public function getBarridos($fecha)
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
        ->order_by("nro_acta","asc")
        ->where($where)
        ->get();
        return $query->result();
    }
   



//obtener todas las actas segun el tipo de acta
    public function getActas_Tipo($tipo_acta)
    {
        $query=$this->db
        ->select("*")
        ->from("quimica.remision_dictamen") 
        ->get();
        return $query->result();
    }





   // REMISION ACTAS PERICIALES DICTAMES
 
    public function modificar_remision_dictamen($where,$datos=array())
    {
        $this->db->where($where);
        $this->db->update('quimica.remision_dictamen', $datos); 
        return true;  
    }

    public function getRemisiones($where)
    {
        $query=$this->db
        ->select("*")
        ->from("quimica.remision_dictamen") 
        ->where($where)
        ->order_by('id_remision_q', 'asc')
        ->get();
        return $query->result();
    }





    public function getRemisiones_id($campo,$campo2)
    {
        $where=" id_remision_q='$campo' and tipo_acta='$campo2'";
        $query=$this->db
        ->select("*")
        ->from("quimica.remision_dictamen") 
        ->where($where)
        ->get();
        return $query->result();
    }
 

 
}