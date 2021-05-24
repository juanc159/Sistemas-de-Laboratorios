<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $session_id;
	public $session_activa;
	public $id_usuario;
	public $apellidos;
	public $nombre;
	public $gdo_jquia;
    public $formato;
    public function __construct()
    {
        parent::__construct();  
        $this->layout->setLayout('login_template');
        $this->load->model('login_model');

        //sessiones
        $this->session_id = $this->session->userdata('slcct');
        $this->session_activa = $this->session->userdata('activa');
        $this->id_usuario = $this->session->userdata('id_usuario');
        $this->cedula = $this->session->userdata('cedula');
        $this->apellidos = $this->session->userdata('apellidos');
        $this->nombre = $this->session->userdata('nombre');
        $this->gdo_jquia = $this->session->userdata('gdo_jquia');

        $this->formato = $this->session->userdata('formato');

    }
	
	public function index()
	{
        $this->layout->css(array(base_url()."public/login_css/diseno_login.css"));
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 
        if($this->input->post()) 
        {
        	 $campousuario=$this->input->post("campousuario",true);
                $campoclave=$this->input->post("campoclave",true);
  

                $datos=$this->login_model->logueo($campousuario,$campoclave);  
                if ($datos !=NULL)
                { 

                    $id_usuario=$datos->id_usuario;
                    $cedula=$datos->cedula;
                    $usuario=$datos->usuario; 
                    $apellidos=$datos->apellidos;
                    $nombre=$datos->nombre;
                    $estado=$datos->estado;
                    $gdo_jquia=$datos->gdo_jquia;

                    
                    $this->session->set_userdata('activa', '1');
                    $this->session->set_userdata('id_usuario', $id_usuario);
                    $this->session->set_userdata('cedula', $cedula);
                    $this->session->set_userdata('apellidos', $apellidos);
                    $this->session->set_userdata('nombre', $nombre);
                    $this->session->set_userdata('gdo_jquia', $gdo_jquia);
                    $this->session->set_userdata('formato', '0');

		            redirect(base_url().'principal/',  301);
		        }else
		        {
		        	$this->session->set_flashdata('ControllerMessage', 'Usuario y/o clave inválida.');
					redirect(base_url(),  301);
		        } 
        }
		$this->layout->view('login');  
	}


    public function logout()
    {
        $this->session->unset_userdata(array('id_usuario' => ''));
        $this->session->sess_destroy("slcct");
        redirect(base_url().'login',  301);
    }
	public function login2()
	{
		$this->load->view('login2');
	}



	
}
