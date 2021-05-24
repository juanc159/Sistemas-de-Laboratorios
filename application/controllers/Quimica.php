<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quimica extends CI_Controller { 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);
 

        $this->lang->load('auth'); 
        $this->layout->setLayout('template1'); 

        //cuadro para mostrar los mensajes de error
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 

        $this->formato = $this->session->userdata('formato');

 
    }

    

    public function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->view('index');       
         
    }





//FUNCIONES DEL ACTA DE BARRIDO
    //SOLO MUESTRA LOS REGISTROS AGREGADOS
    public function barrido()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->js(array(base_url()."public/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bootstrap/js/bootstrap.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/jquery.dataTables.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"));
 
        $fecha_a=$this->uri->segment(3);
        $datos=$this->quimica_model->getActas_barrido($fecha_a); 
        $this->layout->view('barrido/registros',compact("datos"));         
    }


//AGREGAR NUEVA ACTA DE BARRIDO
    public function nuevoBarrido()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->js(array(base_url()."public/ckeditor/ckeditor.js"));
        $this->layout->js(array(base_url()."public/ckeditor/samples/js/sample.js"));
        $this->layout->css(array(base_url()."public/AdminLTE/bower_components/select2/dist/css/select2.min.css")); 
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/jquery/dist/jquery.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/select2/dist/js/select2.full.min.js")); 

         
            //calcular el numero de acta que viene, contando
            // todas las actas que existen
            $may=1;
            $fecha_a=$this->uri->segment(3);
            $datos=$this->quimica_model->contar_barrido($fecha_a);
            if ($datos) {
                foreach($datos as $dato)
                {
                    $nro_acta=$dato->nro_acta;
                    if ($nro_acta>=$may) {
                        $may=$nro_acta+1;
                    }

                }
            }

            $nro_acta=$may; 
            $user = $this->ion_auth->user()->row();
            $id_usuario=$user->id;

             //VALIDA SI EL FORMATO ES 1 ENTONCES MUESTRA PO PRIMERA VEZ EL FORMATO ESCRITO EN EL TEXTAREA SI ES CERO NO LO MUESTRA
            $this->session->set_userdata('formato', '1');
            $this->formato=$this->session->userdata('formato');
            if($this->input->post())
            { 
                //PARA EVITAR QUE MUESTRE OTRA VEZ EL TEXTO FORMATEADO EN EL TEXT AREA
                $this->session->set_userdata('formato', '0');
                $this->formato=$this->session->userdata('formato');
                //if ($this->form_validation->run("peritacion/validar"))
               // { 
                    $data = array(  
                        'nro_acta' => $nro_acta, 
                        'experto' => $this->input->post("experto",true), 
                        'quien_autoriza' => $this->input->post("quien_autoriza",true), 
                        'id_institucion_solicitante' => $this->input->post("id_institucion_solicitante",true),  
                        'id_unidad_solicitante' => $this->input->post("id_unidad_solicitante",true),
                        'dependencia_unidad' => $this->input->post("dependencia_unidad",true),
                        'solicitante' => $this->input->post("solicitante",true),
                        'nro_oficio' => $this->input->post("nro_oficio",true),
                        'fecha_oficio' => $this->input->post("fecha_oficio",true),
                        'fecha_barrido' => $this->input->post("fecha_barrido",true),
                        'lugar' => $this->input->post("lugar",true), 
                        'ubicacion' => $this->input->post("ubicacion",true), 
                        'evidencia' => $this->input->post("editor",true),
                        'id_usuario' => $id_usuario
                    );

                    $nro_acta=$nro_acta;
                    $fecha_barrido=$this->input->post("fecha_barrido",true);
                    $guardar=$this->db->insert('quimica.barrido', $data);
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'quimica/editarBarrido/'.$nro_acta.'/'.$fecha_barrido,  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'quimica/barrido/',  301);
                    }  
               // }
            }
 
            
            //muestra las unidaddes solicitantes agregadas
            $unidades_act=$this->acta_recepcion_model->mostrar_unidad_solicitante();
            $instituciones=$this->acta_recepcion_model->mostrar_institucion_solicitante();
            
            $fecha_a=$this->uri->segment(3);
            $datos=$this->quimica_model->getActas_barrido($fecha_a); 
            $this->layout->view('barrido/nuevo',compact("datos","nro_acta","unidades_act","instituciones"));       
         
    }


    //AGREGAR NUEVA ACTA DE BARRIDO
    public function editarBarrido()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->js(array(base_url()."public/ckeditor/ckeditor.js"));
        $this->layout->js(array(base_url()."public/ckeditor/samples/js/sample.js"));
        $this->layout->css(array(base_url()."public/AdminLTE/bower_components/select2/dist/css/select2.min.css")); 
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/jquery/dist/jquery.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/select2/dist/js/select2.full.min.js")); 

         
            //SACA EL NUMERO DEL ACTA A EDITAR
            $nro_acta=$this->uri->segment(3); 
            
            
            if($this->input->post())
            { 
                //if ($this->form_validation->run("peritacion/validar"))
               // { 
                    $data = array(   
                        'experto' => $this->input->post("experto",true), 
                        'quien_autoriza' => $this->input->post("quien_autoriza",true),
                        'id_institucion_solicitante' => $this->input->post("id_institucion_solicitante",true),  
                        'id_unidad_solicitante' => $this->input->post("id_unidad_solicitante",true),
                        'dependencia_unidad' => $this->input->post("dependencia_unidad",true),
                        'solicitante' => $this->input->post("solicitante",true),
                        'nro_oficio' => $this->input->post("nro_oficio",true),
                        'fecha_oficio' => $this->input->post("fecha_oficio",true),
                        'fecha_barrido' => $this->input->post("fecha_barrido",true),
                        'lugar' => $this->input->post("lugar",true), 
                        'ubicacion' => $this->input->post("ubicacion",true), 
                        'evidencia' => $this->input->post("editor",true)
                    );

                    $fecha_a=$this->input->post("fecha_barrido",true);
                     $where_barrido=array(
                        "nro_acta"=>$nro_acta,
                        "fecha_barrido"=>$fecha_a
                        ); 
                    $guardar=$this->quimica_model->modificar_barrido($where_barrido,$data); 
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Modificado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'quimica/editarBarrido/'.$nro_acta.'/'.$fecha_a,  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'quimica/barrido/',  301);
                    }  
               // }
            }
 
            //muestra las unidaddes solicitantes agregadas
            //muestra las unidaddes solicitantes agregadas
            $unidades_act=$this->acta_recepcion_model->mostrar_unidad_solicitante();
            $instituciones=$this->acta_recepcion_model->mostrar_institucion_solicitante(); 

            $tipo_a='BARRIDO';
            $nro_acta=$this->uri->segment(3);
            $fecha_a=$this->uri->segment(4); 
             $where = array(
                'nro_acta' => $nro_acta,
                'fecha_barrido' => $fecha_a,
            );
            $datos=$this->acta_recepcion_model->buscar('quimica.barrido',$where);
            $this->layout->view('barrido/editar',compact("datos","nro_acta","unidades_act","instituciones"));       

         
    } 

