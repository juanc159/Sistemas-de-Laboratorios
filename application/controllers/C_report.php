<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_report extends CI_Controller {
 
	function __construct()
    {
        parent::__construct(); 
    }


	public function index()
	{
		$this->layout->view('v_report');
	}

	
}
