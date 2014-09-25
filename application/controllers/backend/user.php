<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class user extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('users_management', '', TRUE);

        // $this->load->library('tank_auth');
        $this->load->library('tank_auth_groups', '', 'tank_auth');
        $this->lang->load('tank_auth');
    }

    # default view

    public function index() {
        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/');
        }

        $users = $this->users_management->get_all();

        $data['users'] = $users;
        $data['msg'] = $this->mith_func->build_message($type = 'success', $msg = 'Data successfuly insert');

        $this->load->view('include/header_backend');
        $this->load->view('backend/users', $data);
        $this->load->view('include/footer_backend');
    }

}
