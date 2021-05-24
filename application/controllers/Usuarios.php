<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    private $session_id;
    public $session_activa;
    public $id_usuario;
    public $apellidos;
    public $nombre;
    public $gdo_jquia;
    public function __construct()
    {
        parent::__construct();  
        $this->layout->setLayout('template1'); 

        //sessiones
        $this->session_id = $this->session->userdata('slcct');
        $this->session_activa = $this->session->userdata('activa');
        $this->id_usuario = $this->session->userdata('id_usuario');
        $this->apellidos = $this->session->userdata('apellidos');
        $this->nombre = $this->session->userdata('nombre');
        $this->gdo_jquia = $this->session->userdata('gdo_jquia');

        //cuadro para mostrar los mensajes de error
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 
    }

    

    public function index()
    {
        if(!empty($this->session_activa))
        {
            $this->layout->view('index');       
        }else
        {
            redirect(base_url(),  301);
        }  
    } 
}
