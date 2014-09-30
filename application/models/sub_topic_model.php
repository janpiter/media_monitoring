<?php

class sub_topic_model extends CI_Model {

    private $table_name = 'sub_topic';
    private $table_join = 'topic';
    
    function __construct() {
        parent::__construct();

        $CI =& get_instance();
        $CI->load->model('logging_model');
        $this->log = $CI->logging_model;

        $this->load->library('tank_auth_groups', '', 'tank_auth');
        $this->lang->load('tank_auth');
    }

    function getList($where=array(), $start=0, $limit=0) {
        $this->db->select($this->table_name.'.*, topic_name');
        $this->db->from($this->table_name);
        $this->db->join($this->table_join, $this->table_join.'.topic_id = '.$this->table_name.'.topic_id', 'left');
        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        
        $this->db->order_by("topic_name", "asc"); 
        $this->db->order_by("subtopic_name", "asc"); 
        
        if($limit > 0){
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result();
    }

    function getSubtopic($subtopic_id) {
        $query = $this->db->get_where($this->table_name, array('subtopic_id'=>$subtopic_id));
        
        return $query->row();
    }

    function insertSubtopic($data) {
        $this->db->insert($this->table_name, $data);
        $last_id = $this->db->insert_id();
        $this->log->insertLog('input', $this->table_name, $last_id, $data);
        return $last_id;
    }

    function updateSubtopic($data) {
        $this->db->where('subtopic_id', $data['subtopic_id']);
        $this->db->update($this->table_name, $data);        
        $this->log->insertLog('update', $this->table_name, $data['subtopic_id'], $data);
    }

    function deleteSubtopic($subtopic_id) {
        $data = $this->getSubtopic($subtopic_id);
        $this->db->where('subtopic_id', $subtopic_id);
        $this->db->delete($this->table_name);
        $this->log->insertLog('delete', $this->table_name, $subtopic_id, $data);
        
        $res = $this->db->_error_number();        
        return $res;
    }
    
    function isDuplicate($data) {
        foreach ($data as $key => $value) {
            $this->db->where($key, $value);
        }        
        $this->db->from($this->table_name);        
        $res = $this->db->count_all_results();

        if($res > 0)  return TRUE;
        else    return FALSE;
    }
    
    function getListSubtopic($topic_id="") {
        $this->db->select('*');
        $this->db->from($this->table_name);
        if($topic_id != ""){
            $this->db->where($this->table_join.'.topic_id', $topic_id);
        }
        $this->db->join($this->table_join, $this->table_join.'.topic_id = '.$this->table_name.'.topic_id', 'left');
        $this->db->order_by("subtopic_name", "asc"); 
        $this->db->order_by("topic_name", "asc");
        $query = $this->db->get();
        $n = $query->result();
        
        $nList = array();
        $nList[""] = "-- Choose Program --";
        foreach ($n as $value) {
            $nList[$value->subtopic_id] = $value->program_name;
        }
//        $this->mith_func->debugVar($nList);
        return $nList;
    }

}