<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller { 

	
	public function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth'); 
        $this->layout->setLayout('template1'); 
    }
	
	public function index()
	{ 
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

         
        $this->layout->js(array(base_url()."public/knob/jquery.knob.min.js"));



        
        $this->layout->view('index');       
		     
        
	}

}
