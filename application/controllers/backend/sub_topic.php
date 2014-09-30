<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class sub_topic extends CI_Controller {
    
    private $error = array();
    
    function __construct() {
        parent::__construct();
        
        $this->load->model('sub_topic_model', '', TRUE);
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

        $data['objList'] = $this->sub_topic_model->getList(array('sub_topic.flag' => 0));
        $data['topicList'] = $this->topic_model->getListTopic();
        $data['content_view'] = "backend/sub_topic.php";
        $data['page_title'] = "Sub Topic";
        $data['page_desc'] = "manage the entire sub topic data";
        
        if(!key_exists("error", $data)) $data['error'] = array();
        
        $this->load->view('include/header_backend');
        $this->load->view('backend/sub_topic', $data);
        $this->load->view('include/footer_backend');
    }
    
    public function add() {
        $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_FAILED');
        $data['class'] = 'danger';
        
        if ($this->validate()) {
            $insert_data = array(
                'subtopic_name' => $this->input->post('subtopic_name'),
                'topic_id' => $this->input->post('topic_id'),
                'user_id' => $this->tank_auth->get_user_id()
            );			
			
            $id = $this->sub_topic_model->insertSubtopic($insert_data);

            $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_SUCCESS');
            $data['class'] = 'success';

            $this->session->set_flashdata('parsing_data', $data);
            redirect('backend/sub_topic');
        } else {
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/sub_topic');        
    }

    public function edit() {
        $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_FAILED');
        $data['class'] = 'danger';
        
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate("edit_")) {
            $update_data = array(
                'subtopic_id' => $this->input->post('edit_subtopic_id'),
                'topic_id' => $this->input->post('edit_topic_id'),
                'subtopic_name' => $this->input->post('edit_subtopic_name')
            );
            $this->sub_topic_model->updateSubtopic($update_data);
            
            $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_SUCCESS');
            $data['class'] = 'success';            
        }else{
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/sub_topic'); 
    }

    public function delete() {
        $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_FAILED');
        $data['class'] = 'danger';

        if ($this->input->post('deleted_id') != '') {
            $id = $this->input->post('deleted_id');
            
            $o = $this->sub_topic_model->getSubtopic($id);
            if ($o) {
                $this->sub_topic_model->deleteSubtopic($id);
                
                $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_SUCCESS');
                $data['class'] = 'success';
            } else {
                $data['message_sys'] = "";
            }
        } else {
            $data['message_sys'] = "";
        }

        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/sub_topic');
    }
    
    protected function validate($edit="") {
        $id = "";
        if($edit != "") $id = $this->input->post($edit.'id');
        
        if (strlen($this->input->post($edit.'subtopic_name')) < 3) {
            $this->error['subtopic_name'] = 'sub_topic Name must be at least 3 characters in length.';
        }
        
        $check_data = array(
            'subtopic_name' => $this->input->post($edit.'subtopic_name'),
            'topic_id' => $this->input->post($edit.'topic_id')
        ); 
        
        if($this->sub_topic_model->isDuplicate($check_data)){
            $this->error['duplicate'] = 'Data already exist.';
        }
        
        if (!$this->error) return true;
        else return false;
    }
}

?>
