<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class publisher extends CI_Controller {

	private $error = array();
	
	public function __construct() {
		parent::__construct();
		$this->load->model('publisher_model', '', TRUE);
		
		$this->load->library('tank_auth_groups', '', 'tank_auth');
        $this->lang->load('tank_auth');
		
		# check login
		if (!$this->tank_auth->is_logged_in()) redirect('/auth/login/'); 
		
		# language
		$lang = 'en';
        if ($this->session->userdata('misircLang')) $lang = $this->session->userdata('misircLang');		
		$language = array('id' => 'indonesia', 'en' => 'english');
		
		$this->lang->load($language[$lang], $language[$lang]);
	}
	
	public function index() { $this->home(array()); }	
	public function home($data) {
		if (!$this->tank_auth->is_logged_in()) redirect('/auth/login/');
		
		$data = $this->session->flashdata('parsing_data');
		
		$data['publisher'] = $this->publisher_model->get_all(array('flag' => 0));
		$data['media_type'] = $this->mith_func->getMediaTypeList();
		
		if(!key_exists("error", $data)) $data['error'] = array();

		$this->load->view('include/header_backend');
        $this->load->view('backend/publisher', $data);
        $this->load->view('include/footer_backend');		
	}
	
	public function get() {		
		echo json_encode($this->publisher_model->get_publisher_by_id($this->input->post('id')));
		exit();
	}
	
	public function add() {
	
		$msg = $this->mith_func->build_message('danger', $this->lang->line('MESSAGE_INSERT_FAILED'));
		
		if($this->validate()) {
			$param = array(
				'publisher_name' => $this->input->post('name'),
				'media_type' => $this->input->post('media_type'),
				'user_id' => $this->tank_auth->get_user_id()
			);
			
			$publisher = $this->publisher_model->create_publisher($param);
			
			$msg = $this->mith_func->build_message('success', $this->lang->line('MESSAGE_INSERT_SUCCESS'));									
		}
		
		if (count($this->error) > 0) {
			foreach($this->error as $k => $e) {
				$msg .= $this->mith_func->build_message('danger', $e);
			}
		}
		
		$this->session->set_flashdata('msg', $msg);
		
		redirect('backend/publisher');
	}
	
	public function edit() {
	
		$msg = $this->mith_func->build_message('danger', $this->lang->line('MESSAGE_EDIT_FAILED'));
		
		if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate("edit_")) {
            $param = array(
                'publisher_name' => $this->input->post('name'),
                'media_type' => $this->input->post('media_type'),
				'user_id' => $this->tank_auth->get_user_id()
            );
            $this->publisher_model->change_publisher($param, $this->input->post('id'));
            
            $msg = $this->mith_func->build_message('success', $this->lang->line('MESSAGE_EDIT_SUCCESS'));	         
        }
		
		$this->session->set_flashdata('msg', $msg);
		
		redirect('backend/publisher');
	}
	
	public function delete() {
	
		if($this->publisher_model->delete_publisher($this->input->post("id"))) {
			$msg = $this->mith_func->build_message('success', $this->lang->line('MESSAGE_DELETE_SUCCESS'));
		}else {
			$msg = $this->mith_func->build_message('success', $this->lang->line('MESSAGE_DELETE_FAILED'));
		}
			
		$this->session->set_flashdata('msg', $msg);
		redirect('backend/publisher');
	}
	
	protected function validate($edit="") {
		$id = "";
        if($edit != "") $id = $this->input->post($edit.'id');
        
        // if (strlen($this->input->post($edit.'topic_name')) < 3) {
            // $this->error['topic_name'] = 'Topic Name must be at least 3 characters in length.';
        // }
        
        // if($this->topic_model->isDuplicate($this->input->post($edit.'topic_name'))){
            // $this->error['duplicate'] = 'Data already exist.';
        // }
        
        if (!$this->error) return true;
        else return false;
	}
}

?>