<?php
$config=array
(
    /**
	 * Formulario
	 */
	'peritacion/validar'
		=> array(			 
                  array(
                  'field' => 'fecha_acta',
                  'label' => 'Fecha del Acta',
                  'rules' => 'required|trim'), 
                  array(
                  'field' => 'id_unidad_solicitante',
                  'label' => 'Unidad Solicitante',
                  'rules' => 'validaSelect'),
                   array(
                  'field' => 'id_institucion_solicitante',
                  'label' => 'Institucion Solicitante',
                  'rules' => 'validaSelect'),
                  array(
                  'field' => 'nro_oficio',
                  'label' => 'Numero de Oficio',
                  'rules' => 'required|trim'),
                  array(
                  'field' => 'fecha_oficio',
                  'label' => 'Fecha del Oficio',
                  'rules' => 'required|trim'),
                  array(
                  'field' => 'num_causa',
                  'label' => 'Numero de Causa',
                  'rules' => 'trim'),
                  array(
                  'field' => 'num_expediente',
                  'label' => 'Numero de Expediente',
                  'rules' => 'trim'),
                  array(
                  'field' => 'nombre_imputado',
                  'label' => 'Nombre del o los Imputados',
                  'rules' => 'trim'),
                  array(
                  'field' => 'cedula_imputado',
                  'label' => 'Cedula del Imputado',
                  'rules' => 'required|trim|min_length[7]'),
                  array(
                  'field' => 'editor',
                  'label' => 'Evidencia',
                  'rules' => 'required|trim'), 
                  array(
                  'field' => 'jefe_nombre',
                  'label' => 'Nombre del Jefe de la Comision',
                  'rules' => 'required|trim'),
                  array(
                  'field' => 'jefe_cedula',
                  'label' => 'Cedula del Jefe de la Comision',
                  'rules' => 'required|trim|numeric|max_length[8]|min_length[7]') 
		),
        
        /**
	 * otro ejemplo
	 */
	'actas_dev_recep/validar'
		=> array(              
                  array(
                  'field' => 'tipo_acta',
                  'label' => 'Tipo de Acta',
                  'rules' => 'validaSelect'), 
                  array(
                  'field' => 'id_institucion_solicitante',
                  'label' => 'Institucion Solicitante',
                  'rules' => 'validaSelect'), 
                  array(
                  'field' => 'id_unidad_solicitante',
                  'label' => 'Unidad Actuante',
                  'rules' => 'validaSelect'),
                  array(
                  'field' => 'dependencia_unidad',
                  'label' => 'Dependencia',
                  'rules' => 'required|trim'), 
                  array(
                  'field' => 'nro_expediente',
                  'label' => 'Numero de Expediente',
                  'rules' => 'required|trim'), 
                  array(
                  'field' => 'nro_oficio',
                  'label' => 'Numero de Oficio',
                  'rules' => 'required|trim'), 
                  array(
                  'field' => 'fecha_oficio',
                  'label' => 'Fecha del Oficio',
                  'rules' => 'required|trim'), 
                  array(
                  'field' => 'id_tipo_experticia',
                  'label' => 'Fecha del Oficio',
                  'rules' => 'validaSelect'), 
                  array(
                  'field' => 'cedula_jefe',
                  'label' => 'Cedula del Jefe de la Comisión',
                  'rules' => 'required|trim|numeric|max_length[8]|min_length[7]'),
                  array(
                  'field' => 'ape_nom_jefe',
                  'label' => 'Apellidos y nombres del Jefe de la Comisión',
                  'rules' => 'required|trim'), 
                  array(
                  'field' => 'cargo_jefe',
                  'label' => 'Grado / Jerarquia del Jefe de la Comisión',
                  'rules' => 'required|trim'), 
                  array(
                  'field' => 'telefono_jefe',
                  'label' => 'Telefono del Jefe de la Comisión',
                  'rules' => 'required|trim'), 

		),


























       /**
       * otro ejemplo
       */
      'formulario/edit'
            => array(
                  
            array('field' => 'nom',                               'label' => 'Nombre',                                                    'rules' => 'required|is_string|trim'),
             array('field' => 'nom',                                    'label' => 'Nombre',                                                    'rules' => 'required|is_string|trim')
            ),
       /**
       * otro ejemplo
       */
      'formulario/edit'
            => array(
                  
            array('field' => 'nom',                               'label' => 'Nombre',                                                    'rules' => 'required|is_string|trim'),
             array('field' => 'nom',                                    'label' => 'Nombre',                                                    'rules' => 'required|is_string|trim')
            ),
       /**
       * otro ejemplo
       */
      'formulario/edit'
            => array(
                  
            array('field' => 'nom',                               'label' => 'Nombre',                                                    'rules' => 'required|is_string|trim'),
             array('field' => 'nom',                                    'label' => 'Nombre',                                                    'rules' => 'required|is_string|trim')
            ),
       /**
       * otro ejemplo
       */
      'formulario/edit'
            => array(
                  
            array('field' => 'nom',                               'label' => 'Nombre',                                                    'rules' => 'required|is_string|trim'),
             array('field' => 'nom',                                    'label' => 'Nombre',                                                    'rules' => 'required|is_string|trim')
            ),
        
); 