<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Secretaria extends CI_Controller { 
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
    }

    


  public function index2()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        for ($i=523; $i <=638 ; $i++) { 
            $data = array(
                'nro_acta' =>$i,
                'fecha_acta' => date('d-m-Y'),
                'tipo_acta' => 'PERITACION',
                'id_institucion_solicitante' => 3,
                'id_unidad_solicitante' => 3,
                'nro_oficio' => 1,
                'fecha_oficio' => date('d-m-Y'),
                'id_usuario' => 1,

            );

            $this->db->insert('quimica.acta_peritacion', $data);

        }
        
        $this->layout->view('index');       
          
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


//REMISION DE TOXICOLOGICO
    public function remision_toxicologico()
    {
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bootstrap/js/bootstrap.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/jquery.dataTables.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"));

        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $fecha_a=$this->uri->segment(3); 
        $datos=$this->quimica_model->getActas_toxicologia($fecha_a);  
        $this->layout->view('remision_toxicologico/registros',compact("datos"));  
         
    } 


public function nuevoToxicologico()
    {

        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

            if($this->input->post())
            {
                //SACA EL NUMERO DEL ACTA
                $nro_acta=$this->uri->segment(3);
                $fecha_a=$this->uri->segment(4);
                $fecha_ano_R=substr($fecha_a, 0,4);
                $nombre_file='TOX-'.$nro_acta.'-'.$fecha_ano_R;
                //proceso la imagen
                    $error=NULL;
                    //valido la foto
                    $config['upload_path'] = './uploads/archivos_toxicologico/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '0'; 
                    $config["overwrite"]=true;
                    $config['encrypt_name'] = false; 
                    $config['file_name'] = $nombre_file; 
                    $config['remove_spaces'] = true;
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('archivo'))
                    {
                        $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('ControllerMessage', $error["error"]);
                    }
                    if($error==null)
                    {
                        $ima = $this->upload->data();
                        $file_name = $ima['file_name'];
                    }

                 
                $data = array(  
                    'id_remision_tox' => $nro_acta, 
                    'num_ofi_remi_tox' => $this->input->post("num_ofi_remi_tox",true),
                    'fecha_remi_tox' => $this->input->post("fecha_remision",true),
                    'hora_remi_tox' => $this->input->post("hora_remision",true),
                    'obs_remi_tox' => $this->input->post("observaciones",true), 
                    'archivo_pdf_remi_tox' => $file_name,
                    'status_remi_tox' => '1',
                    'remision_ano' => $fecha_ano_R

                );

                $guardar=$this->db->insert('quimica.remision_toxicologico', $data);
                if($guardar)
                {
                    $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                        redirect(base_url().'secretaria/nuevoToxicologico/'.$nro_acta.'/'.$fecha_a,  301);
                }else
                {
                    $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                           redirect(base_url().'secretaria/remision_toxicologico/',  301);
                }   
            }
            
            //SACA EL NUMERO DEL ACTA A EDITAR
            $nro_acta=$this->uri->segment(3);
            $fecha_a=$this->uri->segment(4);
            $fecha_ano_R=substr($fecha_a, 0,4);
            //muestra el acta de quimica a la cual se le quiere dar salida
            $where = array(
                        'id_remision_tox' => $nro_acta,
                    'remision_ano' => $fecha_ano_R);
            $datos=$this->acta_recepcion_model->buscar('quimica.remision_toxicologico',$where);

             
            $this->layout->view('remision_toxicologico/nuevo',compact("datos","nro_acta"));       
         
    } 





//REMISION DE DESCARTES
    public function remision_descarte()
    {
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bootstrap/js/bootstrap.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/jquery.dataTables.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"));

        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $fecha_a=$this->uri->segment(3);
           $datos=$this->secretaria_model->getDescarte($fecha_a); 
            $this->layout->view('remision_descarte/registros',compact("datos"));  
          
    } 


