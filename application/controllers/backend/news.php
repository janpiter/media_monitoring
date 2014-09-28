<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class news extends CI_Controller {
    
    private $error = array();
    
    function __construct() {
        parent::__construct();
        
        $this->load->model('news_model', '', TRUE);

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

        $data['objList'] = $this->news_model->getList(array('news.flag' => 0));
        $data['content_view'] = "backend/news.php";
        $data['page_title'] = "News";
        $data['page_desc'] = "manage the entire news data";
        
        if(!key_exists("error", $data)) $data['error'] = array();
        
        $this->load->view('include/header_backend');
        $this->load->view('backend/news', $data);
        $this->load->view('include/footer_backend');
    }
    
    public function add() {
        $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_FAILED');
        $data['class'] = 'danger';
        
        if ($this->validate()) {
            $insert_data = array(
                'news_name' => $this->input->post('news_name'),
                'publisher_id' => $this->input->post('publisher_id'),
                'user_id' => $this->tank_auth->get_user_id()
            );

            $id = $this->news_model->insertNews($insert_data);

            $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_SUCCESS');
            $data['class'] = 'success';

            $this->session->set_flashdata('parsing_data', $data);
            redirect('backend/news');
        } else {
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/news');        
    }

    public function edit() {
        $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_FAILED');
        $data['class'] = 'danger';
        
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate("edit_")) {
            $update_data = array(
                'news_id' => $this->input->post('edit_news_id'),
                'publisher_id' => $this->input->post('edit_publisher_id'),
                'news_name' => $this->input->post('edit_news_name')
            );
            $this->news_model->updateNews($update_data);
            
            $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_SUCCESS');
            $data['class'] = 'success';            
        }else{
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/news'); 
    }

    public function delete() {
        $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_FAILED');
        $data['class'] = 'danger';

        if ($this->input->post('deleted_id') != '') {
            $id = $this->input->post('deleted_id');
            
            $o = $this->news_model->getNews($id);
            if ($o) {
                $this->news_model->deleteNews($id);
                
                $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_SUCCESS');
                $data['class'] = 'success';
            } else {
                $data['message_sys'] = "";
            }
        } else {
            $data['message_sys'] = "";
        }

        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/news');
    }
    
    protected function validate($edit="") {
        $id = "";
        if($edit != "") $id = $this->input->post($edit.'id');
        
        if (strlen($this->input->post($edit.'news_name')) < 3) {
            $this->error['news_name'] = 'News Name must be at least 3 characters in length.';
        }
        
        $check_data = array(
            'news_name' => $this->input->post($edit.'news_name'),
            'publisher_id' => $this->input->post($edit.'publisher_id')
        ); 
        
        if($this->news_model->isDuplicate($check_data)){
            $this->error['duplicate'] = 'Data already exist.';
        }
        
        if (!$this->error) return true;
        else return false;
    }
}
