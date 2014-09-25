<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class person extends CI_Controller {
    
    private $path = '../assets/data/persons';
    private $error = array();
    private $photo = '';
    
    function __construct() {
        parent::__construct();
        
        $this->load->model('person_model', '', TRUE);

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

        $data['objList'] = $this->person_model->getList(array('flag' => 0));
        $data['content_view'] = "backend/persons.php";
        $data['page_title'] = "Persons";
        $data['page_desc'] = "manage the entire persons data";
        
        if(!key_exists("error", $data)) $data['error'] = array();
        
        $this->load->view('include/header_backend');
        $this->load->view('backend/persons', $data);
        $this->load->view('include/footer_backend');
    }
    
    public function add() {
        $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_FAILED');
        $data['class'] = 'danger';
        
        if ($this->validate()) {
            $insert_data = array(
                'person_name' => $this->input->post('person_name'),
                'user_id' => $this->tank_auth->get_user_id()
            );
            
            if ($this->thumbs) {
                $insert_data['person_image'] = $this->thumbs;
            }
            
            $id = $this->person_model->insertPerson($insert_data);

            $data['message_sys'] = $this->lang->line('MESSAGE_INSERT_SUCCESS');
            $data['class'] = 'success';

            $this->session->set_flashdata('parsing_data', $data);
            redirect('backend/person');
        } else {
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/person');        
    }

    public function edit() {
        $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_FAILED');
        $data['class'] = 'danger';
        
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate("edit_")) {
            $update_data = array(
                'person_id' => $this->input->post('edit_person_id'),
                'person_name' => $this->input->post('edit_person_name')
            );
            
            $id = $this->input->post('edit_person_id');            
            if ($this->thumbs) {
                $o = $this->person_model->getPerson($id);
                $this->mith_func->delete_image($o->person_image, $this->path);
                $update_data['person_image'] = $this->thumbs;
            }
            
            $this->person_model->updatePerson($update_data);
            
            $data['message_sys'] = $this->lang->line('MESSAGE_EDIT_SUCCESS');
            $data['class'] = 'success';            
        }else{
            # error management
            $data['error'] = $this->error;
        }
        
        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/person'); 
    }

    public function delete() {
        $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_FAILED');
        $data['class'] = 'danger';

        if ($this->input->post('deleted_id') != '') {
            $id = $this->input->post('deleted_id');
            
            $o = $this->person_model->getPerson($id);
            if ($o) {
                $id = $this->input->post('deleted_id');
                $o = $this->person_model->getPerson($id);
                $this->mith_func->delete_image($o->person_image, $this->path);
                $this->person_model->deletePerson($id);
                
                $data['message_sys'] = $this->lang->line('MESSAGE_DELETE_SUCCESS');
                $data['class'] = 'success';
            } else {
                $data['message_sys'] = "";
            }
        } else {
            $data['message_sys'] = "";
        }

        $this->session->set_flashdata('parsing_data', $data);
        redirect('backend/person');
    }
    
    protected function validate($edit="") {
        $id = "";
        if($edit != "") $id = $this->input->post($edit.'id');
        
        if (strlen($this->input->post($edit.'person_name')) < 3) {
            $this->error['person_name'] = 'Person Name must be at least 3 characters in length.';
        }
        
        if($this->person_model->isDuplicate($this->input->post($edit.'person_name'))){
            $this->error['duplicate'] = 'Data already exist.';
        }
        
        // check image validation
        $image = $this->mith_func->uploaded_image($edit."image_pic", $this->path);
        if (isset($image['error'])) {
            $this->error['image'] = $image['error'];
        }else{
            $this->thumbs = $image['upload_data']['file_name'];
        }
        
        if (!$this->error) return true;
        else return false;
    }
}