public function nuevoDescarte()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

           if($this->input->post())
            {
                //SACA EL NUMERO DEL ACTA
                $nro_acta=$this->uri->segment(3);
                $fecha_a=$this->uri->segment(4);
                $fecha_ano_R=substr($fecha_a, 0,4);

                $nombre_file='DES-'.$nro_acta.'-'.$fecha_ano_R;
                //proceso la imagen
                    $error=NULL;
                    //valido la foto
                    $config['upload_path'] = './uploads/archivos_descartes/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '0'; 
                    $config["overwrite"]=true;
                    $config['encrypt_name'] = false; 
                    $config['file_name'] = $nombre_file; 
                    $config['remove_spaces'] = true;
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('archivo'))
                    {
                        $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('ControllerMessage', $error["error"]);
                    }
                    if($error==null)
                    {
                        $ima = $this->upload->data();
                        $file_name = $ima['file_name'];
                    } 


                    

                 
                $data = array(  
                    'id_remision_des' => $nro_acta, 
                    'num_ofi_remision' => $this->input->post("num_ofi_remision",true),
                    'fecha_remision' => $this->input->post("fecha_remision",true),
                    'hora_remision' => $this->input->post("hora_remision",true),
                    'obs_remision' => $this->input->post("observaciones",true), 
                    'archivo_pdf' => $file_name,
                    'status_remi' => '1',
                    'remision_ano' => $fecha_ano_R

                );

                $guardar=$this->db->insert('quimica.remision_descarte', $data);
                if($guardar)
                {
                    $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                        redirect(base_url().'secretaria/nuevoDescarte/'.$nro_acta.'/'.$fecha_a,  301);
                }else
                {
                    $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                           redirect(base_url().'secretaria/remision_descarte/',  301);
                }   
            }
            
            //SACA EL NUMERO DEL ACTA A EDITAR
            $nro_acta=$this->uri->segment(3);
            $fecha_a=$this->uri->segment(4);
            $fecha_ano_R=substr($fecha_a, 0,4);
            //muestra el acta de quimica a la cual se le quiere dar salida
            $where = array(
                        'id_remision_des' => $nro_acta,
                    'remision_ano' => $fecha_ano_R);
            $datos=$this->acta_recepcion_model->buscar('quimica.remision_descarte',$where);
            $this->layout->view('remision_descarte/nuevo',compact("datos","nro_acta"));       
           
    } 








//REMISION DE DESCARTES
    public function remision_barrido()
    {
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/bootstrap/js/bootstrap.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/jquery.dataTables.min.js"));
        $this->layout->js(array(base_url()."public/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"));

        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $fecha_a=$this->uri->segment(3); 
           $datos=$this->secretaria_model->getBarridos($fecha_a); 
            $this->layout->view('remision_barrido/registros',compact("datos"));  
          
    } 


public function nuevoBarrido()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

           if($this->input->post())
            {
                //SACA EL NUMERO DEL ACTA
                $nro_acta=$this->uri->segment(3);
                $fecha_a=$this->uri->segment(4);
                $fecha_ano_R=substr($fecha_a, 0,4);

                $nombre_file='BARR-'.$nro_acta.'-'.$fecha_ano_R;
                //proceso la imagen
                    $error=NULL;
                    //valido la foto
                    $config['upload_path'] = './uploads/archivos_barridos/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '0'; 
                    $config["overwrite"]=true;
                    $config['encrypt_name'] = false; 
                    $config['file_name'] = $nombre_file; 
                    $config['remove_spaces'] = true;
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('archivo'))
                    {
                        $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('ControllerMessage', $error["error"]);
                    }
                    if($error==null)
                    {
                        $ima = $this->upload->data();
                        $file_name = $ima['file_name'];
                    } 
 
                $data = array(  
                    'id_remision_bar' => $nro_acta, 
                    'num_ofi_remision' => $this->input->post("num_ofi_remision",true),
                    'fecha_remision' => $this->input->post("fecha_remision",true),
                    'hora_remision' => $this->input->post("hora_remision",true),
                    'obs_remision' => $this->input->post("observaciones",true), 
                    'archivo_pdf' => $file_name,
                    'status_remi' => '1',
                    'remision_ano' => $fecha_ano_R

                );

                $guardar=$this->db->insert('quimica.remision_barrido', $data);
                if($guardar)
                {
                    $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                        redirect(base_url().'secretaria/nuevoBarrido/'.$nro_acta.'/'.$fecha_a,  301);
                }else
                {
                    $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                           redirect(base_url().'secretaria/remision_descarte/',  301);
                }   
            }
            
            //SACA EL NUMERO DEL ACTA A EDITAR
            $nro_acta=$this->uri->segment(3);
            $fecha_a=$this->uri->segment(4);
            $fecha_ano_R=substr($fecha_a, 0,4);
            //muestra el acta de quimica a la cual se le quiere dar salida
            $where = array(
                    'id_remision_bar' => $nro_acta,
                    'remision_ano' => $fecha_ano_R);
            $datos=$this->acta_recepcion_model->buscar('quimica.remision_barrido',$where);
            $this->layout->view('remision_barrido/nuevo',compact("datos","nro_acta"));       
           
    } 





















