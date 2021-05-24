<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller { 
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

    

    public function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        $this->layout->view('index');       
         
    }

    

    public function grupos()
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



        $this->layout->view('grupos/registros');       
         
    }


//TIPO DE EXPERTICIAS
    public function experticias()
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

        $this->layout->view('experticias/registros');       
         
    }



    public function nuevoTipoExperticia()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        if($this->input->post())
            { 
                //if ($this->form_validation->run("peritacion/validar"))
               // { 
                    $data = array(   
                        'des_experticia' => $this->input->post("des_experticia",true) 
                    );
 
                    $guardar=$this->db->insert('div_inf_for.tipo_experticia', $data);
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'configuracion/experticias/',  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'configuracion/experticias',  301);
                    }  
               // }
            }


        $this->layout->view('experticias/nuevo');       
         
    }


public function editarTipoExperticia()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        if($this->input->post())
            { 
                //if ($this->form_validation->run("peritacion/validar"))
               // { 
                    $data = array(   
                        'des_experticia' => $this->input->post("des_experticia",true) 
                    );
                    $id=$this->uri->segment(3); 
                    $this->db->where('id_tipo_experticia', $id);
                    $nro_acta=$nro_acta;
                    $guardar=$this->db->update('div_inf_for.tipo_experticia', $data);
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'configuracion/editarTipoExperticia/'.$id,  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'configuracion/instituciones',  301);
                    }  
               // }
            }
            

        $this->layout->view('experticias/editar');       
         
    }



















//INSTITUCION
public function instituciones()
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



        $this->layout->view('instituciones/registros');       
         
    }


    public function nuevoInstitucion()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        if($this->input->post())
            { 
                //if ($this->form_validation->run("peritacion/validar"))
               // { 
                    $data = array(   
                        'des_institucion_solicitante' => $this->input->post("des_institucion_solicitante",true) 
                    );
 
                    $guardar=$this->db->insert('div_inf_for.institucion_solicitante', $data);
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'configuracion/instituciones/',  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'configuracion/instituciones',  301);
                    }  
               // }
            }


        $this->layout->view('instituciones/nuevo');       
         
    }


    public function editarInstitucion()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        if($this->input->post())
            { 
                //if ($this->form_validation->run("peritacion/validar"))
               // { 
                    $data = array(   
                        'des_institucion_solicitante' => $this->input->post("des_institucion_solicitante",true) 
                    );
                    $id=$this->uri->segment(3); 
                    $this->db->where('id_institucion_solicitante', $id);
                    $nro_acta=$nro_acta;
                    $guardar=$this->db->update('div_inf_for.institucion_solicitante', $data);
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'configuracion/editarInstitucion/'.$id,  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'configuracion/instituciones',  301);
                    }  
               // }
            }
            

        $this->layout->view('instituciones/editar');       
         
    }



//UNIDADES
    public function unidades()
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
 
        $this->layout->view('unidades/registros');       
         
    }

    public function nuevoUnidad()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        if($this->input->post())
            { 
                //if ($this->form_validation->run("peritacion/validar"))
               // { 
                    $data = array(   
                        'des_unidad_solicitantente' => $this->input->post("des_unidad_solicitantente",true) 
                    );
 
                    $guardar=$this->db->insert('div_inf_for.unidad_solicitante', $data);
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'configuracion/unidades/',  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'configuracion/unidades',  301);
                    }  
               // }
            }


        $this->layout->view('unidades/nuevo');       
         
    }


    public function editarUnidad()
    {
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        if($this->input->post())
            { 
                //if ($this->form_validation->run("peritacion/validar"))
               // { 
                    $data = array(   
                        'des_unidad_solicitantente' => $this->input->post("des_unidad_solicitantente",true) 
                    );
                    $id=$this->uri->segment(3); 
                    $this->db->where('id_unidad_solicitante', $id); 
                    $guardar=$this->db->update('div_inf_for.unidad_solicitante', $data);
                    if($guardar)
                    {
                        $this->session->set_flashdata('ControllerMessage', "<div id='alert' name='alert' role='alert' class='alert' style='background-color:#5D9CEC; color:#fff'><strong>Bien Hecho!</strong> Se ha Insertado el registro exitosamente.<button class='close' aria-hiden='true' data-dismiss='alert'>&times;</button></div>");
                                    redirect(base_url().'configuracion/editarUnidad/'.$id,  301);
                    }else
                    {
                        $this->session->set_flashdata('ControllerMessage_Error', "<div role='alert' class='alert alert-danger' style='color:black'><strong>ALERTA!</strong> Se ha producido un error. Inténtelo nuevamente por favor.</div>");
                                                       redirect(base_url().'configuracion/unidades',  301);
                    }  
               // }
            }
            

        $this->layout->view('unidades/editar');       
         
    }
     


}
