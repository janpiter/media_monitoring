<?php

class Backend extends CI_Controller {
	# default view
	public function index() {
		$this->load->view('include/header_backend');
		// $this->load->view('backend/box-themes');		
		$this->load->view('backend/dashboard');
		$this->load->view('include/footer_backend');
	}

	public function users() {
		$this->load->view('include/header_backend');		
		$this->load->view('backend/users');
		$this->load->view('include/footer_backend');
	}
}