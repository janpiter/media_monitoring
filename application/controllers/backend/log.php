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
		
		if (!$this->tank_auth->is_logged_in()) redirect('/auth/login/');        
        
        $lang = 'en';
        if ($this->session->userdata('misircLang')) {
            $lang = $this->session->userdata('misircLang');
        }

        switch ($lang) {
            case 'en': $language = 'english';
                break;

            case 'id': $language = 'indonesia';
                break;

            default: $language = 'english';
        }
        
        $this->lang->load($language, $language);
    }

    # default view
    public function index() {
        $this->home(array());
    }

    public function home() {
		# check login
        if (!$this->tank_auth->is_logged_in()) redirect('/auth/login/');        

		$data = $this->session->flashdata('parsing_data');

		$data['objList'] = $this->logging_model->getList(array('flag' => 0));
        $data['content_view'] = "backend/logging.php";
        $data['page_title'] = "Activity Log";
        $data['page_desc'] = "Monitoring all user activity";
        
        if(!key_exists("error", $data)) $data['error'] = array();
        
        $this->load->view('include/header_backend');
        $this->load->view('backend/logging', $data);
        $this->load->view('include/footer_backend');
    }

    public function delete() {
        $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_FAILED');
        $data['class'] = 'danger';

        if ($this->input->post('deleted_id') != '') {
            $id = $this->input->post('deleted_id');
            
            $o = $this->logging_model->getLog($id);
            if ($o) {
                $this->logging_model->deleteLog($id);
                
                $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_SUCCESS');
                $data['class'] = 'success';
            } else {
                $data['message_sys'] = "";
            }
        } else {
            $data['message_sys'] = "";
        }

        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/log');
    }

}
