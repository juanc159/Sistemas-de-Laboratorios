<?php
class acta_recepcion_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
   
    function contar_actas($campo,$fecha) 
    {

        $fecha_inicio=$fecha.'-01-01';
        $fecha++;
        $fecha_fin=$fecha.'-01-01';
        
        
        $where="acta_recepcion.tipo_acta='$campo' and fecha_acta>='$fecha_inicio' and fecha_acta<='$fecha_fin'";
        $query=$this->db
            ->select("*")
            ->from("div_inf_for.acta_recepcion") 
            ->where($where)
            ->get(); 
        return $query->result(); 
    }

 

    public function getActas($variable,$fecha)
    {
        
        $fecha_inicio=$fecha.'-01-01';
        $fecha++;
        $fecha_fin=$fecha.'-01-01';
        
       
        
        if ($variable=='RECEPCION' or $variable=='DEVOLUCION')
        {
            $where="acta_recepcion.id_institucion_solicitante = institucion_solicitante.id_institucion_solicitante AND
                    acta_recepcion.id_unidad_solicitante = unidad_solicitante.id_unidad_solicitante AND
                  acta_recepcion.id_tipo_experticia = tipo_experticia.id_tipo_experticia AND
                  acta_recepcion.id_usuario = users.id and acta_recepcion.tipo_acta='$variable' and fecha_acta>='$fecha_inicio' and fecha_acta<='$fecha_fin'";

            $tablas = array('public.users,
                    div_inf_for.tipo_experticia, 
                  div_inf_for.institucion_solicitante, 
                  div_inf_for.unidad_solicitante, 
                  div_inf_for.acta_recepcion');
        }

        if ($variable=='PERITACION')
        {
            $where="acta_peritacion.id_institucion_solicitante = institucion_solicitante.id_institucion_solicitante AND                 unidad_solicitante.id_unidad_solicitante = acta_peritacion.id_unidad_solicitante AND
                users.id = acta_peritacion.id_usuario and tipo_acta='$variable' and fecha_acta>='$fecha_inicio' and fecha_acta<='$fecha_fin'"; 

            $tablas = array('quimica.acta_peritacion, 
                div_inf_for.institucion_solicitante, 
                div_inf_for.unidad_solicitante, 
                public.users'); 
        }


        $query=$this->db
        ->select("*") 
        ->from($tablas) 
        ->where($where)
        ->order_by("nro_acta","asc")
        ->get();
        return $query->result();
    }

    public function buscar_acta($campo1,$campo2,$campo3,$campo4,$fecha)
    {  
        $query=$this->db
        ->select("*")
        ->from("div_inf_for.acta_recepcion")
        ->where("$campo1='$campo2' and $campo3='$campo4' and fecha_acta='$fecha'")
        ->get();
        return $query->result(); 
    }

    public function buscar_evidencias($campo1,$campo2)
    {  
        $query=$this->db
        ->select("*")
        ->from("div_inf_for.evidencia")
        ->where("nro_acta='$campo1'")
        ->get();
        return $query->result(); 
    }

    public function buscar($tabla,$where,$tipo=true)
    {  
         
        $query=$this->db
        ->select("*")
        ->from("$tabla")
        ->where($where)
        ->get();
        if ($tipo)
            return $query->result();
        else
            return $query->row();
         
    }

    public function buscar2($tabla,$campo1,$campo2,$tipo=true)
    {  
        $query=$this->db
        ->select("*")
        ->from("$tabla")
        ->where("$campo1='$campo2'")
        ->get();
        if ($tipo)
            return $query->result();
        else
            return $query->row();
    }

    public function mostrar_unidad_solicitante()
    { 
        $query=$this->db
        ->select("*")
        ->from("div_inf_for.unidad_solicitante") 
        ->order_by("id_unidad_solicitante","asc")
        ->get(); 
        return $query->result();
    }

     public function mostrar_institucion_solicitante()
    { 
        $query=$this->db
        ->select("*")
        ->from("div_inf_for.institucion_solicitante") 
        ->order_by("id_institucion_solicitante","asc")
        ->get(); 
        return $query->result();
    }

    public function mostrar_tipo_experticia($id_grupo)
    { 
        $where=array(
            "id_grupo"=>$id_grupo
        );
        $query=$this->db
        ->select("*")
        ->from("div_inf_for.tipo_experticia") 
        ->where($where)
        ->order_by("id_tipo_experticia","asc")
        ->get(); 
        return $query->result();
    }

    public function mostrar_experto_designado()
    { 
        $query=$this->db
        ->select("*")
        ->from("div_inf_for.experto_designado") 
        ->order_by("id_exp_desig","asc")
        ->get(); 
        return $query->result();
    }

    public function modificar_acta_recepcion($campo,$campo2,$campo3,$datos=array())
    {
        $where=array(
            "nro_acta"=>"$campo",
            "tipo_acta"=>"$campo2",
            "fecha_acta"=>"$campo3"
            );
        $this->db->where($where);
        $this->db->update('div_inf_for.acta_recepcion', $datos); 
        return true;  
    }

    public function eliminar_acta_recepcion($campo,$campo2,$campo3)
    {
        $where=array(
            "nro_acta"=>"$campo",
            "tipo_acta"=>"$campo2",
            "fecha_acta"=>"$campo3"  
            ); 
        $this->db->where($where);
        $this->db->delete('div_inf_for.acta_recepcion'); 
        return true;  
    }




    //buscar unidad solicitante segun campo id
    public function buscar_unidad_solicitante($campo,$tipo=true)
    { 
        $where=array(
            "id_unidad_solicitante"=>"$campo"
            ); 
        $query=$this->db 
        ->select("*")
        ->from("div_inf_for.unidad_solicitante") 
        ->where($where) 
        ->get();  
        if ($tipo)
            return $query->result();
        else
            return $query->row(); 
    }

    //buscar insittucion solicitante segun campo id
    public function buscar_institucion_solicitante($campo,$tipo=true)
    { 
        $where=array(
            "id_institucion_solicitante"=>"$campo"
            ); 
        $query=$this->db 
        ->select("*")
        ->from("div_inf_for.institucion_solicitante") 
        ->where($where) 
        ->get(); 
        if ($tipo)
            return $query->result();
        else
            return $query->row(); 
    }


    //buscar tipo de experticia segun campo id
    public function buscar_tipo_experticias($campo,$tipo=true)
    { 
        $where=array(
            "id_tipo_experticia"=>"$campo"
            ); 
        $query=$this->db 
        ->select("*")
        ->from("div_inf_for.tipo_experticia") 
        ->where($where) 
        ->get(); 
        if ($tipo)
            return $query->result();
        else
            return $query->row(); 
    }

     
 
	public function eliminar_dictamen($nro_acta,$tipo_acta,$fecha_acta)
    {
        $datos=array(
            "representante_mp" => "",
            "fecha_autorizacion" => "",
            "hora_autorizacion" => "",
            "num_ofi_remision" => "",
            "fecha_remision" => "",
            "hora_remision" => "",
            "fecha_entrega" => "",
            "hora_entrega" => "",
            "nombre_entrega" => "",
            "cargo_entrega" => "",
            "ced_entrega" => "",
            "telf_entrega" => "",
            "obs_remision" => "",
            "status_remi" => "1",
            "remision_ano" => "",

            ); 
        $where=array(
            "id_remision_q"=>"$nro_acta",
            "tipo_acta"=>"$tipo_acta",
            "remision_ano"=>"$fecha_acta" 
            ); 
            $this->db->where($where);
            $this->db->update('quimica.remision_dictamen', $datos); 
        return true;  
    } 
 
}