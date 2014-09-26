<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class program extends CI_Controller {
    
    private $error = array();
    
    function __construct() {
        parent::__construct();
        
        $this->load->model('publisher_model', '', TRUE);
        $this->load->model('program_model', '', TRUE);

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

        $data['objList'] = $this->program_model->getList(array('program.flag' => 0));
        $data['publisherList'] = $this->publisher_model->getListPublisher();
        $data['content_view'] = "backend/programs.php";
        $data['page_title'] = "Programs";
        $data['page_desc'] = "manage the entire programs data";
        
        if(!key_exists("error", $data)) $data['error'] = array();
        
        $this->load->view('include/header_backend');
        $this->load->view('backend/programs', $data);
        $this->load->view('include/footer_backend');
    }
    
    public function add() {
        $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_FAILED');
        $data['class'] = 'danger';
        
        if ($this->validate()) {
            $insert_data = array(
                'program_name' => $this->input->post('program_name'),
                'publisher_id' => $this->input->post('publisher_id'),
                'user_id' => $this->tank_auth->get_user_id()
            );

            $id = $this->program_model->insertProgram($insert_data);

            $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_SUCCESS');
            $data['class'] = 'success';

            $this->session->set_flashdata('parsing_data', $data);
            redirect('backend/program');
        } else {
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/program');        
    }

    public function edit() {
        $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_FAILED');
        $data['class'] = 'danger';
        
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate("edit_")) {
            $update_data = array(
                'program_id' => $this->input->post('edit_program_id'),
                'publisher_id' => $this->input->post('edit_publisher_id'),
                'program_name' => $this->input->post('edit_program_name')
            );
            $this->program_model->updateProgram($update_data);
            
            $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_SUCCESS');
            $data['class'] = 'success';            
        }else{
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/program'); 
    }

    public function delete() {
        $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_FAILED');
        $data['class'] = 'danger';

        if ($this->input->post('deleted_id') != '') {
            $id = $this->input->post('deleted_id');
            
            $o = $this->program_model->getProgram($id);
            if ($o) {
                $this->program_model->deleteProgram($id);
                
                $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_SUCCESS');
                $data['class'] = 'success';
            } else {
                $data['message_sys'] = "";
            }
        } else {
            $data['message_sys'] = "";
        }

        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/program');
    }
    
    protected function validate($edit="") {
        $id = "";
        if($edit != "") $id = $this->input->post($edit.'id');
        
        if (strlen($this->input->post($edit.'program_name')) < 3) {
            $this->error['program_name'] = 'Program Name must be at least 3 characters in length.';
        }
        
        $check_data = array(
            'program_name' => $this->input->post($edit.'program_name'),
            'publisher_id' => $this->input->post($edit.'publisher_id')
        ); 
        
        if($this->program_model->isDuplicate($check_data)){
            $this->error['duplicate'] = 'Data already exist.';
        }
        
        if (!$this->error) return true;
        else return false;
    }
}
