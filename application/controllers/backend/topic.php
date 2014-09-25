<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class topic extends CI_Controller {
    
    private $error = array();
    
    function __construct() {
        parent::__construct();
        
        $this->load->model('topic_model', '', TRUE);

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

        $data['objList'] = $this->topic_model->getList(array('flag' => 0));
        $data['content_view'] = "backend/topics.php";
        $data['page_title'] = "Topics";
        $data['page_desc'] = "manage the entire topics data";
        
        if(!key_exists("error", $data)) $data['error'] = array();
        
        $this->load->view('include/header_backend');
        $this->load->view('backend/topics', $data);
        $this->load->view('include/footer_backend');
    }
    
    public function add() {
        $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_FAILED');
        $data['class'] = 'danger';
        
        if ($this->validate()) {
            $insert_data = array(
                'topic_name' => $this->input->post('topic_name'),
                'user_id' => $this->tank_auth->get_user_id()
            );

            $id = $this->topic_model->insertTopic($insert_data);

            $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_SUCCESS');
            $data['class'] = 'success';

            $this->session->set_flashdata('parsing_data', $data);
            redirect('backend/topic');
        } else {
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/topic');        
    }

    public function edit() {
        $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_FAILED');
        $data['class'] = 'danger';
        
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate("edit_")) {
            $update_data = array(
                'topic_id' => $this->input->post('edit_topic_id'),
                'topic_name' => $this->input->post('edit_topic_name')
            );
            $this->topic_model->updateTopic($update_data);
            
            $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_SUCCESS');
            $data['class'] = 'success';            
        }else{
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/topic'); 
    }

    public function delete() {
        $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_FAILED');
        $data['class'] = 'danger';

        if ($this->input->post('deleted_id') != '') {
            $id = $this->input->post('deleted_id');
            
            $o = $this->topic_model->getTopic($id);
            if ($o) {
                $this->topic_model->deleteTopic($id);
                
                $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_SUCCESS');
                $data['class'] = 'success';
            } else {
                $data['message_sys'] = "";
            }
        } else {
            $data['message_sys'] = "";
        }

        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/topic');
    }
    
    protected function validate($edit="") {
        $id = "";
        if($edit != "") $id = $this->input->post($edit.'id');
        
        if (strlen($this->input->post($edit.'topic_name')) < 3) {
            $this->error['topic_name'] = 'Topic Name must be at least 3 characters in length.';
        }
        
        if($this->topic_model->isDuplicate($this->input->post($edit.'topic_name'))){
            $this->error['duplicate'] = 'Data already exist.';
        }
        
        if (!$this->error) return true;
        else return false;
    }
}
