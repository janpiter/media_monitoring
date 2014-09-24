<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class backend_ extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('tank_auth_groups', '', 'tank_auth');
        $this->lang->load('tank_auth');		
    }

    # default view
    public function index() {
        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/');
        }
        
        $data['message_sys'] = "Welcome to MIS IRC.";
        $data['class'] = 'success';
                
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/dashboard');
    }
    
}
