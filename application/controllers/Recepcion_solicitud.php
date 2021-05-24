<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recepcion_solicitud extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('template1'); 
    }

	public function formato1()
	{
		$this->load->view('recepcion_solicitud/formato1'); 
	}

	
 
	public function index()
	{ 
        $this->layout->view('index');
	}
}
