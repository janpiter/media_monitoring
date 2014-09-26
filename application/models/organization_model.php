<?php

class organization_model extends CI_Model {

    private $table_name = 'organization';

    function __construct() {
        parent::__construct();

        $CI =& get_instance();
        $CI->load->model('logging_model');
        $this->log = $CI->logging_model;
    }

    function getList($where=array(), $start=0, $limit=0) {
        $this->db->select('*');
        $this->db->from($this->table_name);
        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        
        $this->db->order_by("organization_name", "asc"); 
        
        if($limit > 0){
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result();
    }

    function getOrganization($organization_id) {
        $query = $this->db->get_where($this->table_name, array('organization_id'=>$organization_id));
        
        return $query->row();
    }

    function insertOrganization($data) {
        $this->db->insert($this->table_name, $data);
        $last_id = $this->db->insert_id();
        $this->log->insertLog('input', $this->table_name, $last_id, $data);
        return $last_id;
    }

    function updateOrganization($data) {
        $this->db->where('organization_id', $data['organization_id']);
        $this->db->update($this->table_name, $data);        
        $this->log->insertLog('update', $this->table_name, $data['organization_id'], $data);
    }

    function deleteOrganization($organization_id) {
        $data = $this->getOrganization($organization_id);
        // print_r($data);
        // exit();
        $this->db->where('organization_id', $organization_id);
        $this->db->delete($this->table_name);
        $this->log->insertLog('delete', $this->table_name, $organization_id, $data);
        
        $res = $this->db->_error_number();
        return $res;
    }
        
    function isDuplicate($name) {
        $this->db->where('organization_name', $name);
        $this->db->from($this->table_name);        
        $res = $this->db->count_all_results();

        if($res > 0)  return TRUE;
        else    return FALSE;
    }
    
    function getListOrganization() {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->order_by("organization_name", "asc"); 
        $query = $this->db->get();        
        $n = $query->result();
        
        $nList = array();
        $nList[""] = "-- Choose Organization --";
        foreach ($n as $value) {
            $nList[$value->organization_id] = $value->organization_name;
        }
        
        return $nList;     
    }

}