//pdf donde se vizualiza el acta de BARRIDO
    public function pdfBarrido()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        
        $this->load->view('quimica/barrido/pdfBarrido'); 
    }


//ELIMINAR ACTA DE BARRIDO
    public function eliminarBarrido()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $id_p=$this->uri->segment(3); 

        $fecha_a=$this->uri->segment(4);
        $fecha_link=substr($fecha_a, 0,4);

        $eliminar=$this->quimica_model->eliminar_barrido($id_p,$fecha_a); 
        redirect(base_url().'quimica/barrido/'.$fecha_link,  301);
    }


     




//FUNCIONES DEL ACTA DE TOXICOLOGIA
    //SOLO MUESTRA LOS REGISTROS AGREGADOS
    public function toxicologico()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->js(array(base_url()."public/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bootstrap/js/bootstrap.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/jquery.dataTables.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"));
 
        $fecha_a=$this->uri->segment(3); 

            $datos=$this->quimica_model->getActas_toxicologia($fecha_a); 
            $this->layout->view('toxicologico/registros',compact("datos"));       
         
    }

//AGREGAR NUEVA ACTA DE TOXICOLOGICO
    public function nuevoToxicologico()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->js(array(base_url()."public/ckeditor/ckeditor.js"));
        $this->layout->js(array(base_url()."public/ckeditor/samples/js/sample.js"));
        $this->layout->css(array(base_url()."public/AdminLTE/bower_components/select2/dist/css/select2.min.css")); 
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/jquery/dist/jquery.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/select2/dist/js/select2.full.min.js")); 

         
            //calcular el numero de acta que viene, contando
            // todas las actas que existen
            $may=1;
            $fecha_a=$this->uri->segment(3);
            $datos=$this->quimica_model->contar_toxicologia($fecha_a); 
            if ($datos) {
                foreach($datos as $dato)
                {
                    $nro_acta=$dato->nro_acta;
                    if ($nro_acta>=$may) {
                        $may=$nro_acta+1;
                    }

                }
            }

            $nro_acta=$may; 
            $user = $this->ion_auth->user()->row();
            $id_usuario=$user->id; 
            if($this->input->post())
            { 
                //if ($this->form_validation->run("peritacion/validar"))
               // { 
                    $data = array(  
                        'nro_acta' => $nro_acta, 
                        'experto' => $this->input->post("experto",true), 
                        'quien_autoriza' => "CNEL. MARIN GONZALEZ EDUARDO EMIRO", 
                        'solicitante' => $this->input->post("solicitante",true),  
                        'nro_oficio' => $this->input->post("nro_oficio",true),
                        'fecha_oficio' => $this->input->post("fecha_oficio",true),
                        'ciudadano' => $this->input->post("ciudadano",true),
                        'nacio_ciu' => $this->input->post("nacio_ciu",true),
                        'cedula_ciu' => $this->input->post("cedula_ciu",true),
                        'domicilio_ciu' => $this->input->post("domicilio_ciu",true), 
                        'fecha_tox' => $this->input->post("fecha_tox",true), 
                        'hora_tox' => $this->input->post("hora_tox",true),
                        'testigo' => $this->input->post("testigo",true),
                        'marihuana' => $this->input->post("marihuana",true),
                        'cocaina' => $this->input->post("cocaina",true),
                        'opiaceos' => $this->input->post("opiaceos",true),
                        'id_usuario' => $id_usuario
                    );

                    $nro_acta=$nro_acta;
                    $fecha_toxi=$this->input->post("fecha_tox",true);
                    $guardar=$this->db->insert('quimica.toxicologia', $data);
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'quimica/editarToxicologico/'.$nro_acta.'/'.$fecha_toxi,  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'quimica/Toxicologico/',  301);
                    }  
               // }
            }
 
            
            //muestra las unidaddes solicitantes agregadas
            $unidades_act=$this->acta_recepcion_model->mostrar_unidad_solicitante();
            $instituciones=$this->acta_recepcion_model->mostrar_institucion_solicitante();
            $fecha_a=$this->uri->segment(3); 

            $datos=$this->quimica_model->getActas_toxicologia($fecha_a);  
            $this->layout->view('toxicologico/nuevo',compact("datos","nro_acta","unidades_act","instituciones"));       
         
    }


