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
		
		$this->load->config('tank_auth', TRUE);
    }

    # default view

    public function index($act='list') {
		# check login
        if (!$this->tank_auth->is_logged_in()) redirect('/auth/login/');        

		# get all users
        $users = $this->users_management->get_all();
		
		# response paramter
        $data['users'] = $users;        
		
		# load view
        $this->load->view('include/header_backend');
        $this->load->view('backend/users', $data);
        $this->load->view('include/footer_backend');
    }
	
	public function get() {		
		echo json_encode($this->users_management->get_user_by_id($this->input->post('id')));
		exit();
	}
	
	public function edit() {
		$param = array(
			'name' => $this->input->post('personname'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'group_id' => $this->input->post('user-level')
		);
		
		if($this->users_management->change_user($param, $this->input->post('id')))
			$this->session->set_flashdata('msg', $this->mith_func->build_message('success', 'Data successfully updated'));
		else
			$this->session->set_flashdata('msg', $this->mith_func->build_message('danger', 'Editing data failed'));
			
		redirect('backend/user');
	}
	
	public function force_reset() {
	
		$hasher = new PasswordHash(
					$this->config->item('phpass_hash_strength', 'tank_auth'),
					$this->config->item('phpass_hash_portable', 'tank_auth'));
		$hashed_password = $hasher->HashPassword($this->input->post('password'));
		
		$param = array('password' => $hashed_password);
		
		if ($this->users_management->change_user($param, $this->input->post('id')))		
			$this->session->set_flashdata('msg', $this->mith_func->build_message('success', 'Password has been reset successfully'));
		else
			$this->session->set_flashdata('msg', $this->mith_func->build_message('success', 'Password error reset'));
		redirect('backend/user');
	}
	
	public function delete() {
		$this->users_management->delete_user($this->input->post("id"));
		
		$this->session->set_flashdata('msg', $this->mith_func->build_message('success', 'Data successfully deleted'));
		redirect('backend/user');
	}

}