// REMISION DE ACTAS PERICIALES

    public function remision()
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

         

        $tipo_acta=$this->uri->segment(3);  
        $fecha_a=$this->uri->segment(4); 


        $datos=$this->acta_recepcion_model->getActas($tipo_acta,$fecha_a);
        $this->layout->view('remision/registros',compact("datos"));  
           
    } 


    public function dictamenes_entregados()
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
         $where=array(
                            'status_remi' => '3',
                            'remision_ano' => $fecha_a
                            );
            $datos=$this->secretaria_model->getRemisiones($where); 
            $this->layout->view('dictamenes_entregados/registros',compact("datos"));  
           
    } 

    public function nuevoDictamen()
    {

        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }


            if($this->input->post())
            {
                //SACA EL NUMERO DEL ACTA
                $nro_acta=$this->uri->segment(3);
                $tipo_acta=$this->uri->segment(4);
                $fecha_acta=$this->uri->segment(5);

                $nombre_file='DICTAMEN-'.$nro_acta.'-'.$tipo_acta.'-'.$fecha_acta;
                //proceso la imagen
                    $error=NULL;
                    //valido la foto
                    $config['upload_path'] = './uploads/archivos_secretaria/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '0'; 
                    $config["overwrite"]=true;
                    $config['encrypt_name'] = false; 
                    $config['file_name'] = $nombre_file; 
                    $config['remove_spaces'] = true;
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('archivo'))
                    {
                        $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('ControllerMessage', $error["error"]);
                    }
                    if($error==null)
                    {
                        $ima = $this->upload->data();
                        $file_name = $ima['file_name'];
                    }

                    
                //SACA EL NUMERO DEL ACTA A EDITAR
                $nro_acta=$this->uri->segment(3);
                $tipo_acta=$this->uri->segment(4);
                $fecha_ano=$this->uri->segment(5);
                //muestra el acta de quimica a la cual se le quiere dar salida
                $where = array(
                            'id_remision_q' => $nro_acta, 
                             'tipo_acta' => $tipo_acta, 
                              'remision_ano' => $fecha_ano, 
                        );
                $datos=$this->acta_recepcion_model->buscar('quimica.remision_dictamen',$where);
                foreach($datos as $dato)
                {
                    if ($dato->archivo_pdf) {
                        $file_name=$dato->archivo_pdf;
                    }
                    
                }

                $data = array(  
                    'id_remision_q' => $nro_acta, 
                    'tipo_acta' => $tipo_acta, 
                    'representante_mp' => $this->input->post("representante_mp",true), 
                    'fecha_autorizacion' => $this->input->post("fecha_autorizacion",true),  
                    'hora_autorizacion' => $this->input->post("hora_autorizacion",true),
                    'quien_autoriza' => $this->input->post("quien_autoriza",true), 
                    'num_ofi_remision' => $this->input->post("num_ofi_remision",true),
                    'fecha_remision' => $this->input->post("fecha_remision",true),
                    'hora_remision' => $this->input->post("hora_remision",true),
                    'fecha_entrega' => $this->input->post("fecha_entrega",true), 
                    'hora_entrega' => $this->input->post("hora_entrega",true), 
                    'nombre_entrega' => $this->input->post("nombre_entrega",true), 
                    'cargo_entrega' => $this->input->post("cargo_entrega",true),
                    'ced_entrega' => $this->input->post("ced_entrega",true),
                    'telf_entrega' => $this->input->post("telf_entrega",true), 
                    'obs_remision' => $this->input->post("obs_remision",true),
                    'archivo_pdf' => $file_name,
                    'status_remi' => $this->input->post("status_remi",true),
                    'remision_ano' => $fecha_ano

                );

                $llave=$this->input->post("llave",true);
                if ($llave!='editar') 
                {
                    $guardar=$this->db->insert('quimica.remision_dictamen', $data);
                    if($guardar)
                    {
                            $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                        redirect(base_url().'secretaria/nuevoDictamen/'.$nro_acta.'/'.$tipo_acta.'/'.$fecha_ano,  301);
                    }else
                    {
                            $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                           redirect(base_url().'secretaria/remision/',  301);
                    }  
                }
                if ($llave!='nuevo') 
                {
                    
                    $nro_acta=$this->uri->segment(3);
                    $tipo_acta=$this->uri->segment(4);
                    $fecha_ano=$this->uri->segment(5);
                    $where=array(
                            "id_remision_q"=>$nro_acta,
                            "tipo_acta"=>$tipo_acta,
                            "remision_ano"=>$fecha_ano,
                            ); 
                    $modificar=$this->secretaria_model->modificar_remision_dictamen($where,$data);  
                    if($modificar)
                    {
                            $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Modificado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                 redirect(base_url().'secretaria/nuevoDictamen/'.$nro_acta.'/'.$tipo_acta.'/'.$fecha_ano,  301);
                    }else
                    {
                            $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                redirect(base_url().'secretaria/remision/',  301);
                    }
                }
            }
            //SACA EL NUMERO DEL ACTA A EDITAR
            $nro_acta=$this->uri->segment(3);
            $tipo_acta=$this->uri->segment(4);
            $fecha_ano=$this->uri->segment(5);
            //muestra el acta de quimica a la cual se le quiere dar salida 
            $where=array(
                'id_remision_q'=>$nro_acta,
                'tipo_acta'=>$tipo_acta,
                "remision_ano"=>$fecha_ano
                );
            $datos=$this->acta_recepcion_model->buscar('quimica.remision_dictamen',$where);
            $this->layout->view('remision/nuevo',compact("datos","nro_acta"));       
          
    } 