//AGREGAR NUEVA ACTA DE TOXICOLOGICO
    public function editarToxicologico()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->js(array(base_url()."public/ckeditor/ckeditor.js"));
        $this->layout->js(array(base_url()."public/ckeditor/samples/js/sample.js"));
        $this->layout->css(array(base_url()."public/AdminLTE/bower_components/select2/dist/css/select2.min.css")); 
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/jquery/dist/jquery.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/select2/dist/js/select2.full.min.js")); 

         
            //SACA EL NUMERO DEL ACTA A EDITAR
            $nro_acta=$this->uri->segment(3);
            $fecha_a=$this->uri->segment(4);
            $where = array(
                'nro_acta' =>$nro_acta,
                'fecha_tox' =>$fecha_a,
            );
            $datos=$this->quimica_model->buscar_toxicologico($where);
             
            
            if($this->input->post())
            { 
                //if ($this->form_validation->run("peritacion/validar"))
               // { 
                    $data = array(   
                        'experto' => $this->input->post("experto",true),  
                        'solicitante' => $this->input->post("solicitante",true),  
                        'nro_oficio' => $this->input->post("nro_oficio",true),
                        'fecha_oficio' => $this->input->post("fecha_oficio",true),
                        'ciudadano' => $this->input->post("ciudadano",true),
                        'nacio_ciu' => $this->input->post("nacio_ciu",true),
                        'cedula_ciu' => $this->input->post("cedula_ciu",true),
                        'domicilio_ciu' => $this->input->post("domicilio_ciu",true), 
                        'fecha_tox' => $this->input->post("fecha_tox",true), 
                        'hora_tox' => $this->input->post("hora_tox",true),
                        'testigo' => $this->input->post("testigo",true),
                        'marihuana' => $this->input->post("marihuana",true),
                        'cocaina' => $this->input->post("cocaina",true),
                        'opiaceos' => $this->input->post("opiaceos",true) 
                    );
 
                    $guardar=$this->quimica_model->modificar_toxicologico($nro_acta,$data); 
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Modificado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'quimica/editarToxicologico/'.$nro_acta.'/'.$fecha_a,  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'quimica/Toxicologico/',  301);
                    }  
               // }
            }
 
             
              
            $this->layout->view('toxicologico/editar',compact("datos","nro_acta"));       
         
    } 


