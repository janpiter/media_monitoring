<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class publisher extends CI_Controller {

	private $error = array();
	
	function __construct() {
        parent::__construct();
        
        $this->load->model('publisher_model', '', TRUE);

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
	
	public function home($data) {
        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/');
        }
         
        $data = $this->session->flashdata('parsing_data');
		
        $data['objList'] = $this->publisher_model->getList(array('flag' => 0));
        $data['content_view'] = "backend/publisher.php";
        $data['page_title'] = "Publishers";
        $data['page_desc'] = "manage the entire publishers data";
        
        if(!key_exists("error", $data)) $data['error'] = array();
        
        $this->load->view('include/header_backend');
        $this->load->view('backend/publisher', $data);
        $this->load->view('include/footer_backend');
    }
	
	public function add() {
        $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_FAILED');
        $data['class'] = 'danger';
        
        if ($this->validate()) {
            $insert_data = array(
                'publisher_name' => $this->input->post('publisher_name'),
                'media_type' => $this->input->post('media_type'),
                'user_id' => $this->tank_auth->get_user_id()
            );

            $id = $this->publisher_model->insertPublisher($insert_data);

            $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_SUCCESS');
            $data['class'] = 'success';

            $this->session->set_flashdata('parsing_data', $data);
            redirect('backend/publisher');
        } else {
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/publisher');        
    }
	
	public function edit() {
        $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_FAILED');
        $data['class'] = 'danger';
        
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate("edit_")) {
            $update_data = array(
                'publisher_id' => $this->input->post('edit_publisher_id'),
                'publisher_name' => $this->input->post('edit_publisher_name'),
                'media_type' => $this->input->post('edit_media_type')
            );
            $this->publisher_model->updatePublisher($update_data);
            
            $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_SUCCESS');
            $data['class'] = 'success';            
        }else{
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/publisher'); 
    }
	
	public function delete() {
        $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_FAILED');
        $data['class'] = 'danger';

        if ($this->input->post('deleted_id') != '') {
            $id = $this->input->post('deleted_id');
            
            $o = $this->publisher_model->getPublisher($id);
            if ($o) {
                $this->publisher_model->deletePublisher($id);
                
                $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_SUCCESS');
                $data['class'] = 'success';
            } else {
                $data['message_sys'] = "";
            }
        } else {
            $data['message_sys'] = "";
        }

        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/publisher');
    }
	
	 protected function validate($edit="") {
        $id = "";
        if($edit != "") $id = $this->input->post($edit.'id');
        
        // if (strlen($this->input->post($edit.'publisher_name')) < 3) {
            // $this->error['publisher_name'] = 'Topic Name must be at least 3 characters in length.';
        // }
        
        // if($this->publisher_model->isDuplicate($this->input->post($edit.'publisher_name'))){
            // $this->error['duplicate'] = 'Data already exist.';
        // }
        
        if (!$this->error) return true;
        else return false;
    }
	
}

?>