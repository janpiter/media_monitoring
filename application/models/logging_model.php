<?php

class logging_model extends CI_Model {

    private $table_name = 'history';

    function __construct() {
        parent::__construct();
        
        // $this->load->model('organization_model', '', TRUE);

        $this->load->library('tank_auth_groups', '', 'tank_auth');
        $this->lang->load('tank_auth');
    }

    function getList($where=array(), $start=0, $limit=0) {
        $this->db->select('*');
        $this->db->from($this->table_name);
        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        
        // $this->db->order_by("organization_name", "asc"); 
        
        if($limit > 0){
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result();
    }

    function insertLog($activity, $table, $id) {
        $log_data = array(
            'activity'          => $activity,
            'activity_detail'   => $data,
            'user_id'           => 
        );
        $this->db->insert($this->table_name, $data);
        $last_id = $this->db->insert_id();
        
        return $last_id;
    }

}