//pdf donde se vizualiza el acta de TOXICOLOGIA
    public function pdfToxicologico()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->load->view('quimica/toxicologico/pdfToxicologico'); 
    }



//ELIMINAR ACTA DE TOXICOLOGIA
    public function eliminarToxicologico()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $id_p=$this->uri->segment(3);
 

        $fecha_a=$this->uri->segment(4);
        $fecha_link=substr($fecha_a, 0,4);

        $eliminar=$this->quimica_model->eliminar_toxicologico($id_p,$fecha_a); 
        redirect(base_url().'quimica/toxicologico/'.$fecha_link,  301);
    }


    



























//FUNCIONES DEL ACTA DE DESCARTE
    //SOLO MUESTRA LOS REGISTROS AGREGADOS
    public function descarte()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->js(array(base_url()."public/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bootstrap/js/bootstrap.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/jquery.dataTables.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"));
 

        $fecha_a=$this->uri->segment(3);
            $datos=$this->quimica_model->getActas_descarte($fecha_a); 
            $this->layout->view('descarte/registros',compact("datos"));       
          
    }

//AGREGAR NUEVA ACTA DE DESCARTE
    public function nuevoDescarte()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->js(array(base_url()."public/ckeditor/ckeditor.js"));
        $this->layout->js(array(base_url()."public/ckeditor/samples/js/sample.js"));
        $this->layout->css(array(base_url()."public/AdminLTE/bower_components/select2/dist/css/select2.min.css")); 
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/jquery/dist/jquery.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/select2/dist/js/select2.full.min.js")); 

         
            //calcular el numero de acta que viene, contando
            // todas las actas que existen
            $may=1;
            $fecha_a=$this->uri->segment(3);
            $datos=$this->quimica_model->contar_descarte($fecha_a);
            if ($datos) {
                foreach($datos as $dato)
                {
                    $nro_acta=$dato->nro_acta;
                    if ($nro_acta>=$may) {
                        $may=$nro_acta+1;
                    }

                }
            }

            $nro_acta=$may;
            //VALIDA SI EL FORMATO ES 1 ENTONCES MUESTRA PO PRIMERA VEZ EL FORMATO ESCRITO EN EL TEXTAREA SI ES CERO NO LO MUESTRA
            $this->session->set_userdata('formato', '1');
            $this->formato=$this->session->userdata('formato');
            $user = $this->ion_auth->user()->row();
            $id_usuario=$user->id; 
            if($this->input->post())
            {
                $this->session->set_userdata('formato', '0');
                $this->formato=$this->session->userdata('formato');
                //if ($this->form_validation->run("peritacion/validar"))
                //{ 
                    $data = array(  
                        'nro_acta' => $nro_acta, 
                        'fecha_acta' => $this->input->post("fecha_acta",true), 
                        'id_institucion_solicitante' => $this->input->post("id_institucion_solicitante",true), 
                        'id_unidad_solicitante' => $this->input->post("id_unidad_solicitante",true),  
                        'dependencia_unidad' => $this->input->post("dependencia_unidad",true),
                        'nro_oficio' => $this->input->post("nro_oficio",true),
                        'fecha_oficio' => $this->input->post("fecha_oficio",true),
                        'id_usuario' => $id_usuario,
                        'tipo_acta' => 'DESCARTE',
                        'empresa' => $this->input->post("empresa",true),
                        'exportador' => $this->input->post("exportador",true), 
                        'evidencia' => $_POST['editor'] , 
                        'jefe_nombre' => $this->input->post("jefe_nombre",true),
                        'jefe_cedula' => $this->input->post("jefe_cedula",true) 
                    );

                    $nro_acta=$nro_acta;
                    $fecha_acta=date('Y-m-d');
                    $guardar=$this->db->insert('quimica.descarte', $data);
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'quimica/editarDescarte/'.$nro_acta.'/'.$fecha_acta,  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'quimica/descarte/',  301);
                    }  
                //}
            }
 
            
            //muestra las unidaddes solicitantes agregadas
            $unidades_act=$this->acta_recepcion_model->mostrar_unidad_solicitante();
            $instituciones=$this->acta_recepcion_model->mostrar_institucion_solicitante();
            
            $fecha_a=$this->uri->segment(3);
            $datos=$this->quimica_model->getActas_descarte($fecha_a); 
            $this->layout->view('descarte/nuevo',compact("datos","nro_acta","unidades_act","instituciones"));       
        
    }


