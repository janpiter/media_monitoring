<?php

class topic_model extends CI_Model {

    private $table_name = 'topic';

    function getList($where=array(), $start=0, $limit=0) {
        $this->db->select('*');
        $this->db->from($this->table_name);
        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        
        $this->db->order_by("topic_name", "asc"); 
        
        if($limit > 0){
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result();
    }

    function getTopic($topic_id) {
        $query = $this->db->get_where($this->table_name, array('topic_id'=>$topic_id));
        
        return $query->row();
    }

    function insertTopic($data) {
        $this->db->insert($this->table_name, $data);
        $last_id = $this->db->insert_id();
        
        return $last_id;
    }

    function updateTopic($data) {
        $this->db->where('topic_id', $data['topic_id']);
        $this->db->update($this->table_name, $data);        
    }

    function deleteTopic($topic_id) {
        $this->db->where('topic_id', $topic_id);
        $this->db->delete($this->table_name);
        
        $res = $this->db->_error_number();        
        return $res;
    }
        
    function isDuplicate($name) {
        $this->db->where('topic_name', $name);
        $this->db->from($this->table_name);        
        $res = $this->db->count_all_results();

        if($res > 0)  return TRUE;
        else    return FALSE;
    }
    
    function getListTopic() {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->order_by("topic_name", "asc"); 
        $query = $this->db->get();        
        $n = $query->result();
        
        $nList = array();
        $nList[""] = "-- Choose Topic --";
        foreach ($n as $value) {
            $nList[$value->topic_id] = $value->topic_name;
        }
        
        return $nList;     
    }

}