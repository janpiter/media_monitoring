<?php

class logging_model extends CI_Model {

    private $table_name = 'history';

    function __construct() {
        parent::__construct();

        $this->load->library('tank_auth_groups', '', 'tank_auth');
        $this->lang->load('tank_auth');
    }
    
    function get_all() {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->result();
    }

    function insertLog($activity, $table, $id, $data) {
        /*
        action: login, input, update, delete, deactivate
        detail: table_name;id;value
        */
        $data = $data != '' ? json_encode($data) : '';
        $log_data = array(
            'activity'          => $activity,
            'activity_detail'   => $table.';'.$id.';'.$data,
            'user_id'           => $this->tank_auth->get_user_id()
        );
        $this->db->insert($this->table_name, $log_data);
        $last_id = $this->db->insert_id();
        
        return $last_id;
    }

}