//AGREGAR NUEVA ACTA DE DESCARTE
    public function editarDescarte()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->js(array(base_url()."public/ckeditor/ckeditor.js"));
        $this->layout->js(array(base_url()."public/ckeditor/samples/js/sample.js"));
        $this->layout->css(array(base_url()."public/AdminLTE/bower_components/select2/dist/css/select2.min.css")); 
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/jquery/dist/jquery.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/select2/dist/js/select2.full.min.js")); 
 
 
         
            //SACA EL NUMERO DEL ACTA A EDITAR
            $nro_acta=$this->uri->segment(3);
            $fecha_a=$this->uri->segment(4);

            $user = $this->ion_auth->user()->row();
            $id_usuario=$user->id; 
            if($this->input->post())
            {
                //if ($this->form_validation->run("peritacion/validar"))
                //{
                    $data = array(    
                        'id_institucion_solicitante' => $this->input->post("id_institucion_solicitante",true), 
                        'id_unidad_solicitante' => $this->input->post("id_unidad_solicitante",true), 
                        'dependencia_unidad' => $this->input->post("dependencia_unidad",true), 
                        'nro_oficio' => $this->input->post("nro_oficio",true),
                        'fecha_oficio' => $this->input->post("fecha_oficio",true),
                        'id_usuario' => $id_usuario,
                        'tipo_acta' => 'DESCARTE',
                        'empresa' => $this->input->post("empresa",true),
                        'exportador' => $this->input->post("exportador",true), 
                        'evidencia' => $_POST['editor'] , 
                        'jefe_nombre' => $this->input->post("jefe_nombre",true),
                        'jefe_cedula' => $this->input->post("jefe_cedula",true) 
                    );
                    $datos=$this->quimica_model->modificar_descarte($nro_acta,$data); 
                    if($datos)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Modificado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'quimica/editarDescarte/'.$nro_acta.'/'.$fecha_a,  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'quimica/editarDescarte/'.$nro_acta,  301);
                    } 
                //}
            }

            //muestra las unidaddes solicitantes agregadas
            $unidades_act=$this->acta_recepcion_model->mostrar_unidad_solicitante();
            $instituciones=$this->acta_recepcion_model->mostrar_institucion_solicitante();

            $nro_acta=$this->uri->segment(3);
            $fecha_a=$this->uri->segment(4);
            $where = array(
                'nro_acta' =>$nro_acta,
                'fecha_acta' =>$fecha_a,
            ); 
            $datos=$this->acta_recepcion_model->buscar('quimica.descarte',$where);
            $this->layout->view('descarte/editar',compact("datos","nro_acta","unidades_act","instituciones"));       
           
    }


