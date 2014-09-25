<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class log extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('logging_model', '', TRUE);

        // $this->load->library('tank_auth');
        $this->load->library('tank_auth_groups', '', 'tank_auth');
        $this->lang->load('tank_auth');
		
		$this->load->config('tank_auth', TRUE);
    }

    # default view
    public function index() {
		# check login
        if (!$this->tank_auth->is_logged_in()) redirect('/auth/login/');        

		$data = $this->session->flashdata('parsing_data');

        $data['objList'] = $this->logging_model->get_all();
        
        if(!key_exists("error", $data)) $data['error'] = array();
        
        $this->load->view('include/header_backend');
        $this->load->view('backend/logging', $data);
        $this->load->view('include/footer_backend');
    }

}