//subir pdf de las actas de devolucion y recepcion
    public function remision_recep_devol()
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
        $datos2=$this->acta_recepcion_model->getActas('DEVOLUCION',$fecha_a);

            $this->layout->view('remision_recep_devol/registros',compact("datos2"));         
        

    }


    public function nuevoRemiRD()
    {

        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

            if($this->input->post())
            {
                 
                //SACA EL NUMERO DEL ACTA
                $nro_acta=$this->uri->segment(3);
                $tipo_a=$this->uri->segment(4);
                $fecha_ano=$this->uri->segment(5);
                $fecha_ano=substr($fecha_ano, 0,4);
                $nombre_file=$tipo_a.'-'.$nro_acta.'-'.$fecha_ano;
                //proceso la imagen
                    $error=NULL;
                    //valido la foto
                    $config['upload_path'] = './uploads/archivos_actaRD/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 0; 
                    $config["overwrite"]=true;
                    $config['encrypt_name'] = false; 
                    $config['file_name'] = $nombre_file; 
                    $config['remove_spaces'] = true;
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('archivo'))
                    {
                        $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('ControllerMessage', $error["error"]);
                    }
                    if($error==null)
                    {
                        $ima = $this->upload->data();
                        $file_name = $ima['file_name'];
                    }

                 
                $data = array(  
                    'archivo_pdf_rd' => $file_name
                );

                $where=array("nro_acta"=>$nro_acta,
                    'tipo_acta' => $tipo_a 
                            ); 
                $this->db->where($where); 
                $guardar=$this->db->update('div_inf_for.acta_recepcion', $data);
                $fecha_a=$this->uri->segment(5);

                if($guardar)
                {
                    $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                        redirect(base_url().'secretaria/nuevoRemiRD/'.$nro_acta.'/'.$tipo_a.'/'.$fecha_a,  301);
                }else
                {
                    $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                           redirect(base_url().'secretaria/remision_recep_devol/',  301);
                }   
            }
            
            //SACA EL NUMERO DEL ACTA A EDITAR
            $nro_acta=$this->uri->segment(3);
            $tipo_a=$this->uri->segment(4);
            $fecha_a=$this->uri->segment(5);

            //muestra el acta de quimica a la cual se le quiere dar salida
            $where = array(
                        'nro_acta' => $nro_acta,
                    'tipo_acta' => $tipo_a,
                    'fecha_acta' => $fecha_a);
            $datos=$this->acta_recepcion_model->buscar('div_inf_for.acta_recepcion',$where);
            $this->layout->view('remision_recep_devol/nuevo',compact("datos","nro_acta","tipo_a"));       
         
    } 

	public function eliminar_dictamen()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $nro_acta=$this->uri->segment(3);
        $tipo_acta=$this->uri->segment(4); 
        $fecha_ano=$this->uri->segment(5);
    

        $eliminar=$this->acta_recepcion_model->eliminar_dictamen($nro_acta,$tipo_acta,$fecha_ano); 
        //echo $this->db->last_query(); exit;
        redirect(base_url().'secretaria/nuevoDictamen/'.$nro_acta.'/'.$tipo_acta.'/'.$fecha_ano,  301);
    } 

}