//pdf donde se vizualiza el acta de DESCARTE
    public function pdfDescarte()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->load->view('quimica/descarte/pdfDescarte'); 
    }



//ELIMINAR ACTA DE DESCARTE
    public function eliminarDescarte()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } 


        $id_p=$this->uri->segment(3);
 

        $fecha_a=$this->uri->segment(4);
        $fecha_link=substr($fecha_a, 0,4);

        $eliminar=$this->quimica_model->eliminar_descarte($id_p,$fecha_a); 
        redirect(base_url().'quimica/descarte/'.$fecha_link,  301);
    }


   


//FUNCIONES DEL ACTA DE PERITACION
    //SOLO MUESTRA LOS REGISTROS AGREGADOS
    public function peritacion()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->js(array(base_url()."public/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bootstrap/js/bootstrap.min.js"));
        
 
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/jquery.dataTables.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"));
        

        $fecha_a=$this->uri->segment(3);
        $datos=$this->quimica_model->getActas($fecha_a); 
        $this->layout->view('peritacion/registros',compact("datos"));       
          
    }

    //AGREGAR NUEVA ACTA DE PERITACION
    public function nuevoPeritacion()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }


        $this->layout->js(array(base_url()."public/ckeditor/ckeditor.js"));
        $this->layout->js(array(base_url()."public/ckeditor/samples/js/sample.js"));
        $this->layout->css(array(base_url()."public/AdminLTE/bower_components/select2/dist/css/select2.min.css")); 
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/jquery/dist/jquery.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/select2/dist/js/select2.full.min.js")); 

         
            //calcular el numero de acta que viene, contando
            // todas las actas que existen
            $may=1;
            $fecha_ano=$this->uri->segment(3);
            $datos=$this->quimica_model->contar_actas($fecha_ano);
            if ($datos) {
                foreach($datos as $dato)
                {
                    $nro_acta=$dato->nro_acta;
                    if ($nro_acta>=$may) {
                        $may=$nro_acta+1;
                    }

                }
            }
            $nro_acta=$may;



            $user = $this->ion_auth->user()->row();
            $id_usuario=$user->id; 

            //VALIDA SI EL FORMATO ES 1 ENTONCES MUESTRA PO PRIMERA VEZ EL FORMATO ESCRITO EN EL TEXTAREA SI ES CERO NO LO MUESTRA
            $this->session->set_userdata('formato', '1');
            $this->formato=$this->session->userdata('formato');
            if($this->input->post())
            {
                //PARA EVITAR QUE MUESTRE OTRA VEZ EL TEXTO FORMATEADO EN EL TEXT AREA
                $this->session->set_userdata('formato', '0');
                $this->formato=$this->session->userdata('formato');
                if ($this->form_validation->run("peritacion/validar"))
                { 
                    $data = array(  
                        'nro_acta' => $nro_acta, 
                        'fecha_acta' => $this->input->post("fecha_acta",true), 
                        'id_institucion_solicitante' => $this->input->post("id_institucion_solicitante",true), 
                        'id_unidad_solicitante' => $this->input->post("id_unidad_solicitante",true),  
                        'dependencia_unidad' => $this->input->post("dependencia_unidad",true),  
                        'nro_oficio' => $this->input->post("nro_oficio",true),
                        'fecha_oficio' => $this->input->post("fecha_oficio",true),
                        'id_usuario' => $id_usuario,
                        'tipo_acta' => 'PERITACION',
                        'num_causa' => $this->input->post("num_causa",true),
                        'num_expediente' => $this->input->post("num_expediente",true),
                        'nombre_imputado' => $this->input->post("nombre_imputado",true),
                        'cedula_imputado' => $this->input->post("cedula_imputado",true), 
                        'evidencia' => $_POST['editor'] , 
                        'jefe_nombre' => $this->input->post("jefe_nombre",true),
                        'jefe_cedula' => $this->input->post("jefe_cedula",true),
                        'telefono_jefe' => $this->input->post("telefono_jefe",true) 
                    );
                    $nro_acta=$nro_acta;
                    $fecha_acta=date('Y-m-d'); 
                    $guardar=$this->db->insert('quimica.acta_peritacion', $data);
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'quimica/editarPeritacion/'.$nro_acta.'/PERITACION/'.$fecha_acta,  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'quimica/peritacion/',  301);
                    }  
                }
            }
 
            
            //muestra las unidaddes solicitantes agregadas
            $unidades_act=$this->acta_recepcion_model->mostrar_unidad_solicitante();
            $instituciones=$this->acta_recepcion_model->mostrar_institucion_solicitante();
 
             
            $this->layout->view('peritacion/nuevo',compact("unidades_act","instituciones"));       
          
    }


    //AGREGAR NUEVA ACTA DE PERITACION
    public function editarPeritacion()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->layout->js(array(base_url()."public/ckeditor/ckeditor.js"));
        $this->layout->js(array(base_url()."public/ckeditor/samples/js/sample.js"));
        $this->layout->css(array(base_url()."public/AdminLTE/bower_components/select2/dist/css/select2.min.css")); 
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/jquery/dist/jquery.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bower_components/select2/dist/js/select2.full.min.js")); 
 
 
         
            //SACA EL NUMERO DEL ACTA A EDITAR
            $nro_acta=$this->uri->segment(3); 
            $fecha_a=$this->uri->segment(5);
            
            if($this->input->post())
            {
                //if ($this->form_validation->run("peritacion/validar"))
                //{
                    $data = array(    
                        'id_institucion_solicitante' => $this->input->post("id_institucion_solicitante",true),  
                        'id_unidad_solicitante' => $this->input->post("id_unidad_solicitante",true),  
                        'dependencia_unidad' => $this->input->post("dependencia_unidad",true),  
                        'nro_oficio' => $this->input->post("nro_oficio",true),
                        'fecha_oficio' => $this->input->post("fecha_oficio",true),  
                        'num_causa' => $this->input->post("num_causa",true),
                        'num_expediente' => $this->input->post("num_expediente",true),
                        'nombre_imputado' => $this->input->post("nombre_imputado",true),
                        'cedula_imputado' => $this->input->post("cedula_imputado",true), 
                        'evidencia' => $_POST['editor'] ,
                        'jefe_nombre' => $this->input->post("jefe_nombre",true),
                        'jefe_cedula' => $this->input->post("jefe_cedula",true),
                        'telefono_jefe' => $this->input->post("telefono_jefe",true) 
                    );
                    $datos=$this->quimica_model->modificar_acta_peritacion($nro_acta,$fecha_a,$data); 
                    if($datos)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Modificado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'quimica/editarPeritacion/'.$nro_acta.'/PERITACION/'.$fecha_a,  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'quimica/editarPeritacion/'.$nro_acta,  301);
                    } 
                //}
            }

            //muestra las unidaddes solicitantes agregadas
            //muestra las unidaddes solicitantes agregadas
            $unidades_act=$this->acta_recepcion_model->mostrar_unidad_solicitante();
            $instituciones=$this->acta_recepcion_model->mostrar_institucion_solicitante(); 
            $fecha_a=$this->uri->segment(5);
            $tipo_a='PERITACION';
            $where = array(
                'nro_acta' =>$nro_acta,
                'fecha_acta' =>$fecha_a,
            );
            $datos=$this->quimica_model->buscar_acta($where);
            $this->layout->view('peritacion/editar',compact("datos","nro_acta","unidades_act","instituciones"));       
         
    }




    //ELIMINAR ACTA DE PERITACION
    public function eliminarPeritacion()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $id_p=$this->uri->segment(3);

        $tipo_a=$this->uri->segment(4);

        $fecha_a=$this->uri->segment(5);
        $fecha_link=substr($fecha_a, 0,4);

        $eliminar=$this->quimica_model->eliminar_acta_peritacioncion($id_p,$fecha_a); 
        redirect(base_url().'quimica/peritacion/'.$fecha_link,  301);
    }
  
 
        
 





    //pdf donde se vizualiza el acta de PERITACION
    public function pdfPeritacion()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        
        $this->load->view('quimica/peritacion/pdf_peritacion'); 
    }

    




}
